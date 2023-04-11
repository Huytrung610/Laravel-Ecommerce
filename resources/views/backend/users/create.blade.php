@extends('backend.layouts.master')

@section('main-content')
    @php
        $styleResult = 'display:block';
    @endphp 
<div class="card">
<h5 class="card-header">Add User</h5>
<div class="card-body">
<form method="post" action="{{route('users.store')}}">
{{csrf_field()}}
{{-- <div class="form-group wgt-customer-id" style="{{$styleResult}}">
    <label for="inputTitle" class="col-form-label">{{ __('Customer ID') }}</label>
    <input id="inputTitle" type="text" name="customer_id" value="{{$users->customer_id ?? '' }}" class="form-control">
    @error('customer_id')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div> --}}
<div class="form-group">
    <label for="inputTitle" class="col-form-label">Name</label>
    <input id="inputTitle" type="text" name="name" placeholder="Enter name" value="{{old('name')}}"
           class="form-control">
    @error('name')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>
{{-- <div class="form-group">
    <label for="inputTitle" class="col-form-label">First Name</label>
    <input id="inputTitle" type="text" name="first_name" placeholder="Enter First Name"
           value="{{old('first_name')}}" class="form-control">
    @error('first_name')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    <label for="inputTitle" class="col-form-label">Last Name</label>
    <input id="inputTitle" type="text" name="last_name" placeholder="Enter Last Name"
           value="{{old('last_name')}}" class="form-control">
    @error('last_name')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div> --}}
<div class="form-group">
    <label for="inputEmail" class="col-form-label">Email</label>
    <input id="inputEmail" type="email" name="email" placeholder="Enter email" value="{{old('email')}}"
           class="form-control">
    @error('email')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    <label for="inputPassword" class="col-form-label">Password</label>
    <input id="inputPassword" type="password" name="password" placeholder="Enter password"
           value="{{old('password')}}" class="form-control">
    @error('password')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>
@php
    $roles = \App\Models\User::ROLE;
            @endphp
            <div class="form-group">
                <label for="role" class="col-form-label">Role</label>
                <select name="role" class="form-control" id="wgt-role">
                    <option value="">-----Select Role-----</option>
                    @foreach($roles as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
                @error('role')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status" class="col-form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
