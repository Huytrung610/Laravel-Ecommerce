import $ from 'jquery';
window.jQuery = $;
window.$ = $;

require('select2');
$(document).ready(function () {
    const selectField = $('#product-target');

        const setSelect2 = function() {
        selectField.select2({
            width: '100%',
            maximumSelectionLength: 1,
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
         // Event khi có sự thay đổi trong Select2
         selectField.on('change', function (e) {
            // Kiểm tra nếu đã chọn nhiều hơn 1 mục, giữ lại mục cuối cùng
            if ($(this).val() && $(this).val().length > 1) {
                let lastValue = $(this).val().pop();
                $(this).val([lastValue]).trigger('change');
            }
        });
    
        // Event khi Select2 mở ra
        selectField.on('select2:opening', function (e) {
            // Nếu đã chọn 1 mục, giữ lại giá trị hiện tại
            if ($(this).val() && $(this).val().length === 1) {
                let currentValue = $(this).val()[0];
                $(this).val([currentValue]).trigger('change');
            }
        });
    
        // Event khi Select2 đóng
        selectField.on('select2:closing', function (e) {
            // Nếu chưa chọn mục nào, bỏ qua sự kiện đóng để giữ lại Select2 mở ra
            if (!$(this).val() || $(this).val().length === 0) {
                e.preventDefault();
            }
        });

        setupProductVariant();
});
function setupProductVariant() {
    $('#variant-checkbox').change(function() {
        if ($(this).is(':checked')) {
            $('.variant-wrapper').removeClass('tw-hidden');
        } else {
            $('.variant-wrapper').addClass('tw-hidden');
        }
    });
}

