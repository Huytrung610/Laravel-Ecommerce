@extends('backend.layouts.master')
@section('title', env('APP_NAME') . ' || Banner Edit')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Banner</h5>
    <div class="card-body">
      <form method="post" action="{{route('banner.update',$banner->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$banner->title}}" class="form-control">
        @error('title')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <div class="form-group">
          <label for="inputHeading" class="col-form-label">Heading banner</label>
          <input id="inputHeading" type="text" name="heading" placeholder="Enter Heading" value="{{$banner->heading}}" class="form-control">
          @error('heading')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputUrl" class="col-form-label">Url banner</label>
          <input id="inputUrl" type="text" name="url" placeholder="Enter Url" value="{{$banner->url}}" class="form-control">
          @error('url')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{$banner->description}}</textarea>
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
                  <div class="thumb-preview-container">
                    @if($banner->photo)
                      <div class="thumb-preview tw-relative">
                        <img src="{{$banner->photo}}" alt="{{$banner->photo}}">
                        <button type="button" class="del-img-banner tw-absolute tw-left-[5px] tw-top-[5px] tw-text-red-600"><i class="fa fa-trash"></i></button>
                        <input type="text" hidden name="photo" value="{{$banner->photo}}" class="img-banner-input"></input>
                      </div>
                    @endif
                  </div>
              </div>
          </div>
          <div id="preview-image-banner" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($banner->status=='active') ? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($banner->status=='inactive') ? 'selected' : '')}}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success tw-bg-green-600" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')

@endpush
@push('after_scripts')

<script src="/backend/ckfinder_2/ckfinder.js"></script>
<script src="{{ mix('js/backend/banner.js') }}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
<script>

    $(document).ready(function() {
      $('#description').summernote({
        height: 600,
        placeholder: "Write short description.....",
        tabsize: 2,
        height: 150,
        toolbar: [
    
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
          ]
      });
    });
</script>
@endpush
