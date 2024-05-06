@vite(['resources/js/supplier/request_form.js'])
@vite(['resources/css/supplier/supplier.css'])

{{$error}}

<section class="filter-section">
    <div class="filter-container">
        <form  action="/supplier" method="POST" class="search-bar">
            @csrf
            <input 
                type="search" 
                name="search" 
                id="search-bar"
                placeholder="Search by name"
                >
            <button type="submit">Search</button>
        </form>
    </div>
</section>

<section class="suppliers">
    @foreach ($suppliers as $supplier )

    <form class="supplier-container" method="POST" action="/request-form">
        @csrf
        <div class="image-section">
            <div class="image"></div>
            {{-- <img src="" alt="" srcset=""> --}}
        </div>

        <div class="info-section">
            <p>{{$supplier['supplier']->id}}</p>
            <h3 class="name">{{$supplier['supplier']->name}}</h3>
            <h4 class="description">{{$supplier['supplier']->description}}</h2>
            <div class="contacts">
                <h4 class="email"><span class="label">Email us at: </span>{{$supplier['contact']->email}}</h4>                
                <h4 class="numbers"><span class="label">Call at: </span>{{$supplier['contact']->primary_number}} OR {{$supplier['contact']->secondary_number}}</h4>                    
            </div>
            <input type="hidden" name="id" value={{$supplier['supplier']->id}}>
            <button type="submit">Order Items</button>
        </div>
    </form>

    

    @endforeach

</section>
