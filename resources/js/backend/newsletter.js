$(document).ready(function () {
    $('#subcriber-status-form .check-status-subcriber').change(function (e) {
        e.preventDefault();
        var isChecked = $(this).prop('checked');
        var currentUrl = window.location.origin;
        var updateUrl = window.location.origin + '/admin/update-subscriber-status';

        var subscriberId = $(this).data('subscriber-id');
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: updateUrl,
            type: 'POST',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                'subscriber_id': subscriberId,
                'status': isChecked ? '1' : '0'
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