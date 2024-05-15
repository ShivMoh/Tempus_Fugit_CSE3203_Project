document.addEventListener('DOMContentLoaded', function () {
    // Create the sales chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    let salesChart;

    function createSalesChart() {
        const transactions = window.transactionsData;
        const salesLabels = transactions.map(transaction => {
            const date = new Date(transaction.created_at);
            return date.toLocaleDateString(); // Format date to only display date part
        });
        const salesDataValues = transactions.map(transaction => transaction.total_cost);

        const salesData = {
            labels: salesLabels,
            datasets: [{
                label: 'Total Cost',
                data: salesDataValues,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false,
                tension: 0.1
            }]
        };

        const salesConfig = {
            type: 'line',
            data: salesData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        if (salesChart) {
            salesChart.destroy();
        }

        salesChart = new Chart(salesCtx, salesConfig);
    }


    createSalesChart();

    // Create the highest stock items chart
    const stockCtx = document.getElementById('highestStockChart').getContext('2d');
    let stockChart;

    function createStockChart() {
        const highestStockItems = window.highestStockItemsData;
        const stockLabels = highestStockItems.map(item => item.name);
        const stockDataValues = highestStockItems.map(item => item.stock_count);

        const stockData = {
            labels: stockLabels,
            datasets: [{
                label: 'Stock Count',
                data: stockDataValues,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1,
                fill: false,
                tension: 0.1
            }]
        };

        const stockConfig = {
            type: 'bar',
            data: stockData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        if (stockChart) {
            stockChart.destroy();
        }

        stockChart = new Chart(stockCtx, stockConfig);
    }

    createStockChart();

    // Create the lowest stock items chart
    const lowestStockCtx = document.getElementById('lowestStockChart').getContext('2d');
    let lowestStockChart;

    function createLowestStockChart() {
        const lowestStockItems = window.lowestStockItemsData;
        const lowestStockLabels = lowestStockItems.map(item => item.name);
        const lowestStockDataValues = lowestStockItems.map(item => item.stock_count);

        const lowestStockData = {
            labels: lowestStockLabels,
            datasets: [{
                label: 'Stock Count',
                data: lowestStockDataValues,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: false,
                tension: 0.1
            }]
        };

        const lowestStockConfig = {
            type: 'bar',
            data: lowestStockData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        if (lowestStockChart) {
            lowestStockChart.destroy();
        }

        lowestStockChart = new Chart(lowestStockCtx, lowestStockConfig);
    }

    createLowestStockChart();

    // Create the category doughnut chart
    const categoryDoughnutCtx = document.getElementById('categoryDoughnutChart').getContext('2d');
    const chartData = window.chartData;

    new Chart(categoryDoughnutCtx, {
        type: 'doughnut',
        data: {
            labels: chartData.labels,
            datasets: chartData.datasets
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
});
