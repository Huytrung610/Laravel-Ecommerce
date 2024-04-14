@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Post</h5>
    <div class="card-body">
      <form method="post" action="{{route('post.update',$post->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$post->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{$post->description}}</textarea>
          @error('description')
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
                              <img class="tw-w-[200px] tw-h-[200px] img-thumbnail img-thumb_blog" src="{{$post->photo}}" alt="{{$post->photo}}">
                          </span>
                          <button type="button" class="del-img-thumb tw-absolute tw-left-[5px] tw-top-[5px] tw-text-red-600 tw-hidden"><i class="fa fa-trash"></i></button>
                          <input type="text" name="photo" hidden value="{{$post->photo}}" class="img_thumbnail-input"></input>
                      </div>
                  </div>
              </div>
          </div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($post->status=='active')? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($post->status=='inactive')? 'selected' : '')}}>Inactive</option>
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
    <link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}"> 
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
        
@endpush
@push('after_scripts')
    <script src="/backend/ckfinder_2/ckfinder.js"></script>
    <script src="{{ mix('js/backend/finder.js') }}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
  <script>
    var defaultThumnail = "{{ asset('backend/img/default-product-image.png') }}";
    $(document).ready(function() {
      $('#description').summernote({
          placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });
    </script>
@endpush

