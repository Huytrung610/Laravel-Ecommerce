@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Setting</h5>
    <div class="card-body">
        <div class="tw-flex tw-gap-8">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @php
                    $columns = array_keys($pageSettings->getAttributes());
                    $excludeColumns = ['id', 'created_at', 'updated_at'];
                    $tabs = array_diff($columns, $excludeColumns);
                @endphp
                @foreach($tabs as $column => $value)
                    @php
                        $columnName = ucwords(str_replace('_', ' ', $value));
                    @endphp
                        <button class="nav-link @if($loop->first) active @endif tw-whitespace-nowrap" id="v-pills-{{$value}}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{$value}}" type="button" role="tab" aria-controls="v-pills-{{$value}}" aria-selected="@if($loop->first) true @else false @endif">{{$columnName}}</button>
                @endforeach
            </div>
            <form method="post" action="{{route('page-setting.update')}}">
                {{csrf_field()}}
                <div class="tab-content tw-flex tw-flex-col tw-gap-4" id="v-pills-tabContent">
                    @foreach($tabs as $column)
                        @php
                            $value = $pageSettings->$column ?? ''; // Lấy giá trị của cột từ $pageSettings
                            $columnName = ucwords(str_replace('_', ' ', $column));
                            $isActive = $loop->first ? 'show active' : '';
                        @endphp
                        
                            <div class="tab-pane fade {{$isActive}}" id="v-pills-{{$column}}" role="tabpanel" aria-labelledby="v-pills-{{$column}}-tab">
                                <textarea id="{{$column}}-des" class="summernote-page" type="text" name="{{$column}}" class="form-control">{{ $value ?? '' }}</textarea>
                            </div>
                            @error($column)
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    @endforeach
                    <div class="form-group mb-3">
                        <button class="btn btn-success tw-text-white tw-bg-green-600" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
        
        
        {{-- <form method="post" action="{{route('page-setting.update')}}">
            {{csrf_field()}}
            <div class="form-group">
            <label for="about-us-des" class="col-form-label">About Us</label>
            <textarea id="about-us-des" type="text" name="about_us" class="form-control">{{ $aboutUsData->about_us ?? '' }}</textarea>
            @error('about_us')
            <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form> --}}
    </div>
</div>
@endsection
@push('after_scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>

<script>
    $(document).ready(function() {
        $('.summernote-page').each(function() {
            let id = $(this).attr('id');
            $('#' + id).summernote({
                height: 800,
                placeholder: "Write detail description.....",
                tabsize: 2,
            });
        });
    });
</script>
   
    
@endpush