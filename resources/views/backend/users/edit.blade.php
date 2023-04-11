@extends('backend.layouts.master')

@section('main-content')
    @if(session('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! session('success') !!}</li>
            </ul>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! session('error') !!}</li>
            </ul>
        </div>
    @endif
    @php
        $roleCustomer = $user->role ?? '';
    @endphp
    @if($roleCustomer == \App\Models\User::ROLE_TYPE_ADMIN)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {!! $error !!}
            </div>
        @endforeach
    @endif

    <div class="card">
        <div class="card-header card-tabs d-flex">
            <div id="user" class="tab-header">{{ __('User Info') }}</div>
            @if(isset($user->role) && $user->role != \App\Models\User::ROLE_TYPE_ADMIN)
                <div id="address" class="tab-header">{{ __('Address Info') }}</div>
            @endif
        </div>
        <div class="card-body" id="tab-user">
            <form method="post" action="{{route('users.update',$user->id)}}">
                @csrf
                @method('PATCH')
                @php
                    $styleResult = 'display:block';
                    $customerStyle = 'display:block';
                        $roleCustomer = $user->role ?? '';
                        // $customerType = $user->user_type ?? '';
                        // if ($roleCustomer != 'user') {
                        //     $styleResult = 'display:none';
                        //     $customerStyle = 'display:none';
                        // } else {
                        //     if($customerType != \App\User::GROUP_CHILDREN_COMPANY) {
                        //         $customerStyle = 'display:none';
                        //     }
                        // }
                @endphp
                {{-- <div class="form-group wgt-customer-id" style="{{ $styleResult }}">
                    <label for="inputTitle" class="col-form-label">{{ __('Customer ID') }}</label>
                    <input id="inputTitle" type="text" name="customer_id" value="{{ $user->customer_id ?? '' }}" class="form-control">
                    @error('customer_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}
                {{-- <div class="form-group">
                    <label for="inputTitle" class="col-form-label">{{ __('First Name') }}</label>
                    <input id="inputTitle" type="text" name="first_name" placeholder="Enter First Name"
                           value="{{$user->first_name}}" class="form-control">
                    @error('first_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">{{ __('Last Name') }}</label>
                    <input id="inputTitle" type="text" name="last_name" placeholder="Enter Last Name"
                           value="{{$user->last_name}}" class="form-control">
                    @error('last_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div> --}}
                <div class="form-group">
                    <label for="inputName" class="col-form-label">Name</label>
                    <input id="inputName" type="text" name="name" placeholder="Enter name" value="{{$user->name}}"
                           class="form-control">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-form-label">Email</label>
                    <input id="inputEmail" type="email" name="email" placeholder="Enter email" value="{{$user->email}}"
                           class="form-control">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                @php
                $roles = \App\Models\User::ROLE;
                @endphp
                <div class="form-group">
                    <label for="role" class="col-form-label">{{ __('Role') }}</label>
                        <select name="role" class="form-control" id="wgt-role">
                        @if(isset($roles))
                            @foreach($roles as $key => $role)
                                <option value="{{$key}}" {{(($user->role == $key) ? 'selected' : '')}}>{{$role}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('role')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="status" class="col-form-label">{{ __('Status') }}</label>
                    <select name="status" class="form-control">
                        <option value="active" {{(($user->status=='active') ? 'selected' : '')}}>{{ __('Active')}}</option>
                        <option value="inactive" {{(($user->status=='inactive') ? 'selected' : '')}}>{{ __('Inactive') }}</option>
                    </select>
                        @error('status')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group mb-3">
                       <button class="btn btn-success" type="submit">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
        @if($user->role == 'user')
            <div class="card-body" id="tab-address">
                <button type="button" id="add_address" class="btn btn-primary mb-4" data-toggle="modal" data-target="#formAddress">
                    {{ __('Add Address') }}
                </button>

                <!-- Modal add new address  -->
                {{-- @include('backend.users.address.customer-address-form')
                <!-- End Modal -->

                <!-- Customer address list -->
                @include('backend.users.address.customer-address-list') --}}
            </div>
        @endif
</div>

@endsection

