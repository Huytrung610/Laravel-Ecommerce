import $ from 'jquery';
window.jQuery = $;
window.$ = $;


$(document).ready(function () {
    validateForm();
});

function handleSubmitForm(event) {
    event.preventDefault();

    let phone = $('form#form_address').find('input[name="phone_number"]').val();
    console.log(validatePhoneNumber(phone))
    if (!validatePhoneNumber(phone)) {
        $('form#form_address').find('.phone_error').removeClass('tw-hidden'); 
    } else {
        $('form#form_address').off('submit').submit();
    }
}


function validatePhoneNumber(input_str) {
    let re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    return re.test(input_str);
}

// Hàm validate form
function validateForm() {
    $('form#form_address').submit(handleSubmitForm); 
}


