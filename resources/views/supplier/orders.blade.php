@vite(['resources/js/supplier/orders.js'])
@vite(['resources/css/supplier/orders.css'])

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Outfit">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

<section class="orders">
    @foreach ($orders as $key => $order)
    <div class="order-container">
        <div class="label-container">
            <p>Total Cost:</p>
            <span>{{$order->net_cost}}</span>
        </div>
        <div class="label-container">
            <p>Order Date:</p>
            <span>{{$order->order_date}}</span>
        </div>
        <div class="label-container">
            <p>Date Arrived</p>
            @if ($order->received == false)
                <span>Not yet received</span>
            @else
                <span>{{$order->date_arrived}}</span>
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


        <form id="mark-as-received-form" action="/mark-as-received" method="POST">
            @csrf
            <input name="order-id" type="hidden" value={{$order->id}}>
        </form>
        
        <span>{{$order->id}}</span>

        {{-- <form id="mark-as-received-form" action="/mark-as-received" method="POST">
            @csrf
            <input name="order-id" type="hidden" value={{$order->id}}>
        </form> --}}


        <form id="view-more-form" action="/view-bill" method="POST">
            @csrf
            <input type="hidden" name="payment" value={{$cards[$key]->id}}>
            <input type="hidden" name="supplier" value={{$suppliers[$key]->id}}>
            <input type="hidden" name="items" value={{$items[$key]}}>
        </form>

        <div class="button-container">
            <button class="mark-as-received-button" type="submit" form="mark-as-received-form">Mark as received</button>
            
            <button class="view-more-button" type="submit" form="view-more-form">View More</button>
        </div>

        
    </div>
    @endforeach
</section>
