<div class="profile-info-wrapper tw-flex tw-flex-col tw-gap-3">
    <div class="tw-border-b tw-border-gray-200 tw-pb-2.5">
        <h1 class="tw-text-2xl tw-font-bold">Change password</h1>
    </div>
    <form action="{{route('change.password')}}" method="POST">
        @csrf
        <div class="form-group tw-flex tw-flex-col tw-gap-2">
            <input type="password" name="current_password" id="old-password" class="form-control" required placeholder="Enter your old password">
            <input type="password" name="new_password" id="new-password" class="form-control mt-1" required placeholder="New password">
            <input type="password" name="new_confirm_password" id="new-password-confirm" required class="form-control mt-1" placeholder="Confirm new password">
            <small id="password-error" class="form-text text-danger"></small>
        </div>
        <button type="submit" id="update-password-btn" class="btn btn-primary">Update Password</button>
    </form>
</div>

