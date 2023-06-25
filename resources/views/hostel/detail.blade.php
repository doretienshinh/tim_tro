@extends('layouts.admin_layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Hostel /</span> {{ $hostel->title }}</h4>
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                        <i class="tf-icons bx bx-home"></i> Detail
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">3</span> --}}
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile"
                        aria-selected="false">
                        <i class="tf-icons bx bx-user"></i> Profile
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages"
                        aria-selected="false">
                        <i class="tf-icons bx bx-message-square"></i> Feedback & Rating
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">

                    <div class="p-4 min-vh-100">
                        <div class="card-body row">
                            <div class="col-md-6">
                                <div id="carouselExample" class="carousel slide min-vh-50" data-bs-ride="carousel">
                                    <ol class="carousel-indicators" style="top:0 !important;bottom:auto;">
                                        @php
                                            $images = explode(';', $hostel->image);
                                            $images = array_filter($images, function ($value) {
                                                return !empty($value);
                                            });
                                        @endphp
                                        @foreach ($images as $index => $image)
                                            <li data-bs-target="#carouselExample" data-bs-slide-to="{{ $index - 1 }}"
                                                class="{{ $index == 1 ? 'active' : '' }}"></li>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner min-vh-50">
                                        @foreach ($images as $index => $image)
                                            <div class="carousel-item {{ $index == 1 ? 'active' : '' }}">
                                                <img class="d-block w-100 h-100 img-fluid object-fit-contain"
                                                    src="{{ asset('storage/' . $image) }}"
                                                    alt="{{ asset('storage/' . $image) }}" />
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExample" role="button"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExample" role="button"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="fw-bold py-3 mb-4">
                                    {{ $hostel->title }}
                                    <button type="button" class="ms-2 btn btn-primary" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true"
                                        title="<i class='bx bx-trending-up bx-xs' ></i> <span>{{ $hostel->tag->description }}</span>">
                                        {{ $hostel->tag->name }}
                                    </button>
                                </h4>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Mô tả</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>{{ $hostel->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="preview_city" class="form-label">province</label>
                                    <input class="form-control" id="preview_city" type="text" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="preview_district" class="form-label">District</label>
                                    <input class="form-control" id="preview_district" type="text" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="preview_ward" class="form-label">Ward</label>
                                    <input class="form-control" id="preview_ward" type="text" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlReadOnlyInput1" class="form-label">Địa chỉ chi
                                        tiết</label>
                                    <input class="form-control" type="text" readonly
                                        value="{{ $hostel->address_detail }}" />
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        <img src="{{ $hostel->user->avatar ? asset('storage/' . $hostel->user->avatar) : asset('assets/img/avatars/default.png') }}"
                                            alt="user-avatar" class="d-block rounded" height="100" width="100" />
                                        <div class="button-wrapper">
                                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                <span class="d-none d-sm-block">{{ $hostel->user->name }}</span>
                                                <i class="bx bx-upload d-block d-sm-none"></i>
                                            </label>
                                            {{-- <div type="button" class="btn btn-outline-secondary mb-4">
                              <i class="bx bx-reset d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Reset</span>
                            </div> --}}

                                            {{-- <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> --}}
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter">
                                    Đặt lịch xem trọ
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                    <div>
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                {{-- <img src="{{ asset('assets/img/avatars/default.png') }}" alt="user-avatar"
                                        class="d-block rounded" height="100" width="100" id="uploadedAvatar" /> --}}
                                <img src="{{ $hostel->user->avatar ? asset('storage/' . $hostel->user->avatar) : asset('assets/img/avatars/default.png') }}"
                                    alt="user-avatar" class="d-block rounded" height="100" width="100"
                                    id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">{{ $hostel->user->name }}</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                    </label>
                                    {{-- <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
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
                                        value="{{ $hostel->user->first_name }}" disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Tên</label>
                                    <input class="form-control" type="text" name="last_name" id="lastName"
                                        value="{{ $hostel->user->last_name }}" disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ $hostel->user->email }}" disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="role" class="form-label">Vai trò</label>
                                    <div class="form-check">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role" id="role1"
                                                value="admin"
                                                {{ $hostel->user->getRoleNames()[0] == 'admin' ? 'checked' : '' }}
                                                disabled />
                                            <label class="form-check-label" for="role1">Admin</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role" id="role2"
                                                value="host"
                                                {{ $hostel->user->getRoleNames()[0] == 'host' ? 'checked' : '' }}
                                                disabled />
                                            <label class="form-check-label" for="role2">Chủ trọ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role" id="role3"
                                                value="user"
                                                {{ $hostel->user->getRoleNames()[0] == 'user' ? 'checked' : '' }}
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
                                                value="1" {{ $hostel->user->gender == '1' ? 'checked' : '' }}
                                                disabled />
                                            <label class="form-check-label" for="gender1">Nam</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender2"
                                                value="0" {{ $hostel->user->gender == '0' ? 'checked' : '' }}
                                                disabled />
                                            <label class="form-check-label" for="gender2">Nữ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender3"
                                                value="2" {{ $hostel->user->gender == '2' ? 'checked' : '' }}
                                                disabled />
                                            <label class="form-check-label" for="gender3">Khác</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="name"
                                        value="{{ $hostel->user->name }}" disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Số điện thoại</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="phoneNumber" name="phone_number" class="form-control"
                                            value="{{ $hostel->user->phone_number }}" disabled />
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ $hostel->user->address }}" disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="birthday" class="form-label">Ngày sinh</label>
                                    <input class="form-control" type="date"
                                        value="{{ date('Y-m-d', strtotime($hostel->user->birthday)) }}" id="birthday"
                                        name="birthday" disabled />
                                </div>
                                @if ($hostel->user->school)
                                    <div class="mb-3 col-md-6">
                                        <label for="school" class="form-label">Trường</label>
                                        <input type="text" class="form-control" id="school" name="school"
                                            value="{{ $hostel->user->school }}" maxlength="100" disabled />
                                    </div>
                                @endif
                                @if ($hostel->user->student_card)
                                    <div class="mb-3 col-md-6">
                                        <label for="student_card" class="form-label">Thẻ sinh viên</label>
                                        {{-- <input class="form-control" type="file" id="student-card-upload"
                                                name="student_card" /> --}}
                                        <div class="mt-3" id="student_card_show">
                                            <a href="{{ asset('storage/' . $hostel->user->student_card) }}"
                                                target="_blank">
                                                <img src="{{ asset('storage/' . $hostel->user->student_card) }}"
                                                    width="250px"></a>
                                        </div>
                                    </div>
                                @endif
                                @if ($hostel->user->citizen_identification)
                                    <div class="mb-3 col-md-6">
                                        <label for="citizen_identification" class="form-label">CCCD/CMT</label>
                                        {{-- <input class="form-control" type="file" id="citizen-identification-upload"
                                            name="citizen_identification" /> --}}
                                        <div class="mt-3" id="citizen_identification_show">
                                            <a href="{{ asset('storage/' . $hostel->user->citizen_identification) }}"
                                                target="_blank">
                                                <img src="{{ asset('storage/' . $hostel->user->citizen_identification) }}"
                                                    width="250px"></a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- /Account -->
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                    a
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Chọn lịch xem trọ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach ($hostel->user->times as $time)
                            <a class="dropdown-item" href="{{ route('admin.hostel.detail', $hostel) }}">
                                <i class="bx bx-search-alt me-1"></i>
                                <span>Thời gian: {{ $time->start_at }} -> {{ $time->end_at }} </span><br>
                                @if ($time->day)
                                    <span>Ngày: {{ $time->day }}</span>
                                @endif
                                @if ($time->weekly_at)
                                    <span>Hằng tuần: {{ $time->weekly_at }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
                {{-- <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary"
                    data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function(e) {
        var ward_id = {{ $hostel->ward_id }};
        var district_id;
        var province_id;

        // function getDataLocation(ajaxurl) {
        //     return $.ajax({
        //         url: ajaxurl,
        //         type: 'GET',
        //     });
        // };
        // async function getLocation(ajaxurl) {
        //     try {
        //         const res = await getData(ajaxurl);
        //         return res;
        //     } catch (err) {
        //         return error;
        //     }
        // }
        // var ward = await getLocation('https://provinces.open-api.vn/api/w/' + ward_id).then(
        //     $('#preview_ward').val(ward.name);
        //     district_id = warden.district_id;
        // );
        // var district = await getLocation('https://provinces.open-api.vn/api/d/' + ward_id).then(
        //     $('#preview_district').val(ward.name);
        //     province_id = district.district_id;
        // );
        // var city = await getLocation('https://provinces.open-api.vn/api/p/' + ward_id).then(
        //     $('#preview_city').val(city.name);
        // );

        $.ajax({
            url: 'https://provinces.open-api.vn/api/w/' + ward_id,
            method: 'get',
            success: function(response) {
                console.log(response);

                district_id = response.district_code;
                $('#preview_ward').val(response.name);

                $.ajax({
                    url: 'https://provinces.open-api.vn/api/d/' + district_id,
                    method: 'get',
                    success: function(response) {
                        console.log(response);
                        province_id = response.province_code;
                        $('#preview_district').val(response.name);

                        $.ajax({
                            url: 'https://provinces.open-api.vn/api/p/' +
                                province_id,
                            method: 'get',
                            success: function(response) {
                                console.log(response);

                                $('#preview_city').val(response.name);
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });


    });
</script>
