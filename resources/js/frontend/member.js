import $ from 'jquery';
window.jQuery = $;
window.$ = $;

$(document).ready(function(){
  
    HandleUpdateForm()
    HandleNewAddressForm()
    updateDefaultAddress()
    deleteAddress() 
    showModalOrder()
    hideModalOrder()
})

function HandleUpdateForm(){
    $('.existing-address').find('span').click(function(event){
        event.stopPropagation();

        let addressForm = $(this).closest('.existing-address').siblings('.existed-address-member--form');
        let isHidden = addressForm.hasClass('tw-hidden');

        $('.existed-address-member--form').addClass('tw-hidden');
    
        if (isHidden) {
            addressForm.removeClass('tw-hidden');
        } else {
            addressForm.addClass('tw-hidden');
        }
    });
}

function HandleNewAddressForm(){
    $('.create-address--btn').click(function(){
        let addressForm = $(this).siblings('.new-address-member--form');
        
        let isHidden = addressForm.hasClass('tw-hidden');

        $('.new-address-member--form').addClass('tw-hidden');
        
        if (isHidden) {
            addressForm.removeClass('tw-hidden');
        } else {
            addressForm.addClass('tw-hidden');
        }
    });
}
function updateDefaultAddress() {
    $('input[type="radio"][name="default_address"]').click(function() {
        let addressId = $(this).data('id');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: 'update-default-address',
            data: {
                id: addressId,
                _token: csrfToken
            },
            success: function(response) {
                if (response.success) {
                    console.log('Default address updated successfully.');
                } else {
                    console.log('Error occurred while updating default address.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error occurred while updating default address:', error);
            }
        });
    });
    
}
function deleteAddress() {
    $('.dlt-address--btn').click(function(e){
        let form = $(this).closest('form');

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
}
function showModalOrder(){
    $('.order-detail-link').click(function(e) {
        e.preventDefault();

        let orderId = $(this).data('order-id');
        let modalId = '#orderDetailModal-' + orderId;
        loadOrderDetail(orderId);

        $(modalId).modal('show'); 
    });
}
function loadOrderDetail(orderId) {
    $.ajax({
        url: 'order-detail/' + orderId,
        data : {
            id: orderId,
        },
        type: 'GET',
        success: function(response) {
            let dataOrder = response.data
            let dataProducts = response.cartProducts['cart-products'];
            console.log(response);
            $('#orderDetailModal-'+ orderId + ' .order_number').html(dataOrder.order_number) ?? '';
            if(dataOrder.status == 'new'){
                $('#orderDetailModal-'+ orderId +' .status').addClass('badge tw-capitalize tw-p-1 tw-bg-blue-500 tw-text-white')
            }else if(dataOrder.status == 'process') {
                $('#orderDetailModal-'+ orderId +' .status').addClass('badge tw-capitalize tw-p-1 tw-bg-yellow-400 tw-text-black')
            }else if(dataOrder.status == 'delivered') {
                $('#orderDetailModal-'+ orderId +' .status').addClass('badge tw-capitalize tw-p-1 tw-bg-green-400 tw-text-white')
            } else {
                $('#orderDetailModal-'+ orderId +' .status').addClass('badge tw-capitalize tw-p-1 tw-bg-red-500 tw-text-white')
            }
            $('#orderDetailModal-'+ orderId +' .status').html(dataOrder.status)?? '';
            $('#orderDetailModal-'+ orderId +' .name').html(dataOrder.name) ?? '';
            if(dataProducts.length != 0){
                $('#orderDetailModal-'+ orderId +' .subTotalOrder').html(parseFloat(dataOrder.sub_total).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })) ?? '';
            }
            $('#orderDetailModal-'+ orderId +' .delivery_date').html(dataOrder.delivery_date) ?? '';
            $('#orderDetailModal-'+ orderId +' .payment_method').html(dataOrder.payment_method) ?? '';
            $('#orderDetailModal-'+ orderId +' .phone').html(dataOrder.phone) ?? '';
            $('#orderDetailModal-'+ orderId +' .email').html(dataOrder.email) ?? '';
            $('#orderDetailModal-'+ orderId +' .detail_address').html(dataOrder.detail_address) ?? '';
            appendProductOrder(dataProducts)
        },
        error: function(xhr, status, error) {
            console.error('Error occurred while loading order detail:', error);
        }
    });
}

function appendProductOrder(dataProducts) {
    let $orderItemProductsColumn = $('.order-item-products-column');
    let $orderItemQuantiesColumn = $('.order-item-quanties-column');
    let $orderItemPriceColumn = $('.order-item-prices-column');
    let $orderItemTotalsColumn = $('.order-item-totals-column');
    let domain = window.location.hostname;
    let port = window.location.port;
    if (port) {
        domain += ":" + port;
    }
    $orderItemProductsColumn.empty();
    $orderItemQuantiesColumn.empty();
    $orderItemPriceColumn.empty();
    $orderItemTotalsColumn.empty();

    dataProducts.forEach(function(product) {
        let productName = product.code_variant ?  product.product.title + ' ' + product.product_variant.name : product.product.title;
        let quantity = product.quantity;
        let priceProduct = product.code_variant ?  product.product_variant.price : product.product.price;
        let totalProduct = product.amount;
        let formattedPrice = parseFloat(priceProduct).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        let formattedTotal = parseFloat(totalProduct).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });

        $orderItemProductsColumn.append('<a href="http://' + domain + '/product-detail/' + product.product.slug + '"><span class="order-item">' + productName + '</span></a>');
        $orderItemQuantiesColumn.append('<span class="order-item-quantity">' + quantity + '</span>');
        $orderItemPriceColumn.append('<span class="order-item-price">' + formattedPrice + '</span>');
        $orderItemTotalsColumn.append('<span class="order-item-total">' + formattedTotal + '</span>');
    });
}


function hideModalOrder(){
    $('.modal-footer button[data-dismiss="modal"]').click(function() {
        $(this).closest('.modal').modal('hide'); 
    });
}


