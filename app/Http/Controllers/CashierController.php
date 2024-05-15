<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Bill;    
use App\Http\Controllers\ItemController;


class CashierController extends Controller
{
    // Gets the items from the db.
    public function getItems() {
        $items = Item::all();
        return $items;
    }

    // Used to populate the dropdown with db items.
    public function index() {
        $items = $this->getItems();
        return view('cashier', ['items' => $items]);
    }

    // Used to populate the bill fields before printing.
    // Used to populate the bill fields before printing.
    public function createBill(Request $request) {
        $item_controller = new ItemController;
        $customerName = $request->input('customer_name');
        $itemNames = $request->input('item_name');
        $prices = $request->input('price');
        $amounts = $request->input('amount');
        $discounts = $request->input('discount');
        $deliveryFee = $request->has('delivery_fee') ? 50 : 0;  // Delivery fee is either $50 or $0

        // Calculate item totals and gross cost
        $itemTotals = [];
        $grossCost = 0;

        foreach ($itemNames as $index => $itemName) 
        {
            if (!empty($itemName) && !empty($amounts[$index])) 
            {
                $itemId = Item::where('name', $itemName)->value('id');
                $price = $prices[$index];
                $amount = $amounts[$index];
                $discount = $discounts[$index];
                $itemTotal = ($price * $amount) * (1 - $discount / 100);
                $itemTotals[] = [
                    'name' => $itemName,
                    'price' => $price,
                    'amount' => $amount,
                    'discount' => $discount,
                    'total' => $itemTotal
                ];
                $grossCost = $grossCost + $itemTotal;
                $item_controller->update_stock($itemId, $amount *-1);
                $item_controller->update_total_sold($itemId, $amount);
            }
        }
        
        $netCost = $grossCost + $deliveryFee; // After discounts
        $duty = $grossCost * 0.16;
        $grossCost = $grossCost + $duty; // net + duty

        return view('bill_preview', 
        [
            'customerName' => $customerName,
            'grossCost' => $grossCost,
            'deliveryFee' => $deliveryFee,
            'netCost' => $netCost,
            'duty' => $duty,
            'itemTotals' => $itemTotals
        ]
    );
    }    

    public function getBills() {
        $bills = Bill::all();
        return $bills;
    }

    public function viewBills() {
        $bills = $this->getBills();
        return view('bills', ['bills' => $bills]);
    }
}