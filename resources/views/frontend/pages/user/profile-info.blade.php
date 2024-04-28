<div class="profile-info-wrapper tw-flex tw-flex-col tw-gap-3">
    <div class="tw-border-b tw-border-gray-200 tw-pb-2.5">
        <h1 class="tw-text-2xl tw-font-bold">Profile Information</h1>
    </div>
    <div class="profile-form">
        <form action="{{route('update.profile')}}" method="POST">
            @csrf
            <div class="form-group tw-flex tw-flex-col tw-gap-1.5">
                <label for="fullName">Full Name</label>
                <input type="text" class="form-control" name='name' id="fullName" aria-describedby="fullNameHelp" placeholder="Enter your fullname" value="{{$user->name}}">
                <small id="fullNameError" class="form-text text-danger"></small>
            </div>
            <div class="form-group tw-flex tw-flex-col tw-gap-1.5">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your username" value="{{$user->email}}" readonly>
                <small id="emailHelp" class="form-text text-muted">Bạn không thể thay đổi email đã được đặt từ trước</small>
            </div>
    
            <button type="submit" id="update-profile-btn" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>