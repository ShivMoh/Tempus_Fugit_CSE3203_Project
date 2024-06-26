<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <title>Cashier</title>
    <link href="{{ asset('resources/css/cashier/cashier.css') }}" rel="stylesheet" type="text/css">
    @vite(['resources/css/cashier/cashier.css', 'resources/js/cashier.js', 'resources/js/dashboard.js', 'resources/css/dashboard/dashboard.css'])
</head>

<body>
    <x-nav></x-nav>
    
    <section class="overlay"></section>

    <div class="cashier-content">
        <form action="{{ route('bill_preview') }}" method="POST">
            @csrf
            <table class="cashier">
                <thead>
                    <tr>
                        <th class="item-id">ID</th>
                        <th class="name-of-item">Name of Item</th>
                        <th class="price">Price</th>
                        <th class="amount">Amount</th>
                        <th class="discount">Discount (%)</th>
                        <th class="item-total">Item Total</th>
                    </tr>
                </thead>

                <tbody>
                    @for ($i = 0; $i < 15; $i++)
                        <tr>
                            <td class="item-id">{{ $i + 1 }}</td>
                            
                            <td class="name-of-item">
                                <select name="item_name[]" onchange="updateRow(this)">
                                    <option value="" disabled selected>Select Item</option>
                                    @foreach($items as $item)
                                        <option
                                            value="{{ $item->name }}"
                                            data-price="{{ $item->selling_price }}"
                                            data-stock="{{ $item->stock_count }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="price">
                                <input type="number" name="price[]" readonly>
                            </td>

                            <td class="amount">
                                <input type="number" min="1" name="amount[]" value="" onchange="updateTotal(this)">
                            </td>

                            <td class="discount">
                                <input type="number" min="0" name="discount[]" value="" onchange="updateTotal(this)">
                            </td>

                            <td class="item-total"></td>
                        </tr>
                    @endfor
                </tbody>
            </table>

            <div class="cashier-bottom-content">
                <div class="cashier-options">

                    <div class="customer-info">
                        <label for="customer">Customers: </label>
                            <select name="customer" id="customer" required>
                                <option value="" disabled selected>Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->first_name." ".$customer->last_name}}</option>
                                @endforeach
                                <option value="">New Customer</option>

                            </select>
                    </div>
                    
                    <div class="customer-info">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" id="customer_name" name="customer_name" placeholder="Leave Blank if Customer Exists">
                    </div>
                    
                    <div class="customer-info">
                        <label for="customer_number">Customer Number</label>
                        <input type="text" id="customer_number" name="customer_number" placeholder="Leave Blank if Customer Exists">
                    </div>

                    <div class="customer-info">
                        <label for="customer_email">Customer Email</label>
                        <input type="email" id="customer_email" name="customer_email" placeholder="Leave Blank if Customer Exists">
                    </div>
                    
                    <div class="additional-options">
                        <label for="delivery_fee">Delivery Fee</label>
                        <input type="checkbox" id="delivery_fee" name="delivery_fee" value="50">
                    </div>

                    <div class="additional-options">
                        <label for="payment_method">Payment Method</label>
                        <select class="payment-method-dropdown" name="payment_method" id="payment_method" onchange="toggleCardDetails(this)">
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                        </select>
                    </div>

                    <div id="card-details" style="display: none;">
                        <div class="additional-options">
                            <label for="card_details">Card Details</label>
                            <input type="text" id="card_details" name="card_details" placeholder="Card Number">
                        </div>

                        <div class="additional-options">
                            <label for="card_pin">Card PIN</label>
                            <input type="text" id="card_pin" name="card_pin" placeholder="PIN">
                        </div>

                        <div class="additional-options">
                            <label for="card_expiry">Expiry Date</label>
                            <input type="text" id="card_expiry" name="card_expiry" placeholder="MM/YY">
                        </div>
                    </div>
                </div>

                <div class="total-and-bill-options">
                    <input type="text" id="totalCost" readonly placeholder="Total Cost" style="background-color: white; border: 1px solid black;">
                    <input type="submit" class="confirm-and-print-bill" value="Confirm and Print Bill">
                    <a href="/bills" class="view-bills">View Bills</a>
                </div>

    <script>
        var items = @json($items);

        function toggleCardDetails(select) {
            var cardDetails = document.getElementById('card-details');
            cardDetails.style.display = select.value === 'card' ? 'block' : 'none';
        }
    </script>
    <script src="{{ asset('resources/js/cashier.js') }}"></script>
</body>
</html>
