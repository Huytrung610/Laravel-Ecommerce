import $ from 'jquery';
window.jQuery = $;
window.$ = $;

require('select2');
$(document).ready(function () {
    // $(".categories-brand").select2({
    //     tags: true,
    //     tokenSeparators: [',', ' '],
    //     multiple: true
    // });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('.dltBtn-brand').click(function(e){
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
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

        // let selectField = $('#brand-selections');

        //     let setSelect2 = function() {
        //     width: '100%',
        //     selectField.select2({
        //         templateResult: function(option) {
        //         if (option.element && (option.element).hasAttribute('hidden')) {
        //             return null;
        //         }
        //         return option.text;
        //         }
        //     });
        //     };

        //     setSelect2();

        //     $(document.body).on('click', '.select2-results__option', function() {
        //     var label = $(this).find('.select2-results__group').html();
        //     $('optgroup.brandgroup').each(function() {
        //         if (this.label === label) {
        //         $(this).find('option.brand-item').prop({
        //             'disabled': true,
        //             'selected': false
        //         });
        //         $(this).find('option.brand-hidden').prop('selected', true);
        //         }
        //     });

        //     selectField.select2('destroy');
        //     setSelect2();
        //     });

        //     selectField.on('select2:unselecting', function(e) {
        //     var $option = $(e.params.args.data.element);
        //     if ($option.hasClass('brand-hidden')) {
        //         $option.parents('brandgroup').find('option.brand-item').prop('disabled', false);
        //         window.setTimeout(function() {
        //         selectField.select2('close');
        //         selectField.select2('destroy');
        //         setSelect2();
        //         selectField.select2('open');
        //         }, 500);
        //     }
        //     });
        const selectField = $('#brand-target');

        const setSelect2 = function() {
        selectField.select2({
            width: '100%',
            templateResult: function(option) {
            if (option.element && (option.element).hasAttribute('hidden')) {
                return null;
            }
            return option.text;
            }
        });
        };

        setSelect2();

        $(document.body).on('click', '.select2-results__option', function() {
        var label = $(this).find('.select2-results__group').html();
        $('optgroup.optgroup').each(function() {
            if (this.label === label) {
            $(this).find('option.optnormal').prop({
                'disabled': true,
                'selected': false
            });
            $(this).find('option.opthidden').prop('selected', true);
            }
        });

        selectField.select2('destroy');
        setSelect2();
        });

        selectField.on('select2:unselecting', function(e) {
        var $option = $(e.params.args.data.element);
        if ($option.hasClass('opthidden')) {
            $option.parents('optgroup').find('option.optnormal').prop('disabled', false);
            window.setTimeout(function() {
            selectField.select2('close');
            selectField.select2('destroy');
            setSelect2();
            selectField.select2('open');
            }, 500);
        }
        });
});