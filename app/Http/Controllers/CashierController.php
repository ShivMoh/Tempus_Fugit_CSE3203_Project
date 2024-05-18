<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\CardPayment;
use App\Models\Contact;
use App\Models\Card;

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CashierController extends Controller
{
    // Used to get item info from the db
    public function getItems()
    {
        $items = Item::all();
        return $items;
    }

    // Creates the register with the db items in the dropdown
    public function index()
    {
        $items = $this->getItems();
        $customers = Customer::all();
        return view('cashier', [
            'items' => $items,
            'customers' => $customers
        ]);
    }

    public function viewBill(Request $request) {
        $bill = Bill::where('id', $request->input('bill_id'))->get();
        $customer = Customer::where('id', $bill[0]->customer_id)->get();

        $data =  [
            'customerName' => $customer[0]->name,
            'grossCost' => $bill[0]->gross_cost,
            'deliveryFee' => $bill[0]->delivery_free, // typo in db --> delivery_fee
            'netCost' => $bill[0]->net_cost,
            'duty' => $bill[0]->duty_and_vat,
            'totalDiscount' => $bill[0]->discount
        ];

        return view('bill_view', $data);
    }

    // Creates the bill preview 
    public function createBill(Request $request)
    {
        // Gets details from the cashier page

        $customerName = null;
        $customerNumber = null;
        $customerEmail = null;
        $customerId = false;
        $cardNumber = false;
        $cardPin = false;
        

        if (!empty($request->input('customer_name'))) {
            // if customer does not exist
            $customerName = $request->input('customer_name');
            $customerNumber = $request->input('customer_number');
            $customerEmail = $request->input('customer_email');
            // Check if customer name is provided without email or phone number
            if (!empty($customerName) && (empty($customerNumber) && empty($customerEmail))) {
                return redirect()->route('customer_error'); // Redirect to customer_error route
            }
        } else {
            $customer = Customer::where('id', $request->input('customer'))->get()[0];
            $contact = Contact::where('id', $customer->contact_id)->get()[0];

            $customerName = $customer->first_name." ".$customer->last_name;
            $customerNumber = $contact->primary_number;
            $customerEmail = $contact->email;
            $customerId = $customer->id;
        }

        if(!empty($request->input('card_details'))) {
            $cardNumber = $request->input('card_details');
        }

        $itemDetails = $this->getItemDetails($request);
        $deliveryFee = $request->has('delivery_fee') ? 50 : 0;
        $costs = $this->calculateCosts($itemDetails, $deliveryFee);

        // Gets the exact discount value for the bill
        $totalDiscount = array_reduce($itemDetails, function ($carry, $item) {
            return $carry + ($item['price'] * $item['amount'] * $item['discount'] / 100);
        }, 0);

        // Stores cash register details in a session
        session([
            'billPreview' => [
                'customerName' => $customerName,
                'customerNumber' => $customerNumber,
                'customerEmail' => $customerEmail,
                'itemDetails' => $itemDetails,
                'costs' => $costs,
                'totalDiscount' => $totalDiscount,
                'customerId' => $customerId,
                "cardNumber" => $cardNumber,
                "cardPin" => $cardPin
            ]
        ]);

        return view('bill_preview', $this->getBillPreviewData($customerName, $costs));
    }


    // Gets all the data needed for the bill preview
    private function getBillPreviewData(string $customerName, array $costs)
    {
        return [
            'customerName' => $customerName,
            'grossCost' => $costs['grossCost'],
            'deliveryFee' => $costs['deliveryFee'],
            'netCost' => $costs['netCost'],
            'duty' => $costs['duty'],
            'totalDiscount' => session('billPreview.totalDiscount')
        ];
    }

    // Creates user, payment id and contact info if entered, else get info from db and create bill
    public function confirmBill(Request $request)
    {
        $billPreview = session('billPreview');

        if (!$billPreview) {
            return redirect()->route('cashier')->with('error', 'No bill to confirm.');
        }

        DB::beginTransaction();

        // try {
            $customerName = $billPreview['customerName'];
            $customerNumber = $billPreview['customerNumber'];
            $customerEmail = $billPreview['customerEmail'];
            $itemDetails = $billPreview['itemDetails'];
            $costs = $billPreview['costs'];
            $customerId = $billPreview['customerId'];
            $cardNumber = $billPreview['cardNumber'];
            $cardPin = $billPreview['cardPin'];

            $totalDiscount = array_reduce($itemDetails, function ($carry, $item) {
                return $carry + ($item['price'] * $item['amount'] * $item['discount'] / 100);
            }, 0);

            // $customerId = null;
            $contactId = null;
            $paymentId = null;

            if (!$customerId) {
                $contact = new Contact([
                    "id" => (string) Str::uuid(),
                    "primary_number" => $customerNumber,
                    "secondary_number" => 'N/A',
                    "email" => $customerEmail,
                ]);
    
                $contact->save();    
                $contactId = $contact->id;

            } else {
                $customer = Customer::where('id', $customerId)->get()[0];
                $contact = Contact::where("id", $customer->contact_id)->get()[0];
                $contactId = $contact->id;  
            }
            

            if ($cardNumber) {

                $payment = new Payment([
                    "id" => (string) Str::uuid(),
                    "cash" => true,
                    "amount" => $costs['netCost'],
                ]);

                $card = Card::where("card_number", $request->input('card_details'))->get();

                if(!empty($card)) {
                    $card = new Card([
                        "id" => (string) Str::uuid(),
                        "card_holder" => $customerName,
                        "card_number"=>$cardNumber,
                        "security_pin"=>"242",
                        "expirary_date"=>"2025-05-23",
                        "company_card"=>false
                    ]);    
                    $card->save();
                } else {
                    $card = $card[0];
                }

                $card_payment = new CardPayment([
                    "id" => (string) Str::uuid(),
                    "payment_id" => $payment->id,
                    "card_id"=>$card->id
                ]);

                $payment->save();
                $card_payment->save();
        
            } else {
                $payment = new Payment([
                    "id" => (string) Str::uuid(),
                    "cash" => true,
                    "amount" => $costs['netCost'],
                ]);

                $payment->save();
            }

            $paymentId = $payment->id;

            if(!$customerId) {
                $customerId = $this->createCustomer($customerName, $contactId, $paymentId);
            }

            $bill = new Bill([
                'id' => (string) Str::uuid(),
                'gross_cost' => $costs['grossCost'],
                'net_cost' => $costs['netCost'],
                'discount' => $totalDiscount,
                'duty_and_vat' => $costs['duty'],
                'delivery_free' => $costs['deliveryFee'] ?? 0,
                'user_id' => Auth::id(),
                'customer_id' => $customerId,
                'payment_id' => $paymentId
            ]);

            $bill->save();

            foreach ($itemDetails as $itemDetail) {
                $this->updateStockAndSoldCount($itemDetail);
                $this->addTransaction($itemDetail, $bill->id);
            }

            DB::commit();

            session()->forget('billPreview');

            return redirect()->route('bill_success')->with('success', 'Bill confirmed and saved successfully.');
        // } 
        // catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->route('cashier')->with('error', 'Failed to confirm and save bill.');
        // }
    }

    private function getItemDetails(Request $request)
    {
        // Make them empty if viewing bills alone
        $itemDetails = [];
        $itemNames = $request->input('item_name', []);
        $prices = $request->input('price', []);       
        $amounts = $request->input('amount', []);     
        $discounts = $request->input('discount', []); 

        foreach ($itemNames as $index => $itemName) {
            if (!empty($itemName) && !empty($amounts[$index])) {
                $itemId = Item::where('name', $itemName)->value('id');
                $itemDetails[] = [
                    'id' => $itemId,
                    'name' => $itemName,
                    'price' => $prices[$index],
                    'amount' => $amounts[$index],
                    'discount' => $discounts[$index],
                    'total' => ($prices[$index] * $amounts[$index]) * (1 - $discounts[$index] / 100),
                ];
            }
        }

        return $itemDetails;
    }

    private function calculateCosts(array $itemDetails, $deliveryFee)
    {
        $grossCost = 0;

        foreach ($itemDetails as $itemDetail) {
            $grossCost += $itemDetail['total'];
        }

        $duty = $grossCost * 0.16;
        $netCost = $grossCost + $deliveryFee;
        $grossCost += $duty;

        return [
            'grossCost' => $grossCost,
            'netCost' => $netCost,
            'deliveryFee' => $deliveryFee,
            'duty' => $duty,
        ];
    }

    private function updateStockAndSoldCount(array $itemDetail)
    {
        $itemController = new ItemController;
        $itemController->update_stock($itemDetail['id'], $itemDetail['amount'] * -1);
        $itemController->update_total_sold($itemDetail['id'], $itemDetail['amount']);
    }

    private function addTransaction(array $itemDetail, string $billId)
    {
        $transaction = new Transaction([
            'id' => (string) Str::uuid(),
            'count' => $itemDetail['amount'],
            'total_cost' => $itemDetail['total'],
            'item_id' => $itemDetail['id'],
            'bill_id' => $billId
        ]);

        $transaction->save();
    }

    private function getCustomerIdByName(string $customerName)
    {
        $customer = Customer::where('first_name', $customerName)->orWhere('last_name', $customerName)->first();
        return $customer ? $customer->id : null;
    }

    private function createCustomer(string $customerName, string $contactId, string $paymentId)
    {
        $customer = explode(" ", $customerName);

        if(count($customer) == 1) {
            array_push($customer, " ");
        }

        $newCustomer = new Customer([
            'id' => (string) Str::uuid(),
            'first_name' => $customer[0],
            'last_name' => $customer[1],
            'contact_id' => $contactId,
            'payment_id' => $paymentId
        ]);

        $newCustomer->save();

        return $newCustomer->id;
    }

    public function getBills()
    {
        $bills = Bill::all();
        return $bills;
    }

    public function viewBills()
    {
        $bills = Bill::with('customer')->get();
        return view('bills', ['bills' => $bills]);
    }

    public function customerError()
    {
        return view('customer_error');
    }
}

