import $ from 'jquery';
window.jQuery = $;
window.$ = $;


$(document).ready(function () {
    attachPhoneNumberValidation();
    attachFormSubmitValidation();
});


function validatePhoneNumber(phoneNumber) {
    const phoneRegex = /^[0-9]{10}$/;
    return phoneRegex.test(phoneNumber);
}


function displayPhoneNumberError($phoneNumberInput, $phoneError) {
    const phoneNumber = $phoneNumberInput.val();
    let isValid = validatePhoneNumber(phoneNumber);

    if (phoneNumber === '') {
        $phoneError.addClass('tw-hidden');
    } else {
        if (isValid) {
            $phoneError.addClass('tw-hidden');
            $('#submit_addr_button').prop('disabled', false);
        } else {
            $phoneError.removeClass('tw-hidden');
            $('#submit_addr_button').prop('disabled', true);
        }
    }
}

function attachPhoneNumberValidation() {
    $(document).on('keyup blur', 'input[name="phone_number"]', function() {
        let $phoneNumberInput = $(this);
        let $phoneError = $phoneNumberInput.closest('.form-group').find('.phone_error');
        displayPhoneNumberError($phoneNumberInput, $phoneError);
    });
}

function attachFormSubmitValidation() {
    $(document).on('submit', '#form_address', function(event) {
        let $phoneNumberInput = $('input[name="phone_number"]');
        let $phoneError = $phoneNumberInput.closest('.form-group').find('.phone_error');
        displayPhoneNumberError($phoneNumberInput, $phoneError);

        if (!$phoneError.hasClass('tw-hidden')) {
            event.preventDefault();
        }
    });
}


