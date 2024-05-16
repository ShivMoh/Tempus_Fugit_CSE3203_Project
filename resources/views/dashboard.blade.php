{{-- <link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet" type="text/css" > --}}
@vite(['resources/js/dashboard.js', 'resources/css/dashboard/dashboard.css','resources/js/salesChart.js'])


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <!-- <title>Dashboard</title> -->
    <!-- Boxicons CSS -->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  </head>


  <body>
  <x-nav></x-nav>
    <section class="overlay"></section>

    <section class="dashboard">
        <div class="dashboard-content">
            <div class="upper-section">
                <!-- Upper Section Boxes -->
                <div class="upper-section-left">
                    <h2>Sales of the Week</h2>
                    <div class="box" id="box-1">

                        <canvas id="salesChart"></canvas>
                        <script>
                            var transactions = @json($transactions);
                        </script>
                    </div>
                </div>
                <div class="upper-section-right">
                    <h5>Recently Sold Items</h5>
                    <div class="box" id="box-2">
                        <ul>
                            @foreach ($recentTransactions as $transaction)
                                <li>{{ $transaction->item_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <h5>Recent Performance</h5>
                    <div class="box" id="box-3">
                        <ul>
                        @foreach ($topSellingItems as $item)
                            <li>
                                {{ $item->name }} - Sold: {{ $item->total_sold }}
                            </li>
                        @endforeach
                        </ul>


                    </div>
                </div>
            </div>

            <div class="lower-section">
                <!-- Lower Section Boxes -->
                <div class="left-box">
                    <div class="box" id="box-4">
                        <canvas id="highestStockChart"></canvas>
                    </div>
                    <h3>Highest Stock Items</h3>
                </div>

                <div class="middle-box">
                    <div class="box" id="box-5">
                        <canvas id="lowestStockChart"></canvas>
                    </div>
                    <h3>Lowest Stock Items</h3>

                </div>
                <div class="right-box">
                    <div class="box" id="box-6">
                        <canvas id="categoryDoughnutChart"></canvas>
                    </div>
                    <h3>Inventory Makeup</h3>




            </div>
        </div>
    </section>


    <script>
        window.transactionsData = @json($transactions);
        window.highestStockItemsData = @json($highestStockItems);
        window.lowestStockItemsData = @json($lowestStockItems);
        window.chartData = {!! json_encode($chartData) !!};
    </script>

  </body>
</html>
