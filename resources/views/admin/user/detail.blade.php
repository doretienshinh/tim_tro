@extends('admin.layouts.admin_layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Detail /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    @csrf
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            {{-- <img src="{{ asset('assets/img/avatars/default.png') }}" alt="user-avatar"
                                    class="d-block rounded" height="100" width="100" id="uploadedAvatar" /> --}}
                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/img/avatars/default.png') }}"
                                alt="user-avatar" class="d-block rounded" height="100" width="100"
                                id="uploadedAvatar" />
                            <div class="button-wrapper">
                                {{-- <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Tải ảnh mới</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" name="avatar" class="account-file-input"
                                            hidden accept="image/png, image/jpeg" />
                                    </label>
                                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Đặt lại</span>
                                    </button> --}}

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
                                    value="{{ $user->first_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Tên</label>
                                <input class="form-control" type="text" name="last_name" id="lastName"
                                    value="{{ $user->last_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email"
                                    value="{{ $user->email }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="role" class="form-label">Vai trò</label>
                                <div class="form-check">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="role1"
                                            value="admin" {{ $user->getRoleNames()[0] == 'admin' ? 'checked' : '' }}
                                            disabled />
                                        <label class="form-check-label" for="role1">Admin</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="role2"
                                            value="host" {{ $user->getRoleNames()[0] == 'host' ? 'checked' : '' }}
                                            disabled />
                                        <label class="form-check-label" for="role2">Chủ trọ</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="role3"
                                            value="user" {{ $user->getRoleNames()[0] == 'user' ? 'checked' : '' }}
                                            disabled />
                                        <label class="form-check-label" for="role3">Sinh viên</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="role" class="form-label">Giới tính</label>
                                <div class="form-check">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender1"
                                            value="1" {{ $user->gender == '1' ? 'checked' : '' }} disabled />
                                        <label class="form-check-label" for="gender1">Nam</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender2"
                                            value="0" {{ $user->gender == '0' ? 'checked' : '' }} disabled />
                                        <label class="form-check-label" for="gender2">Nữ</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender3"
                                            value="2" {{ $user->gender == '2' ? 'checked' : '' }} disabled />
                                        <label class="form-check-label" for="gender3">Khác</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="name"
                                    value="{{ $user->name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Số điện thoại</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="phoneNumber" name="phone_number" class="form-control"
                                        value="{{ $user->phone_number }}" disabled />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $user->address }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="birthday" class="form-label">Ngày sinh</label>
                                <input class="form-control" type="date"
                                    value="{{ date('Y-m-d', strtotime($user->birthday)) }}" id="birthday"
                                    name="birthday" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="school" class="form-label">Trường</label>
                                <input type="text" class="form-control" id="school" name="school"
                                    value="{{ $user->school }}" maxlength="100" disabled />
                            </div>
                            @if ($user->student_card)
                                <div class="mb-3 col-md-6">
                                    <label for="student_card" class="form-label">Thẻ sinh viên</label>
                                    {{-- <input class="form-control" type="file" id="student-card-upload"
                                        name="student_card" /> --}}
                                    <div class="mt-3" id="student_card_show">
                                        <a href="{{ asset('storage/' . $user->student_card) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $user->student_card) }}" width="250px"></a>
                                    </div>
                                </div>
                            @endif
                            @if ($user->citizen_identification)
                                <div class="mb-3 col-md-6">
                                    <label for="citizen_identification" class="form-label">CCCD/CMT</label>
                                    {{-- <input class="form-control" type="file" id="citizen-identification-upload"
                                            name="citizen_identification" /> --}}
                                    <div class="mt-3" id="citizen_identification_show">
                                        <a href="{{ asset('storage/' . $user->citizen_identification) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $user->citizen_identification) }}"
                                                width="250px"></a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mt-2">
                            <button type="reset"
                                onclick="window.location='{{ URL::route('admin.user.edit', $user->id) }}'"
                                class="btn btn-primary me-2">Sửa</button>
                            <button type="reset" onclick="window.location='{{ URL::route('admin.user.index') }}'"
                                class="btn btn-outline-secondary">Trở về</button>
                        </div>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript" src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
