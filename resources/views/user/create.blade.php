@extends('layouts.admin_layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <form id="formAccountSettings" method="POST" action=" {{ route('admin.user.store') }}"
                        enctype='multipart/form-data'>
                        @csrf
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ asset('assets/img/avatars/default.png') }}" alt="user-avatar"
                                    class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Tải ảnh mới</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" name="avatar" class="account-file-input"
                                            hidden accept="image/png, image/jpeg" />
                                    </label>
                                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Đặt lại</span>
                                    </button>

                                    {{-- <p class="text-muted mb-0">Cho phép định dạng JPG, GIF hoặc PNG. Dung lượng tối đa 800KB</p> --}}
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Họ</label>
                                    <input class="form-control" type="text" id="firstName" name="first_name"
                                        placeholder="Fisrt Name" autofocus />
                                    @if ($errors->has('first_name'))
                                        <span id="first-name-error" class="error text-danger"
                                            for="input-name">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Tên</label>
                                    <input class="form-control" type="text" name="last_name" id="lastName"
                                        placeholder="Last Name" />
                                    @if ($errors->has('last_name'))
                                        <span id="last-name-error" class="error text-danger"
                                            for="input-name">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        placeholder="timtro@example.com" />
                                    @if ($errors->has('email'))
                                        <span id="email-error" class="error text-danger"
                                            for="input-name">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Mật khẩu</label>
                                    <input class="form-control" type="text" id="password" name="password"
                                        placeholder="123456" />
                                    @if ($errors->has('password'))
                                        <span id="password-error" class="error text-danger"
                                            for="input-name">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="role" class="form-label">Vai trò</label>
                                    <div class="form-check">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role" id="role1"
                                                value="admin" />
                                            <label class="form-check-label" for="role1">Admin</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role" id="role2"
                                                value="host" />
                                            <label class="form-check-label" for="role2">Chủ trọ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role" id="role3"
                                                value="user" />
                                            <label class="form-check-label" for="role3">Sinh viên</label>
                                        </div>
                                        @if ($errors->has('role'))
                                            <span id="role-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('role') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="role" class="form-label">Giới tính</label>
                                    <div class="form-check">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender1"
                                                value="1" />
                                            <label class="form-check-label" for="gender1">Nam</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender2"
                                                value="0" />
                                            <label class="form-check-label" for="gender2">Nữ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender3"
                                                value="2" />
                                            <label class="form-check-label" for="gender3">Khác</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="name"
                                        placeholder="Username" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Số điện thoại</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="phoneNumber" name="phone_number" class="form-control"
                                            placeholder="093xxxxxxx" />
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Địa chỉ" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="birthday" class="form-label">Ngày sinh</label>
                                    <input class="form-control" type="date" value="2021-06-18" id="birthday"
                                        name="birthday" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="school" class="form-label">Trường</label>
                                    <input type="text" class="form-control" id="school" name="school"
                                        placeholder="Trường đại học xxx" maxlength="100" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="student_card" class="form-label">Thẻ sinh viên</label>
                                    <input class="form-control" type="file" id="student-card-upload"
                                        name="student_card" />
                                    <div class="mt-5" id="student_card_show">
                                        {{-- <label for="formFile" class="form-label">Thẻ sinh viên</label> --}}
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="citizen_identification" class="form-label">CCCD/CMT</label>
                                    <input class="form-control" type="file" id="citizen-identification-upload"
                                        name="citizen_identification" />
                                    <div class="mt-5" id="citizen_identification_show">
                                        {{-- <label for="formFile" class="form-label">CCCD/CMT</label> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Tạo</button>
                                <button type="reset" onclick="window.location='{{ URL::route('admin.user.index') }}'"
                                    class="btn btn-outline-secondary">Trở về</button>
                            </div>
                        </div>
                    </form>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript" src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
