$(document).ready(function () {
    //Change status
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

    // Delete subscriber
   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('.dltBtn-subscriber').click(function(e){
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
            // alert(dataID);
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                } else {
                    swal("Your data is safe!");
                }
            });
        })
   

});