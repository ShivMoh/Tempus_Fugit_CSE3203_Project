<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class SalesController extends Controller
{
    public function getItems()
    {
        return Item::all();
    }

    public function index()
    {
        $items = $this->getItems();

        // Initialize arrays for labels and data
        $labels = [];
        $sales = [];
        $profitsData = [];
        $costs = [];

        // Calculate data for each item
        foreach ($items as $item) {
            $labels[] = $item->name;
            $sales[] = $item->selling_price * $item->total_sold;
            $costs[] = $item->cost_price * $item->total_sold;
            $profitsData[] = ($item->selling_price - $item->cost_price) * $item->total_sold;
        }

        // Calculate total received from customers and given to suppliers
        $receivedFromCustomers = array_sum($sales);
        $givenToSuppliers = array_sum($costs);
        $netBalance = $receivedFromCustomers - $givenToSuppliers;
        $profits = $receivedFromCustomers - $givenToSuppliers;

        return view('sales', [
            'netBalance' => $netBalance,
            'givenToSuppliers' => $givenToSuppliers,
            'receivedFromCustomers' => $receivedFromCustomers,
            'profits' => $profits,
            'labels' => $labels,
            'sales' => $sales,
            'profitsData' => $profitsData,
            'costs' => $costs,
        ]);
    }

}