@extends('backend.layouts.master')
<?php
// $helper = new \App\Helpers\Backend\CategoryHelper();
// $productHelper = new \App\Helpers\Backend\ProductHelper();
?>
@section('main-content')
    @if(session('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! session('success') !!}</li>
        </ul>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! session('error') !!}</li>
        </ul>
    </div>
    @endif
    
<div class="card">
    <div class="card-header card-tabs d-flex">
        <div id="product" class="tab-header" style="border: 1px solid #ccc">{{ __('Edit Product') }}</div>
        <div id="attribute" class="tab-header" style="border: 1px solid #ccc">{{ __('Attribute Product') }}</div>
    </div>
    <div class="card-body" id="tab-product">
        <form method="post" action="{{route('product.update',$product->id)}}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="product_id" id="currentStoreView" value="{{$product->id}}"/>
            <div class="form-group">
                <label for="status" class="col-form-label">{{__('Status')}}<span
                        class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option
                        value="active" {{(($product->status=='active')? 'selected' : '')}}>{{__('Active')}}</option>
                    <option
                        value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>{{__('Inactive')}}</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">{{__('Title')}}<span
                        class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="title" placeholder="{{__('Enter title')}}"
                        value="{{$product->title}}" class="form-control">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="code" class="col-form-label">{{__('Product Code')}}</label>
                <input id="inputProductCode" type="text" name="product_code" placeholder="{{__('Enter Product Code')}}"
                        value="{{$product->code}}" class="form-control">
                @error('code')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
           
            <div class="form-group">
                <label for="summary" class="col-form-label">{{__('Short Description')}}<span
                        class="text-danger">*</span></label>
                <textarea class="form-control" id="summary" name="summary">{{$product->summary}}</textarea>
                @error('summary')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description" class="col-form-label">{{__('Description')}}</label>
                <textarea class="form-control" id="description"
                            name="description">{{$product->description}}</textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="brand_id">{{__('Brand')}}</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    <option value="">{{__('--Select any brand--')}}</option>
                    @foreach($brands as $key=>$brand)
                        <option
                            value='{{$brand->id}}' {{(($product->brand_id==$brand->id)? 'selected' : '')}}>{{$brand->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group category-type">
                <label for="category_id" class="col-form-label">{{ __('Category Type') }}<span class="text-danger">*</span></label>
                <select name="category_id" id="product-target" class="form-control categories-product" multiple>
                    @foreach($parentCategories as $parentCategory)
                        <optgroup label="{{ $parentCategory->Photo }}" class="optgroup">
                            @foreach($childCategories->where('parent_id', $parentCategory->id) as $childCategory)
                                <option value="{{ $childCategory->id }}" {{  in_array($childCategory->id, $selectedCategory) ? 'selected' : '' }} class="optnormal">{{ $childCategory->title }}</option>
                            @endforeach   
                            <option value="{{ $parentCategory->id }}" {{ in_array($parentCategory->id, $selectedCategory) ? 'selected' : '' }} hidden class="opthidden">{{ $parentCategory->title }}</option>
                        </optgroup>
                    @endforeach  
                </select>
                @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="price" class="col-form-label">{{__('Price')}}</label>
                <input id="inputPrice" type="text" name="price" placeholder="{{__('Enter Price')}}"
                        value="{{$product->price}}" class="form-control">
                @error('price')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="stock" class="col-form-label">{{__('Stock')}}</label>
                <input id="inputStock" type="number" name="stock" required placeholder="{{__('Enter stock')}}"
                        value="{{$product->stock}}" class="form-control">
                @error('stock')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputPhoto" class="col-form-label">Thumbnail</label>
                <div class="input-group">
                    <div class="input-group-btn">
                        <div class="thumb-preview-container">
                            <div class="thumb-preview tw-relative">
                                <span class="thumbnail-wrapper choose-thumb-btn hover:tw-cursor-pointer">
                                    <img class="tw-w-[200px] tw-h-[200px] img-thumbnail img-thumb_product" src="{{$product->photo}}" alt="{{$product->photo}}">
                                </span>
                                <button type="button" class="del-img-thumb del-img_product tw-absolute tw-left-[5px] tw-top-[5px] tw-text-red-600 tw-hidden"><i class="fa fa-trash"></i></button>
                                <input type="text" name="photo" hidden value="{{$product->photo}}" class="img_thumbnail-input img_product-input"></input>
                            </div>
                        </div>
                    </div>
                </div>
                @error('photo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="album-general-product">
                <label for="inputAlbum" class="col-form-label">Album</label>
                <div class="tw-text-right"><span class="hover:tw-cursor-pointer choose-general-images tw-text-blue-400 hover:tw-text-blue-500">Choose images</span></div>
                <div class="click-to-upload-album {{ $product->album ? 'tw-hidden' : ''  }} tw-flex tw-flex-col tw-items-center tw-border tw-border-dashed tw-border-gray-400 tw-p-5 tw-gap-2">
                    <div class="icon"><a type="button" class="upload-variant-picture">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tư-w-20 tw-h-20">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <div class="small-text tw-text-blue-400">Use "choose image" or click into this to add new image</div>
                </div>
                <ul id="album-general" class="upload-general-album {{ $product->album ? '' : 'tw-hidden' }} tw-flex tw-border tw-border-dashed tw-border-gray-400 tw-p-6 tw-gap-2.5 sortui ui-sortable">
                    @if($product->album)
                        @foreach(explode(',', $product->album) as $image)
                            <li class="ui-state-default">
                                <div class="album-item-wrapper tw-w-28">
                                    <span class="span image img-scaledown">
                                        <img src="{{$image}}" alt="{{$image}}">
                                        <input type="hidden" name="album-item" value="{{$image}}">
                                    </span>
                                    <button class="variant-delete-image">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
                <input type="hidden" name="album[]" value="{{$product->album}}" class="general_album">
            </div>
            <div class="form-group mb-3 tw-mt-5">
                <button class="btn btn-success tw-bg-green-600" type="submit">{{__('Update')}}</button>
            </div>
        </form>
    </div>
    <div class="card-body" id="tab-attribute">
        <div class="row">
            <div class="col-lg-12">
                <div class="variant-checkbox">
                    <input type="checkbox" 
                            name="has_variants" 
                            id="variantCheckbox"
                            value="1"
                            {{ $product->has_variants == 1 ? 'checked' : '' }}>
                    <label for="variantCheckbox" class="turnOnVariant">Product with variants?</label>
                </div>
            </div>
        </div>
        
        <div class="variant-wrapper {{ $product->has_variants != 1 ? 'tw-hidden' : '' }} ">
            <div class="row variant-container">
                <div class="col-lg-3">
                    <div class="attribute-title tw-text-blue-400">Attribute</div>
                </div>
                <div class="col-lg-9">
                    <div class="attribute-title tw-text-blue-400">Value Attribute</div>
                </div>
            </div>
            <div class="variant-body"> 

                {{-- @dd($selectedVariants); --}}
                @if($selectedVariants)
                    @foreach(json_decode($selectedVariants, true) as $attributeId => $selectedAttributes)
                    @php
                        $attributeList =  app(\App\Helpers\Backend\ProductHelper::class)->getValueByAttribute($attributeId);
                    @endphp
                        <div class="row variant-item tw-mb-4">
                            <div class="col-lg-3">
                                <div class="attribute-catalogue">
                                    <select name="attributeCatalogue[]" class="choose-attribute nice-select">
                                        <option value="">---Select Attribute---</option>
                                        @foreach($attributes as $attribute)
                                            <option {{$attributeId == $attribute->id ? 'selected' : '' }}  value="{{ $attribute->id }}">{{ $attribute->name }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <select class="selectVariant variant-{{ $attributeId }} form-control" name="attribute[{{ $attributeId }}][]" data-catid="{{ $attributeId }}" multiple="multiple">
                                    @foreach($attributeList as $keyAttr => $valAttr)
                                        <option value="{{ $valAttr->id }}" {{ (in_array($valAttr->id, $selectedAttributes)) ? 'selected' : '' }} >{{ $valAttr->value }}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            <div class="col-lg-1">
                                <button type="button" class="remove-attribute btn btn-danger tw-bg-red-600">Delete</button>
                            </div>
                        </div>
                        @endforeach
                @endif
            </div>
            <input type="text" hidden id="selectedAttributeId">
            <div class="variant-foot tw-mb-5 tw-flex tw-justify-between">
                <button type="button" class="add-variant tw-border-blue-400 tw-border tw-text-white tw-bg-blue-400 tw-p-2">Add new attribute</button>
                @if($productVariantsCount)
                    <div class="col-lg-1 tw-px-6">
                        <button type="button" id="saveVariantsButton" class="save-variants tw-border-blue-400 tw-border tw-text-white tw-bg-blue-400 tw-p-2">Save</button>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Product Variant Table -->
        {{-- @include('backend.product.attribute.product-attribute-list')  --}}
        <div class="variant-wrapper tw-hidden">
        </div>
        <div class="product-variant">
            <div class="variants-title">
                <h2 class="tw-font-bold">Product Variants</h2>
            </div>
            <div class="table-responsive {{ $product->has_variants != 1 ? 'tw-hidden' : '' }}">
                <table class="table productVariant-table">
                    <thead class="tw-text-white tw-bg-gray-500">

                    </thead>
                    <tbody></tbody>
                </table>
            </div>
           
        </div>
    </div>
    
</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>

@endpush
@push('after_scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
    </script>
    <script src="{{ mix('js/backend/product.js') }}"></script>      
    <script src="/backend/ckfinder_2/ckfinder.js"></script>
    <script src="{{ mix('js/backend/finder.js') }}"></script>

    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>

    <script>
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.edit_attribute', function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                $('.form-attribute-title').text('Edit Attribute');
                $('#form_attribute').attr('action', location.origin + '/admin/attribute/update/' + id);
                $('.attribute_sku').prop('readonly', true);
                $.ajax({
                    type: 'GET',
                    url: '/admin/attribute-edit/'+id,
                    data: {},
                    processData: false,
                    contentType: false,
                    success: function(response){
                        console.log(response);
                         $('form input[name=attribute_sku]').val(response.attribute.sku);
                         $('form input[name=attribute_color]').val(response.attribute.color);
                         $('form input[name=attribute_price]').val(response.attribute.price);
                         $('form input[name=attribute_stock]').val(response.attribute.stock);
                         $('form input[name=attribute-photo]').val(response.attribute.photo);
                    },
                    error: function (response){
                        console.log(response);
                    }
            })
    
       });  
            $(document).on('click', '.remove-table-row', function(){
                $(this).parents('tr').remove();
            });

            $('#tab-attribute').hide();
            $('.tab-header').on('click', function () {
                var t = $(this).attr('id');
                $(this).addClass('active');
                $('.tab-header').not($(this)).removeClass('active');

                if ($(this).hasClass('active')) {
                $('.card-body').hide();
                $('#tab-' + t).show();
            }
            });
    </script> 

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function (e) {
            var form = $(this).closest('form');
            e.preventDefault();
            swal({
                title: "{{__('Are you sure?')}}",
                text: "{{__('Once deleted, you will not be able to recover this data!')}}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    } else {
                        swal("{{__('Your data is safe!')}}");
                    }
                });
        })  
    })
