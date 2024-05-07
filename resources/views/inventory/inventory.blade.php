@vite(['resources/js/app.js'])
@vite(['resources/css/inventory/inventory.css'])

<h1>Does inventory work?</h1>

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

<section class="items">
    @foreach ($items as $item)

    <!-- Remember to add the redirect in the class, then route, then here, then the solo item page when you come back from making your list -->
    <form action="" method="post">
        <div class="item-preview">{
            <input type="hidden" name="id" value={{$item->id}}>
            <button type="submit">
                <x-item :item="$item" />
            </button>
        </div>
       
    </form>
        
    @endforeach

</section>