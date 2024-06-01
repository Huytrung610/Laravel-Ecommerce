@extends('frontend.layouts.master')
@section('title', env('APP_NAME') . ' || My Order')
@section('main-content')
    <div class="top_bg"></div>
    <section class="order_list section flex-1">
        <div class="container">
            <div class="list_order">
                @if(count(auth()->user()->Notifications)>0)
                    <table id="order-dataTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('Time')}}</th>
                            <th scope="col">{{__('Title')}}</th>
                            <th scope="col">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($notifications as $notification)
                            <?php
                            $style = '';
                            if ($notification->unread()) {
                                $style = "style=font-weight:bold;color:#000";
                            }
                            ?>
                            <tr class="@if($notification->unread()) bg-light border-left-light @else border-left-success @endif" {{$style}}>
                                <td scope="row">{{$notification->id}}</td>
                                <td>{{$notification->created_at->format('F d, Y h:i A')}}</td>
                                <td>{{$notification->data['title']}}</td>
                                <td class ="wgt-action-notification">
                                    <a href="{{route('user.notification.show', $notification->id) }}"
                                       title="{{__('View')}}"><span class="wgt-action-view-notification">
                                            <i class="fa fa-eye"></i></span>
                                    </a>
                                    <form method="POST" action="{{ route('user.notification.delete', $notification->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button data-id="{{$notification->id}}"
                                                data-toggle="tooltip" data-placement="bottom" title="{{__('Delete')}}" class="wgt-button-notification bg-light">
                                            <span class="wgt-action-delete-notification"><i class="fa fa-trash"></i></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span class="wgt-notification-paginate">{{($notifications->links())}}</span>
                @else
                    <h6 class="text-center">{{__('Notifications Empty!')}}</h6>
                @endif
            </div>
        </div>
    </section>
    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
@endsection

