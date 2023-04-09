@extends('backend.layouts.master')
@section('title', env('APP_NAME') . ' || DASHBOARD')
@section('main-content')
    <div class="container-fluid">
    @include('backend.layouts.notification')
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        <!-- Content Row -->
        <div class="row">
            <!-- Category -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a class="card border-left-primary shadow h-100 py-2" href="{{ route('category.index') }}">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('Category') }}</div>
                                <!-- <div class="h5 mb-0 font-weight-bold text-gray-800"></div> -->
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Products -->
        <div class="row">
            <!-- Content Row -->
        </div>
@endsection
