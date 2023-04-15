@extends('backend.layouts.master')
<?php
//  $helper = new \App\Helpers\Backend\CategoryHelper();
?>
@section('main-content')

    <div class="card">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <h5 class="card-header">{{__('Edit Category')}}</h5>
        <div class="card-body">
            <form method="post" action="{{route('category.update',$category->id)}}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="store_id" id="currentStoreView" value="0"/>
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">{{__('Title')}}<span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="{{__('Enter title')}}"
                           value="{{$category->title}}" class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug" class="col-form-label">{{__('Slug')}}<span class="text-danger">*</span></label>
                    <input id="slug" type="text" name="slug" placeholder="{{__('Enter Slug')}}"
                           value="{{$category->slug ?? ''}}" class="form-control">
                    @error('slug')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">{{__('Summary')}}</label>
                    <textarea class="form-control" id="summary" name="summary">{{$category->summary}}</textarea>
                    @error('summary')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="summary" class="col-form-label">{{ __('Parent Category') }}</label>
                    <select name="parent_id" class="form-control">
                        @if($category->parent_id == 0)
                        <option value="0">---Main Category---</option>
                    @else
                        @foreach($categories as $key => $value)
                        <option value="{{$value->id}}">{{$value->title}}</option>
                        @endforeach
                    @endif
                </select>
                </div>
                <div class="form-group">
                    <label for="status" class="col-form-label">{{__('Status')}}<span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active" {{(($category->status=='active')? 'selected' : '')}}>{{__('Active')}}</option>
                        <option value="inactive" {{(($category->status=='inactive')? 'selected' : '')}}>{{__('Inactive')}}</option>
                    </select>
                    @error('status')
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
@endpush
@push('after_scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>

    <script src="{{ mix('/js/backend/storeView.js') }}"></script>

    <script>
        $('#lfm').filemanager('image');
        $(document).ready(function () {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150
            });
        });
    </script>
    <script>
        $('#is_parent').change(function () {
            var isChecked = $('#is_parent').prop('checked');
            if (isChecked) {
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            } else {
                $('#parent_cat_div').removeClass('d-none');
            }
        })
    </script>
@endpush
