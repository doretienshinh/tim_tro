@extends('user.layouts.user_layout')

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
                    <div class="row g-0">
                        <div class="col-md-12">
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
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">{{ $hostel->title }}</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true"
                                        title="<i class='bx bx-trending-up bx-xs' ></i> <span>{{ $hostel->tag->description }}</span>">
                                        {{ $hostel->tag->name }}
                                    </button>
                                </div>
                                <hr>
                                <p class="card-text">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button type="button" class="accordion-button collapsed p-0"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#accordion_desciption_{{ $hostel->id }}" aria-expanded="false"
                                            aria-controls="accordion_desciption_{{ $hostel->id }}">
                                            Mô tả
                                        </button>
                                    </h2>
                                    <div id="accordion_desciption_{{ $hostel->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body pt-4">
                                            {{ $hostel->description }}
                                        </div>
                                    </div>
                                </div>
                                </p>
                                <hr>
                                <h6 class="card-title">Thông tin địa chỉ</h6>
                                <p class="card-text">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input class="form-control" id="address" type="text" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlReadOnlyInput1" class="form-label">Địa chỉ chi
                                        tiết</label>
                                    <input class="form-control" type="text" readonly
                                        value="{{ $hostel->address_detail }}" />
                                </div>
                                </p>
                                <hr>
                                <h6 class="card-title">Thông tin chi tiết trọ</h6>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="price" class="form-label">Giá trọ</label>
                                        <input class="form-control" type="text" id="price" name="price"
                                            placeholder="Nhập giá tiền thuê trọ" autofocus
                                            value="{{ number_format($hostel->price) }}  Đồng" readonly />
                                    </div>
                                    <div class="col-6">
                                        <label for="payment_note" class="form-label">Thông tin thanh toán</label>
                                        <input class="form-control" type="text" id="payment_note" name="payment_note"
                                            placeholder="Ví dụ: 3 tháng / lần, 1 tháng / lần" autofocus
                                            value="{{ $hostel->payment_note }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    @if (isset($hostel->deposit_price))
                                        <div class="col-6">
                                            <label for="deposit_price" class="form-label">Giá tiền cọc</label>
                                            <input class="form-control" type="text" id="deposit_price"
                                                name="deposit_price" placeholder="Nhập giá tiền cọc" autofocus
                                                value="{{ number_format($hostel->deposit_price) }} Đồng" readonly />
                                        </div>
                                    @endif
                                    <div class="col-6">
                                        <label for="electricity_price" class="form-label">Giá điện</label>
                                        <input class="form-control" type="text" id="electricity_price"
                                            name="electricity_price" placeholder="Nhập giá tiền điện / 1 kWh" autofocus
                                            value="{{ number_format($hostel->electricity_price) }} Đồng" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="water_price" class="form-label">Tiền nước</label>
                                        <input class="form-control" type="text" id="water_price" name="water_price"
                                            placeholder="Nhập tiền nước"
                                            value="{{ number_format($hostel->water_price) }} Đồng" readonly />
                                    </div>
                                    <div class="col-6">
                                        <label for="water_note" class="form-label">Cách tính</label>
                                        <input class="form-control" type="text" id="water_note" name="water_note"
                                            placeholder="Nhập cách tính ví dụ: người/tháng, giá nước/số khối" readonly
                                            value="{{ $hostel->water_note }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="internet_price" class="form-label">Giá internet</label>
                                        <input class="form-control" type="text" id="internet_price"
                                            name="internet_price" placeholder="Nhập giá / tháng" autofocus
                                            value="{{ number_format($hostel->internet_price) }}" readonly />
                                    </div>
                                    <div class="col-6">
                                        <label for="internet_note" class="form-label">Chú thích internet</label>
                                        <input class="form-control" type="text" id="internet_note"
                                            name="internet_note" placeholder="Người/tháng, phòng/tháng" autofocus
                                            value="{{ $hostel->internet_note }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="acreage" class="form-label">Diện tích</label>
                                        <input class="form-control" type="text" id="acreage" name="acreage"
                                            placeholder="Nhập diện tích tính theo mét vuông" autofocus
                                            value="{{ $hostel->acreage }} Mét vuông" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="stay_with_host" class="form-label">Ở chung chủ</label>
                                        <select id="stay_with_host" class="selectpicker w-100" data-style="btn-default"
                                            name="stay_with_host" disabled>
                                            <option value=1 {{ $hostel->stay_with_host == 1 ? 'selected' : '' }}>Chung chủ
                                            </option>
                                            <option value=0 {{ $hostel->stay_with_host == 0 ? 'selected' : '' }}>Không
                                                chung chủ</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="air_conditional" class="form-label">Điều hòa</label>
                                        <select id="air_conditional" class="selectpicker w-100" data-style="btn-default"
                                            name="air_conditional" disabled>
                                            <option value=1 {{ $hostel->air_conditional == 1 ? 'selected' : '' }}>Có điều
                                                hòa</option>
                                            <option value=0 {{ $hostel->air_conditional == 0 ? 'selected' : '' }}>Không có
                                                điều hòa</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="heater" class="form-label">Nóng lạnh</label>
                                        <select id="heater" class="selectpicker w-100" data-style="btn-default"
                                            name="heater" disabled>
                                            <option value=1 {{ $hostel->heater == 1 ? 'selected' : '' }}>Có bình nóng lạnh
                                            </option>
                                            <option value=0 {{ $hostel->heater == 0 ? 'selected' : '' }}>Không có bình nóng
                                                lạnh</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="washing_machine" class="form-label">Máy giặt</label>
                                        <select id="washing_machine" class="selectpicker w-100" data-style="btn-default"
                                            name="washing_machine" disabled>
                                            <option value=1 {{ $hostel->washing_machine == 1 ? 'selected' : '' }}>Có máy
                                                giặt</option>
                                            <option value=0 {{ $hostel->washing_machine == 0 ? 'selected' : '' }}>Không có
                                                máy giặt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="amount_of_people" class="form-label">Số người ở</label>
                                        <input class="form-control" type="number" id="amount_of_people"
                                            name="amount_of_people" placeholder="Nhập số người ở" autofocus
                                            value="{{ $hostel->amount_of_people }}" readonly />
                                    </div>
                                    <div class="col-3">
                                        <label for="closed_room" class="form-label">Khép kín</label>
                                        <select id="closed_room" class="selectpicker w-100" data-style="btn-default"
                                            name="closed_room" disabled>
                                            <option value=1 {{ $hostel->closed_room == 1 ? 'selected' : '' }}>Khép kín
                                            </option>
                                            <option value=0 {{ $hostel->closed_room == 0 ? 'selected' : '' }}>Không khép
                                                kín</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="parking_area" class="form-label">Chỗ đổ xe</label>
                                        <select id="parking_area" class="selectpicker w-100" data-style="btn-default"
                                            name="parking_area" disabled>
                                            <option value=1 {{ $hostel->parking_area == 1 ? 'selected' : '' }}>Có chỗ đổ xe
                                            </option>
                                            <option value=0 {{ $hostel->parking_area == 0 ? 'selected' : '' }}>Không có chỗ
                                                đổ xe</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <label for="floor" class="form-label">Vị trí phòng trọ trong nhà</label>
                                        <input class="form-control" type="number" id="floor" name="floor"
                                            placeholder="Nằm ở tầng mấy" value="{{ $hostel->floor }}" readonly />
                                    </div>
                                    <div class="col-3">
                                        <label for="elevator" class="form-label">Thang máy</label>
                                        <select id="elevator" class="selectpicker w-100" data-style="btn-default"
                                            name="elevator" disabled>
                                            <option value=1 {{ $hostel->elevator == 1 ? 'selected' : '' }}>Có thang máy
                                            </option>
                                            <option value=0 {{ $hostel->elevator == 0 ? 'selected' : '' }}>Không có thang
                                                máy</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="kitchen" class="form-label">Chỗ nấu ăn</label>
                                        <select id="kitchen" class="selectpicker w-100" data-style="btn-default"
                                            name="kitchen" disabled>
                                            <option value=1 {{ $hostel->kitchen == 1 ? 'selected' : '' }}>Có chỗ nấu ăn
                                            </option>
                                            <option value=0 {{ $hostel->kitchen == 0 ? 'selected' : '' }}>Không có chỗ nấu
                                                ăn</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="balcony" class="form-label">Ban công</label>
                                        <select id="balcony" class="selectpicker w-100" data-style="btn-default"
                                            name="balcony" disabled>
                                            <option value=1 {{ $hostel->balcony == 1 ? 'selected' : '' }}>Có ban công
                                            </option>
                                            <option value=0 {{ $hostel->balcony == 0 ? 'selected' : '' }}>Không có ban công
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalCenter">
                                        Đặt lịch xem trọ
                                    </button>
                                </div>
                                {{-- <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button type="button" class="accordion-button collapsed p-0"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#accordion_attribute_{{ $hostel->id }}" aria-expanded="false"
                                            aria-controls="accordion_attribute_{{ $hostel->id }}">
                                            Thông tin nhà trọ
                                        </button>
                                    </h2>
                                    <div id="accordion_attribute_{{ $hostel->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body pt-4">
                                            {{ $hostel->description }}
                                        </div>
                                    </div>
                                </div> --}}
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
                                                value="host"
                                                {{ $hostel->user->getRoleNames()[0] == 'host' ? 'checked' : '' }}
                                                disabled />
                                            <label class="form-check-label" for="role1">host</label>
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
                            <form id="form-{{ $time->id }}"
                                action="{{ route('user.booking.store', ['time_id'=> $time->id,'hostel_id'=>$hostel->id]) }}" method="POST"
                                class="d-none">@csrf</form>
                            <a href="javascript:void(0)" class="dropdown-item"
                                onclick="document.getElementById('form-{{ $time->id }}').submit()">
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
        var address_show = $('#address');
        var district_id;
        var province_id;
        var address;
        $.ajax({
            url: 'https://provinces.open-api.vn/api/w/' + ward_id,
            method: 'get',
            success: function(response) {

                district_id = response.district_code;
                address = response.name;

                $.ajax({
                    url: 'https://provinces.open-api.vn/api/d/' + district_id,
                    method: 'get',
                    success: function(response) {
                        province_id = response.province_code;
                        address = address + ' - ' + response.name;

                        $.ajax({
                            url: 'https://provinces.open-api.vn/api/p/' +
                                province_id,
                            method: 'get',
                            success: function(response) {

                                address = address + ' - ' +
                                    response.name;
                                address_show.val(address);
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
