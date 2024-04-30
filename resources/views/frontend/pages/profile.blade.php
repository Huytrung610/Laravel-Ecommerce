@extends('frontend.layouts.master')

@section('title', env('APP_NAME') . ' || Member')

@section('main-content')
@include('frontend.layouts.header_fe')
<div class="member-container tw-bg-gray-100">
    <section class="container tw-min-h-screen tw-pt-5">

        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
            </ol>
        </nav>

        <div class="tw-grid tw-grid-cols-[1fr_2.4fr] tw-gap-8 tw-py-8 tw-px-4 tw-bg-white">
            <div class="user-name tw-shadow-xl tw-h-fit">
                <div class="greeting-user tw-flex tw-items-center tw-bg-blue-500 tw-gap-4 tw-p-2.5">
                    <img src="https://didongthongminh.vn/images/logo-user.svg" alt="avatar" class="img-responsive tw-w-11 tw-h-11">
                    <div class="name tw-text-lg tw-text-white">
                        Hello, <span>{{ $user->name ?? $defaultAddress->name }}</span>
                    </div>
                </div>
                <ul class="nav flex-column nav-pills me-3" id="v-pills-member-tab" role="tablist" aria-orientation="vertical">
                    <li class="item-user tw-p-2 tw-pl-3 tw-font-bold active" id="v-pills-profile-tab" 
                        data-bs-toggle="pill" data-bs-target="#v-pills-profile" 
                        role="tab" aria-controls="v-pills-profile" 
                        aria-selected="true">
                        Profile information
                    </li>
                    <li class="item-user tw-p-2 tw-pl-3 tw-font-bold tw-text-black" id="v-pills-order-manage-tab" 
                        data-bs-toggle="pill" data-bs-target="#v-pills-order-manage" 
                        role="tab" aria-controls="v-pills-order-manage" 
                        aria-selected="false">
                        Order management
                    </li>
                    <li class="item-user tw-p-2 tw-pl-3 tw-font-bold tw-text-black" id="v-pills-change-pw-tab" 
                        data-bs-toggle="pill" data-bs-target="#v-pills-change-pw" 
                        role="tab" aria-controls="v-pills-change-pw" 
                        aria-selected="false">
                        Change password
                    </li>
                    <li class="item-user tw-p-2 tw-pl-3 tw-font-bold tw-text-black" id="v-pills-address-list-tab" 
                        data-bs-toggle="pill" data-bs-target="#v-pills-address-list" 
                        role="tab" aria-controls="v-pills-address-list" 
                        aria-selected="false">
                        Address list
                    </li>
                </ul>
            </div>
            
            <div class="tab-content tw-px-4 tw-border tw-border-gray-400 tw-p-2" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-profile" 
                    role="tabpanel" 
                    aria-labelledby="v-pills-profile-tab">
                    @include('frontend.pages.user.profile-info')
                </div>
                <div class="tab-pane fade" id="v-pills-order-manage" 
                    role="tabpanel" 
                    aria-labelledby="v-pills-order-manage-tab">
                    @include('frontend.pages.user.order-list')
                </div>
                <div class="tab-pane fade" id="v-pills-change-pw" 
                    role="tabpanel" 
                    aria-labelledby="v-pills-change-pw-tab">
                    @include('frontend.pages.user.change-password')
                </div>
                <div class="tab-pane fade" id="v-pills-address-list" 
                    role="tabpanel" 
                    aria-labelledby="v-pills-address-list-tab">
                    @include('frontend.pages.user.address-list')
                </div>
            </div>
        </div>
    </section>
</div>

    
@push('after_scripts')
    <script src="{{ mix('js/frontend/member.js') }}"></script>
    <link href="{{ asset('css/member-setting.css') }}" rel="stylesheet">
  
@endpush
   
@endsection 