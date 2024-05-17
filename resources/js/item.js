document.addEventListener('DOMContentLoaded', function (){
    //* Daily Sales */
    const dailySalesCtx = document.getElementById('dailySales').getContext('2d');
    const dailySalesData = window.dailySales;
    console.log(dailySalesData);

    // Initialize empty arrays to store the extracted data
    const days = [];
    const sales = [];

    // Iterate over the dailySalesData array and extract the day and daily_sales values
    dailySalesData.forEach(entry => {
        days.push(entry.day);
        sales.push(entry.daily_sales);
    });

    // Now you can use the days and sales arrays in your chart data
    const dailySalesChart = new Chart(dailySalesCtx, {
        type: 'bar',
        data: {
            labels: days, // Use the days array for labels
            datasets: [{
                label: 'Daily Sales',
                data: sales, // Use the sales array for data
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

    // Initialize arrays to store labels (IDs) and total profits
    const labels = [];
    const totalProfits = [];

    // Iterate over totalProfitPerTransactionData to extract IDs and total profits
    totalProfitPerTransactionData.forEach((entry, index) => {
        labels.push(index + 1); // Use array index plus 1 as the ID
        totalProfits.push(entry.total_profit);
    });

    // Now you can use labels and totalProfits arrays in your chart data
    const totalProfitPerTransactionChart = new Chart(totalProfitPerTransactionCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Profit per Transaction',
                data: totalProfits,
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

    // Initialize arrays to store transaction dates and total earnings
    const transactionDates = [];
    const totalEarnings = [];

    // Iterate over totalEarningsPerDayData to extract transaction dates and total earnings
    totalEarningsPerDayData.forEach(entry => {
        transactionDates.push(entry.transaction_date);
        totalEarnings.push(entry.total_earnings);
    });

    // Now you can use transactionDates and totalEarnings arrays in your chart data
    const totalEarningsPerDayChart = new Chart(totalEarningsPerDayCtx, {
        type: 'line',
        data: {
            labels: transactionDates,
            datasets: [{
                label: 'Total Earnings per Day',
                data: totalEarnings,
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
