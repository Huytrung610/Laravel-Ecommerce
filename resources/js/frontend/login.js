import $ from 'jquery';
window.jQuery = $;
window.$ = $;

$(document).ready(function(){
    initializeValidation();
})

function validatePasswords() {
    let password = $('.passowrd-register').val();
    let confirmPassword = $('.confirm_password-register').val();
    let submitButton = $('.signupBx .signup-submit');
    let error = $('.signupBx .password-error');

    if (password !== confirmPassword) {
        error.show();
        submitButton.prop('disabled', true);
    } else {
        error.hide();
        submitButton.prop('disabled', false);
    }
}

function initializeValidation() {
    let password = $('.passowrd-register');
    let confirmPassword = $('.confirm_password-register');

    password.on('keyup blur', validatePasswords);
    confirmPassword.on('keyup blur', validatePasswords);

    $('.signupBx .register-form').on('submit', function (event) {
        if ($('.passowrd-register').val() !== $('.confirm_password-register').val()) {
            event.preventDefault();
            validatePasswords();
        }
    });
}