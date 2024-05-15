<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Support\Str;

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
     *//* 
    public function create_item()
    {
        return view('inventory.create');
    } */

    public function store_item(){
        // TODO
        request()->validate([
            'name'=>'required|string|max:255',
            'selling_price'=>'required|numeric|min:0',
            'cost_price'=>'required|numeric|min:0',
            'total_sold'=>'required|integer|min:0',
            'stock_count'=>'required|integer|min:0',
            'image_url'=>'nullable|string',
            'supplier_id'=>'nullable|string',
            'category_id'=>'nullable|string',
        ]);

        $item = new Item([
            'id' => (string) Str::uuid(),
            'name'=>request('name'),
            'selling_price'=>request('selling_price'),
            'cost_price'=>request('cost_price'),
            'total_sold'=>request('total_sold'),
            'stock_count'=>request('stock_count'),
            'image_url'=>request('image_url'),
            'supplier_id'=>request('supplier_id'),
            'category_id'=>request('category_id'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show_individual(Request $request)
    {
        // the item's name is id
        $itemId = $request->input('id');
        $item = Item::findOrFail($itemId);
        if ($item != null){
            $info = array();
            $category = Category::where('id',$item->category_id)->value('name');
            $supplier = Supplier::where('id',$item->supplier_id)->value('name');

            array_push($info,
            [
                'item'=>$item,
                'category'=>$category,
                'supplier'=>$supplier
            ]);

            return view('inventory.solo',
                [
                    'info'=>$info
                ]
            );
        }
        else{
            abort(404, "Item not found");
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_stock(Request $request, int $amount)
    {

        //TODO: this function needs to be called when sold AND ordered
        // Assuming you're passing the item ID via the request
        $itemId = $request->input('item_id');

        // Retrieve the item from the database
        $item = Item::findOrFail($itemId);

        // Update the stock count
        $item->stock_count += $amount;
        
        // Save the updated item
        $item->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
