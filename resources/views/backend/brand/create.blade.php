@extends('backend.layouts.master')
<?php
?>
@section('main-content')
    <div class="card">
        <h5 class="card-header">{{ __('Add Brand') }}</h5>
        <div class="card-body">
            <form method="post" action="{{ route('brand.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">{{ __('Name') }}<span
                            class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="name" placeholder="{{ __('Enter name') }}"
                        class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug" class="col-form-label">{{ __('Slug') }}<span
                            class="text-danger">*</span></label>
                    <input id="slug" type="text" name="slug" placeholder="{{ __('Enter Slug') }}"
                        class="form-control">
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category[]" class="col-form-label">{{ __('Category Type') }}<span class="text-danger">*</span></label>
                    <select name="category[]" id="brand-target" data-placeholder="Select categories" multiple='multiple'>
                        @foreach($parentCategories as $parentCategory)
                            <optgroup label="{{ $parentCategory->title }}" class="optgroup">
                                @foreach($childCategories->where('parent_id', $parentCategory->id) as $childCategory)
                                    <option value="{{ $childCategory->id }}" class="optnormal">{{ $childCategory->title }}</option>
                                @endforeach   
                                <option value="{{ $parentCategory->id }}" hidden class="opthidden">{{ $parentCategory->title }}</option>
                            </optgroup>
                        @endforeach
                    </select>
                    @error('category[]')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="inputLogo" class="col-form-label">Logo</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="logo_brand" value="{{old('logo_brand')}}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    @error('photo')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                  @php
                    $statusBrandActive = \App\Models\Brand::STATUS_ACTIVE;
                    $statusBrandInactive = \App\Models\Brand::STATUS_INACTIVE;
                 @endphp
                <div class="form-group">
                    <label for="status" class="col-form-label">{{ __('Status') }}<span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="{{ $statusBrandActive }}">{{ __('Active') }}</option>
                        <option value="{{ $statusBrandInactive }}">{{ __('Inactive') }}</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>      
                <div class="form-group mb-3">
                    <button type="reset" class="tw-bg-yellow-500 hover:tw-bg-yellow-700 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-border tw-border-yellow-700 tw-rounded">{{ __('Reset') }}</button>
                    <button class="tw-bg-blue-500 hover:tw-bg-blue-700 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-border tw-border-blue-700 tw-rounded " type="submit">{{ __('Submit') }}</button>
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
      
          // Initialize summernote with LFM button in the popover button group
          // Please note that you can add this button to any other button group you'd like
  
            $('#description').summernote({
                placeholder: "Write detail description.....",
                tabsize: 2,
                height: 150
            });
        });

      </script>

      <script src="{{ mix('js/backend/brand.js') }}"></script>
@endpush
