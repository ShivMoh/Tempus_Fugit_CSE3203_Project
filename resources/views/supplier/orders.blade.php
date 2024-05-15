@vite(['resources/js/supplier/orders.js'])
@vite(['resources/css/supplier/orders.css'])

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Outfit">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

<x-nav></x-nav>
<section class="orders">
    <form action="/supplier">
        <button type="submit" class="manage-suppliers-button">Manage Suppliers</button>
    </form>
    @foreach ($orders as $key => $order)
    <div class="order-container">
        <div class="label-container">
            <p>Total Cost:</p>
            <span>{{$order->net_cost}}</span>
        </div>
        <div class="label-container">
            <p>Order Date:</p>
            <span>{{date_format($order->order_date, "Y/m/d")}}</span>
        </div>
        <div class="label-container">
            <p>Date Arrived</p>
            @if ($order->received == false)
                <span>Not yet received</span>
            @else
                <span>{{date_format($order->date_arrived, "Y/m/d")}}</span>
            @endif
        </div>
        <div class="label-container">
            <p>Supplier</p>
            <span>{{$suppliers[$key]->name}}</span>
        </div>

        <div class="label-container">
            <p>Card Used</p>
            <span>{{$cards[$key]->card_holder}}</span>
        </div>

        {{-- <form id="mark-as-received-form" action="/mark-as-received" method="POST">
            @csrf
            <input name="order-id" type="hidden" value={{$order->id}}>
        </form> --}}



        <div class="button-container">

            <form action="/mark-as-received" method="POST">
                @csrf
                <input name="order-id" type="hidden" value={{$order->id}}>
                @if($order->received)
                    <button class="mark-as-received-button" type="submit">Mark as not received</button>                
                @else 
                    <button class="mark-as-received-button" type="submit">Mark as received</button>                
                @endif
            </form>


            <form action="/view-bill" method="POST">
                @csrf
                <input type="hidden" name="payment" value={{$cards[$key]->id}}>
                <input type="hidden" name="supplier" value={{$suppliers[$key]->id}}>
                <input type="hidden" name="items" value={{$items[$key]}}>
                <button class="view-more-button" type="submit">View More</button>
            </form>
            
        </div>

        
    </div>
    @endforeach
</section>
