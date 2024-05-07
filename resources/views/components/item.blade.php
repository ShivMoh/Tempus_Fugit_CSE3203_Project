<!-- Here you have your input stuff, click anywhere to view -->
<!-- $item is the name of the variable -->
@vite(['resources/js/app.js'])
@vite(['resources/css/inventory/item.css'])

<div class="preview">
    <!-- <div class="img">
        <img src="{{$item->image_url}}" alt="">
    </div> -->
    <div class="info">
        <h3>{{$item->name}}</h3>
        <div class="details">
            <h5>Selling Price per unit: ${{$item->selling_price}}</h5>
            <h5>Cost Price per unit: ${{$item->cost_price}}</h5>
            <h5>Remaining Stock: ${{$item->stock_count}}</h5>
        </div>
    </div>
    
</div>