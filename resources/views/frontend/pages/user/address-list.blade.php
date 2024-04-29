<div class="tab-pane tw-flex tw-flex-col tw-gap-3" id="address">
    <div class="tw-border-b tw-border-gray-200 tw-pb-2.5">
        <h1 class="tw-text-2xl tw-font-bold">Change password</h1>
    </div>
    <div class="form-group tw-flex tw-flex-col tw-gap-4">
        @if(empty($defaultAddress) && empty($address))
            <span class="tw-text-[#FF8C00] tw-font-bold">No delivery address yet? Create now</span>
        @endif
        <div class="add-new-address--container tw-flex tw-flex-col tw-gap-4">
            <span class="create-address--btn tw-flex tw-gap-1 tw-items-center hover:tw-cursor-pointer hover:tw-text-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-4 tw-h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                </svg>
                <span>Thêm địa chỉ nhận hàng</span>
            </span>
            <div class="new-address-member--form tw-flex tw-justify-center tw-hidden">
                <form action="{{route('address.add')}}"  method="POST" class="tw-w-4/6 tw-border tw-flex tw-flex-col tw-gap-3 tw-p-2">
                    @csrf
                    <div class="tw-flex tw-gap-3">
                        <div class="tw-w-1/2"> 
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="name-user">Name</label>
                                <input type="text" class="form-control" value="" name="name" />
                            </div>
                        </div>
                        <div class="tw-w-1/2">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="phone-user">Phone</label>
                                <input type="text"  name="phone_number" value="" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="email-user">Email</label>
                        <input type="email" name="email" value="" class="form-control" />
                    </div>
                    <div class="gender-user-address tw-flex tw-gap-4">
                        <label for="gender">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="{{ \App\Models\CustomerAddress::GENDER_MALE }}" checked>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="{{ \App\Models\CustomerAddress::GENDER_FEMALE }}">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>                    
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="detail-address">Detailed address</label>
                        <input type="text" name="detail_address" value="" class="form-control" />
                    </div>
                    <input type="hidden" id="name-user" class="form-control" name="user_id" value="" />
                    <button type="submit" class="btn btn-primary">Add Address</button>
                </form>
            </div>
        </div>
        @foreach($addressList as $addressItem)
            <div class="existed-address-container border border-gray-500 bg-gray-200 p-3 font-size-sm list_contact">
                <div class="existing-address">
                    <div class="address-item tw-flex tw-gap-2">
                        <div class="item">
                            <input type="radio" data-id="{{ $addressItem->id }}" @if($addressItem->is_default == 1) checked @endif id="use_{{ $addressItem->id }}" name="default_address" value="{{ $addressItem->id }}">
                        </div>
                        <span class="hover:tw-cursor-pointer">
                            {{ $addressItem->name }} - {{ $addressItem->phone_number }} - {{ $addressItem->detail_address }}
                        </span>
                        <form method="POST" action="{{route('customer-address.destroy',[$addressItem->id])}}">
                            @csrf
                            @method('delete')
                            <span class="dlt-address--btn hover:tw-cursor-pointer" data-id="{{ $addressItem->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#D2042D" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-4 tw-h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </span>
                        </form>
                    </div>
                </div>
                <div class="existed-address-member--form tw-flex tw-justify-center tw-hidden">
                    <form action="{{ route('customer-address.update', ['id' => $addressItem->id]) }}"  method="POST" class="tw-w-4/6 tw-flex tw-flex-col tw-gap-3 tw-p-2">
                        @csrf
                        <div class="tw-flex tw-gap-3">
                            <input type="hidden" name="id" value={{ $addressItem->id }}>
                            <div class="tw-w-1/2"> 
                                <div data-mdb-input-init class="form-outline">
                                    <label class="form-label" for="name-user">Name</label>
                                    <input type="text" class="form-control" value="{{ $addressItem->name }}" name="name" />
                                </div>
                            </div>
                            <div class="tw-w-1/2">
                                <div data-mdb-input-init class="form-outline">
                                    <label class="form-label" for="phone-user">Phone</label>
                                    <input type="text" name="phone_number" value="{{ $addressItem->phone_number }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="email-user">Email</label>
                            <input type="email" name="email" value="{{ $addressItem->email }}" class="form-control" />
                        </div>
                        <div class="gender-user-address tw-flex tw-gap-4">
                            <label for="gender">Gender</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="{{ \App\Models\CustomerAddress::GENDER_MALE }}" {{ $addressItem->gender == \App\Models\CustomerAddress::GENDER_MALE ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="{{ \App\Models\CustomerAddress::GENDER_FEMALE }}" {{ $addressItem->gender == \App\Models\CustomerAddress::GENDER_FEMALE ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>                    
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="detail-address">Detailed address</label>
                            <input type="text" name="detail_address" value="{{ $addressItem->detail_address }}" class="form-control" />
                        </div>
                        <input type="hidden" class="form-control" name="user_id" value="{{ $user->id ?? auth()->user()->id }}" />
                        <button type="submit" class="btn btn-primary">Update Address</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

      