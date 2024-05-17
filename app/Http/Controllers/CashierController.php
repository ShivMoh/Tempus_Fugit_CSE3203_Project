<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Contact;
use App\Models\CardPayment;

use App\Http\Controllers\ItemController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CashierController extends Controller
{
    // used to get item info from the db
    public function getItems() {
        $items = Item::all();
        return $items;
    }

    // creates the register with the db items in the dropdown
    public function index() {
        $items = $this->getItems();
        return view('cashier', ['items' => $items]);
    }

    // Creates the bill preview 
    public function createBill(Request $request)
    {
        // gets details from the cashier page
        $customerName = $request->input('customer_name');
        $itemDetails = $this->getItemDetails($request);
        $costs = $this->calculateCosts($itemDetails, $request->has('delivery_fee'));

        // gets the exact discount value for the bill
        $totalDiscount = array_reduce($itemDetails, function ($carry, $item) {
            return $carry + ($item['price'] * $item['amount'] * $item['discount'] / 100);
        }, 0);

        session([
            'billPreview' => [
                'customerName' => $customerName,
                'itemDetails' => $itemDetails,
                'costs' => $costs,
                'totalDiscount' => $totalDiscount
            ]
        ]);

        return view('bill_preview', $this->getBillPreviewData($customerName, $costs));
    }

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

    public function confirmBill()
    {
        $billPreview = session('billPreview');

        if (!$billPreview) {
            return redirect('/cashier')->with('error', 'No bill to confirm.');
        }

        $customerName = $billPreview['customerName'];
        $itemDetails = $billPreview['itemDetails'];
        $costs = $billPreview['costs'];

        $totalDiscount = array_reduce($itemDetails, function ($carry, $item) {
            return $carry + ($item['price'] * $item['amount'] * $item['discount'] / 100);
        }, 0);

       

        
        $payment = new Payment([
            "id"=>(string) Str::uuid(),
            "cash"=>false,
            "amount"=>0,
        ]);
        
        $contact = new Contact(
        [
            "id"=>(string) Str::uuid(),
            "primary_number" => '123',
            "secondary_number" => '123',
            "email" => "1@gmail.com"
            ]
        );
            
            //  $card_payment = new CardPayment([
                //      "id"=>(string) Str::uuid(),
                //      "payment_id"=>$payment->id,
                //      "card_id"=>$request->input('card')
                //  ]);
                
                $contact->save();
                $payment->save();
                $customerId = $this->getOrCreateCustomerId($customerName, $contact->id, $payment->id);

                $bill = new Bill([
                    'id' => (string) Str::uuid(),
                    'gross_cost' => $costs['grossCost'],
                    'net_cost' => $costs['netCost'],
                    'discount' => $totalDiscount,
                    'duty_and_vat' => $costs['duty'],
                    'delivery_free' => $costs['deliveryFee'],
                    'employee_id' => Auth::id(),
                    'customer_id' => $customerId
                ]);

                $bill->save();
                
                foreach ($itemDetails as $itemDetail) {
            $this->updateStockAndSoldCount($itemDetail);
            $this->addTransaction($itemDetail, $bill->id);
        }

        session()->forget('billPreview');

        return redirect('/cashier')->with('success', 'Bill confirmed and saved successfully.');
    }

    private function getItemDetails(Request $request) {
        $itemDetails = [];
        $itemNames = $request->input('item_name');
        $prices = $request->input('price');
        $amounts = $request->input('amount');
        $discounts = $request->input('discount');

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

    private function calculateCosts(array $itemDetails, bool $hasDeliveryFee) {
        $grossCost = 0;
        foreach ($itemDetails as $itemDetail) {
            $grossCost += $itemDetail['total'];
        }

        $deliveryFee = $hasDeliveryFee ? 50 : 0;
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

    private function updateStockAndSoldCount(array $itemDetail) {
        $itemController = new ItemController;
        $itemController->update_stock($itemDetail['id'], $itemDetail['amount'] * -1);
        $itemController->update_total_sold($itemDetail['id'], $itemDetail['amount']);
    }

    private function addTransaction(array $itemDetail, string $billId) {
        $transaction = new Transaction([
            'count' => $itemDetail['amount'],
            'total_cost' => $itemDetail['total'],
            'item_id' => $itemDetail['id'],
            'bill_id' => $billId
        ]);

        $transaction->save();
    }

    public function getBills() {
        $bills = Bill::all();
        return $bills;
    }

    public function viewBills() {
        $bills = $this->getBills();
        return view('bills', ['bills' => $bills]);
    }

    private function getOrCreateCustomerId(string $customerName, string $contactId, string $paymentId)
    {
        $customer = Customer::where('first_name', $customerName)->orWhere('last_name', $customerName)->first();

        if ($customer) {
            return $customer->id;
        }

        $newCustomer = new Customer([
            'id' => (string) Str::uuid(),
            'first_name' => $customerName,
            'last_name' => '',
            'contact_id' => $contactId,
            'payment_id' => $paymentId
        ]);

        $newCustomer->save();

        return $newCustomer->id;
    }
}