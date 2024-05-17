<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index(Request $request)
    {
        //Get list of all items
        $items = Item::all();

        // Search functionality
        if ($request->has('search') && $request->input('search') != "") {
            $searchTerm = $request->input('search');
            $searchResults = Item::where('name', 'like', '%' . $searchTerm . '%')->get();
            return view('inventory.inventory', ["items" => $searchResults]);
        }

        return view('inventory.inventory', ["items" => $items]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function add_new(Request $request)
    {
        $categories = Category::all();
        $info = array();
        $suppliers = Supplier::all();
        

        $cat_list = array();
        foreach ($categories as $category) {
            $cat_list[$category->id] = $category->name;
        }

        $sup_list = array();
        foreach ($suppliers as $supplier) {
            $sup_list[$supplier->id] = $supplier->name; 
        }
        array_push($info,
        [
           'categories'=> $cat_list,
           'suppliers'=> $sup_list,
        ]);
        return view('inventory.add-new',[
            'info' => $info
        ]
    );
    }

    public function store_item(Request $request){
        // TODO
        $validatedData = $request->validate([
            'name' => 'required|string',
            'selling_price' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'image_url' => 'nullable|url',
            'category' => 'required|string', // Assuming category is a string, adjust if needed
            'supplier' => 'required|string', // Assuming supplier is a string, adjust if needed
        ]);

        // Create a new Item instance
        $item = new Item();
        $item->id = Str::uuid();
        $item->name = $validatedData['name'];
        $item->selling_price = $validatedData['selling_price'];
        $item->cost_price = $validatedData['cost_price'];
        $item->image_url = $validatedData['image_url'];
        $item->category_id = $validatedData['category'];
        $item->supplier_id = $validatedData['supplier'];
        $item->total_sold = 0;
        $item->stock_count= 0;

        // Default amount in stock and sold is 0, so no need to set it explicitly

        // Save the item to the database
        $item->save();
        $data = [
            'supplier' => $validatedData['supplier'],
            'item' => $item->id
        ];
        
        return view('inventory.confirm',
        [
            'data' =>$data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show_individual(Request $request)
    {
        $itemId = $request->input('id');
        $transactions = Transaction::all();


        $item = Item::findOrFail($itemId);
        if ($item != null){
            //Put the chart data here: Daily Sales, Profit Per Sale, Daily Earning
            $dailySales = DB::table('transactions')
                ->select(DB::raw('DATE(created_at) as day'), DB::raw('SUM(count) as daily_sales'))
                ->where('item_id', $itemId)
                ->groupBy(DB::raw('DATE(created_at)'))
                ->get();
            // echo(json_encode($dailySales));

            $totalProfitPerTransaction = DB::table('transactions')
                ->join('items', 'transactions.item_id', '=', 'items.id')
                ->select('transactions.id', 'transactions.count', 'transactions.total_cost', 'items.selling_price', 'items.cost_price')
                ->addSelect(DB::raw('(transactions.count * (items.selling_price - items.cost_price)) as total_profit'))
                ->get();
            // echo(json_encode($totalProfitPerTransaction));
                
            $totalEarningsPerDay = DB::table('transactions')
                ->select(DB::raw('DATE(created_at) as transaction_date'), DB::raw('SUM(total_cost) as total_earnings'))
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy(DB::raw('DATE(created_at)'), 'desc')
                ->get();
            // echo(json_encode($totalEarningsPerDay));


            

            $info = array();
            $category = Category::where('id',$item->category_id)->value('name');
            $supplier = Supplier::where('id',$item->supplier_id)->value('name');

            array_push($info,
            [
                'item'=>$item,
                'category'=>$category,
                'supplier'=>$supplier
            ]);

            return view('inventory.solo',compact('info', 'dailySales', 'totalProfitPerTransaction', 'totalEarningsPerDay'));
        }
        else{
            abort(404, "Item not found");
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_stock(string $id, int $amount)
    {
        $itemId = $id;

        // Retrieve the item from the database
        $item = Item::findOrFail($itemId);

        // Update the stock count
        $item->stock_count += $amount;
        
        // Save the updated item
        $item->save();
    }

    public function update_total_sold(string $id, int $amount)
    {
        $itemId = $id;

        // Retrieve the item from the database
        $item = Item::findOrFail($itemId);

        // Update the stock count
        $item->total_sold += $amount;
        
        // Save the updated item
        $item->save();
    }

}
