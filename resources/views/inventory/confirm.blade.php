@vite(['resources/css/inventory/confirm.css','resources/css/app.css'])

<body>
    <x-nav></x-nav>
<br><br><br>

    <section id="main">
        <div class="main-section">
                <h1 id="notif">
                <span><i>You do not have any of this item in stock. Order more?</i></span>
            </h1>

            <div class="btn-container">
                <form action="/request-form" id="order-more">
                    @csrf
                <input type="hidden" name="id" value="{{$data['supplier']}}">    
                <button type="submit" id="order-more" form="order-more">Order More</button></form>

                <form action="/info" method="post" id="view-item">
                    @csrf
                    <input type="hidden" name="id" value="{{$data['item']}}">

                    <button type="submit" id="view-item" form="view-item">View Item</button>
                </form>
                <form action="/inventory" method="get">
                    <button type="submit" id="view-inv">View Inventory</button> 

                </form>

            </div>
        
        </div>
    </section>
</body>