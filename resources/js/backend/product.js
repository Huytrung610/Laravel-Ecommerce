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
        saveAllVariants()
        checkExistedImage()
        chooseImageThumnailProduct()
        removeProductThumb()
        
});

function setupProductVariant() {
    $('#variantCheckbox').change(function() {
        let price = $('input[name="price"]').val();
        let code = $('input[name="code"]').val();
        let productId = $('input[name="product_id"]').val();
        let isChecked = $(this).is(':checked');
        let _token = $('meta[name="csrf-token"]').attr('content');

        if (price == '' || code == '') {
            alert('Please fill in the price and product code before activating the variation.');
            $(this).prop('checked', false);
            return;
        } else {

            let url = '/admin/product/'+ productId +'/has-variants'

            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                data: {
                    // _token: _token,
                    has_variants: isChecked ? 1 : 0
                },
                success: function(response) {
                    if (isChecked) {
                        $('.variant-wrapper').removeClass('tw-hidden');
                        $('.table-responsive').removeClass('tw-hidden');
                    } else {
                        $('.variant-wrapper').addClass('tw-hidden');
                        $('.table-responsive').addClass('tw-hidden');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
}
//Save Variant product into database
function saveAllVariants() {
    $(document).on('click', '#saveVariantsButton', function(e) {
        e.preventDefault();
        if (checkSelectedVariants()) {
            let variantsData = [];
            let productId = $('input[name="product_id"]').val();
            let attributeId = $('#selectedAttributeId').val();
            let variantByAttribute = collectVariantData();

            
            $('.variant-row').each(function() {
                let quantity = $(this).find('.variant_quantity').val();
                let sku = $(this).find('.variant_sku').val();
                let price = $(this).find('.variant_price').val();
                let barcode = $(this).find('.variant_barcode').val();
                let slug = $(this).find('.variant_slug').val();
                let album = $(this).find('.variant_album').val();
                let code = $(this).find('input[name="productVariant[id][]"]').val();

                let variantData = {
                    quantity: quantity,
                    sku: sku,
                    price: price,
                    barcode: barcode,
                    slug: slug,
                    album: album,
                    code:code
                };

                variantsData.push(variantData);
            });
            $.ajax({
                method: 'GET',
                url: '/admin/product/'+productId+'/save-variants',
                data: {
                    attributeArray: variantByAttribute,
                    attribute: attributeId,
                    variants: variantsData,
                    product_id :productId
                },
                success: function(response) {
                    swal.fire({
                        title: "Success!",
                        text: "Product variant has been updated!",
                        icon: "success"
                    });
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        } else {
            Swal.fire({
                title: "Error!",
                text: "Please select attribute value for all variant options.",
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    }); 
}

function checkSelectedVariants() {
    let isValid = true;

    if (!$('#variantCheckbox').is(':checked') || $('.selectVariant').filter(function() { return $(this).val() !== null && $(this).val().length > 0; }).length === 0) {
        isValid = false;
    }

    return isValid;
}

function collectVariantData() {
    let variantsData = {};
    $('.variant-item select').each(function() {
        let catId = $(this).data('catid');
        if (catId !== undefined) {
            let selectedOptions = $(this).val();
            variantsData[catId] = selectedOptions;
        }
    });
    return variantsData;
}

function chooseImageThumnailProduct() {
    $(document).on('click', '.choose-thumb-btn', function(e){
        browseThumbnailProduct();
        e.preventDefault(); 
    })
}
function checkExistedImage(){
     let imagePath = $('.thumb-preview-container .thumb-preview img').attr('src');

     if (imagePath === defaultThumnail) {
         $('.del-img_product').addClass('tw-hidden');
         $('.img_product-input').val(imagePath);
     } else {
        $('.del-img_product').removeClass('tw-hidden');
     }
}
function browseThumbnailProduct(){
    var type = "Images";
    var finder = new CKFinder();
    finder.resourceType = type;
    finder.selectActionFunction = function (fileUrl, data) {
        $('.img-thumb_product').attr("src", fileUrl);
        $('.img_product-input').val(fileUrl);
        $('.del-img_product').removeClass('tw-hidden');
        $('.thumbnail-wrapper').removeClass('choose-thumb-btn hover:tw-cursor-pointer');
    }
    finder.popup();
}

function removeProductThumb() {
    $(document).on('click', '.del-img_product', function(){
        let _this = $(this);
        $('.img-thumb_product').attr("src", defaultThumnail);
        $('.img_product-input').val(defaultThumnail);
        // _this.find('.img_product-input').val(defaultThumnail);
        _this.addClass('tw-hidden');
        $('.thumbnail-wrapper').addClass('choose-thumb-btn hover:tw-cursor-pointer');
    })
}

