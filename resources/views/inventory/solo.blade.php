@vite(['resources/js/app.js', 'resources/js/item.js'])
@vite(['resources/css/inventory/item.css','resources/css/app.css'])

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <x-nav></x-nav>

    <section id="main">
        <div class="sec-container">
            <div class="image-container">
                <img id="image" src="{{asset($info[0]['item']->image_url)}}" alt="">
            </div>
            <div class="main-details">
                <h1>{{$info[0]['item']->name}}</h1>
                <h4>{{$info[0]['category']}}</h4>
                <h5>{{$info[0]['supplier']}}</h5>
                <a href="/inventory">Back to Inventory</a>
            </div>
        </div>
    </section>

    <section id="details">

        <div class="sec-container">
            <div class="column">
                <div class="row">
                    <p><b>Unique ID:</b></p>
                    <p>{{$info[0]['item']->id}}</p>
                </div>
                <hr>
                <div class="row">
                    <p><b>Name:</b></p>
                    <p>{{$info[0]['item']->name}}</p>
                </div> 
                <hr>
                <div class="row">
                    <p><b>Selling Price:</b></p>
                    <p>{{$info[0]['item']->selling_price}}</p>
                </div>
                <hr>
                <div class="row">
                    <p><b>Cost Price:</b></p>
                    <p>{{$info[0]['item']->cost_price}}</p>
                </div>
                <hr>
            </div>
            <div class="column">
                <div class="row">
                    <p><b>Total Sold:</b></p>
                    <p>{{$info[0]['item']->total_sold}}</p>
                </div>
                <hr>
                <div class="row">
                    <p><b>Stock Count:</b></p>
                    <p>{{$info[0]['item']->stock_count}}</p>
                </div>
                <hr>
                <div class="row">
                    <p><b>Category:</b></p>
                    <p>{{$info[0]['item']->category_id}}</p>
                </div>
                <hr>
                <div class="row">
                    <p><b>Supplier:</b></p>
                    <p>{{$info[0]['item']->supplier_id}}</p>
                </div>
                <hr>
            </div>
            
            
        </div> 
        <div class="order-sec">
            <form action="/request-form" method="GET" >
                <input type="hidden" name="id" value="{{$info[0]['item']->supplier_id}}">
                <button type="submit" class="order-btn">Order More</button>
            </form>
        </div>
        
    </section>

    <section id="stats">
        <div class="sec-container">
            <h1 style="width: 100%">Statistics</h1>
            <div class="graph">
                <canvas id="dailySales"></canvas>
                <img id="image-container" src="{{ asset('images/graph-line.jpg') }}" alt="Graph">
                <h5>Name of Graph</h5>
            </div>
            <div class="graph">
                <img id="image-container" src="{{ asset('images/graph-line.jpg') }}" alt="Graph">
                <h5>Name of Graph</h5>
            </div>
            <div class="graph">
                <img id="image-container" src="{{ asset('images/graph-line.jpg') }}" alt="Graph">
                <h5>Name of Graph</h5>
            </div>
        </div>
    </section>

    <script>
        window.dailySales = @json($dailySales);
        window.totalProfitPerTransaction = @json($totalProfitPerTransaction);
        window.totalEarningsPerDay = @json($totalEarningsPerDay);
    </script>
</body>