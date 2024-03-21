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
            <input type="hidden" name="store_id" id="currentStoreView" value="0"/>
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
                <label for="summary" class="col-form-label">{{__('Short Description')}}<span
                        class="text-danger">*</span></label>
                <textarea class="form-control" id="" name="summary">{{$product->summary}}</textarea>
                @error('summary')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description" class="col-form-label">{{__('Description')}}</label>
                <textarea class="form-control" id=""
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
                        <optgroup label="{{ $parentCategory->title }}" class="optgroup">
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
                <label for="inputPhoto" class="col-form-label">{{__('Photo')}}<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-picture-o"></i>{{__('Choose')}}
                    </a>
                </span>
                    <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$product->photo}}">
                </div>
                <small id="warningInputImg" class="form-text " style="font-size: 14px;color:red;margin-bottom: 26px;"> *Image size must be: 550 x 550</small>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                @error('photo')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <button class="btn btn-success" type="submit">{{__('Update')}}</button>
            </div>
        </form>
    </div>
    
    <div class="card-body" id="tab-attribute">
        <div class="row">
            <div class="col-lg-12">
                <div class="variant-checkbox">
                    <input type="checkbox" id="variant-checkbox">
                    <label for="variant-checkbox" class="turnOnVariant">Product with variants?</label>
                </div>
            </div>
        </div>
        <div class="variant-wrapper tw-hidden">
            <div class="row variant-container">
                <div class="col-lg-3">
                    <div class="attribute-title tw-text-blue-400">Attribute</div>
                </div>
                <div class="col-lg-9">
                    <div class="attribute-title tw-text-blue-400">Value Attribute</div>
                </div>
            </div>
            <div class="variant-body">     
            </div>
            <div class="variant-foot">
                <button type="button" class="add-variant tw-border-blue-400 tw-border tw-text-white tw-bg-blue-400 tw-p-2">Add new attribute</button>
            </div>
        </div>

        {{-- <div id="attribute_container" class="tw-flex tw-mb-4">
        <div id="attribute_values_container" style="display: none;"></div> --}}

        <!-- Modal add new address  -->
        {{-- @include('backend.product.attribute.product-variants-form') --}}
        <!-- End Modal -->

        <!-- Customer address list -->
        {{-- @include('backend.product.attribute.product-attribute-list') --}}
    </div>
    
</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>

@endpush
@push('after_scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    {{-- <script src="{{asset('backend/summernote/summernote.min.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="{{ mix('js/backend/product.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
    <script>
        $('#attr-photo').filemanager('image');
    </script>
    <script>
        $('#attr-photo').filemanager('image', { input: "#thumbnail-attribute" });
    </script>

    

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
    {{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> --}}
    <script>
        $(document).ready(function(){
      
          // Define function to open filemanager window
          var lfm = function(options, cb) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = cb;
          };
      
          // Define LFM summernote button
          var LFMButton = function(context) {
            var ui = $.summernote.ui;
            var button = ui.button({
              contents: '<i class="note-icon-picture"></i> ',
              tooltip: 'Insert image with filemanager',
              click: function() {
      
                lfm({type: 'image', prefix: '/laravel-filemanager'}, function(lfmItems, path) {
                  lfmItems.forEach(function (lfmItem) {
                    context.invoke('insertImage', lfmItem.url);
                  });
                });
      
              }
            });
            return button.render();
          };
      
          // Initialize summernote with LFM button in the popover button group
          // Please note that you can add this button to any other button group you'd like
          $('#summary').summernote()
          $('#description').summernote()
        });
       

    </script>

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
            // $('#add_attribute').on('click', function () {
            //     $("form :input:not([type=hidden])").val('');
            //     $('#form_attribute').attr('action', location.origin + '/admin/attribute');
            //     $('.form-attribute-title').text('Add a new attribute');
            // });
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
                currentVariantCount++;
                maxVariantCount = response.length; // Cập nhật maxVariantCount từ response
                checkMaxAttribute(currentVariantCount, maxVariantCount); // Kiểm tra xem có đạt đến giới hạn tối đa không
                console.log(response.length);
                disabledAttributeCatlogueChoose(); 
            }
        });
    });
    removeAttribute();
    disabledAttributeCatlogueChoose();
    chooseVariantGroup();
    createProductVariant();
});
function renderVariantItem(attributes) {
    var html = '';

    html += '<div class="row variant-item tw-mb-4">';
    html += '<div class="col-lg-3">';
    html += '<div class="attribute-catalogue">';
    html += '<select name="" class="choose-attribute nice-select">';
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
    html += '<button type="button" class="remove-attribute btn btn-danger">Delete</button>';
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
}
function checkMaxAttribute(currentCount, maxCount) {
    if (currentCount >= maxCount) {
        $('.add-variant').remove();    
    } else {
        $('.variant-foot').html('<button type="button" class="add-variant tw-border-blue-400 tw-border tw-text-white tw-bg-blue-400 tw-p-2">Add new attribute</button>');
    }
}
function removeAttribute () {
    $(document).on('click', '.remove-attribute', function(){
        let _this = $(this);
        _this.parents('.variant-item').remove();
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
            _this.parents('.col-lg-3').siblings('.col-lg-8').html('<input type="text" disabled class="fake-variant form-control tw-h-12">')
        }
        disabledAttributeCatlogueChoose();
    })
}

function getValueAttribute(attributeId) {
    $.ajax({
        type: 'GET',
        url: '{{url("admin/get-attribute-values")}}',
        data: { attributeId: attributeId }, // Truyền giá trị của thuộc tính value
        success: function(response) {
            attributeValues = response;
            renderAttributeValues(attributeValues);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
    
}

function renderAttributeValues(values) {
    let selectVariant = $('.selectVariant');
    
    // Thêm các option mới từ danh sách giá trị thuộc tính vào selectVariant
    $.each(values, function(index, value) {
        selectVariant.append($('<option>', {
            value: value.id,
            text: value.value
        }));
    });

    // Khởi tạo lại plugin select2 cho selectVariant
    selectVariant.select2();
}

function createProductVariant() {
    $(document).on('change', '.selectVariant', function(){
       let _this = $(this);
       createVariant();
    })
}

function createVariant() {
    let atttributes = [];
    let variant = [];
    
    $('.variant-item').each(function(){
        let _this = $(this);
        let attr = [];
        let attributeCatalougeId = _this.find('.choose-attribute option:selected').val();
        let optionText = _this.find('.choose-attribute option:selected').text();
        let attribute = $('.variant-'+attributeCatalougeId).select2('data')
        
    })
}

</script>
@endpush
