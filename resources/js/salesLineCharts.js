document.addEventListener('DOMContentLoaded', function() {
    const { labels, sales, profits, costs } = window.chartData;

    function drawLineChart(labels, datasets, chartContainerId) {
        var ctx = document.getElementById(chartContainerId).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    }

    drawLineChart(labels, [
        {
            label: 'Sales',
            data: sales,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            fill: false
        },
        {
            label: 'Profits',
            data: profits,
            borderColor: 'rgb(54, 162, 235)',
            tension: 0.1,
            fill: false
        }
    ], 'salesProfitsChart');

    drawLineChart(labels, [
        {
            label: 'Costs',
            data: costs,
            borderColor: 'rgb(255, 99, 132)',
            tension: 0.1,
            fill: false
        },
        {
            label: 'Sales',
            data: sales,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            fill: false
        }
    ], 'costsSalesChart');
});
