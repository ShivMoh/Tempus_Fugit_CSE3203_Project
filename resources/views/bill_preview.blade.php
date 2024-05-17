<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Preview</title>
</head>

<body>
<x-nav></x-nav>

<h1 style="margin-top: 300px">Bill Preview</h1>
    <p>User ID: {{ Auth::id() }}</p>
    <p>Customer Name: {{ $customerName }}</p>
    <p>Gross Cost: ${{ $grossCost }}</p>
    <p>Net Cost: ${{ $netCost }}</p>
    <p>Delivery Fee: ${{ $deliveryFee }}</p>
    <p>Duty: ${{ $duty }}</p>
    <p>Total Discount: ${{ $totalDiscount }}</p>

<form action="{{ route('bill_confirmed') }}" method="POST">
    @csrf
    <button type="submit">Confirm Bill</button>
</form>
</body>
</html>
