<div class="payment_method--container form-group tw-pb-5 tw-flex tw-flex-col tw-gap-3">
    <h1 class="payment_method--heading tw-font-bold tw-text-xl">Payment Method</h1>
    <div class="payment_method--wrapper">
        <label for="cod" class="tw-flex tw-gap-3 tw-items-center tw-border tw-border-gray-400 tw-px-4 tw-py-2 tw-rounded-3xl">
            <input type="radio" name="payment_method" value="cod" id="cod" checked>
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-10 tw-h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>                  
            </span>
            <span class="payment_method--title tw-font-bold">Cash On Delivery (COD)</span>
        </label>
    </div>
    <div class="payment_method--wrapper">
        <label for="vnpay" class="tw-flex tw-gap-3 tw-items-center tw-border tw-border-gray-400 tw-px-4 tw-py-2 tw-rounded-3xl">
            <input type="radio" name="payment_method" value="vnpay" id="vnpay">
            <span><img class="tw-w-10 tw-h-10 tw-object-contain" src="{{asset('frontend/img/vnpay-logo.png')}}" alt=""></span>
            <span class="payment_method--title tw-font-bold">Payment Via VNPAY Wallet</span>
        </label>
    </div>
    <div class="payment_method--wrapper">
        <label for="momo" class="tw-flex tw-gap-3 tw-items-center tw-border tw-border-gray-400 tw-px-4 tw-py-2 tw-rounded-3xl">
            <input type="radio" name="payment_method" value="momo" id="momo">
            <span><img class="tw-w-10 tw-h-10 tw-object-contain" src="{{asset('frontend/img/vnpay-logo.png')}}" alt=""></span>
            <span class="payment_method--title tw-font-bold">Payment Via Momo Wallet</span>
        </label>
    </div>
</div>