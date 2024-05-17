<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills</title>
    @vite('resources/css/cashier/bills.css')
</head>
<body>

<x-nav></x-nav>

<div class="container">
    <h1>Bills</h1>

    <table class="bill-table">
        <thead>
            <tr>
                <th>Bill ID</th>
                <th>Customer Name</th>
                <th>Gross Cost</th>
                <th>Net Cost</th>
                <th>Discount</th>
                <th>Duty and VAT</th>
                <th>Delivery Fee</th>
                <th>Customer ID</th>
                <th>Actions</th> <!-- New column for actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($bills as $bill)
            <tr>
                <td>{{ $bill->id }}</td>
                <td>{{ $bill->customer->first_name }}</td>
                <td>${{ $bill->gross_cost }}</td>
                <td>${{ $bill->net_cost }}</td>
                <td>${{ $bill->discount }}</td>
                <td>${{ $bill->duty_and_vat }}</td>
                <td>${{ $bill->delivery_free ?? 0 }}</td>
                <td>{{ $bill->customer_id }}</td>
                <td>
                    <button class="print-button">Print</button> <!-- Print button -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('cashier') }}" class="return-button">Return to Cashier</a>
</div>

</body>
</html>
