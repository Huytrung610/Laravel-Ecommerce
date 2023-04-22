@extends('backend.layouts.master')
<?php
?>
@section('main-content')
    <div class="card">
        <h5 class="card-header">{{ __('Add Attribute Value') }}</h5>
        <div class="card-body">
            <form method="post" action="{{ route('attribute_value.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="attribute" class="col-form-label">{{ __('Attribute') }}</label>
                    <select name="attribute" class="form-control">
                    <option value="0">---Attribute---</option>
                    @foreach($attributes as $key => $value)                    
                        <option name="attribute_id" value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">{{ __('Value') }}<span
                            class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="value" placeholder="{{ __('Enter Value Attribute') }}"
                        class="form-control">
                    @error('value')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
        
    </div>

    
    <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">{{ __('Reset') }}</button>
        <button class="btn btn-success" type="submit">{{ __('Submit') }}</button>
    </div>
    </form>
    </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
@endpush
@push('after_scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>

    <script src="{{ mix('/js/backend/storeView.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');
        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "{{ __('Write short description.....') }}",
                tabsize: 2,
                height: 120
            });
        });
    </script>
@endpush
