<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Contact;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\CardPayment;
use App\Models\Card;
use App\Models\Address;

use Illuminate\Support\Str;
use Carbon\Carbon;

class SupplierController extends Controller
{

    public function index(Request $request) {

        $suppliers = Supplier::all();
        $contacts = array();

        $result = array();
        $no_results = false;

        if($request->input('search') != "") {
            $suppliers = Supplier::where("name", 'like', '%'.$request->input('search').'%')->get();
            
            if(count($suppliers) != 0) {
                $contact = Contact::where('id', $suppliers[0]->contact_id)->get();

                array_push($result, 
                    array(
                        'supplier'=>$suppliers[0],
                        'contact'=>$contact[0]
                    )
                );
            } else {
               $no_results = true;
            }

            
        } else {
            foreach ($suppliers as $supplier) {

                $contact = Contact::where('id', $supplier->contact_id)->get();
                
                array_push($result, 
                    array(
                        'supplier'=>$supplier,
                        'contact'=>$contact[0]
                    )
                );
            }    
        }
        
        return view('supplier/supplier', 
            [
                'suppliers' => $result,
                'error' => $no_results
            ]
        );
    }

    public function review(Request $request) {

        $card = Card::where('id', $request->input('payment'))->get();
        $supplier = Supplier::where('id', $request->input('supplier'))->get();
        $address = Address::where('company_address', true)->get();
        
        $item_names = array();
        $item_amounts = array();
        foreach(explode("|", $request->input('items')) as $item) {
            $data = explode("X", $item);

            // $item_id = preg_replace('/\s+/', '', $data[1]);

            $item_id = preg_replace('/\s+/', '', explode("x", $data[1])[1]);
            $retrieved_item = Item::where('id', $item_id)->get();

            array_push($item_names, $retrieved_item);
            array_push($item_amounts, $data[0]);

        }

        return view('supplier/review', [
                'supplier'=>$supplier,
                'card'=>$card,
                'address'=>$address,
                'item_names'=>$item_names,
                'item_amounts'=>$item_amounts,
                'items'=> preg_replace('/\s+/', '', $request->input('items'))
            ]
        );
    }

    public function get_request_form(Request $request) {
        $supplier = Supplier::where('id', $request->input('id'))->get(); 

        $items = Item::where('supplier_id', $supplier[0]->id)->get();
        
        // company has multiple cards to use for payments
        $company_cards = Card::where('company_card', true)->get();
        
        $result = array();

        array_push($result, 
            array(
                'supplier'=>$supplier[0],
                'items'=>$items,
                'cards'=>$company_cards
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
        );

        error_log("message");

        // echo $data['items'];

        $payment = new Payment([
            "id"=>(string) Str::uuid(),
            "cash"=>false
        ]);

        $card_payment = new CardPayment([
           "id"=>(string) Str::uuid(),
           "payment_id"=>$payment->id,
           "amount"=>0,
           "card_id"=>"d625a5d9-7277-46df-8c5e-970e8770ab67"
        ]);

        // create a order
        $order = new Order([
            "id"=>(string) Str::uuid(),
            "gross_cost"=>0.0,
            "net_cost"=>0.0,
            "duty_and_vat"=>0.0,
            "insurance_fee"=>10000.0,
            "processing_fee"=>10000.0,
            "shipping_fee"=>5000,
            "order_date"=>Carbon::now(),
            "date_arrived"=>Carbon::now(),
            "received"=>false,
            "user_id"=>"f1d09c2a-b362-4ec9-b736-292b5fcbff3d",
            "supplier_id"=>$data['supplier'],
            "payment_id"=> $payment->id,
            "address_id"=> "2d9d32a9-0d08-43c0-a0a5-48f9d5d9aad2"
        ]);

        $order_items = array();

        
        // for each item, create a order item
        foreach(explode("|", $data['items']) as $item) {
            $data = explode("X", $item);

            if (count($data) != 2) {
                break;
            }

            $item_amount = $data[0];
            $item_id = preg_replace('/\s+/', '', explode("x", $data[1])[1]);
            
            $order_item = new OrderItem([
                "id"=>(string) Str::uuid(),
                "amount"=>(int) $item_amount,
                "item_id"=>$item_id,
                "order_id"=>$order->id,
            ]);

            $retrieved_item = Item::where('id', $item_id)->get();
            $item_cost = $retrieved_item[0]->selling_price;

            array_push($order_items, $order_item);
            $order->gross_cost += $item_cost;

        }

        $order->duty_and_vat = 0.16 * $order->gross_cost;
        $order->net_cost = $order->gross_cost - $order->duty_and_vat;
        $payment->amount = $order->net_cost;

        $payment->save();
        $card_payment->save();
        $order->save();

        foreach ($order_items as $order_item) {
            $order_item->save();
        }

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
