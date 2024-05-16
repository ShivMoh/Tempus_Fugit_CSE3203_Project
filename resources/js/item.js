document.addEventListener('DOMContentLoaded', function (){
    //* Daily Sales */
    const dailySalesCtx = document.getElementById('dailySales').getContext('2d');
    const dailySalesData = window.dailySales;
    console.log(dailySalesData);

    const dailySalesChart = new Chart(dailySalesCtx, {
        type: 'bar',
        data: {
            labels: dailySalesData.dates,
            datasets: [{
                label: 'Daily Sales',
                data: dailySalesData.sales,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    /* Profit per Transaction */
    // Create Total Profit per Transaction Chart
    const totalProfitPerTransactionCtx = document.getElementById('totalProfitPerTransaction').getContext('2d');
    const totalProfitPerTransactionData = window.totalProfitPerTransaction;

    const totalProfitPerTransactionChart = new Chart(totalProfitPerTransactionCtx, {
        type: 'bar',
        data: {
            labels: totalProfitPerTransactionData.transactionIds,
            datasets: [{
                label: 'Total Profit per Transaction',
                data: totalProfitPerTransactionData.totalProfits,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    /* Earning per Day */
    // Create Total Earnings per Day Chart
    const totalEarningsPerDayCtx = document.getElementById('totalEarningsPerDay').getContext('2d');
    const totalEarningsPerDayData = window.totalEarningsPerDay;

    const totalEarningsPerDayChart = new Chart(totalEarningsPerDayCtx, {
        type: 'line',
        data: {
            labels: totalEarningsPerDayData.transactionDates,
            datasets: [{
                label: 'Total Earnings per Day',
                data: totalEarningsPerDayData.totalEarnings,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


});
