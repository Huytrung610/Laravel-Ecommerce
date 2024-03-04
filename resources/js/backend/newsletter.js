$(document).ready(function () {
    $('#subcriber-status-form .check-status-subcriber').change(function (e) {
        e.preventDefault();
        var isChecked = $(this).prop('checked') == true ? 1 : 0; 
        var subscriberId = $(this).data('subscriber-id');
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/admin/update-subscriber-status',
            type: 'GET',
            data: {
                '_token': '{{ csrf_token() }}',
                'subscriber_id': subscriberId,
                'status': isChecked 
            },
            success: function (response) {
                console.log(response);
            },
            error: function () {
                console.error('Failed to update subscriber status');
            }
        });
    });
});