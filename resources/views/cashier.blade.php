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

    <!-- Cashier Stuff -->
    <div class="cashier-content">
        <!-- Table is wrapped in form tags so that its information can be used to produce the bill -->
        <form action="/bill_preview" method="POST">
            @csrf
            <div class="customer-info">
                <label for="customer_name">Customer Name:</label>
                <input type="text" id="customer_name" name="customer_name" required>
            </div>

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
                    <!-- Can input up to 15 items at once -->
                    @for ($i = 0; $i < 15; $i++)
                        <tr>
                            <td class="item-id">{{ $i + 1 }}</td>

                            <td class="name-of-item">
                                <select name="item_name[]" onchange="updateRow(this)">
                                    <option value="" disabled selected>Select Item</option>
                                    @foreach($items as $item)

                                        <option
                                            value="{{ $item->name }}"
                                            data-price="{{ $item->selling_price }}">{{ $item->name }}
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

                            <td class="item-total">
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>

            <!-- Add $50 dollars if delivery is checked -->
            <div class="additional-options">
                <label for="delivery_fee">Apply Delivery Fee:</label>
                <input type="checkbox" id="delivery_fee" name="delivery_fee" value="50">
            </div>

            <div class="total-and-bill-options">
                <input type="text" id="totalCost" readonly placeholder="Total Cost">
                <input type="submit" class="confirm-and-print-bill" value="Confirm and Print Bill">
                <button class="manage-bills">
                    <a href="/bills">Manage Bills</a>
                </button>
            </div>
        </form>
    </div>

    <!-- Pass items array to js so the item's price can be accessed -->
    <script>
        var items = <?php echo json_encode($items); ?>;
    </script>
    <script src="{{ asset('resources/js/cashier.js') }}"></script>
</body>
</html>
