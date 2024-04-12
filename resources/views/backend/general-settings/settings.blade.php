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
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="logo_path" value="{{ $data->logo_path }}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('logo_path')
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
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    {{-- <script src="{{asset('backend/summernote/summernote.min.js')}}"></script> --}}


    <script>
        $('#lfm').filemanager('image');
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
        });
       

      </script>
@endpush