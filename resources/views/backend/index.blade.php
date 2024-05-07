@extends('backend.layouts.master')
@section('title', env('APP_NAME') . ' || DASHBOARD')
@section('main-content')
    {{-- <div class="container-fluid"> --}}
    @include('backend.layouts.notification')
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        <!-- Content Row -->
        @include('backend.sections.card-statistics')

        <div class="col-xl-9 col-lg-7">
            @include('backend.sections.chart-statistic')
        </div>
        <div class="col-xl-9 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Best-selling Products</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Lợi nhuận thu về</th>
                            
                          </tr>
                        </thead>
            
                        <tbody>
                          @foreach($products as $product)
                            @php
                                $attribute = new \App\Models\Attribute;
                                $productHelper = new \App\Helpers\Backend\ProductHelper();
                            @endphp 
                            <tr>
                                <th scope="row">
                                    <a href="#">Product A</a>
                                </th>
                                <td>{{$product['total_quantity']}}</td>
                                <td>{{$product['total_amount']}} VNĐ</td>  
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>

<script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{ mix('js/backend/dashboard.js') }}"></script> 
{{-- <script>
    var labels = {!! json_encode($labels) !!};
    var revenues = {!! json_encode($revenues) !!};
    var quantities = {!! json_encode($quantities) !!};

    var ctx = document.getElementById('chart_statistic').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Revenue',
                    data: revenues,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true
                },
                {
                    label: 'Quantity',
                    data: quantities,
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Amount'
                    }
                }
            }
        }
    });
</script> --}}
@endsection
