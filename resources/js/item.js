document.addEventListener('DOMContentLoaded', function (){
    // Create Daily Sales Chart
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
});
