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

function fetchDailyRevenue(selectedDate) {
    $.ajax({
        url: 'ajax-daily-revenue',
        method: 'GET',
        data: { selected_date: selectedDate },
        success: function(response) {
            let groupDailySaleProducts = response.groupDailySaleProducts;
            let totalDailyRevenue = response.totalDailyRevenue;

            let tbody = '';
            $.each(groupDailySaleProducts, function(index, product) {
                let productName = product.code_variant ? product.product.title + ' ' + product.product_variant.name : product.product.title;

                tbody += '<tr>';
                tbody += '<td class="tw-font-bold"><a href="/admin/product/' + product.product_id + '/edit">' + productName + '</a></td>';
                tbody += '<td>' + product.quantity + '</td>';
                tbody += '<td>' + new Intl.NumberFormat().format(product.amount) + 'đ</td>';
                tbody += '</tr>';
            });

            $('tbody#product-table-body').html(tbody); 
            $('.total-daily_amount').text(new Intl.NumberFormat().format(totalDailyRevenue) + 'đ'); 
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

$('#selected_date').on('change', function() {
    let selectedDate = $(this).val();
    fetchDailyRevenue(selectedDate);
});

let initialDate = $('#selected_date').val();
if (initialDate) {
    fetchDailyRevenue(initialDate);
}
