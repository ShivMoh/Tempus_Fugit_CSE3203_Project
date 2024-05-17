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
        return view('cashier', ['items' => $items]);
    }

    // Creates the bill preview 
    public function createBill(Request $request)
    {
        // Gets details from the cashier page
        $customerName = $request->input('customer_name');
        $customerNumber = $request->input('customer_number');
        $customerEmail = $request->input('customer_email');
        $itemDetails = $this->getItemDetails($request);
        $costs = $this->calculateCosts($itemDetails, $request->has('delivery_fee'));

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
                'totalDiscount' => $totalDiscount
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

        try {
            $customerName = $billPreview['customerName'];
            $customerNumber = $billPreview['customerNumber'];
            $customerEmail = $billPreview['customerEmail'];
            $itemDetails = $billPreview['itemDetails'];
            $costs = $billPreview['costs'];

            $totalDiscount = array_reduce($itemDetails, function ($carry, $item) {
                return $carry + ($item['price'] * $item['amount'] * $item['discount'] / 100);
            }, 0);

            $customerId = null;
            $contactId = null;
            $paymentId = null;

            if (!empty($customerNumber) && !empty($customerEmail)) {
                $contact = new Contact([
                    "id" => (string) Str::uuid(),
                    "primary_number" => $customerNumber,
                    "secondary_number" => 'N/A',
                    "email" => $customerEmail,
                ]);

                $contact->save();
                $contactId = $contact->id;

                if ($request->has('card_details')) {
                    $payment = new CardPayment([
                        "id" => (string) Str::uuid(),
                        "card_number" => $request->input('card_details'),
                        "amount" => $costs['netCost'],
                    ]);
                } else {
                    $payment = new Payment([
                        "id" => (string) Str::uuid(),
                        "cash" => true,
                        "amount" => $costs['netCost'],
                    ]);
                }

                $payment->save();
                $paymentId = $payment->id;

                $customerId = $this->createCustomer($customerName, $contactId, $paymentId);
            } else {
                $customerId = $this->getCustomerIdByName($customerName);
                if ($customerId) {
                    $customer = Customer::find($customerId);
                    $contactId = $customer->contact_id;
                    $paymentId = $customer->payment_id;
                }
            }

            $bill = new Bill([
                'id' => (string) Str::uuid(),
                'gross_cost' => $costs['grossCost'],
                'net_cost' => $costs['netCost'],
                'discount' => $totalDiscount,
                'duty_and_vat' => $costs['duty'],
                'delivery_fee' => $costs['deliveryFee'],
                'user_id' => Auth::id(),
                'customer_id' => $customerId
            ]);

            $bill->save();

            foreach ($itemDetails as $itemDetail) {
                $this->updateStockAndSoldCount($itemDetail);
                $this->addTransaction($itemDetail, $bill->id);
            }

            DB::commit();

            session()->forget('billPreview');

            return redirect()->route('bill_success')->with('success', 'Bill confirmed and saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cashier')->with('error', 'Failed to confirm and save bill.');
        }
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


    private function calculateCosts(array $itemDetails, bool $hasDeliveryFee)
    {
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

    public function getBills()
    {
        $bills = Bill::all();
        return $bills;
    }

    public function viewBills()
    {
        $bills = $this->getBills();
        return view('bills', ['bills' => $bills]);
    }
}
