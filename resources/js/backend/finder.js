(function($)  {
    "use strict";
    var HT = {};
    

    HT.setupCkeditor = () => {
        if($('.ckeditor')) {
            $('.ckeditor').each(function(){
                let editor =$(this);
                HT.ckeditor4(editor)
                let elementId = editor.attr('id')
                HT.ckeditor4(elementId)
            })
        }
    }

    HT.ckeditor4 = (elementId) => {
        CKEDITOR.replace( elementId,{
            height: 250,
            removeButtons: '',
            allowedContent: true,
            toolbarGroups: [
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                { name: 'forms', groups: [ 'forms' ] },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                { name: 'links', groups: [ 'links' ] },
                { name: 'insert', groups: [ 'insert' ] },
                '/',
                { name: 'styles', groups: [ 'styles' ] },
                { name: 'colors', groups: [ 'colors' ] },
                { name: 'tools', groups: [ 'tools' ] },
                { name: 'others', groups: [ 'others' ] },
                { name: 'about', groups: [ 'about' ] }
            ],
        })
    }
    HT.uploadImageToInput = () => {
        $('.upload-image').click(function(){
            let input = $(this);
            let type = input.attr('data-type');
            HT.setupCkFinder2(input, type );
        })
    }
    HT.setupCkFinder2 = (object, type) => {
        if(typeof(type) == 'undefined'){
            type = 'Image';
        }
        var finder = new CKFinder();
        finder.resourceType = type;
        finder.selectActionFunction = function (fileUrl, data){
            object.val(fileUrl);
        }
        finder.popup();
    }
    
    function chooseImageThumnail() {
        $(document).on('click', '.choose-thumb-btn', function(e){
            browseThumbnail();
            e.preventDefault(); 
        })
    }
    function checkExistedImage(){
        let imagePath = $('.thumb-preview-container .thumb-preview img').attr('src');

        if (imagePath === defaultThumnail) {
            $('.del-img-thumb').addClass('tw-hidden');
            $('.img_thumbnail-input').val(imagePath);
        } else {
            $('.del-img-thumb').removeClass('tw-hidden');
        }
    }
    function browseThumbnail(){
        var type = "Images";
        var finder = new CKFinder();
        finder.resourceType = type;
        finder.selectActionFunction = function (fileUrl, data) {
            $('.img-thumbnail').attr("src", fileUrl);
            $('.img_thumbnail-input').val(fileUrl);
            $('.del-img-thumb').removeClass('tw-hidden');
            $('.thumbnail-wrapper').removeClass('choose-thumb-btn hover:tw-cursor-pointer');
        }
        finder.popup();
    }

    function removeThumb() {
        $(document).on('click', '.del-img-thumb', function(){
            let _this = $(this);
            $('.img-thumbnail').attr("src", defaultThumnail);
            $('.img_thumbnail-input').val(defaultThumnail);
            // _this.find('.img_thumbnail-input').val(defaultThumnail);
            _this.addClass('tw-hidden');
            $('.thumbnail-wrapper').addClass('choose-thumb-btn hover:tw-cursor-pointer');
        })
    }

    $(document).ready(function(){
        HT.uploadImageToInput();
        HT.setupCkeditor();
        checkExistedImage()
        chooseImageThumnail()
        removeThumb()
    });
})(jQuery)