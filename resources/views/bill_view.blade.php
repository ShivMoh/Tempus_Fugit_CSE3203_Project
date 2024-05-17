<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Preview</title>
    @vite('resources/css/cashier/bill_preview.css')
</head>

<body>
    <x-nav></x-nav>

    <div class="container">
        <h1 class="title">Bill Preview</h1>

        <p class="user-id">Employee ID: {{ Auth::id() }}</p>

        <p class="customer-name">{{ $customerName }}</p>

        <div class="total">
            <h2 class="total-title">Total</h2>
            <div class="total-detail">
                <span>Gross Cost:</span>
                <span>${{ $grossCost }}</span>
            </div>
            <div class="total-detail">
                <span>Discount:</span>
                <span>${{ $totalDiscount }}</span>
            </div>
            <div class="total-detail">
                <span>Duty:</span>
                <span>${{ $duty }}</span>
            </div>
            <div class="total-detail">
                <span>Delivery Fee:</span>
                <span>${{ $deliveryFee }}</span>
            </div>
            <div class="total-net">
                <span>Net Cost:</span>
                <span>${{ $netCost }}</span>
            </div>
        </div>

        <button type="submit" class="confirm-button" onclick="print()">Print Bill</button>
    </div>
</body>
</html>
