<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class SalesController extends Controller
{
    public function getItems()
    {
        $items = Item::all();
        return $items;
    }

    public function index() {
        $items = $this->getItems();
        return view('sales', ['items' => $items]);
    }
}