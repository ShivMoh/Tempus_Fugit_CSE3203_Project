@vite(['resources/js/app.js'])
@vite(['resources/css/inventory/item.css'])


<body>

    <section id="main">
        <div class="sec-container">
            <div>
                <img id="image-container" src="{{asset($info[0]['item']->image_url)}}" alt="">
            </div>
            <div class="main-details">
                <h1>{{$info[0]['item']->name}}</h1>
                <h4>{{$info[0]['category']}}</h4>
                <h5>{{$info[0]['supplier']}}</h5>
            </div>
        </div>
    </section>

    <section id="details">
        <div class="sec-container">
            <div class="column">
                <div class="row">
                    <p>Unique ID:</p>
                    <p>{{$info[0]['item']->id}}</p>
                </div>
                <hr>
                <div class="row">
                    <p>Name:</p>
                    <p>{{$info[0]['item']->name}}</p>
                </div> 
                <hr>
                <div class="row">
                    <p>Selling Price:</p>
                    <p>{{$info[0]['item']->selling_price}}</p>
                </div>
                <hr>
                <div class="row">
                    <p>Cost Price:</p>
                    <p>{{$info[0]['item']->cost_price}}</p>
                </div>
                <hr>
            </div>
            <div class="column">
                <div class="row">
                    <p>Total Sold:</p>
                    <p>{{$info[0]['item']->total_sold}}</p>
                </div>
                <hr>
                <div class="row">
                    <p>Stock Count:</p>
                    <p>{{$info[0]['item']->stock_count}}</p>
                </div>
                <hr>
                <div class="row">
                    <p>Category:</p>
                    <p>{{$info[0]['item']->category_id}}</p>
                </div>
                <hr>
                <div class="row">
                    <p>Supplier:</p>
                    <p>{{$info[0]['item']->supplier_id}}</p>
                </div>
                <hr>
            </div>
            <div class="order-sec">
                <form action="/request-form" method="GET">
                    <input type="hidden" name="id" value="{{$info[0]['item']->supplier_id}}">
                    <button type="submit">Order More</button>
                </form>
            </div>
            
        </div> 
        
    </section>

    <section id="stats">
        <div class="sec-container">
            <h1 style="width: 100%">Statistics</h1>
            <div>
                <img id="image-container" src="{{ asset('images/graph-line.jpg') }}" alt="Graph">
            </div>
            <div>
                <img id="image-container" src="{{ asset('images/graph-line.jpg') }}" alt="Graph">
            </div>
            <div>
                <img id="image-container" src="{{ asset('images/graph-line.jpg') }}" alt="Graph">
            </div>
        </div>
    </section>
</body>