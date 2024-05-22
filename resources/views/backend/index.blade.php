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
        {{-- <div class="col-xl-9 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Best-selling Products</h6>
                </div>
                
            </div>
        </div> --}}

<script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{ mix('js/backend/dashboard.js') }}"></script> 

@endsection
