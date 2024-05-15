<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sales</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
    <link href="{{ asset('resources/css/sales/sales.css') }}" rel="stylesheet" type="text/css" >
    @vite(['resources/css/sales/sales.css','resources/js/dashboard.js', 'resources/css/dashboard/dashboard.css'])
  </head>
  <body>
  <x-nav></x-nav>
    <div class="main-container">
      <div class="flex-column-a">
        <span class="finances">Finances</span>
        <div class="rectangle-1">
          <div class="flex-row-ef">
            <span class="net-balance">Net Balance</span
            ><span class="dollar-sign">$$$</span>
          </div>
          <button class="rectangle-2">
            <span class="log-investment">Log Investment</span>
          </button>
        </div>
        <button class="rectangle-button">
          <span class="given-to-suppliers">Given to Suppliers</span></button
        ><button class="rectangle-button-3">
          <span class="received-from-customers"
            >Received from Customers</span
          ></button
        ><button class="rectangle-button-4">
          <span class="profits">Profits</span></button
        ><span class="financial-statistics">Financial Statistics</span>
    </div>
  </body>
</html>
