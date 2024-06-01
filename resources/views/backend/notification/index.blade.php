@extends('backend.layouts.master')
@section('title', env('APP_NAME') . ' || All Notifications')
@section('main-content')
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <h5 class="card-header">{{__('Notifications')}}</h5>
        <div class="card-body">
            @if(count(backpack_user()->Notifications)>0)
                <table class="table  table-hover admin-table" id="notification-dataTable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('Time')}}</th>
                        <th scope="col">{{__('Title')}}</th>
                        <th scope="col">{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ( backpack_user()->Notifications as $notification)
                        <?php
                             $style = '';
                             if ($notification->unread()) {
                                 $style = "style=font-weight:bold;color:#000";
                             }
                        ?>
                        <tr class="@if($notification->unread()) bg-light border-left-light @else border-left-success @endif" {{$style}}>
                            <td scope="row">{{$loop->index +1}}</td>
                            <td>{{$notification->created_at->format('F d, Y h:i A')}}</td>
                            <td>{{$notification->data['title']}}</td>
                            <td>
                                <a href="{{route('admin.notification', $notification->id) }}"
                                   class="btn btn-primary btn-sm float-left mr-4"
                                   style="height:30px; width:35px;border-radius:50%" data-toggle="tooltip" title="{{__('View')}}"
                                   data-placement="bottom"><i class="fas fa-eye"></i></a>
                                <form method="POST" action="{{ route('notification.delete', $notification->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm dltBtn"
                                            data-id="{{$notification->id}}"
                                            style="height:30px;width:30px;border-radius:50%"
                                            data-toggle="tooltip" data-placement="bottom" title="{{__('Delete')}}"><i
                                        class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h2>{{__('Notifications Empty!')}}</h2>
            @endif
        </div>
    </div>
@endsection
@push('styles')
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
@endpush
@push('after_scripts')
    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
    <script>
        $('#notification-dataTable').DataTable({
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [3]
                }
            ]
        });
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function (e) {
                var form = $(this).closest('form');
                e.preventDefault();
                swal({
                    title: "{{__('Are you sure?')}}",
                    text: "{{__('Once deleted, you will not be able to recover this data!')}}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("{{__('Your data is safe!')}}");
                        }
                    });
            })
        })
    </script>
@endpush
