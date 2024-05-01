<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Contact;

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
        
        return view('supplier/test', 
            [
                'suppliers' => $result,
            ]
        );
    }
    //
    function test() {

        return view('supplier/test', [
            
            'name'=>'somebody that i used to know',
            'test_arr'=>[0, 1, 2, 3, 4]
        ]);
    }
}
