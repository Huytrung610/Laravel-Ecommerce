import $ from 'jquery';
window.jQuery = $;
window.$ = $;
// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';
 
// import styles bundle
import 'swiper/css/bundle';



$(document).ready(function () {
    selectVariantProduct();
    loadProductVariant();
    initSwiper()
});

//Swiper Gallery
function initSwiper() {
    let pd_slider = new Swiper ('.product_detail--gallery-slider', {
        slidesPerView: 1,
        centeredSlides: true,
        loopedSlides: 6, 
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });


    let pd_thumbs = new Swiper ('.product_detail--gallery-thumbs', {
        slidesPerView: 'auto',
        spaceBetween: 10,
        centeredSlides: true,
        slideToClickedSlide: true,
    });

    pd_slider.controller.control = pd_thumbs;
    pd_thumbs.controller.control = pd_slider;
}
//Select Variant

function selectVariantProduct() {
    if($('.choose-attribute').length){
        $(document).on('click', '.choose-attribute', function(e){
            e.preventDefault();
            let _this = $(this);
            let attribute_id = _this.attr('data-attributevalueid')
            _this.parents('.attribute-value').find('.choose-attribute').removeClass('active');
            _this.addClass('active');
            handleAttribute();
        })
    }
}

function setupVariantUrl(res, attribute_id){
    let queryString = '?attribute_id=' + attribute_id.join(',')
    let productCanonical = $('.productSlug--hidden').val()
    productCanonical = productCanonical + queryString
    let stateObject = {attribute_id: attribute_id};
    history.pushState(stateObject, "Page Title", productCanonical)

}
function handleAttribute(){
    let attribute_id = [];
    let flag = true;
    $('.attribute-value .choose-attribute').each(function(){
        let _this = $(this);
        if(_this.hasClass('active')){
            attribute_id.push(_this.attr('data-attributevalueid'))
        }
    })
    $('.attribute_value_id--hidden').val(attribute_id)
    $('.attribute').each(function(){
        if($(this).find('.choose-attribute.active').length === 0 ){
            flag =  false;
            return false;
        }
    })
    
    if(flag) {
        $.ajax({
            url: '/product/loadVariant',
            type: 'GET',
            data: {
                'attribute_id': attribute_id,
                'product_id': $('input[name=product_id]').val()
            },
            dataType: 'json',
    
            success: function (response) {
                let album;
                if (response.variant && response.variant.image) {
                    album = response.variant.image.split(',');
                } else {
                    album = defaultImg
                }
                setupVariantPrice(response)
                setupVariantUrl(response, attribute_id)
                setupVariantGallery(album)
                setupVariantName(response)
                // console.log(response);
            },
            error: function () {
                console.error();
            }
        });
    } 
}
function loadProductVariant() {
    
        let attributeCatalougue = JSON.parse($('.attributeCatalogue').val());
        if(attributeCatalougue != null){
            if(typeof attributeCatalougue != 'undefined' && attributeCatalougue.length){
                handleAttribute()
            }
        }
        
}
function setupVariantPrice(res){
    var price = parseFloat(res.variant.price);
    var formattedPrice = price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    $('.main-price').text(formattedPrice);
    
}
function setupVariantName(res){
    let productName = $('.productName--hidden').val()
    let productVariantName = productName + ' ' + res.variant.name

    $('.product-main-title').html(productVariantName)
}

function setupVariantGallery(gallery) {
    let html = `<div class="swiper-container product_detail--gallery-slider">
                    <div class="swiper-wrapper">`
                    if(gallery != defaultImg ){
                        gallery.forEach((val) => {
                            html += `<div class="swiper-slide">
                                <img src="${val}" alt="${val}">
                            </div>`
                        })   
                    } else {
                        html += `<div class="swiper-slide">
                            <img src="${gallery}" alt="${gallery}">
                        </div> `
                    }
                    html += `</div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div class="swiper-container product_detail--gallery-thumbs">
                <div class="swiper-wrapper">`
                    if(gallery != defaultImg ){
                        gallery.forEach((val) => {
                            html += `<div class="swiper-slide">
                                <img src="${val}" alt="${val}">
                            </div>`
                        })   
                    } else {
                        html += `<div class="swiper-slide">
                            <img src="${gallery}" alt="${gallery}">
                        </div> `
                    }
                html += `</div>
            </div>`
    if(gallery.length){
        $('.product_detail--gallery').html(html)
        initSwiper();
    }
}
