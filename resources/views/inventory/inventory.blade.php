@vite(['resources/js/app.js'])
@vite(['resources/css/inventory/inventory.css', 'resources/css/app.css'])

<body>
    <x-nav></x-nav>
    <h1 id="page-title">
        Inventory 
    </h1>

    <section class="filter-section">
        <div class="filter-container">
            <div class="search-container">
                <form  action="/inventory" method="POST" class="search-bar" id="search">
                    @csrf
                    <input 
                        type="search" 
                        name="search" 
                        id="search-bar"
                        placeholder="Search by name"
                        >
                </form>
                <form  action="/inventory" method="POST" id="clear">
                    @csrf
                </form>
            
                <div class="button-container">
                    <button type="submit" form="search" id="search-button">Search</button>
                    <button type="submit" form="clear" id="clear-button">Clear</button>
                </div>
            </div>
            
        </div>
    </section>
     <!-- TODO -->
     <!-- error management in search -->

    <section class="items">
        
        <div class="content">
            @foreach ($items as $item)
            <form action="/info" method="post" class="preview-btn">
                @csrf
                <div class="item-preview">
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <button type="submit">
                        <x-item :item="$item" />
                    </button>
                </div>
            
            </form>
                
            @endforeach
        </div>
        
        <form method="GET" action="/add-new">
            <button type="submit" id="add-more">
                Add More
            </button>
        </form>
        

    </section>
</body>
