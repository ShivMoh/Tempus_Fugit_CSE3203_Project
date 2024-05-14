<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Bill;

class CashierController extends Controller
{
    public function getItems() {
        $items = Item::all();
        return $items;
    }

    public function index() {
        $items = $this->getItems();
        return view('cashier', ['items' => $items]);
    }

    public function createBill() {
        return view('bill_preview');
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