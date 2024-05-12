<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class CashierController extends Controller
{
    public function getItems()
    {
        $items = Item::all();
        return $items;
    }

    public function index() {
        $items = $this->getItems();
        return view('cashier', ['items' => $items]);
    }
}