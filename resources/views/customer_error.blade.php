<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Error</title>
    @vite('resources/css/cashier/bill_success.css')
</head>

<body>
    <x-nav></x-nav>

    <div class="container">
        <h1 class="title">Customer Does Not Exist</h1>
        <p class="message">The customer specified does not exist!</p>
        <p class="message">Please enter their details in the respective fields.</p>
        <a href="{{ route('cashier') }}" class="return-button">Return to Cashier</a>
    </div>
</body>
</html>
