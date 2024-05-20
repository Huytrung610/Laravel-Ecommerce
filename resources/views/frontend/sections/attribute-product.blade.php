@php
    $attributeQueryString = explode(',', request()->get('attribute_id'));
@endphp
<div class="swatch-option-container tw-flex tw-flex-col tw-gap-4 tw-border-b tw-pb-5 tw-border-gray-300">
    @if($productDetail->has_variants != 0 && !is_null($productDetail->attributes))
        @foreach ($productDetail->attributes as $attribute)
            <div class="swatch-option-wrapper attribute tw-flex tw-gap-5 tw-w-full tw-grid tw-gap-5">
                <div class="swatch-title tw-flex tw-items-center">
                    <span class="tw-font-bold tw-text-sm">{{ $attribute['name'] }}:</span>
                </div>
                <div class="swatch-value attribute-value tw-flex tw-gap-5">
                    @if(!is_null($attribute['values']))
                        @foreach ($attribute['values'] as $keyAttr => $value)
                            <a 
                                class="choose-attribute tw-px-1.5 tw-py-1 tw-border tw-border-black hover:tw-cursor-pointer hover:tw-text-third
                                @php
                                    $isActive =(is_array($attributeQueryString) && in_array($value->id, $attributeQueryString)) && $productDetail->has_variants != 0 || ($keyAttr == 0 && empty($attributeQueryString[0])) && $productDetail->has_variants != 0 
                                @endphp
                                {{ $isActive ? 'active' : '' }}"
                                data-attributevalueid="{{ $value->id }}" 
                                title="{{ $value->value }}"
                                >
                                {{ $value->value }}
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach  
    @endif  
</div>
<input type="hidden" name="product_id" value={{$productDetail->id}}>
<input type="hidden" name="code_product_variant" class="attribute_value_id--hidden">
