<!-- We're going to need:
a field for every detail of the model
a list of all supplier ids and their names
A button to return to inventory
A button to Order from supplier
Default Amount in stock and sold is 0 -->
@vite(['resources/css/inventory/add-new.css','resources/css/app.css'])

<body>
    <x-nav></x-nav>

    <!-- This is dependent on the length of the suppliers list, if on beck to supplier, if 2, back to inventory -->

    <div class="btn-container">
        <form action="/inventory" method="get">
            <button type="submit" id="back">
                Back to Inventory
            </button>
        </form>
    </div>

    <section id="test-info">
    @foreach ($info as $data)
        @foreach ($data['categories'] as $categoryId => $categoryName)
                <p>Category ID: {{ $categoryId }}, Category Name: {{ $categoryName }}</p>
            @endforeach
            
            @foreach ($data['suppliers'] as $supplierId => $supplierName)
                <p>Supplier ID: {{ $supplierId }}, Supplier Name: {{ $supplierName }}</p>
            @endforeach
        @endforeach


    </section>

    <!--  protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'selling_price' => 'float',
        'cost_price' => 'float',
        'total_sold' => 'integer',
        'stock_count' => 'integer',
        'image_url' => 'string',
        'category_id' => 'string',
        'supplier_id' => 'string',
    ]; -->

    <section id="main-form">
        <form action="/confirm" method="post" class="main-form">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" required>
            </div>
            <div class="form-group">
                <label for="selling_price">Selling Price:</label>
                $<input type="number" name="selling_price" id="selling_price" placeholder="0.00">
            </div>
            <div class="form-group">
                <label for="cost_price">Cost Price:</label>
                $
                <input type="number" name="cost_price" id="cost_price" placeholder="0.00">
            </div>
            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input name="image_url" id="image_url" type="url" placeholder="https://www.google.com">
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" class="form-control">
                    
                    @foreach ($data['categories'] as $categoryId => $categoryName)
                        <option value="{{ $categoryId }}">{{ $categoryName }}</option>
                    @endforeach
                </select>    
            </div>
            <div class="form-group">
                <label for="supplier">Supplier:</label>
                <select id="supplier" name="supplier" class="form-control">
                    
                    @foreach ($data['suppliers'] as $supplierId => $supplierName)
                        <option value="{{ $supplierId }}">{{ $supplierName }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="add-btn">
                Add to Inventory
            </button>
        </form>
    </section>

    
</body>