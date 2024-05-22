import $ from 'jquery';
window.jQuery = $;
window.$ = $;

$(document).ready(function () {
    createBarChart('bar-chart-year', labelYear, dataYear) 
    $('.tab-chart').on('click', function () {
        let chartType = $(this).data('chart-type');
        let idChart = $(this).attr('href').replace('#tabs-', '');
        switch (chartType) {
            case 'year':
                createBarChart(idChart, labelYear, dataYear);
                break;
            case 'week':
                createBarChart(idChart, labelWeek, dataWeek);
                break;
            case 'month':
                createBarChart(idChart, labelMonth, dataMonth);
                break;
            case 'best-products':
                createPieChart('best-sell-products', productLabels, productQuantities)
                break;
        }
    });
  
});

function createBarChart(idChart, label, data) {
    let canvas = document.getElementById(idChart);
    let ctx = canvas.getContext('2d');
    let myBarChart;
    if(myBarChart){
        myBarChart.destroy();
    }

    let chartData = {
        labels: label,
        datasets: [
            {
                label: 'Revenue',
                data: data,
                borderColor: 'rgb(52, 211, 153)',
                backgroundColor: 'rgb(52, 211, 153)',
                fill: true
            }
        ]
    }

    let chartOption = {
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                    let value = tooltipItem.yLabel;
                    value = value.toString();
                    value = value.split(/(?=(?:...)*$)/);
                    value = value.join('.');
                    
                    return value;
                }
            }
        },
        scales:{
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    userCallback: function (value, index, values){
                        value = value.toString();
                        value = value.split(/(?=(?:...)*$)/);
                        value = value.join('.');
                        
                        return value;
                    }
                }
            }],
            xAxes: [{
                ticks: {
                }
            }]
        }
    }

    window.myBarChart = new Chart(ctx, {type: 'bar', data: chartData, options: chartOption});

}

function createPieChart(idChart, labels, data) {
    let canvas = document.getElementById(idChart);
    let ctx = canvas.getContext('2d');
    let myPieChart;

    // Kiểm tra và hủy biểu đồ hiện tại nếu tồn tại
    if (window.myPieChart) {
        window.myPieChart.destroy();
    }

    let chartData = {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)'
            ],
            hoverOffset: 4
        }]
    };

    let chartOptions = {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        let value = tooltipItem.raw;
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    }
                }
            }
        }
    };

    window.myPieChart = new Chart(ctx, {
        type: 'pie',
        data: chartData,
        options: chartOptions
    });
}
