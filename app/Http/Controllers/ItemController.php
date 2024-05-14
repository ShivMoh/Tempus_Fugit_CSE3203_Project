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
        //Get list of items
        $items = Item::all();

        $result = array();
        // Search functionality
        if ($request->input('search') != ""){
            $items = Item::where('name','like', '%', $request->input('search').'%')->get();
        }

        return view('inventory.inventory',
            [
                "items"=> $items
            ]
        );
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
