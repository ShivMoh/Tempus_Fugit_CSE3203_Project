<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Preview</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
        }
        .bill-info, .bill-items {
            margin-bottom: 20px;
        }
        .bill-info label, .bill-items label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }
        .bill-info span, .bill-items span {
            display: inline-block;
            width: 200px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bill Preview</h1>

        <div class="bill-info">
            <label for="customer_name">Customer Name:</label>
            <span id="customer_name">{{ $customerName }}</span>
        </div>

        <div class="bill-info">
            <label for="gross_cost">Gross Cost:</label>
            <span id="gross_cost">${{ number_format($grossCost, 2) }}</span>
        </div>

        <div class="bill-info">
            <label for="delivery_fee">Delivery Fee:</label>
            <span id="delivery_fee">${{ number_format($deliveryFee, 2) }}</span>
        </div>

        <div class="bill-info">
            <label for="net_cost">Net Cost:</label>
            <span id="net_cost">${{ number_format($netCost, 2) }}</span>
        </div>

        <div class="bill-info">
            <label for="duty">Duty:</label>
            <span id="duty">${{ number_format($duty, 2) }}</span>
        </div>

        <h2>Item Details</h2>
        <div class="bill-items">
            <table>
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Price (1x)</th>
                        <th>Amount</th>
                        <th>Discount (%)</th>
                        <th>Item Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($itemTotals as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>{{ $item['amount'] }}</td>
                            <td>{{ $item['discount'] }}</td>
                            <td>${{ number_format($item['total'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
