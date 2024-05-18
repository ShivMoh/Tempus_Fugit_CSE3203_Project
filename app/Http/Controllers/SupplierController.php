<?php

namespace App\Http\Controllers;

use Illuminate\View\Middleware\ShareErrorsFromSession;
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
        
        $request->validate([
            'item'=>'required',
            'amount'=>'required|integer',
            'payment'=>'required'
        ]);

        $card = Card::where('id', $request->input('payment'))->get();
        $supplier = Supplier::where('id', $request->input('supplier'))->get();
        $address = Address::where('company_address', true)->get();

        $processing_fee = $supplier[0]->processing_fee;
        $shipping_fee = $supplier[0]->shipping_fee;
        $insurance_fee = $supplier[0]->insurance_fee;

        $item_names = array();
        $item_amounts = array();
        $total_cost = 0;

        foreach(explode("|", $request->input('items')) as $item) {
            $data = explode("X", $item);
            $item_id = preg_replace('/\s+/', '', explode("x", $data[1])[1]);
            $retrieved_item = Item::where('id', $item_id)->get();
            $total_cost += ((int) $data[0]) * $retrieved_item[0]->selling_price;
            array_push($item_names, $retrieved_item);
            array_push($item_amounts, $data[0]);
        }

        $vat = 0.16 * $total_cost;
        $gross_cost = $total_cost;
        $total_cost += $insurance_fee + $processing_fee + $shipping_fee + $vat;

        return view('supplier/review', [
                'supplier'=>$supplier,
                'card'=>$card,
                'address'=>$address,
                'item_names'=>$item_names,
                'item_amounts'=>$item_amounts,
                'items'=> preg_replace('/\s+/', '', $request->input('items')),
                'total_cost'=>$total_cost,
                'gross_cost'=>$gross_cost,
                'insurance_fee'=>$insurance_fee,
                'processing_fee'=>$processing_fee,
                'shipping_fee'=>$shipping_fee,
                'vat'=>$vat
            ]
        );
    }


    public function view_bill(Request $request) {
        $card = Card::where('id', $request->input('payment'))->get();
        $supplier = Supplier::where('id', $request->input('supplier'))->get();
        $address = Address::where('company_address', true)->get();
        $total_cost = 0;
        $item_names = array();
        $item_amounts = array();

        $processing_fee = $supplier[0]->processing_fee;
        $shipping_fee = $supplier[0]->shipping_fee;
        $insurance_fee = $supplier[0]->insurance_fee;


        foreach(explode("|", $request->input('items')) as $item) {
            $data = explode("X", $item);
            $item_id = preg_replace('/\s+/', '', explode("x", $data[1])[1]);
            $retrieved_item = Item::where('id', $item_id)->get();
            $total_cost += ((int) $data[0]) * $retrieved_item[0]->selling_price;
            array_push($item_names, $retrieved_item);
            array_push($item_amounts, $data[0]);
        }

        $vat = 0.16 * $total_cost;
        $total_cost += $insurance_fee + $processing_fee + $shipping_fee + $vat;


        return view('supplier/order_bill', [
                'supplier'=>$supplier,
                'card'=>$card,
                'address'=>$address,
                'item_names'=>$item_names,
                'item_amounts'=>$item_amounts,
                'items'=> preg_replace('/\s+/', '', $request->input('items')),
                'total_cost'=>$total_cost,
                'insurance_fee'=>$insurance_fee,
                'processing_fee'=>$processing_fee,
                'shipping_fee'=>$shipping_fee,
                'vat'=>$vat
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

        // error_log("message");

        // echo $data['items'];

        $supplier = Supplier::where('id', $data['supplier'])->get()[0];
        
        // create each transaction for item
        // create bill
        // link each transaction to bill
        // create payment
        //  


        $payment = new Payment([
           "id"=>(string) Str::uuid(),
           "cash"=>false,
           "amount"=>$request->input('net-cost'),
        ]);

        $card_payment = new CardPayment([
            "id"=>(string) Str::uuid(),
            "payment_id"=>$payment->id,
            "card_id"=>$request->input('card')
        ]);


        // create a order
        $order = new Order([
            "id"=>(string) Str::uuid(),
            "gross_cost"=>$request->input('gross-cost'),
            "net_cost"=>$request->input('net-cost'),
            "duty_and_vat"=>(0.16 * $request->input('gross-cost')),
            "insurance_fee"=>$supplier->insurance_fee, // standard fee
            "processing_fee"=>$supplier->processing_fee, // standard fee
            "shipping_fee"=>$supplier->shipping_fee, // standard fee
            "order_date"=>Carbon::now(),
            "date_arrived"=>Carbon::now(),
            "received"=>false,
            "user_id"=>$request->user()->id,
            "supplier_id"=>$data['supplier'],
            "payment_id"=> $payment->id,
            "address_id"=> "2d9d32a9-0d08-43c0-a0a5-48f9d5d9aad2" // links to company address. Business only has one location so value is hardcoded.
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
        }
        
        $payment->save();
        $card_payment->save();
        $order->save();

        foreach ($order_items as $order_item) {
            $order_item->save();
        }

        // link order to address -> should seed to a default company payment
        // link order to payment detail -> should seed to a default company payment
        // link each order item to the newly created order
        
        return redirect('/supplier');
    }

    public function view_orders() {
        $orders = Order::orderBy('id', 'ASC')->get(); 
        $suppliers = array();
        $cards = array();
        $items = array();
        $items_string = "";

        /*2XRandom_Itemx06ac9ba3-27e7-4026-a838-591e7a08a778 | 3XRandom_Itemx06ac9ba3-27e7-4026-a838-591e7a08a778 */

        foreach ($orders as $order) {
            $supplier = Supplier::where('id', $order->supplier_id)->get();
            $payment = Payment::where('id', $order->payment_id)->get()[0];
            $card_payment = CardPayment::where('payment_id', $payment->id)->get()[0];
            $card = Card::where('id', $card_payment->card_id)->get()[0];
            $order_items = OrderItem::where('order_id', $order->id)->get();

            foreach ($order_items as $key => $order_item) {
                $item = Item::where('id', $order_item->item_id)->get()[0];
                $item_name = str_replace(" ", "_", $item->name);
                if ($key == 0) {
                    $items_string = $order_item->amount."X".$item_name."x".$item->id;

                } else {
                    $items_string = $items_string."|".$order_item->amount."X".$item_name."x".$item->id;
                }
            }

            array_push($suppliers, $supplier[0]);
            array_push($cards, $card);
            array_push($items, $items_string);
            $items_string = "";
        }

        return(view('supplier/orders', [
            'orders'=>$orders,
            'suppliers'=>$suppliers,
            'cards'=>$cards,
            'items'=>$items
        ]));
    }

    // 3.78 - 5132fc53-e3d6-4e6f-a98e-53b5b62c5ea2
    // 7.56 - 1fd5a5da-4800-483d-aeb0-ecf89209ed69


    public function mark_as_received(Request $request) {

        $order_id = $request->input('order-id');
        // echo $order_id;
        
        $order = Order::where('id', $order_id)->get()[0];
        $order->date_arrived = Carbon::now();
        $order->received = !$order->received;
        $order->save();
        return redirect('/orders');
    }
    //
    function test() {

        return view('supplier/test', [
            
            'name'=>'somebody that i used to know',
            'test_arr'=>[0, 1, 2, 3, 4]
        ]);
    }
}
