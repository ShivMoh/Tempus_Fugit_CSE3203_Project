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

    public function index()
{
    $items = $this->getItems();


    // Calculates the total sales received from customers
    $receivedFromCustomers = $items->sum(function ($item) {
        return $item->selling_price * $item->total_sold;
    });

    // Calculates the total costs given to suppliers
    $givenToSuppliers = $items->sum(function ($item) {
        return $item->cost_price * $item->total_sold;
    });

    // Calculates net balance 
    $netBalance = $receivedFromCustomers - $givenToSuppliers;

    // Calculates profit 
    $profits = $receivedFromCustomers - $givenToSuppliers;

    return view('sales', [
        'netBalance' => $netBalance,
        'givenToSuppliers' => $givenToSuppliers,
        'receivedFromCustomers' => $receivedFromCustomers,
        'profits' => $profits,
        'items' => $items,
    ]);
}   

}