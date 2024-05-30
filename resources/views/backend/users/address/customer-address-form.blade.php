<div class="modal fade" id="formAddress" tabindex="-1" role="dialog" aria-labelledby="addressModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title form-address-title" id="exampleModalLongTitle">{{ __('Add a new address') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_address" method="post" action="{{route('admin.customer-address.store')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input class="form-control" type="text" name="name" required="required">
                    </div>
                    
                    <div class="form-group">
                        <label>{{ __('Email') }}</label>
                        <input class="form-control" type="text" name="email" required="required">
                    </div>
                    <div class="form-group tw-flex tw-flex-col">
                        <label>{{ __('Gender') }}</label>
                        <select class="tw-h-10 tw-rounded-md tw-border-gray-400" type="text" name="gender">
                            <option id="male" value="{{ \App\Models\CustomerAddress::GENDER_MALE }}" selected>{{ __('Male') }}</option>
                            <option id="female" value="{{ \App\Models\CustomerAddress::GENDER_FEMALE }}">{{ __('Female') }}</option>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label>{{ __('Phone') }}</label>
                        <input class="form-control" required="required" type="text" name="phone_number">
                        <span class="phone_error tw-hidden tw-text-red-400">Please enter a valid phone number</span>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Detail Address') }}</label>
                        <input class="form-control" type="text" name="detail_address" required="required">
                    </div>
                   
                    <div class="form-group is_default tw-flex tw-align-center tw-gap-3">
                        <span class="tw-font-bold">{{ __('Is Default : ') }}</span>
                        <input class="tw-w-6 tw-h-6" type="checkbox" name="is_default">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="hidden" name="user_id" value="{{ $user->id }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tw-bg-gray-500" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary text-white tw-bg-blue-500" id="submit_addr_button">{{ __('Save changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
