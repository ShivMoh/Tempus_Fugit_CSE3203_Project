<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier</title>
    @vite('resources/css/cashier/cashier.css')
</head>

<body>
    <div class="cashier-content">
        <table class="cashier">
            <thead>
                <tr>
                    <th class="item-id">Item ID</th>
                    <th class="name-of-item">Name of Item</th>
                    <th class="amount">Amount</th>
                    <th class="discount">Discount (%)</th>
                    <th class="item-total">Item Total</th>
                </tr>
            </thead>
            
            <tbody>
                @php
                    $food_items = array(
                        array("id" => 1, "name" => "Pizza", "cost" => 20),
                        array("id" => 2, "name" => "Sushi", "cost" => 25),
                        array("id" => 3, "name" => "Salad", "cost" => 10),
                        array("id" => 4, "name" => "Pasta", "cost" => 18),
                        array("id" => 5, "name" => "Rices", "cost" => 73)
                    );
                @endphp

                @for ($i = 0; $i < 15; $i++)
                    <tr>
                        <td class="item-id"></td>
                        <td class="name-of-item">
                            <select name="item_name" onchange="updateRow(this)">
                                <option value="">Select Item</option>
                                @foreach($food_items as $item)
                                    <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="amount">
                            <input type="number" min="1" value="" onchange="updateTotal(this)">
                        </td>
                        <td class="discount">
                            <input type="number" min="0" value="" style="display: none;" onchange="updateTotal(this)">
                        </td>
                        <td class="item-total"></td>
                    </tr>
                @endfor
            </tbody>
        </table>

        <div class="total-and-print">
            <input type="text" id="totalCost" readonly>
            <button class="confirm-and-print-bill">Confirm and Print Bill</button>
            <button class="confirm-order">Confirm Order</button>
            <button class="manage-bills">Manage Bills</button>
        </div>
    </div>
    @vite('resources/js/cashier.js')
</body>
</html>
