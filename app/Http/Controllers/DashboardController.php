<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the total_cost and created_at columns from the transaction table
        $transactions = Transaction::all();

        $recentTransactions = DB::table('transactions')
            ->join('items', 'transactions.item_id', '=', 'items.id')
            ->select('transactions.*', 'items.name as item_name')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Fetch the top 3 highest selling items
        $topSellingItems = DB::table('items')
            ->select('name', 'total_sold')
            ->orderBy('total_sold', 'desc')
            ->limit(3)
            ->get();

        $highestStockItems = DB::table('items')
            ->select('name', 'stock_count')
            ->orderBy('stock_count', 'desc')
            ->limit(3)
            ->get();

        $lowestStockItems = DB::table('items')
            ->select('name', 'stock_count')
            ->orderBy('stock_count', 'asc')
            ->limit(3)
            ->get();

        // Fetch category data for doughnut chart
        $categoryData = DB::table('items')
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', DB::raw('count(*) as total'))
            ->groupBy('categories.name')
            ->get();

        // Prepare the data for Chart.js
        $labels = [];
        $data = [];
        foreach ($categoryData as $item) {
            $labels[] = $item->category_name;
            $data[] = $item->total;
        }

        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                ]
            ]
        ];

        // Pass the data to the dashboard view
        return view('dashboard', compact('transactions', 'recentTransactions', 'topSellingItems', 'highestStockItems', 'lowestStockItems', 'chartData'));
    }

}
