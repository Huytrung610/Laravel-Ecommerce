@extends('backend.layouts.master')
<?php
// $helper = new \App\Helpers\Backend\CategoryHelper();
// $productHelper = new \App\Helpers\Backend\ProductHelper();
?>
@section('main-content')
    @include('backend.layouts.notification')
    <div class="card">
        <h5 class="card-header">{{__('Add Product')}}</h5>
        <div class="card-body">
            <form method="post" action="{{ route('product.store') }}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="status" class="col-form-label">{{__('Status')}}<span
                            class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active">{{__('Active')}}</option>
                        <option value="inactive">{{__('Inactive')}}</option>
                    </select>
                    @error('status')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="{{__('Enter title')}}"
                           class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="product_code" class="col-form-label">{{__('Product Code')}}</label>
                    <input id="inputProductCode" required type="text" name="product_code" placeholder="{{__('Enter Product Code')}}"
                            value="" class="form-control">
                    @error('product_code')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="summary" class="col-form-label">{{__('Short Description')}}<span
                            class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary"></textarea>
                    @error('summary')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <?php 
                // echo $helper->getUseDefaultValueHtml('summary', null, request());
                ?>
                <div class="form-group">
                    <label for="description" class="col-form-label">{{__('Description')}}</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="brand_id">{{__('Brand')}}<span class="text-danger">*</span></label>
                    <select name="brand_id" id="brand_id" class="form-control" required>
                        <option value="">{{__('--Select any brand--')}}</option>
                        @foreach($brands as $key=>$brand)
                                <option value='{{$brand->id}}'>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="category_id" class="col-form-label">{{ __('Category Type') }}<span class="text-danger">*</span></label>
                    <select name="category_id" id="product-target" data-placeholder="Select categories" multiple='multiple'>
                        @foreach($parentCategories as $parentCategory)
                            <optgroup label="{{ $parentCategory->title }}" class="optgroup">
                                @foreach($childCategories->where('parent_id', $parentCategory->id) as $childCategory)
                                    <option value="{{ $childCategory->id }}" class="optnormal">{{ $childCategory->title }}</option>
                                @endforeach   
                                <option value="{{ $parentCategory->id }}" hidden class="opthidden">{{ $parentCategory->title }}</option>
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
                            value="" class="form-control">
                    @error('price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stock" class="col-form-label">{{__('Stock')}}</label>
                    <input id="inputStock" type="number" name="stock" required placeholder="{{__('Enter Stock')}}"
                            value="" class="form-control">
                    @error('stock')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">Thumbnail<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-btn">
                            <div class="thumb-preview-container">
                                <div class="thumb-preview tw-relative">
                                    <span class="thumbnail-wrapper choose-thumb-btn hover:tw-cursor-pointer">
                                        <img class="tw-w-[200px] tw-h-[200px] img-thumbnail img-thumb_product" src="{{asset('backend/img/default-product-image.png')}}" alt="{{asset('backend/img/thumbnail-default.jpg')}}">
                                    </span>
                                    <button type="button" class="del-img_product tw-absolute tw-left-[5px] tw-top-[5px] tw-text-red-600 tw-hidden"><i class="fa fa-trash"></i></button>
                                    <input type="text" name="photo" hidden value="" class="img_product-input img_thumbnail-input"></input>
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
                    <div class="click-to-upload-album tw-flex tw-flex-col tw-items-center tw-border tw-border-dashed tw-border-gray-400 tw-p-5 tw-gap-2">
                        <div class="icon"><a type="button" class="upload-variant-picture">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tư-w-20 tw-h-20">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        <div class="small-text tw-text-blue-400">Use "choose image" or click into this to add new image</div>
                    </div>
                    <ul id="album-general" class="upload-general-album tw-hidden tw-flex tw-border tw-border-dashed tw-border-gray-400 tw-p-6 tw-gap-2.5 sortui ui-sortable">
                        
                    </ul>
                    <input type="hidden" name="album" value="" class="general_album">
                </div>
                <div class="form-group mb-3 tw-mt-5">
                    <button type="reset" class="btn btn-warning tw-bg-yellow-600">{{__('Reset')}}</button>
                    <button class="btn btn-success tw-bg-green-600" type="submit">{{__('Submit')}}</button>
                </div>
            </form>
        </div>
    </div>

@endsection


@push('styles')

        
@endpush
@push('after_scripts')
    <script src="/backend/ckfinder_2/ckfinder.js"></script>
    <script src="{{ mix('js/backend/finder.js') }}"></script>
    <script src="{{ mix('js/backend/product.js') }}"></script>
 
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
    <script>
        var defaultThumnail = "{{ asset('backend/img/default-product-image.png') }}";
        $(document).ready(function(){
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
        });
        
      </script>

@endpush