</script> 
<script>
    let currentVariantCount = 0; // Số lượng thuộc tính hiện tại
    let maxVariantCount = 0; // Số lượng thuộc tính tối đa
    let attributeValues = {};
    let selectedAttributeValues = {};
    let selectedAttributeId = [];
    var defaultThumnail = "{{ asset('backend/img/default-product-image.png') }}";
    var existedProductVariants = @json($productVariants);
    
    $(document).ready(function() {
        var currentVariantCount = 0; // Số lượng thuộc tính hiện tại
        var maxVariantCount = 0; // Số lượng thuộc tính tối đa
        var attributeValues = {}; 
        $(document).on('click', '.add-variant', function() {
            var url = "{{ url('admin/get-attributes') }}";

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    var html = renderVariantItem(response);
                    $('.variant-body').append(html);
                    $('.productVariant-table thead').html('');
                    $('.productVariant-table tbody').html('');
                    currentVariantCount++;
                    maxVariantCount = response.length; // Cập nhật maxVariantCount từ response
                    checkMaxAttribute(currentVariantCount, maxVariantCount); 
                    disabledAttributeCatlogueChoose(); 
                }
            });
            
        });
        $('.selectVariant').select2({
            width: '100%', 
        });
        $('.selectVariant').on('select2:opening', function(e) {
            var $select = $(this);
            var $dropdown = $select.data('select2').$dropdown;
            var $results = $dropdown.find('.select2-results');

            $results.scrollTop(0); 
        }); 
        $('#summary').summernote({
            placeholder: "Write detail description.....",
            tabsize: 2,
            height: 150
        });
        $('#description').summernote({
            placeholder: "Write detail description.....",
            tabsize: 2,
            height: 150
        });

        productVariant()
        removeDuplicatedValue();
        removeAttribute();
        disabledAttributeCatlogueChoose();
        chooseVariantGroup();
        createProductVariant();
        variantAlbum();
        chooseMoreImg()
        deleteVariantAlbum();
        updateVariant();
        cancleVariantUpdate();
        saveVariantUpdate();
});
    function renderVariantItem(attributes) {
        var html = '';

        html += '<div class="row variant-item tw-mb-4">';
        html += '<div class="col-lg-3">';
        html += '<div class="attribute-catalogue">';
        html += '<select name="attributeCatalogue[]" class="choose-attribute nice-select">';
        html += '<option value="">---Select Attribute---</option>';
        
        $.each(attributes, function(index, attribute) {
            html += '<option value="' + attribute.id + '">' + attribute.name + '</option>';
        });

        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-8">';
        html += '<input type="text" disabled class="fake-variant form-control tw-h-12">';
        html += '</div>';
        html += '<div class="col-lg-1">';
        html += '<button type="button" class="remove-attribute btn btn-danger tw-bg-red-600">Delete</button>';
        html += '</div>';
        html += '</div>';

        return html;
    }
    function disabledAttributeCatlogueChoose() {
        let id = [];
        $('.choose-attribute').each(function(){
            let _this = $(this)
            let selected = _this.find('option:selected').val();
            if ( selected != 0){
                id.push(selected)
            } 
        })
        $('.choose-attribute').find('option').removeAttr('disabled');
        for(let i = 0; i < id.length; i++ ) {
            $('.choose-attribute').find('option[value='+ id[i] + ']').prop('disabled', true);
        }
        $('#selectedAttributeId').val(id);

    }
    function checkMaxAttribute(currentCount, maxCount) {
        if (currentCount >= maxCount) {
            $('.add-variant').remove();

            $('.variant-foot').removeClass('tw-justify-between');
            $('.variant-foot').addClass('tw-justify-end');
            $('.variant-foot').html('<div class="col-lg-1 tw-px-6"><button type="button" id="saveVariantsButton" class="save-variants tw-border-blue-400 tw-border tw-text-white tw-bg-blue-400 tw-p-2">Save</button></div>')    
        } else {
            $('.variant-foot').html('<button type="button" class="add-variant tw-border-blue-400 tw-border tw-text-white tw-bg-blue-400 tw-p-2">Add new attribute</button><div class="col-lg-1 tw-px-6"><button type="button" id="saveVariantsButton" class="save-variants tw-border-blue-400 tw-border tw-text-white tw-bg-blue-400 tw-p-2">Save</button></div>');
        }
    }


    //Remove attribute from variant product
    function removeAttribute () {
        $(document).on('click', '.remove-attribute', function(){
            let _this = $(this);
            _this.parents('.variant-item').remove();
            refreshVariants();
            disabledAttributeCatlogueChoose();
            checkMaxAttribute();
        })
    }
    function select2Variant(attributeId)  {
        let html = '<select class="selectVariant variant-'+ attributeId +'  form-control" name="attribute['+ attributeId +'][]" data-catid="'+attributeId+'"  multiple="multiple"></select>'
        return html;
    }
    function chooseVariantGroup() {
        $(document).on('change', '.choose-attribute', function(){
            let _this = $(this);
            let attributeId = _this.val();
            if (attributeId != 0) {
                _this.parents('.col-lg-3').siblings('.col-lg-8').html(select2Variant(attributeId))
                getValueAttribute(attributeId);
            
            } else {
                _this.parents('.col-lg-3').siblings('.col-lg-8').html('<input type="text" name="attribute['+attributeId+'][]" disabled class="fake-variant form-control tw-h-12">')
            }
            disabledAttributeCatlogueChoose();
        })
    }

    function getValueAttribute(attributeId) {
        $.ajax({
            type: 'GET',
            url: '{{url("admin/get-attribute-values")}}',
            data: { attributeId: attributeId }, 
            success: function(response) {
                attributeValues = response;
                selectedAttributeValues[attributeId] = attributeValues;
                renderAttributeValues(attributeValues, attributeId);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        }); 
    }

    function renderAttributeValues(values, attributeId) {
        let selectVariant = $('.selectVariant');
        
        // Thêm các option mới từ danh sách giá trị thuộc tính vào selectVariant
        $.each(values, function(index, value) {
            let id = parseInt(attributeId);
                if (value.attribute_id === id) {
                    selectVariant.append($('<option>', {
                        value: value.id,
                        text: value.value
                }));
            }
            
        });

        selectVariant.select2();
    }

    function createProductVariant() {
        $(document).on('change', '.selectVariant', function(){
        let _this = $(this);
        createVariant();
        })
    }

    function refreshVariants() {
    $('table.productVariant-table tbody').empty();
    createVariant();
}
    function createVariant() {
        let attributes = [];
        let variants = [];
        let attributeTitle  = [];

        $('.variant-item').each(function(){
            let _this = $(this);
            let attr = [];
            let attrVariant = [];
            let attributeCatalougeId = _this.find('.choose-attribute option:selected').val();
            let optionText = _this.find('.choose-attribute option:selected').text();
            let attribute = $('.variant-'+attributeCatalougeId).select2('data');
            for (let i= 0; i < attribute.length; i++ ) {
                let item = {};
                let itemVariant = {};
                item[optionText] = attribute[i].text;
                itemVariant[attributeCatalougeId] = attribute[i].id;
                attr.push(item);
                attrVariant.push(itemVariant)
            }
            attributeTitle.push(optionText);
            attributes.push(attr)
            variants.push(attrVariant)
        })
        if (attributes.length === 0 || variants.length === 0) {
            return;
        }

        attributes = attributes.reduce(
            (a, b) => a.flatMap( d => b.map ( e => ( { ...d, ...e } ) ) )
        )
        variants = variants.reduce(
            (a, b) => a.flatMap( d => b.map ( e => ( { ...d, ...e } ) ) )
        )
        
        createTableHeader(attributeTitle)

        let trClass= [];

        attributes.forEach((item, index) =>  {
            let $row = createVariantRow(item, variants[index]);
            let classModified ='tr-variant-' + Object.values(variants[index]).join(', ').replace(/, /g, '-');

            trClass.push(classModified);
            if (!$('table.productVariant-table tbody tr').hasClass(classModified)) {
                $('table.productVariant-table tbody').append($row);
            }
        })
        
        // console.log(trClass);

        $('table.productVariant-table tbody tr').each(function(){
            const $row = $(this);
            const rowClasses = $row.attr('class');
            if(rowClasses) {
                const rowClassesArray = rowClasses.split(' ')
                let shouldRemove = false;
                rowClassesArray.forEach(rowClass => {
                    if (rowClass == 'variant-row') {
                        return
                    } else if (!trClass.includes(rowClass)){
                        shouldRemove = true;
                    }
                })
                if (shouldRemove) {
                    $row.remove();
                }
            }
        })
        // let html = renderTableHtml(attributes, attributeTitle, variants);
        // $('table.productVariant-table').html(html);
    }

    //Store variant product 
    function createVariantRow(attributeItem, variantItem) {

        // console.log(variantItem);

        let attributeString = Object.values(attributeItem).join(', ');
        let attributeId = Object.values(variantItem).join(', ');
        let classModified =  attributeId.replace(/, /g, '-');
        let valueModified =  attributeString.replace(/, /g, '-');

        let $row = $('<tr>').addClass('variant-row tr-variant-' + classModified);
        let $td 
        $td = $('<td>').append(
            $('<span>').addClass('image img-cover').append(
                $('<img>').addClass('imageSrc').attr('src',  '/backend/img/thumbnail-default.jpg'  )
            )
        )
        $row.append($td);
        Object.values(attributeItem).forEach(value => {
            $td = $('<td>').text(value);
            $row.append($td);
        })   
        $td =$('<td>').addClass('tw-hidden td-variant');
        let mainPrice = $('input[name="price"]').val();
        let mainSku = $('input[name="product_code"]').val();
        let mainProductCode = $('input[name="code"]').val();
        let inputHiddenFields = [
            { name: 'variant[quantity][]', class: 'variant_quantity' },
            { name: 'variant[sku][]', class: 'variant_sku', value: mainSku + '-' + classModified },
            { name: 'variant[price][]', class: 'variant_price', value: mainPrice },
            { name: 'variant[barcode][]', class: 'variant_barcode' },
            { name: 'variant[slug][]', class: 'variant_slug', value: (mainSku + '-' + valueModified).toLowerCase() },
            { name: 'variant[album][]', class: 'variant_album' },
            { name: 'productVariant[name][]', value: attributeString },
            { name: 'productVariant[id][]', value: attributeId },
        ]

        $.each(inputHiddenFields, function(_, field) {
            let $input = $('<input>').attr('type', 'text').attr('name', field.name).addClass(field.class);
            if (field.value){
                $input.val(field.value)
            }
            $td.append($input)
        })

        $row.append($('<td>').addClass('td-quantity').text('-'))
            .append($('<td>').addClass('td-price').text(mainPrice))
            .append($('<td>').addClass('td-sku').text(mainSku + '-' + classModified))
            .append($td)
        return $row
    }

    // Handle thead after choose attribute, value
    function createTableHeader(attributeTitle) {
        let $thead = $('table.productVariant-table thead');
        let $row = $('<tr class="tw-font-bold">');
        $row.append($('<td>').text('Photo'));
        for ( let i = 0; i < attributeTitle.length; i++) {
            $row.append($('<td>').text(attributeTitle[i]))
        }
        $row.append($('<td>').text('Quantity'));
        $row.append($('<td>').text('Price'));
        $row.append($('<td>').text('SKU'));
            
        $thead.html($row);
        return $thead;
    }

    function renderTableHtml(attributes, attributeTitle, variants) {
        let html = '';
        html = html + '<thead>'
                html = html + '<tr>'
                    html = html + '<th scope="col">Photo</th>'
                    for (let i = 0; i < attributeTitle.length; i++ ) {
                        html = html + '<th scope="col">'+ attributeTitle[i] +'</th>'
                    }
                    html = html + '<th scope="col">Quantity</th>'
                    html = html + '<th scope="col">Price</th>'
                    html = html + '<th scope="col">SKU</th>'
                html = html + '</tr>'
                html = html + '</thead>'
                html = html + '<tbody>'
                    for (let j = 0; j < attributes.length; j++ ) {
                        html = html + '<tr class="variant-row">'
                            html = html + '<td>'
                                html = html + '<div class="img img-cover"><img class="imageSrc" src="" alt=""></div>'
                             html = html + '</td>'
                        let attributeArray = [];
                        let attributeIdArray = [];
                        $.each(attributes[j], function(index, value ){
                            html = html + '<td>'+ value +'</td>'
                            attributeArray.push(value);
                        }) 
                        $.each(variants[j], function(index, value ){
                            attributeIdArray.push(value);
                        })

                        
                        let attributeString = attributeArray.join(', ');
                        let attributeId = attributeIdArray.join(', ');
                        html = html + '<td class="td-quantity">-</td>'
                        html = html + '<td class="td-price">-</td>'
                        html = html + '<td class="td-sku">-</td>'
                        html = html + '<td class="tw-hidden td-variant">'
                            html = html + '<input type="text" name="variant[quantity][]" class="variant_quantity">'
                            html = html + '<input type="text" name="variant[sku][]" class="variant_sku">'
                            html = html + '<input type="text" name="variant[price][]" class="variant_price">'
                            html = html + '<input type="text" name="variant[barcode][]" class="variant_barcode">'
                            html = html + '<input type="text" name="variant[slug][]" class="variant_slug">'
                            html = html + '<input type="text" name="variant[album][]" class="variant_album">'
                            html = html + '<input type="text" name="attribute[name][]" value="'+attributeString+'">'
                            html = html + '<input type="text" name="attribute[id][]" value="'+attributeId+'">'
                        html = html +'</td>'
                        html = html + '</tr>'
                    }
                html = html + '</tbody>'
        return html;
    }
    
    function removeDuplicatedValue(){
        $(document).on('select2:open', '.selectVariant', function (e) {
            let selectVariant = $(this);
            
            let attributeId = selectVariant.data('catid');
            
            let values = selectedAttributeValues[attributeId];
            if(values){
                    selectVariant.find('option').each(function() {
                    let optionValue = $(this).val();
                    if (!values.some(value => value.id == optionValue)) {
                        $(this).remove();
                    }
                });
            }
        });
    }
    function variantAlbum() {
        $(document).on('click', '.click-to-upload-variant', function(e){
            browseVariantServerAlbum();
            e.preventDefault(); 
        })
    }

    function chooseMoreImg(){
        $(document).on('click', '.choose-images', function(e){
            browseVariantServerAlbum();
            e.preventDefault(); 
        })
    }

    function browseVariantServerAlbum(){
        var type = "Images";
        var finder = new CKFinder();
        finder.resourceType = type;
        finder.selectActionFunction = function ( fileUrl, data, allFiles ) {
            let html = '';
            for (var i = 0; i < allFiles.length; i++ ){
                var image = allFiles[i].url;
                html += '<li class="ui-state-default">';
                    html += '<div class="thumb-variant">';
                        html += '<span class="span image img-scaledown">';
                            html += '<img src="'+image+'" alt="'+ image +'">';
                            html += '<input type="hidden" name="variantAlbum[]" value="'+image+'">';
                        html += '</span>'; 
                        html += '<button class="variant-delete-image"><i class="fa fa-trash"></i></button>';
                    html += '</div>'; 
                html += '</li>';
            }

                $('.click-to-upload-variant').addClass('tw-hidden');
                $('#sortable2').append(html);
                $('.upload-variant-list').removeClass('tw-hidden');
        }
        finder.popup();
    }

    function deleteVariantAlbum() {
        $(document).on('click', '.variant-delete-image', function(){
            let _this = $(this);
            _this.parents('.ui-state-default').remove();
            if ($('.ui-state-default').length == 0) {
                $('.click-to-upload-variant').removeClass('tw-hidden');
                $('.upload-variant-list').addClass('tw-hidden');
            }
        })
    }

    //Pre-click table update variant
    function updateVariant() {
        $(document).on('click', '.variant-row', function(){
            let _this = $(this);
            let variantData = {};
            _this.find(".td-variant input[type=text][class^='variant_']").each(function(){
                let className = $(this).attr('class')
                variantData[className] = $(this).val();
            });
            console.log(variantData);
            let updateVariantBox = updateVariantHtml(variantData);
            if($('.updateVariantTr').length == 0 ){
                _this.after(updateVariantBox);

            }
        })
    }

    // Get album list
    function variantAlbumbList(album) {
        let html = '';
        if (album.length && album[0] !== '') {
            for ( let i = 0; i < album.length; i++ ){
                html =  html + '<li class="ui-state-default">'
                    html =  html + '<div class="thumb-variant">'
                        html =  html + '<span class="span image img-scaledown">'
                            html =  html + '<img src="'+album[i]+'" alt="'+album[i]+'">'
                            html =  html + '<input type="hidden" name="variantAlbum[]" value="'+album[i]+'">'
                        html =  html + '</span>'
                            html =  html + '<button class="variant-delete-image">'
                                html =  html + '<i class="fa fa-trash"></i>'
                            html =  html + '</button>'
                    html =  html + '</div>'
                html =  html + '</li>'
            }
        }
        return html;
    }

    function updateVariantHtml(variantData) {
        let variantAlbum = variantData.variant_album.split(',');
        let variantAlbumItem = variantAlbumbList(variantAlbum);
        let html = '';
        html += '<tr class="updateVariantTr">'
            html += '<td colspan="6">'
                html += '<div class="updateVariant tw-p-4 tw-border">'
                    html += '<div class="variant-item-heading tw-flex tw-justify-between tw-mb-6">'
                        html += '<h5 class="tw-font-bold tw-text-lg">Update Variant</h5>'
                        html += '<div class="button-group tw-flex tw-gap-4">'
                            html += '<button type="button" class="cancleUpdate btn btn-danger tw-bg-red-600">Cancle</button>'
                            html += '<button type="button" class="saveUpdateVariant btn btn-success tw-bg-green-600">Save</button>'
                            html += '</div>'
                    html += '</div>'
                    html += '<div class="variant-item-content">'
                        html += '<div class="tw-text-right"><span class="hover:tw-cursor-pointer choose-images tw-text-blue-400 hover:tw-text-blue-500">Choose images</span></div>'
                        html += '<div class="click-to-upload-variant '+((variantAlbum.length > 0 && variantAlbum[0] !== '') ? 'tw-hidden' : '' ) +' tw-flex tw-flex-col tw-items-center tw-border tw-border-dashed tw-border-gray-400 tw-p-5 tw-gap-2">' 
                            html += '<div class="icon">'
                                html += '<a type="button" class="upload-variant-picture">'
                                    html += '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tư-w-20 tw-h-20">'
                                        html += '<path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />'
                                    html += '</svg>'   
                                html += '</a>'                                   
                            html += '</div>'
                            html += '<div class="small-text tw-text-blue-400">Use "choose image" or click into this to add new image</div>'
                        html += '</div>'
                        html += '<ul id="sortable2" class="upload-variant-list tw-flex tw-border tw-border-dashed tw-border-gray-400 tw-p-6 tw-gap-2.5'+ ((variantAlbumItem.length) ? '' : 'tw-hidden' ) +' sortui ui-sortable">'+variantAlbumItem+'</ul>'
                        html += '<div class="row tw-mt-6 tw-flex tw-justify-center">'
                            html += '<div class="col-lg-3">'
                                html += '<label for="" class="control-panel inputLabel">Quantity</label>'
                                html += '<input type="number" class="form-control int" name="variant_quantity" id="variantQuantity"  value="'+variantData.variant_quantity+'">'
                            html += '</div>'
                            html += '<div class="col-lg-3">'
                                html += '<label for="" class="control-panel inputLabel">SKU</label>'
                                html += '<input type="text" class="form-control" name="variant_sku" id="variantSku" value="'+variantData.variant_sku+'">'
                            html += '</div>'
                            html += '<div class="col-lg-3">'
                                html += '<label for="" class="control-panel inputLabel">Price</label>'
                                html += '<input type="number" class="form-control" name="variant_price" id="variantPrice" value="'+ variantData.variant_price+'">'
                            html += '</div>'
                            html += '<div class="col-lg-3">'
                                html += '<label for="" class="control-panel inputLabel">Barcode</label>'
                                html += '<input type="text" class="form-control" name="variant_barcode" id="variantBarcode" value="'+variantData.variant_barcode+'">'
                            html += '</div>'
                        html += '</div>'  
                        html += '<div class="row tw-mt-6 tw-flex tw-justify-center">'
                            html += '<div class="col">'
                                html += '<div>'
                                    html += '<label for="" class="control-panel inputLabel">Slug</label>'
                                    html += '<input type="text" class="form-control" name="variant_slug" id="variantSlug" value="'+variantData.variant_slug+'">'
                                html += '</div>'
                            html += '</div>'
                        html += '</div>'
                    html += '</div>'
                html += '</div>'
            html += '</td>'
        html += '</tr>'
        return html;
    }
    //Remove variant
    function cancleVariantUpdate() {
        $(document).on('click', '.cancleUpdate', function(){
            $('.updateVariantTr').remove();
        }) 
    }

    //Close table update variant
    function closeUpdateVariantBox() {
        $('.updateVariantTr').remove();
    }
    //Save variant after update
    function saveVariantUpdate(){
        $(document).on('click', '.saveUpdateVariant', function(){
            let variant = {
                'quantity' : $('input[name=variant_quantity]').val(),
                'sku' : $('input[name=variant_sku]').val(),
                'price' : $('input[name=variant_price]').val(),
                'barcode' : $('input[name=variant_barcode]').val(),
                'slug' : $('input[name=variant_slug]').val(),
                'album' : $("input[name='variantAlbum[]']").map(function(){
                    return $(this).val();
                }).get(), 
            }
            $.each(variant, function(index, value){
                $('.updateVariantTr').prev().find('.variant_'+index).val(value);
            })
            previewVariantTr(variant);
            closeUpdateVariantBox();
        })
    }

    function previewVariantTr(variant){
        let option = {
            'quantity': variant.quantity,
            'price': variant.price,
            'sku': variant.sku
        }
        $.each(variant, function(index, value){
            $('.updateVariantTr').prev().find('.td-'+index).html(value);
        })
        $('.updateVariantTr').prev().find('.imageSrc').attr('src', variant.album[0]);
    }


    function productVariant() {
        createVariant()
        reRenderEditProductVariant()
    }

    function reRenderEditProductVariant(){
        // let firstImagePath = '/backend/img/thumbnail-default.jpg'; 
        // console.log(existedProductVariants);
        for(let i = 0; i < existedProductVariants.length; i++){
            let code = existedProductVariants[i].code.split(',').map(val => val.trim()).join('-');
            let trClass = 'tr-variant-' + code
           
            if (existedProductVariants[i].image) {
                let imagePaths = existedProductVariants[i].image.split(',');
                firstImagePath = imagePaths[0].trim();
                $('.' + trClass).find('.imageSrc').attr('src', firstImagePath)
                $('.' + trClass).find('.click-to-upload-variant').addClass('tw-hidden')
            }
            
            $('.' + trClass).find('.td-quantity').html(existedProductVariants[i].quantity)
            $('.' + trClass).find('.td-price').html(existedProductVariants[i].price)
            $('.' + trClass).find('.variant_quantity').val(existedProductVariants[i].quantity)
            $('.' + trClass).find('.variant_price').val(existedProductVariants[i].price)
            $('.' + trClass).find('.variant_album').val(existedProductVariants[i].image)
        }
    }

</script>
@endpush
