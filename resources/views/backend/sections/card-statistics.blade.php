@php
    use App\Helpers\Backend\OrderHelper;
    $orderHelper = new OrderHelper();
@endphp

<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 tw-py-4">
            <div class="">
                <div class="">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 tw-flex tw-justify-between">
                            Orders during the month
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="tw-text-2xl">{{ $orderStatistic['orderCurrentMonth'] }}</span></div>
                        <div class="growth-wrapper tw-flex tw-justify-between">
                            <span class="tw-text-xs">Growth compared to the previous month</span>
                            <div class="growth-firgures tw-flex tw-gap-1">
                                {!!  $orderHelper->growHtml($orderStatistic['grow']) !!}
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 tw-py-4">
            <div class="">
                <div class="">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1 tw-flex tw-justify-between">
                            Total Orders
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="tw-text-2xl">{{ $totalOrder }}</span></div>
                        <div class="cancel-order-wrapper tw-flex tw-justify-between">
                            <span class="tw-text-xs">Cancellation rate <span>({{$cancelOrder}} orders)</span></span>
                            <div class="cancel-firgures tw-flex tw-gap-1">
                                <span class="tw-text-red-400">{!!  $orderHelper->cancellationRate( $totalOrder, $cancelOrder ) !!}%</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 tw-py-4 tw-flex">
            <div class="">
                <div class="">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1 tw-flex tw-justify-between">Total Revenue
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="tw-text-2xl">{{ number_format($totalRevenue, 0) }}đ</span></div>
                        <div class="total-revenue-wrapper tw-flex tw-justify-between">
                            <span class="tw-text-xs">Total revenue</span>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 tw-py-4 tw-flex">
            <div class="">
                <div class="">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1 tw-flex tw-justify-between">
                            Total Customer
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#D1D5DB" class="tw-w-6 tw-h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>   
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="tw-text-2xl">{{$totalCustomer}}</span></div>
                        <div class="subcriber-wrapper tw-flex tw-justify-between">
                            <span class="tw-text-xs">Total <span class="tw-text-red-400">{{ $totalSubcribers }}</span> subribers</span>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>