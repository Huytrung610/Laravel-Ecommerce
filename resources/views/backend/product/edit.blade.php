@extends('backend.layouts.master')
<?php
// $helper = new \App\Helpers\Backend\CategoryHelper();
// $productHelper = new \App\Helpers\Backend\ProductHelper();
?>
@section('main-content')
    @include('backend.layouts.notification')
    <div class="card">
        <h5 class="card-header">{{__('Edit Product')}}</h5>
        <div class="card-body">
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
                    <label for="stock">{{__('Quantity')}}<span class="text-danger">*</span></label>
                    <input id="quantity" type="number" name="stock" min="0" placeholder="{{__('Enter quantity')}}"
                           value="{{$product->stock}}" class="form-control">
                    @error('stock')
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
                    <label for="category_id">{{__('Category')}}<span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">{{__('--Select any category--')}}</option>
                        @foreach($categories as $key=>$catData)
                            <option
                                value='{{$catData->id}}' {{(($product->category_id==$catData->id)? 'selected' : '')}}>{{$catData->title}}</option>
                        @endforeach
                    </select>
                </div>


                {{-- <div class="form-group {{(($product->child_cat_id)? '' : 'd-none')}}" id="sub _cat_div">
                    <label for="sub _cat_id">{{__('Sub Category')}}</label>
                    <select name="sub _cat_id" id="sub _cat_id" class="form-control">
                        <option value="{{$currentSubCategory->id ?? ''}}">{{$currentSubCategory->title ?? ''}}</option>
                    </select>
                </div> --}}

                <div class="form-group">
                    <label for="price" class="col-form-label">{{__('Price')}}<span class="text-danger">*</span></label>
                    <input id="price" type="text" name="price" placeholder="{{__('Enter price')}}"
                           value="{{$product->price}}"
                           class="form-control">
                    @error('price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">{{__('Update')}}</button>
                </div>
            </form>
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
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="{{ mix('/js/backend/storeView.js') }}"></script>
    <script src="{{ mix('/js/backend/product.js') }}"></script>
    <script src="{{ mix('/js/backend/tierPrice.js') }}"></script>
@endpush
