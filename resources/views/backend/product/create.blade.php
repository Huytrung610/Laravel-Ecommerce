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
                <?php 
                // echo $helper->getUseDefaultValueHtml('status', null, request());
                ?>
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="{{__('Enter title')}}"
                           class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <?php
                // echo $helper->getUseDefaultValueHtml('title', null, request());
                ?>
                {{-- <div class="form-group">
                    <label for="stock">{{__('Quantity')}}<span class="text-danger">*</span></label>
                    <input id="quantity" type="number" name="stock" min="0" placeholder="{{__('Enter quantity')}}"
                    class="form-control">
                    @error('stock')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div> --}}
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
                <?php 
                // echo $helper->getUseDefaultValueHtml('description', null, request());
                ?>
                
                {{-- <div class="form-group">
                    <label for="category_id">{{__('Category')}}<span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">{{__('--Select any category--')}}</option>
                        @foreach($categories as $key=>$cat_data)
                            @if($cat_data->parent_id == 0)
                                <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div> --}}

                <div class="form-group">
                    <label for="sub_category_id">{{__('Category')}}<span class="text-danger">*</span></label>
                    <select name="sub_category_id" id="sub_category_id" class="form-control">
                        <option value="">{{__('--Select any sub category--')}}</option>
                        @foreach($categories as $key=>$cat_data)
                            @if($cat_data->parent_id != 0)
                                <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
                            @endif
                        @endforeach
                    </select>
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
                        <input id="thumbnail" class="form-control" type="text" name="photo">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    @error('photo')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <button type="reset" class="btn btn-warning">{{__('Reset')}}</button>
                    <button class="btn btn-success" type="submit">{{__('Submit')}}</button>
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
    
    
    
@endpush

   



