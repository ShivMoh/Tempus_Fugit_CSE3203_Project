<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Success</title>
    @vite('resources/css/cashier/bill_success.css')
</head>
<body>
    <x-nav></x-nav>

    <div class="container">
        <h1 class="title">Bill Confirmed Successfully!</h1>
        <p class="message">The bill has been confirmed and saved successfully.</p>
        <a href="{{ route('cashier') }}" class="return-button">Return to Cashier</a>
    </div>
</body>
</html>
