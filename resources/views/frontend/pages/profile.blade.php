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
                    <li class="item-user tw-flex tw-gap-2 tw-p-2 tw-pl-3 tw-font-bold active" id="v-pills-profile-tab" 
                        data-bs-toggle="pill" data-bs-target="#v-pills-profile" 
                        role="tab" aria-controls="v-pills-profile" 
                        aria-selected="true">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-h-5 tw-w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        <span>Profile information</span>
                    </li>
                    <li class="item-user tw-flex tw-gap-2 tw-p-2 tw-pl-3 tw-font-bold tw-text-black" id="v-pills-order-manage-tab" 
                        data-bs-toggle="pill" data-bs-target="#v-pills-order-manage" 
                        role="tab" aria-controls="v-pills-order-manage" 
                        aria-selected="false">
                        <svg class="tw-h-5 tw-w-5"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        <span>Order management</span>
                    </li>
                    <li class="item-user tw-flex tw-gap-2 tw-p-2 tw-pl-3 tw-font-bold tw-text-black" id="v-pills-change-pw-tab" 
                        data-bs-toggle="pill" data-bs-target="#v-pills-change-pw" 
                        role="tab" aria-controls="v-pills-change-pw" 
                        aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-5 tw-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <span>Change password</span>
                    </li>
                    <li class="item-user tw-flex tw-gap-2 tw-p-2 tw-pl-3 tw-font-bold tw-text-black" id="v-pills-address-list-tab" 
                        data-bs-toggle="pill" data-bs-target="#v-pills-address-list" 
                        role="tab" aria-controls="v-pills-address-list" 
                        aria-selected="false">
                        <svg class="tw-h-5 tw-w-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M0 0h24v24H0z" stroke="none"/><rect x="3" y="5" width="18" height="14" rx="3"/>
                            <path d="M3 10h18M7 15h.01M11 15h2"/>
                        </svg>
                        <span>Address list</span>
                    </li>
                    <li class="item-user tw-flex tw-gap-2 tw-p-2 tw-pl-3 tw-text-black" >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-5 tw-h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                        </svg>
                      <a class="dropdown-item tw-font-bold" href="{{route('user.logout')}}"><span class="small-text">Logout</span></a></li>
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