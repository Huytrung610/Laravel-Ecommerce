import $ from 'jquery';
window.jQuery = $;
window.$ = $;

$(document).ready(function(){
    $('.count').prop('disabled', true);
    $(document).on('click', '.plus', function(){
        let _this = $(this);
        let countInput = _this.closest('.product-cart--qty').find('.count');
        countInput.val(parseInt(countInput.val()) + 1);
    });
    
    $(document).on('click', '.minus', function(){
        let _this = $(this);
        let countInput = _this.closest('.product-cart--qty').find('.count');
        countInput.val(parseInt(countInput.val()) - 1);
        if (countInput.val() == 0) {
            countInput.val(1);
        }
    });
    $('form#cart-products').submit(function() {
        $('.count').prop('disabled', false);
        return true;
    });
});