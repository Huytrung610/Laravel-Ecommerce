<div class="card shadow mb-4 tw-gap-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Statistic</h6>
    </div>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link tab-chart active" data-toggle="tab" href="#tabs-bar-chart-year" data-chart-type="year" role="tab">Revenue chart</a>
        </li>
        <li class="nav-item">
            <a class="nav-link tab-chart" data-toggle="tab" href="#tabs-bar-chart-week" data-chart-type="week" role="tab">Last 7 days</a>
        </li>
        <li class="nav-item">
            <a class="nav-link tab-chart" data-toggle="tab" href="#tabs-bar-chart-month" data-chart-type="month" role="tab">Daily in Month</a>
        </li>
        <li class="nav-item">
            <a class="nav-link tab-chart" data-toggle="tab" href="#tabs-best-sell-products" data-chart-type="best-products" role="tab">Best-selling Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link tab-chart" data-toggle="tab" href="#tabs-bar-chart-daily" data-chart-type="daily" role="tab">Daily Revenue</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tabs-bar-chart-year" role="tabpanel">
            <h5 class="tw-uppercase tw-text-green-400 tw-font-bold tw-px-4">{{date('Y')}} revenue chart</h5>
            <div class="card-body" >
                <canvas id="bar-chart-year"></canvas>
            </div>
        </div>
        <div class="tab-pane" id="tabs-bar-chart-week" role="tabpanel">
            <div class="card-body" >
                <canvas id="bar-chart-week"></canvas>
            </div>
        </div>
        <div class="tab-pane" id="tabs-bar-chart-month" role="tabpanel">
             <div class="card-body" >
                <canvas id="bar-chart-month"></canvas>
            </div>
        </div>
        <div class="tab-pane" id="tabs-best-sell-products" role="tabpanel">
             <div class="card-body" >
                <canvas id="best-sell-products"></canvas>
            </div>
        </div>
        <div class="tab-pane" id="tabs-bar-chart-daily" role="tabpanel">
            <h5 class="tw-uppercase tw-text-green-400 tw-font-bold tw-px-4">Daily Revenue</h5>
            <div class="card-body">
                <div class="header-daily tw-flex tw-justify-between tw-pr-3">
                    <form id="daily-revenue-form" method="GET" action="" class="">
                        <div class="">
                            <label for="selected_date" class="mr-2">Select Date:</label>
                            <input type="date" id="selected_date" value="{{ now()->toDateString() }}" name="selected_date" class="tw-border tw-rounded-md tw-border-gray tw-p-1 tw-text-center tw-w-7/12">
                        </div>                    
                    </form> 
                    <div class="total-daily">
                        <span class="tw-font-bold">Total:</span>
                        <span class="total-daily_amount tw-font-bold"> <span class="total-daily_amount"></span></span>
                    </div>
                </div>
                               
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Total Revenue</th>
                            <th>Total Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="product-table-body">
                        
                    </tbody>
                          
                </table>
            </div>
        </div> 
    </div>  
</div>

@php
    $productLabels = json_encode(array_column($orderStatistic['topProductsWithVariants'], 'product_name'));
    $productQuantities = json_encode(array_column($orderStatistic ['topProductsWithVariants'], 'total_quantity'));
    $dataYear = json_encode($orderStatistic['revenueChart']['data']);
    $labelYear = json_encode($orderStatistic['revenueChart']['label']);
    $dataWeek = json_encode($orderStatistic['revenueWeek']['data']);
    $labelWeek = json_encode($orderStatistic['revenueWeek']['label']);
    $dataMonth = json_encode($orderStatistic['revenueMonth']['data']);
    $labelMonth = json_encode($orderStatistic['revenueMonth']['label']);
@endphp
<script>
    var productLabels = {!! $productLabels !!};
    var productQuantities = {!! $productQuantities !!};

    var rawDataYear = {!! $dataYear !!};
    var rawDataWeek = {!! $dataWeek !!};
    var rawDataMonth = {!! $dataMonth !!};
    var dataYear = rawDataYear.map(function(item) {
        return parseFloat(item.replace(/,/g, ''));
    });
    var dataWeek = rawDataWeek.map(function(item) {
        return parseFloat(item.replace(/,/g, ''));
    });
   
    var labelYear = JSON.parse('{!! $labelYear !!}');
    var labelWeek = JSON.parse('{!! $labelWeek !!}');
    var labelMonth = JSON.parse('{!! $labelMonth !!}');
    var dataMonthProcessed = {!! $dataMonth !!}.map(function(item) {
    
    if (typeof item === 'string') {
        return parseFloat(item.replace(/,/g, ''));
    } else {
        return item;
    }
});

var dataMonth = JSON.parse(JSON.stringify(dataMonthProcessed));


</script>