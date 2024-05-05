<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Contact;
use App\Models\Item;

use Illuminate\Support\Str;

class SupplierController extends Controller
{

    public function index() {

        $suppliers = Supplier::all();
        $contacts = array();

        $result = array();
        foreach ($suppliers as $supplier) {

            $contact = Contact::where('id', $supplier->contact_id)->get();
            
            array_push($result, 
                array(
                    'supplier'=>$supplier,
                    'contact'=>$contact[0]
                )
            );
        }
        
        return view('supplier/supplier', 
            [
                'suppliers' => $result,
            ]
        );
    }

    public function get_request_form(Request $request) {
        $supplier = Supplier::where('id', $request->input('id'))->get(); 

        $items = Item::where('supplier_id', $supplier[0]->id)->get();
        
        $result = array();

        array_push($result, 
            array(
                'supplier'=>$supplier[0],
                'items'=>$items
            )
        );

        return view('supplier/request-form', [
            'result' => $result
        ]);
    }

    public function order_item(Request $request) {
        $data = array(
            'items'=>$request->input('items'),
            'supplier'=>$request->input('supplier'),
            'line_1'=>$request->input('line-1'),
            'line_2'=>$request->input('line-2'),
            'city'=>$request->input('city'),
            'state'=>$request->input('state'),
            'country'=>$request->input('country'),
            'zip'=>$request->input('zip'),
            'card_holder'=>$request->input('card-holder'),
            'card_number'=>$request->input('card-number'),
            'security_pin'=>$request->input('security-pin'),
            'expirary_date'=>$request->input('expirary-date')
        );
        
        // for each item, create a order item
        // create a order
        // link order to address -> should seed to a default company payment
        // link order to payment detail -> should seed to a default company payment
        // link each order item to the newly created order
        
        return view('supplier/test', [
            'result'=>$data
        ]);
    }

    //
    function test() {

        return view('supplier/test', [
            
            'name'=>'somebody that i used to know',
            'test_arr'=>[0, 1, 2, 3, 4]
        ]);
    }
}
