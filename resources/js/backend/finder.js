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

    $(document).ready(function(){
        HT.uploadImageToInput();
        HT.setupCkeditor();
    });
})(jQuery)