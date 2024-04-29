import $ from 'jquery';
window.jQuery = $;
window.$ = $;

$(document).ready(function(){
    HandleUpdateForm()
    HandleNewAddressForm()
    updateDefaultAddress()
    deleteAddress() 
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
    
}


