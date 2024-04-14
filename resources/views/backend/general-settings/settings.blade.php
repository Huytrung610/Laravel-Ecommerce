@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Setting</h5>
    <div class="card-body">
      <form method="post" action="{{route('settings.update')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Url Instagram</label>
          <input id="inputTitle" type="text" name="url_instagram" placeholder="Enter Url Instagram"  value="{{ $data->url_instagram }}" class="form-control">
          @error('url_instagram')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Url Facebook</label>
          <input id="inputTitle" type="text" name="url_facebook" placeholder="Enter Url Facebook"  value="{{ $data->url_facebook }}" class="form-control">
          @error('url_facebook')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Address</label>
          <input id="inputTitle" type="text" name="contact_address" placeholder="Enter Address"  value="{{ $data->contact_address }}" class="form-control">
          @error('contact_address')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Hotline</label>
          <input id="inputTitle" type="tel" name="contact_phone" placeholder="Enter hotline"  value="{{ $data->contact_phone }}" class="form-control">
          @error('contact_phone')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        {{-- <div class="form-group">
          <label for="inputTitle" class="col-form-label">Email</label>
          <texterea id="inputTitle" type="text" name="email" placeholder="Enter Summary Enterprise Footer"  value="{{ $data->summary_enterprise }}" class="form-control">
          @error('summary_enterprise')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div> --}}
        <div class="form-group">
          <label for="inputSummaryEnterprise" class="col-form-label">Email</label>
          <input id="inputSummaryEnterprise" type="email" name="email" placeholder="Enter Email"  value="{{ $data->email }}" class="form-control">
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Logo Image</label>
          <div class="input-group">
              <div class="input-group-btn">
                  <div class="thumb-preview-container">
                      <div class="thumb-preview tw-relative">
                          <span class="thumbnail-wrapper choose-thumb-btn hover:tw-cursor-pointer">
                              <img class="tw-w-[200px] tw-h-[200px] img-thumbnail img-thumb_blog" src="{{$data->logo_path}}" alt="{{$data->logo_path}}">
                          </span>
                          <button type="button" class="del-img-thumb tw-absolute tw-left-[5px] tw-top-[5px] tw-text-red-600 tw-hidden"><i class="fa fa-trash"></i></button>
                          <input type="text" name="logo_path" hidden value="{{$data->logo_path}}" class="img_thumbnail-input"></input>
                      </div>
                  </div>
              </div>
          </div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
            <button class="btn btn-success tw-bg-green-600" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>
@endsection
@push('after_scripts')
  <script src="/backend/ckfinder_2/ckfinder.js"></script>
  <script src="{{ mix('js/backend/finder.js') }}"></script>
  <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
  <script>
    var defaultThumnail = "{{ asset('backend/img/logo.png') }}";
    $(document).ready(function(){
  
      
    });
      

    </script>
@endpush