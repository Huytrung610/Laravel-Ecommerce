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
            <tr>
                {{-- <th scope="row"><a href="#">3456789JQK</a></th> --}}
                <th scope="row"><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl">3456789JQK</a></th>
                @include('frontend.popup.order-detail-popup')

                <td>12345 Đống Đa, thành phố Hà nội</td>
                <td>100</td>
                <td>
                    <span class="status-complete">Complete</span>
                </td>
            </tr>
            <tr>
                <th scope="row"><a href="#">ABCOOOASD</a></th>
                <td>12345 ĐẠI CỒ VIỆT, PHƯỜNG BÁCH KHOA, THÀNH PHỐ HÀ NỘI</td>
                <td>100</td>
                <td>
                    <span class="status-new">New</span>
                </td>
            </tr>
            <tr>
                <th scope="row"><a href="#">ABC888888</a></th>
                <td>12345 Đống Đa, thành phố Hà nội</td>
                <td>100</td>
                <td>
                    <span class="status-processing">Processing</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
