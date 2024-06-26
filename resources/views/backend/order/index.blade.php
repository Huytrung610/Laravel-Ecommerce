@extends('backend.layouts.master')

@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">{{__('Order Lists')}}</h6>
            <div class="float-right">
                <form action="{{ Request::is('admin/order') ? route('order.index') : route('order.receipt.index') }}" method="GET" class="form-inline">
                    <div class="form-group">
                        <label for="start_date">{{__('Start Date')}}:</label>
                        <input type="date" class="form-control mx-sm-2" id="start_date" name="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="form-group">
                        <label for="end_date">{{__('End Date')}}:</label>
                        <input type="date" class="form-control mx-sm-2" id="end_date" name="end_date" value="{{ request('end_date') }}">
                    </div>
                    <button type="submit" class="btn tw-text-white tw-bg-blue-400 tw-mr-2 hover:tw-bg-blue-300">{{__('Filter')}}</button>
                    <button type="submit" id="clearFilter" class="btn tw-text-white tw-bg-red-400  hover:tw-bg-red-300">{{ __('Clear Filter') }}</button>
                </form>                
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive tw-gap-4">
                @if(count($orders)>0)
                    <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Order No.')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Detail Address')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Delivery date')}}</th>
                            <th>{{__('Total Amount')}} </th>
                            <th>{{__('Payment Method')}} </th>
                            <th>{{__('Payment Status')}} </th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Order No.')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Detail Address')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Delivery date')}}</th>
                            <th>{{__('Total Amount')}}</th>
                            <th>{{__('Payment Method')}} </th>
                            <th>{{__('Payment Status')}} </th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($orders as $order)
                            {{-- @php
                                $shipping_charge = DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
                            @endphp --}}
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->order_number}}</td>
                                <td>{{$order->name}} </td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->detail_address}}</td>
                                <td>{{$order->quantity}}</td>
                                <td>{{date_format($order->created_at, "Y/m/d")}}</td>
                                <td>{{ $order->delivery_date ? \Illuminate\Support\Carbon::parse($order->delivery_date)->format("Y/m/d") : '' }}</td>
                                <td>{{number_format($order->total_amount,0)}}đ</td>
                                <td class="tw-capitalize">{{$order->payment_method}}</td>
                                <td class="tw-capitalize">
                                    @if( $order->payment_status == 'paid' )
                                        <span class="tw-bg-green-100 tw-text-green-800 tw-text-sm tw-me-2 tw-px-2.5 tw-py-0.5 tw-rounded">{{$order->payment_status}}</span>
                                    @elseif ($order->payment_status == 'unpaid')
                                        <span class="tw-bg-yellow-100 tw-text-yellow-800 tw-text-sm tw-me-2 tw-px-2.5 tw-py-0.5 tw-rounded">{{$order->payment_status}}</span>
                                    @else 
                                        <span class="tw-bg-red-100 tw-text-red-800 tw-text-sm tw-font-medium tw-me-2 tw-px-2.5 tw-py-0.5 tw-rounded">Payment Failed</span>
                                    @endif
                                </td>
                                <td>
                                    @if($order->status=='new')
                                        <span class="badge badge-primary">{{$order->status}}</span>
                                    @elseif($order->status=='process')
                                        <span class="badge badge-warning">{{$order->status}}</span>
                                    @elseif($order->status=='delivered')
                                        <span class="badge badge-success">{{$order->status}}</span>
                                    @else
                                        <span class="badge badge-danger">{{$order->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(empty($orderReceipt))
                                        <a href="{{route('order.show',$order->id)}}"
                                           class="btn btn-warning btn-sm float-left mr-1 tw-h-[30px] tw-w-[30px] tw-rounded-full"
                                            data-toggle="tooltip"
                                           title="view" data-placement="bottom"><i class="fas fa-eye wgt-order-show"></i></a>
                                    @else
                                        <a href="{{route('order.receipt.show',$order->id)}}"
                                           class="btn btn-warning btn-sm float-left mr-1"
                                           style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                           title="view" data-placement="bottom"><i class="fas fa-eye wgt-order-show"></i></a>
                                    @endif
                                    @php
                                        $destroyUrl = route('order.destroy',[$order->id]);
                                        if(!empty($orderReceipt)) {
                                            $destroyUrl = route('order.receipt.destroy',[$order->id]);
                                        }
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="footer-order-list tw-flex tw-justify-between">
                        <a href="{{ Request::is('admin/order') ? route('orders.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) : route('receipts.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="export-order-btn tw-text-blue-500">
                            @if (Request::is('admin/order'))
                                Export order list
                            @else
                                Export receipt list
                            @endif
                        </a>                        
                        <div class="total-amount float-right tw-border-2 tw-border-black tw-p-2.5 tw-bg-[#e3e6f0] tw-font-bold tw-uppercase tw-mt-4">
                            Total Amount: {{ number_format($totalAmount, 0) }} vnđ
                        </div>
                    </div>                    
                    
{{--                    <span style="float:right">{{$orders->links()}}</span>--}}
                @else
                    <h6 class="text-center">{{__('No orders found!!! Please order some products')}}</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
@endpush

@push('after_scripts')
   
<link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<!-- Page level plugins -->
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    

    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
    <script>

        $('#order-dataTable').dataTable({
            "columnDefs": [
                {
                    "ordering":true,
                    "orderable": false,
                    "targets": [9, 10, 11]
                }
            ],
        });

        function deleteData(id) {

        }
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
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
            })
            $('#clearFilter').on('click', function() {
                $('#start_date').val('');
                $('#end_date').val('');
                
                $('#filterForm').submit();
            });
        })
    </script>
@endpush
