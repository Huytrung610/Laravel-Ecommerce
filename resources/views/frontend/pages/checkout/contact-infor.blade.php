<div class="form-group contact-info-card">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <span class="tw-font-bold">Contact Info</span>
                <a href="{{route('profile')}}" class="change_addressdefault change-link tw-text-black tw-text-yellow-700">Change</a>
            </div>
        </div>
        <div class="tw-grid tw-grid-cols-2 tw-p-2.5">
            <div class="">
                <label class="tw-font-bold tw-text-md">{{__('Name')}}</label>
                <p class="value contact-name contact-name-info tw-text-black" name="name">{{ $addressDefault ? $addressDefault->getAttribute('name') : null }}</p>
            </div>
            <div class="">
                <label class="tw-font-bold tw-text-md">{{__('Phone number')}}</label>
                <p class="contact-phone contact-phone-info tw-text-black" name="phone_number"> {{ $addressDefault ? $addressDefault->phone_number : null }}</p>
            </div>
            <div class="">
                <label class="tw-font-bold tw-text-md">{{__('Email')}}</label>
                <p class="value contact-email-info tw-text-black" name="email">{{ $addressDefault->email  ?? $user->getAttribute('email') }}</p>
            </div>
            <div class="">
                <label class="tw-font-bold tw-text-md">{{__('Address')}}</label>
                <div class="contact-address-info" name="detail_address"><p class="tw-text-black"> {{ $addressDefault ? $addressDefault->detail_address  : null }}</p></div>
            </div>
            <div class="tw-hidden">
            <label>{{__('Gender')}}</label>
            <div class="contact-address-info tw-text-black" name="gender"><p> {{ $addressDefault ? $addressDefault->getAttribute('gender')  : App\Models\CustomerAddress::GENDER_MALE }}</p></div>
            </div>
            <div class="row tw-hidden">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                        <label>{{__('Address ID')}}<span>*</span></label>
                        <input type="text" name="address_id" placeholder=""
                                class="input-address-id"
                                value="{{ $addressDefault ? $addressDefault->id : null }}">
                        @error('address_id')
                        <span class='text-danger'>{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>