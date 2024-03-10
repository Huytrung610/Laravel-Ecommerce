@extends('backend.layouts.master')
<?php
?>
@section('main-content')

    <div class="card">
        <h5 class="card-header">{{ __('Attribute') }}</h5>
        <div class="card-body">
            <form method="post" action="{{route('attribute.update',$attribute->id)}}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="inputName" class="col-form-label">{{__('Title')}}<span class="text-danger">*</span></label>
                    <input id="inputName" type="text" name="name" placeholder="{{__('Enter name')}}"
                           value="{{$attribute->name}}" class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group tw-flex tw-flex-col tw-gap-5">
                    <label for="attributeValues" class="col-form-label">{{ __('Attribute Values') }}</label>
                    <div id="attributeValuesContainer">
                        @if(isset($attribute) && $attribute->attributeValues)
                            @foreach($attribute->attributeValues as $value)
                                <div class="attribute-value-container tw-flex tw-gap-5">
                                    <input type="text" name="attribute_values[]" value="{{ $value->value }}" class="form-control mt-2">
                                    <button type="button" class="btn btn-danger removeAttributeValue">Remove</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" id="addAttributeValue" class="btn btn-primary tw-w-[12%]">Add more value</button>
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
        $(document).ready(function () {
            let attributeValueCounter = {{ isset($attribute->values) ? count($attribute->values) : 0 }};

            // Event listener for the "Add Attribute Value" button
            $('#addAttributeValue').on('click', function () {
                // Increment the counter for unique input IDs
                attributeValueCounter++;

                // Create a new input element for attribute value
                let inputElement = $('<input>')
                    .attr({
                        type: 'text',
                        name: 'attribute_values[]',
                        placeholder: 'Enter attribute value',
                        class: 'form-control mt-2 '
                    });

                // Create a new div to hold the input element
                let containerDiv = $('<div>').addClass('attribute-value-container tw-flex tw-gap-5').append(inputElement);

                // Create a new button for removing the attribute value
                let removeButton = $('<button>')
                    .attr({
                        type: 'button',
                        class: 'btn btn-danger removeAttributeValue'
                    })
                    .text('Remove');

                // Append the remove button to the container
                containerDiv.append(removeButton);

                // Append the container to the values container
                $('#attributeValuesContainer').append(containerDiv);
            });

            // Event listener for removing attribute values
            $(document).on('click', '.removeAttributeValue', function () {
                // Remove the parent container when the remove button is clicked
                $(this).closest('.attribute-value-container').remove();
            });

            // Show or hide remove buttons based on the existence of attribute values
            function toggleRemoveButtons() {
                let hasAttributeValues = $('#attributeValuesContainer').find('.attribute-value-container').length > 0;
                $('.removeAttributeValue').toggle(hasAttributeValues);
            }

            // Initial toggle when the page loads
            toggleRemoveButtons();
        });
    </script>
    
@endpush
