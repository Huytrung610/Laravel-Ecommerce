<div class="modal fade" id="formAttribute" tabindex="-1" role="dialog" aria-labelledby="attributeModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title form-attribute-title" id="exampleModalLongTitle">{{ __('Add a new attribute') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_attribute" method="post" action="{{route('attribute.store')}}" >
                  @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('SKU') }}</label>
                        <input class="form-control attribute_sku" type="text" name="attribute_sku" required="required">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Color') }}</label>
                        <input class="form-control" type="color" name="attribute_color" required="required">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Price') }}</label>
                        <input class="form-control" type="text" name="attribute_price" required="required">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Stock') }}</label>
                        <input class="form-control" type="text" name="attribute_stock" required="required">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="hidden" name="product_id" value="{{ $product->id }}">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary text-white">{{ __('Save changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
