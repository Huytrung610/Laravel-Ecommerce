<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/profile-user.css')  }}">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
   

</head>

<body>
    <div class="container">

        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
            </ol>
        </nav>

        <div class="row gutters-sm">
            <div class="col-md-4 d-none d-md-block">
                <div class="card">
                    <div class="card-body">
                        <nav class="nav flex-column nav-pills nav-gap-y-1">
                            <a href="#profile" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>                                Thông tin cá nhân

                            </a>

                            <a href="#security" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield mr-2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>Đổi
                                mật khẩu
                            </a>
                            <a href="#address" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell mr-2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>                                Địa chỉ nhận hàng
                            </a>

                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-bottom mb-3 d-flex d-md-none">
                        <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                            <li class="nav-item">
                                <a href="#profile" data-toggle="tab" class="nav-link has-icon active"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></a>
                            </li>

                            <li class="nav-item">
                                <a href="#security" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></a>
                            </li>
                            <li class="nav-item">
                                <a href="#address" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg></a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane active" id="profile">
                            <h6>YOUR PROFILE INFORMATION</h6>
                            <hr>
                            <form >
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" id="fullName" aria-describedby="fullNameHelp" placeholder="Enter your fullname" value="Nguyễn Anh Dũng">
                                    <small id="fullNameError" class="form-text text-danger"></small>
                                </div>
                        
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Enter your username" value="dungktt" readonly>
                                    <small id="usernameHelp" class="form-text text-muted">Bạn không thể thay đổi Username đã được đặt từ trước</small>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your username" value="dungktt@gmail.com" readonly>
                                    <small id="emailHelp" class="form-text text-muted">Bạn không thể thay đổi email đã được đặt từ trước</small>
                                </div>
                        
                                <div class="form-group">
                                    <label for="phoneNumber">Phone Number:</label>
                                    <input type="tel" class="form-control" id="phoneNumber" placeholder="Enter your phonenumber" value="099999999">
                                    <small id="phoneNumberError" class="form-text text-danger"></small>                                </div>
                        
                                <div class="form-group">
                                    <label for="location">Giới tính</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                                Nam
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                        <label class="form-check-label" for="flexRadioDefault2">
                                                 Nữ
                                        </label>
                                    </div>
                                </div>
                        
                                <button type="button" id="update-profile-btn" class="btn btn-primary">Update Profile</button>
                                {{-- <button type="reset" class="btn btn-light">Reset Changes</button> --}}
                            </form>
                        </div>

                        <div class="tab-pane" id="security">
                            <h6>Đổi mật khẩu</h6>
                            <hr>
                            <form>
                                <div class="form-group">
                                    <label class="d-block">Change Password</label>
                                    <input type="password" id="old-password" class="form-control" placeholder="Enter your old password">
                                    <input type="password" id="new-password-1" class="form-control mt-1" placeholder="New password">
                                    <input type="password" id="new-password-2" class="form-control mt-1" placeholder="Confirm new password">
                                    <small id="password-error" class="form-text text-danger"></small>
                                </div>
                                <button type="button" id="update-password-btn" class="btn btn-primary">Update Password</button>
                            </form>
                        </div>
                        <div class="tab-pane" id="address">
                            <h6>My Address</h6>
                            <hr>
                            <form >
                                <div class="form-group">
                                    <button class="btn btn-info" type="button" onclick="showAddressCard()">Thêm địa chỉ nhận hàng</button>
                                </div>
                        
                                <div class="form-group" id="address-card" style="display: none;">
                                    <label for="address">Địa chỉ nhận hàng:</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="full-name">Họ và tên:</label>
                                                <input type="text" class="form-control" id="full-name" placeholder="Nhập họ và tên">
                                                <div class="invalid-feedback" id="full-name-error"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Số điện thoại nhận hàng:</label>
                                                <input type="tel" class="form-control" id="phone" placeholder="Nhập số điện thoại" pattern="[0-9]{10,12}" title="Vui lòng nhập số điện thoại hợp lệ (từ 10 đến 12 chữ số)" required>
                                                <div class="invalid-feedback" id="phone-error"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="address-detail">Địa chỉ cụ thể:</label>
                                                <input type="text" class="form-control" id="address-detail" placeholder="Nhập địa chỉ cụ thể">
                                                <div class="invalid-feedback" id="address-detail-error"></div>
                                                <small id="addressHelp" class="form-text text-muted">Nhập địa chỉ cụ thể: số nhà, huyện/phường, quận, tỉnh/thành phố</small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="button" onclick="addAddress()">Thêm</button>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="form-group mb-0">
                                    <label class="d-block">Địa chỉ đã có</label>
                                    <div id="existing-addresses" class="border border-gray-500 bg-gray-200 p-3 text-center font-size-sm">
                        
                                        <div class="address-item">
                                            <input type="radio" name="address" value="1">
                                            <label>Nguyễn Anh Dũng -  0849580686 - Đống Đa, Thành phố hà nội
                                            </label>
                                        </div>
                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('frontend/js/user_profile.js') }}"></script>
</body>

</html>