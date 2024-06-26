@vite(['resources/js/supplier/request_form.js'])
@vite(['resources/css/supplier/supplier.css'])
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Outfit">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<x-nav></x-nav>

<section class="filter-section">

    <div class="filter-container">
        <div class="search-container">
            <form  action="/supplier" method="POST" class="search-bar" id="search">
                @csrf
                <input 
                    type="search" 
                    name="search" 
                    id="search-bar"
                    placeholder="Search by name"
                    >
            </form>
            <form  action="/supplier" method="POST" id="clear">
                @csrf
            </form>
           
            <div class="button-container">
                <button type="submit" form="search" class="search-button">Search</button>
                <button type="submit" form="clear" class="clear-button">Clear</button>
            </div>
        </div>
        
    </div>
</section>


@if ($error)
    <section class="errors">
        <h1>No results found</h1>
        <h3 class="suggestion">Perhaps try using a different term!</h3>
    </section>
@endif

<section class="suppliers">

    <div class="buttons">
        <form action="/orders" class="view-orders">
            <button type="submit" class="view-orders-button">Manage Orders</button>
        </form>
        <form action="/add-new" method="get" class="view-orders">
            <button type="submit" class="view-orders-button">Add New Supplied Item</button>
        </form> 
    </div>
    

    @foreach ($suppliers as $supplier )
    <form class="supplier-container" method="GET" action="/request-form">
        @csrf
        <div class="image-section">
            <img class="image" src="{{ asset($supplier['supplier']->image_url) }}" alt="This is image">
        </div>

        <div class="info-section">
            <h3 class="name">{{$supplier['supplier']->name}}</h3>
            <h4 class="description">{{$supplier['supplier']->description}}</h2>
            <div class="contacts">
                <h4 class="email"><span class="label">Email us at: </span>{{$supplier['contact']->email}}</h4>                
                <h4 class="numbers"><span class="label">Call at: </span>{{$supplier['contact']->primary_number}} OR {{$supplier['contact']->secondary_number}}</h4>                    
            </div>
            <input type="hidden" name="id" value="{{$supplier['supplier']->id}}">
            <button type="submit" class="order-item-button">Order Items</button>
        </div>
    </form>


    @endforeach

</section>
