@vite(['resources/css/inventory/add-new.css','resources/css/app.css'])

<body>
    <x-nav></x-nav>

    <div class="btn-container">
        <form action="/inventory" method="get">
            <button type="submit" id="back">
                Back to Inventory
            </button>
        </form>
        <form action="/supplier" method="get">
            <button type="submit" id="back">
                Back to Supplier
            </button>
        </form>
    </div>

    <section id="main-form">
        <div class="main-section">
            <form action="/confirm" method="post" class="main-form">
                @csrf

                <h2 class="header">Enter the Item Details</h2>
                <div class="form-group">
                    <label for="name">Name:</label><br>
                    <input class="form-control" type="text" name="name" id="name" class="form-control" placeholder="Product Name" required>
                </div>
                <div class="form-group">
                    <label for="selling_price">Selling Price:</label><br>
                    <input class="form-control" type="number" name="selling_price" id="selling_price" placeholder="0.00">
                </div>
                <div class="form-group">
                    <label for="cost_price">Cost Price:</label><br>
                    <input class="form-control" type="number" name="cost_price" id="cost_price" placeholder="0.00">
                </div>
                <div class="form-group">
                    <label for="image_url">Image URL:</label><br>
                    <input class="form-control" name="image_url" id="image_url" type="url" placeholder="https://www.google.com">
                </div>
                <div class="form-group">
                    <label for="category">Category:</label><br>
                    <select class="form-control" id="category" name="category" class="form-control">
                        
                        @foreach ($info[0]['categories'] as $categoryId => $categoryName)
                            <option value="{{ $categoryId }}">{{ $categoryName }}</option>
                        @endforeach
                    </select>    
                </div>
                <div class="form-group">
                    <label for="supplier">Supplier:</label><br>
                    <select class="form-control" id="supplier" name="supplier" class="form-control">
                        
                        @foreach ($info[0]['suppliers'] as $supplierId => $supplierName)
                            <option class="form-control" value="{{ $supplierId }}">{{ $supplierName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="btn-container">
                    <button type="submit" class="add-btn">
                        Add to Inventory
                    </button>
                </div>

                
            </form>
        </div>
            
    </section>

    
</body>