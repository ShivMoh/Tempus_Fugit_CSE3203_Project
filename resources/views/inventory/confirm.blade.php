
<body>
    <x-nav></x-nav>
<br><br><br>

    <section id="main">
        <h1 id="notif">
            <span><i>You do not have any of this item in stock. Order more?</i></span>
        </h1>

        <div class="btn-container">
            <form action="/request-form" id="order-more"><button type="submit" id="order-more">Order More</button></form>

            <button onclick="window.location.href='/inventory'">Return to Inventory</button>
        </div>
    </section>
</body>