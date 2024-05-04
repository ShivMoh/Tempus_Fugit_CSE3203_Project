@vite(['resources/js/supplier/request_form.js'])
@vite(['resources/css/supplier/supplier.css'])

<section class="filter-section">
    <div class="filter-container">
        <div class="search-bar">
            <input 
                type="search" 
                name="search-bar" 
                id="search-bar"
                placeholder="Type to search"
                >
        </div>
    </div>
</section>

<section class="suppliers">
    @foreach ($suppliers as $supplier )

    <div class="supplier-container">
        <div class="image-section">
            <div class="image"></div>
            {{-- <img src="" alt="" srcset=""> --}}
        </div>

        <div class="info-section">
            <h3 class="name">{{$supplier['supplier']->name}}</h3>
            <h4 class="description">{{$supplier['supplier']->description}}</h2>
            <div class="contacts">
                <h4 class="email"><span class="label">Email us at: </span>{{$supplier['contact']->email}}</h4>                
                <h4 class="numbers"><span class="label">Call at: </span>{{$supplier['contact']->primary_number}} OR {{$supplier['contact']->secondary_number}}</h4>                    
            </div>
        </div>
    </div>

    @endforeach

</section>
