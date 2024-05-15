@vite('resources/js/supplier/review.js')
@vite('resources/css/supplier/review.css')
<x-nav></x-nav>
<form class="bill-container" id="review-form" action="/order-item" method="POST">
    @csrf

    <div class="bill">
        <div class="payment">
            <h1>Payment</h1>
            @foreach ($card as $res )
                <div class="row">
                    <p class="label">Card Holder</p>
                    <p class="card-holder">{{$res->card_holder}}</p>
                </div>

                <div class="row">
                    <p class="label">Card Number</p>
                    <p class="card-number">{{$res->card_number}}</p>
                </div>

                <div class="row">
                    <p class="label">Security Pin</p>
                    <p class="security-pin">{{$res->security_pin}}</p>
                </div>

                <div class="row">
                    <p class="label">Expiray Date</p>
                    <p class="expirary-date">{{$res->expirary_date}}</p>
                </div>
            @endforeach    
        </div>
        
        <div class="address">
            <h1>Address</h1>
            @foreach ($address as $res )


                <div class="row">
                    <p class="label">Line 1</p>
                    <p class="line-1">{{$res->line_1}}</p>
                </div>

                <div class="row">
                    <p class="label">Line 2</p>
                    <p class="line-2">{{$res->line_2}}</p>
                </div>

                <div class="row">
                    <p class="label">City</p>
                    <p class="city">{{$res->city}}</p>
                </div>

                <div class="row">
                    <p class="label">State</p>
                    <p class="state">{{$res->state}}</p>
                </div>

                <div class="row">
                    <p class="label">Country</p>
                    <p class="country">{{$res->country}}</p>
                </div>
                
                
            @endforeach
        </div>
        
        <div class="items">   
            <h1>Items</h1>   
            <div class="single-item">    
                <div class="item-container">
                    <p class="amount heading">Amount</p>
                    <p class="name heading">Name</p>
                </div>
    
                <div class="cost-container">
                    <p class="item-cost heading">Cost</h1>
                </div>
            </div>    
            @foreach ($item_names as $key => $value )
                <div class="single-item">    
                    <div class="item-container">
                        <p class="amount">{{$item_amounts[$key]}}</p>
                        <p class="name">{{$value[0]->name}}</p>
                    </div>
        
                    <div class="cost-container">
                        <p class="item-cost">{{ (float) $value[0]->selling_price * (float) $item_amounts[$key]}}</h1>
                    </div>
                </div>
            @endforeach

            <div class="single-item final">    
                <div class="item-container">
                    <p class="amount heading big">Total:</p>
                    <p class="name heading"></p>
                </div>
    
                <div class="cost-container">
                    <p class="item-cost heading big">$ {{$total_cost}}</h1>
                </div>
            </div>  
        </div>
        
        <div class="supplier">
            <h1>Supplier</h1>
            @foreach ($supplier as $res )
                <input type="hidden" name="supplier" value={{$res->id}}>
    

                <input type="hidden" name="items" value={{$items}}>

                <div class="row">
                    <p class="label">Name</p>
                    <p class="state">{{$res->name}}</p>
                </div>

                <div class="row">
                    <p class="label">Description</p>
                    <p class="state">{{$res->description}}</p>
                </div>

            @endforeach
        </div>
    </div>
        
</form>

<form action="/request-form" method="POST" id="return-form">
    @csrf

    <input type="hidden" name="id" value={{$supplier[0]->id}}>        
</form>

<div class="button-container">
    <button type="submit" form="return-form" class="cancel-button">Cancel</button>
    <button type="submit" form="review-form" class="confirm-button">Confirm</button>
</div>