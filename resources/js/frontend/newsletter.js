// resources/js/frontend/newsletter.js

$(document).ready(function () {
    $('.subscription-form').submit(function (e) {
        e.preventDefault();
        let email_subscriber = $('#email_subcriber').val();
        // alert(email_subscriber);
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let url = '/add-subcriber';
        let _token = $('meta[name="csrf-token"]').attr('content');
        let formData = $(this).serialize();
        if (!emailRegex.test(email_subscriber)) {
            alert('Invalid email format');
            return;
        } else {
            $.ajax({
                url: '/add-subcriber',
                type: 'POST',
                data: {
                    _token:_token,
                    email_subscriber: email_subscriber},
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        swal('Success', 'Thanks for subscribing!', 'success');
                    } else {
                        swal('Error', 'Your email is already existed! Thanks for subcribing', 'error');
                    }
                },                
                error: function(){
                    swal('Error', 'Failed to subscribe, please try again! :(', 'error');
                }
            })
        }    
    });
});