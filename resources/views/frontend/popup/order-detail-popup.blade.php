  
@php
$user = auth()->user() ?? null;
$listAddress = $user->getAddress();
$defaultAddress =$user->getAddressDefault() ?? $listAddress->first();

@endphp
<div class="modal modalOrder fade bs-example-modal-lg" id="orderDetailModal-{{ $order->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header" >
        <h1 class="tw-text-2xl tw-font-bold">ORDER INFORMATION</h1>
      </div>

      <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-4 tw-flex tw-flex-col tw-gap-3">
                <div class="order-detail--infor">
                  <div class="tw-text-black"><strong>Order ID:</strong> 
                    <span class="order_number tw-text-black tw-font-bold"></span>
                  </div>
                  <div class="tw-text-black"><strong>Delivery date:</strong> 
                      <span class="delivery_date"></span>
                  </div>
                  <div class="tw-text-black"><strong>Status:</strong> 
                      <span class="status tw-text-black"></span>
                  </div>
                </div>
                <div class="order-detail-contact">
                  <span class="title tw-text-black tw-text-lg"><strong>Contact Info</strong> </span>
                  <div class="subtitle tw-text-black"><strong>Name:</strong> 
                      <span class="name tw-text-black"></span>
                  </div>
                  <div class="subtitle tw-text-black"><strong>Email:</strong>
                        <span class="email tw-text-black"></span>
                      </div>
                  <div class="subtitle tw-text-black"><strong>Phone:</strong> 
                      <span class="phone tw-text-black"></span>
                  </div>
                  <div class="tw-text-black"><strong>Payment Method:</strong> 
                    <span class="payment_method tw-capitalize"></span>
                  </div>
                  <div class="tw-text-black"><strong>Shipping Address:</strong>
                    <span class="detail_address"></span>
                  </div>
                </div>
              </div>

              <div class="col tw-flex tw-flex-col tw-gap-6">
                <div class="row">
                  <div class="col-6">
                    <span class="tw-text-black"><strong>Order Item:</strong></span>
                      <div class="order-item-products-column tw-text-black tw-flex tw-flex-col">
                      </div>
                  </div>
                  <div class="col">
                    <span class="tw-text-black"><strong>Quantity:</strong></span>
                      <div class="order-item-quanties-column tw-text-black tw-flex tw-flex-col">
                      </div>
                  </div>
                  <div class="col">
                    <span class="tw-text-black"><strong>Price:</strong></span>
                      <div class="order-item-prices-column tw-text-black tw-flex tw-flex-col">
                      </div>
                  </div>
                  <div class="col">
                    <span class="tw-text-black"><strong>Total:</strong></span>
                      <div class="order-item-totals-column tw-text-black tw-flex tw-flex-col">
                      </div>
                  </div>
                </div>
                <div class="row tw-flex tw-justify-end tw-text-xl ">
                  <div class="subTotalOrder-wrapper tw-bg-gray-300 tw-w-fit">
                    <span class="tw-w-fit tw-text-black">Total amount :</span>
                    <span class="subTotalOrder tw-w-fit tw-text-black tw-text-red-400"></span>
                  </div>
                </div>
              </div>
            </div>
          </div> 
      </div>
      <div class="modal-footer" style="border:0px;">
        <button type="button" class="btn tw-bg-gray-400 tw-text-white hover:tw-bg-gray-300" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  