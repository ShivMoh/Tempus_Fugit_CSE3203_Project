<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
    @vite(['resources/css/sales/sales.css', 'resources/js/salesLineCharts.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <x-nav></x-nav>
    <div class="main-container">
        <div class="flex-column-a">
            <span class="finances">Finances</span>
            <div class="rectangle-1">
                <div class="flex-row-ef">
                    <span class="net-balance">Net Balance:</span>
                    <span class="dollar-sign">${{ number_format($netBalance, 2) }}</span>
                </div>
            </div>
            <div class="rectangle-button">
                <span class="given-to-suppliers">Given to Suppliers: ${{ number_format(abs($givenToSuppliers), 2) }}</span>
            </div>
            <div class="rectangle-button-3">
                <span class="received-from-customers">Received from Customers: ${{ number_format(abs($receivedFromCustomers), 2) }}</span>
            </div>
            <div class="rectangle-button-4">
                <span class="profits">Profits: {!! $profits > 0 ? '<span class="up-arrow">&uarr;</span>' : ($profits < 0 ? '<span class="down-arrow">&darr;</span>' : '') !!} ${{ number_format(abs($profits), 2) }}</span>
            </div>
            <div class="financial-statistics">Financial Statistics</div>
            <div class="charts-container">
                <div class="chart">
                    <canvas id="salesProfitsChart" width="300" height="150"></canvas>
                    <div class="chart-title">Overall Sales vs Profits</div>
                </div>
                <div class="chart">
                    <canvas id="costsSalesChart" width="300" height="150"></canvas>
                    <div class="chart-title">Overall Costs vs Sales</div>
                </div>
            </div>
            <div class="cashier-content">
                <form action="{{ route('bills') }}" method="GET">
                    <button type="submit" class="manage-bills">Sales Log</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        window.chartData = {
            labels: {!! json_encode($labels) !!},
            sales: {!! json_encode($sales) !!},
            profits: {!! json_encode($profitsData) !!},
            costs: {!! json_encode($costs) !!}
        };
    </script>
</body>
</html>
