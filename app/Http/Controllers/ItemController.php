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
