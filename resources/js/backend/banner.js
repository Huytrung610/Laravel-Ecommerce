import $ from 'jquery';
window.jQuery = $;
window.$ = $;

$(document).ready(function () {
    checkExistedImage()
    chooseImageBanner()
    removeBannerThumb()
});

function chooseImageBanner() {
    $(document).on('click', '.choose-img-btn', function(e){
        browseThumbnailBanner();
        e.preventDefault(); 
    })
}
function checkExistedImage(){
    let hasImage = $('.thumb-preview-container .thumb-preview').length > 0;
    if(hasImage) {
        $('.choose-img-btn').addClass('tw-hidden')
    }
}
function browseThumbnailBanner(){
    var type = "Images";
    var finder = new CKFinder();
    finder.resourceType = type;
    finder.selectActionFunction = function (fileUrl, data) {
        let html = '';
    
        html += '<div class="thumb-preview tw-relative">'
            html += '<img src="'+fileUrl+'" alt="'+fileUrl+'">'
            html += '<button type="button" class="del-img-banner tw-absolute tw-left-[5px] tw-top-[5px] tw-text-red-600"><i class="fa fa-trash"></i></button>'
            html +=  '<input type="text" hidden name="photo" value="'+fileUrl+'" class="img-banner-input"></input>'
        html +=  '</div>'
        $('.choose-img-btn').addClass('tw-hidden');
        $('.thumb-preview-container').append(html);
    }
    finder.popup();
}

function removeBannerThumb() {
    $(document).on('click', '.del-img-banner', function(){
        let _this = $(this);
        _this.parents('.thumb-preview').remove();
        $('.choose-img-btn').removeClass('tw-hidden');
    })
}