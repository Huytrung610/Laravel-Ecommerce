<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h5>My Ordered</h5>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter orders
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">All orders</a>
                <a class="dropdown-item" href="#">New</a>
                <a class="dropdown-item" href="#">Processing</a>
                <a class="dropdown-item" href="#">Complete</a>
            </div>
        </div>
    </div>
    <br>
    <table class="table table-hover">
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
            <tr>
                {{-- <th scope="row"><a href="#">3456789JQK</a></th> --}}
                <th scope="row"><a href="#" class="order-detail-link" data-order-id="{{ $order->id }}" data-toggle="modal" data-target=".bd-example-modal-xl"> {{ $order->order_number }}</a></th>
                @include('frontend.popup.order-detail-popup')

                <td>{{ $detail_address }}</td>
                <td>{{$order->quantity}}</td>
                <td>
                    <span class="status-complete">{{$order->status}}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@push('after_scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>   

@endpush
