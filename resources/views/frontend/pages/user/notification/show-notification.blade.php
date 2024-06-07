<a class="tw-flex tw-items-center tw-text-third tw-relative" href="#" id="alertsDropdown" role="button"
   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-6 tw-h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
    </svg>
    @if(count(auth()->user()->unreadNotifications) > 5 )<span data-count="5" class="count-notifications tw-absolute tw-text-third tw-bg-black tw-rounded-full tw-px-[5px] tw-py-[2px] tw-text-[11px] tw-top-[-7px] tw-right-[-12px]">5+</span>
    @else
        <span class="count-notifications tw-absolute tw-text-third tw-bg-black tw-rounded-full tw-px-[5px] tw-py-[2px] tw-text-[11px] tw-top-[-7px] tw-right-[-2px]"
              data-count="{{count(auth()->user()->unreadNotifications)}}">{{count(auth()->user()->unreadNotifications)}}</span>
    @endif

</a>
<!-- Dropdown - Alerts -->
<div class="dropdown-list dropdown-menu dropdown-menu-left shadow animated--grow-in tw-right-[-2px]"
     aria-labelledby="alertsDropdown">
    <h6 class="dropdown-header wgt-notification-center tw-text-black tw-text-xs tw-font-bold !tw-pt-0 tw-border-b">
        {{__('Notifications Center')}}
    </h6>
    @php
        $unreadNotifications = auth()->user()->unreadNotifications;
        $readNotifications = auth()->user()->readNotifications;
        $allNotifications = $unreadNotifications->merge($readNotifications);
    @endphp
    @if($allNotifications->count())
        @foreach($allNotifications as $notification)
            <a class="dropdown-item d-flex align-items-center wgt-notification-center" target="_blank"
               href="{{route('user.notification.show', $notification->id)}}">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas {{$notification->data['fas']}} text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="tw-text-xs tw-capitalize">{{$notification->created_at->format('F d, Y h:i A')}}</div>
                    <span class="tw-normal-case @if($notification->unread()) tw-font-bold  @else tw-text-xs @endif">
                        {{$notification->data['title']}}
                    </span>
                </div>
            </a>
        @endforeach
    @else
        <div class="tw-text-center">
            <span class="tw-text-red-300 tw-text-xs tw-capitalize">Don't have any notification</span>
        </div>
    @endif
</div>

<style>
    .dropdown-list.dropdown-menu{
        height: 194px;
        overflow-y: scroll;
        border-radius: 10px;
    }
   
    .dropdown-list.dropdown-menu::-webkit-scrollbar {
        width: 8px;
    }
    .dropdown-list.dropdown-menu::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #555;
    }

    .dropdown-list.dropdown-menu::-webkit-scrollbar-thumb:hover {
        background-color: #444;
    }

    .dropdown-list.dropdown-menu::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }

</style>