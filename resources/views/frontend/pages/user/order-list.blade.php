<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div class="tw-border-b tw-border-gray-200 tw-pb-2.5">
            <h1 class="tw-text-2xl tw-font-bold">My Orders</h1>
        </div>
        <div class="dropdown">
            <div>
                <input type="text" id="orderSearch" class="form-control" placeholder="Search by Order Number">
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
                <th scope="row"><span class="order-detail-link hover:tw-cursor-pointer" data-ordernumber="{{ $order->order_number }}" data-order-id="{{ $order->id }}" data-toggle="modal" data-target="#orderDetailModal-{{ $order->id }}">{{ $order->order_number }}</span></th>

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
<script>
   $(document).ready(function() {
        function resetTabs() {
            $('.item-user').removeClass('active');
            $('.tab-pane').removeClass('show active');
        }

        function switchToOrderListTabAndFetchOrder(orderNumber) {
            resetTabs(); 
            $('#v-pills-order-manage-tab').addClass('active');
            $('#v-pills-order-manage').addClass('show active');
            $('#orderSearch').val(orderNumber); 
            fetchOrder(orderNumber);
        }

        let urlParams = new URLSearchParams(window.location.search);
        let tab = urlParams.get('tab');
        let orderNumber = urlParams.get('order_number');
        if (tab === 'order-manage' && orderNumber) {
            switchToOrderListTabAndFetchOrder(orderNumber);
            
            let openModal = urlParams.get('openModal')

        } else if (tab === 'order-manage') {
            resetTabs();
            $('#v-pills-order-manage-tab').addClass('active');
            $('#v-pills-order-manage').addClass('show active');
        }
        function fetchOrder(orderNumber) {
            $.ajax({
                url: '{{ route("order.fetch") }}',
                method: 'GET',
                data: { order_number: orderNumber },
                success: function(response) {
                    if (Array.isArray(response.orders)) {
                        console.log("Response from server:", response.orders);
                        $('#orderTable tbody').empty();
                        response.orders.forEach(function(order) {
                            var html = '<tr>';
                            html += '<th scope="row"><span class="order-detail-link hover:tw-cursor-pointer" data-order-id="'+ order.id +'" data-toggle="modal" data-target="#orderDetailModal-'+ order.id +'">' + order.order_number + '</span></th>';
                            html += '<td>' + order.detail_address + '</td>';
                            html += '<td>' + order.quantity + '</td>';
                            html += '<td>';
                            if (order.status == 'new') {
                                html += '<span class="badge badge-primary tw-capitalize tw-p-1 tw-bg-blue-500 tw-text-white">' + order.status + '</span>';
                            } else if (order.status == 'process') {
                                html += '<span class="badge badge-warning tw-capitalize tw-p-1 tw-bg-yellow-400 tw-text-white">' + order.status + '</span>';
                            } else if (order.status == 'delivered') {
                                html += '<span class="badge badge-success tw-capitalize tw-p-1 tw-bg-green-400 tw-text-white">' + order.status + '</span>';
                            } else {
                                html += '<span class="badge badge-danger tw-capitalize tw-p-1 tw-bg-red-500 tw-text-white">' + order.status + '</span>';
                            }
                            html += '</td>';
                            html += '</tr>';
                            $('#orderTable tbody').append(html);
                        });
                    } else {
                        console.error("Response is not an array:", response.orders);
                    }

                    // Update popup HTML
                    $('#orderDetailPopup').html(response.popupHtml);
                },
                error: function(error) {
                    console.error("Error fetching order:", error);
                }
            });
        }   


        $('#orderSearch').on('input', function() {
            let orderNumberInput = $(this).val();
            fetchOrder(orderNumberInput);
        });
        
    });
</script>

@endpush
