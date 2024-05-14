@vite(['resources/js/app.js'])
@vite(['resources/css/inventory/inventory.css'])

<body>

    <!-- <x-nav></x-nav> -->
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
     <!-- TODO -->
     <!-- error management in search -->

    <section class="items">
        @foreach ($items as $item)
        <form action="/info" method="post">
            @csrf
            <div class="item-preview">
                <input type="hidden" name="id" value="{{$item->id}}">
                <button type="submit">
                    <x-item :item="$item" />
                </button>
            </div>
        
        </form>
            
        @endforeach

    </section>
</body>
