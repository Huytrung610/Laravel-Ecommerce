<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div class="tw-border-b tw-border-gray-200 tw-pb-2.5">
            <h1 class="tw-text-2xl tw-font-bold">My Orders</h1>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter orders
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" onclick="updateFilter('All orders')">All orders</a>
                <a class="dropdown-item" href="#" onclick="updateFilter('New')">New</a>
                <a class="dropdown-item" href="#" onclick="updateFilter('Process')">Process</a>
                <a class="dropdown-item" href="#" onclick="updateFilter('Delivered')">Delivered</a>
                <a class="dropdown-item" href="#" onclick="updateFilter('Cancel')">Cancel</a>
            </div>
        </div>
    </div>
    <br>
    @if(count($orderList))
    <table class="table table-hover" id="orderTable">
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Address</th>
                <th scope="col">Quantity</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderList as $order)
                @php
                    $detail_address = $order->detail_address ?? '';
                @endphp
            @include('frontend.popup.order-detail-popup')
            <tr data-status="{{ $order->status }}">
                <th scope="row"><span class="order-detail-link hover:tw-cursor-pointer" data-order-id="{{ $order->id }}" data-toggle="modal" data-target="#orderDetailModal-{{ $order->id }}">{{ $order->order_number }}</span></th>

                <td>{{ $detail_address }}</td>
                <td>{{ $order->quantity }}</td>
                <td>
                    @if($order->status=='new')
                        <span class="badge badge-primary tw-capitalize tw-p-1 tw-bg-blue-500 tw-text-white">{{$order->status}}</span>
                    @elseif($order->status=='process')
                        <span class="badge badge-warning tw-capitalize tw-p-1 tw-bg-yellow-400 tw-text-white">{{$order->status}}</span>
                    @elseif($order->status=='delivered')
                        <span class="badge badge-success tw-capitalize tw-p-1 tw-bg-green-400 tw-text-white">{{$order->status}}</span>
                    @else
                        <span class="badge badge-danger tw-capitalize tw-p-1 tw-bg-red-500 tw-text-white">{{$order->status}}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <span class="tw-text-[#FF8C00] tw-font-bold">You have not made any orders before!</span>
    @endif
</div>


@push('after_scripts')

@endpush
