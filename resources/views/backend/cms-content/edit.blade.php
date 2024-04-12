@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit {{ $cmsPage->title }}</h5>
    <div class="card-body">
      <form method="post" action="{{route('cms-content.update',$cmsPage->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$cmsPage->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="content" class="col-form-label">Content</label>
          <textarea class="form-control" id="content-cms" name="content">{{$cmsPage->content}}</textarea>
          @error('content')
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
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
    {{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> --}}
  <script>
      
    $(document).ready(function() {
      $('#content-cms').summernote({
          placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });


</script>
@endpush

