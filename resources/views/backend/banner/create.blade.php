@extends('backend.layouts.master')

@section('title', env('APP_NAME') . ' || Banner Create')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Banner</h5>
    <div class="card-body">
      <form method="post" action="{{route('banner.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputHeading" class="col-form-label">Heading banner</label>
          <input id="inputHeading" type="text" name="heading" placeholder="Enter Heading" value="" class="form-control">
          @error('heading')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputUrl" class="col-form-label">Url banner</label>
          <input id="inputUrl" type="text" name="url" placeholder="Enter Url" value="" class="form-control">
          @error('url')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Description</label>
          <textarea class="form-control ckeditor" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo<span class="text-danger">*</span></label>
          <div class="input-group">
              <div class="input-group-btn">
                  <button type="button" class="choose-img-btn tw-bg-blue-500 hover:tw-bg-blue-700 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-rounded">Choose</button>
                  <input type="text" hidden name="photo" value="" class="img-banner-input">
                  <div class="thumb-preview-container"></div>
              </div>
          </div>
          <div id="preview-image-banner" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status<span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning tw-bg-yellow-600 ">Reset</button>
           <button class="btn btn-success tw-bg-green-600" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')

<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('after_scripts')
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
{{-- <script src="{!! asset('ckeditor/ckeditor.js') !!}"></script> --}}
<script src="/backend/ckfinder_2/ckfinder.js"></script>
{{-- <script src="{{ mix('js/backend/finder.js') }}"></script> --}}
<script src="{{ mix('js/backend/banner.js') }}"></script>

<script>

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write short description.....",
          tabsize: 2,
          height: 150
      });
    });
</script>
@endpush
