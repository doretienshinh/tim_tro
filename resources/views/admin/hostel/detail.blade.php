@extends('admin.layouts.admin_layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Hostel /</span> {{ $hostel->title }}</h4>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-12 mt-1 mb-1" style="height: 500px">
                    <div id="carouselExample" class="carousel slide carousel-dark carousel-fade" data-bs-ride="carousel">
                        <ol class="carousel-indicators">
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
                                    <img class="d-block m-auto img-fluid object-fit-contain"
                                        src="{{ asset('storage/' . $image) }}" alt="{{ asset('storage/' . $image) }}"
                                        style="height: 500px; width: auto; object-fit: fill;" />
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ $hostel->title }}</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                data-bs-placement="right" data-bs-html="true"
                                title="<i class='bx bx-trending-up bx-xs' ></i> <span>{{ $hostel->tag->description }}</span>">
                                {{ $hostel->tag->name }}
                            </button>
                        </div>
                        <hr>
                        <p class="card-text">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button type="button" class="accordion-button collapsed p-0" data-bs-toggle="collapse"
                                    data-bs-target="#accordion_desciption_{{ $hostel->id }}" aria-expanded="false"
                                    aria-controls="accordion_desciption_{{ $hostel->id }}">
                                    Mô tả
                                </button>
                            </h2>
                            <div id="accordion_desciption_{{ $hostel->id }}" class="accordion-collapse collapse show"
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
                            <input class="form-control" type="text" readonly value="{{ $hostel->address_detail }}" />
                        </div>
                        </p>
                        <hr>
                        <h6 class="card-title">Thông tin chi tiết trọ</h6>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="price" class="form-label">Giá trọ</label>
                                <input class="form-control" type="text" id="price" name="price"
                                    placeholder="Nhập giá tiền thuê trọ" autofocus
                                    value="{{ number_format($hostel->price) }}  Đồng" readonly />
                            </div>
                            <div class="col">
                                <label for="payment_note" class="form-label">Thông tin thanh toán</label>
                                <input class="form-control" type="text" id="payment_note" name="payment_note"
                                    placeholder="Ví dụ: 3 tháng / lần, 1 tháng / lần" autofocus
                                    value="{{ $hostel->payment_note }}" readonly />
                            </div>
                            @if (isset($hostel->deposit_price))
                                <div class="col">
                                    <label for="deposit_price" class="form-label">Giá tiền cọc</label>
                                    <input class="form-control" type="text" id="deposit_price" name="deposit_price"
                                        placeholder="Nhập giá tiền cọc" autofocus
                                        value="{{ number_format($hostel->deposit_price) }} Đồng" readonly />
                                </div>
                            @endif
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="acreage" class="form-label">Diện tích</label>
                                <input class="form-control" type="text" id="acreage" name="acreage"
                                    placeholder="Nhập diện tích tính theo mét vuông" autofocus
                                    value="{{ $hostel->acreage }} Mét vuông" readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="stay_with_host"
                                        name="stay_with_host" {{ $hostel->stay_with_host ? 'checked' : '' }} disabled />
                                    <label class="form-check-label" for="stay_with_host">Chung chủ</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="deposit_price"
                                        name="deposit_price" {{ $hostel->deposit_price ? 'checked' : '' }} disabled />
                                    <label class="form-check-label" for="deposit_price">Phải cọc</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="air_conditional"
                                        name="air_conditional" {{ $hostel->air_conditional ? 'checked' : '' }} disabled />
                                    <label class="form-check-label" for="air_conditional">Điều hòa</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="heater" name="heater"
                                        {{ $hostel->heater ? 'checked' : '' }} disabled />
                                    <label class="form-check-label" for="heater">Bình nóng lạnh </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="washing_machine"
                                        name="washing_machine" {{ $hostel->washing_machine ? 'checked' : '' }} disabled />
                                    <label class="form-check-label" for="washing_machine">Máy giặt</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="closed_room" name="closed_room"
                                        {{ $hostel->closed_room ? 'checked' : '' }} disabled />
                                    <label class="form-check-label" for="closed_room">Khép kín</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="parking_area"
                                        name="parking_area" {{ $hostel->parking_area ? 'checked' : '' }} disabled />
                                    <label class="form-check-label" for="parking_area">Chỗ gửi xe</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="elevator" name="elevator"
                                        {{ $hostel->elevator ? 'checked' : '' }} disabled />
                                    <label class="form-check-label" for="elevator">Thang máy</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="kitchen" name="kitchen"
                                        {{ $hostel->kitchen ? 'checked' : '' }} disabled />
                                    <label class="form-check-label" for="kitchen">Nhà bếp</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="balcony" name="balcony"
                                        {{ $hostel->balcony ? 'checked' : '' }} disabled />
                                    <label class="form-check-label" for="balcony">Ban công</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="electricity_price" class="form-label">Giá điện</label>
                                <input class="form-control" type="text" id="electricity_price"
                                    name="electricity_price" placeholder="Nhập giá tiền điện / 1 kWh" autofocus
                                    value="{{ number_format($hostel->electricity_price) }} Đồng / kWh" readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="water_price" class="form-label">Tiền nước</label>
                                <input class="form-control" type="text" id="water_price" name="water_price"
                                    placeholder="Nhập tiền nước" value="{{ number_format($hostel->water_price) }} Đồng"
                                    readonly />
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
                                <input class="form-control" type="text" id="internet_price" name="internet_price"
                                    placeholder="Nhập giá / tháng" autofocus
                                    value="{{ number_format($hostel->internet_price) }}" readonly />
                            </div>
                            <div class="col-6">
                                <label for="internet_note" class="form-label">Chú thích internet</label>
                                <input class="form-control" type="text" id="internet_note" name="internet_note"
                                    placeholder="Người/tháng, phòng/tháng" autofocus value="{{ $hostel->internet_note }}"
                                    readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="amount_of_people" class="form-label">Số người ở</label>
                                <input class="form-control" type="number" id="amount_of_people" name="amount_of_people"
                                    placeholder="Nhập số người ở" autofocus value="{{ $hostel->amount_of_people }}"
                                    readonly />
                            </div>
                            <div class="col">
                                <label for="floor" class="form-label">Vị trí phòng trọ trong nhà</label>
                                <input class="form-control" type="number" id="floor" name="floor"
                                    placeholder="Nằm ở tầng mấy" value="Tầng {{ $hostel->floor }}" readonly />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            @if (!in_array(Auth::user()->id, $hostel->hostel_users->pluck('user_id')->toArray()))
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter">
                                    Đặt lịch xem trọ
                                </button>
                            @endif
                            @if (
                                $hostel->hostel_users->where('user_id', '=', Auth::user()->id)->isNotEmpty() &&
                                    $hostel->hostel_users->where('user_id', '=', Auth::user()->id)[0]->status == 'accept')
                                <button type="button" class="btn btn-warning" disabled>
                                    Đã thuê trọ
                                </button>
                            @elseif (
                                $hostel->hostel_users->where('user_id', '=', Auth::user()->id)->isNotEmpty() &&
                                    $hostel->hostel_users->where('user_id', '=', Auth::user()->id)[0]->status == 'eject')
                                <button type="button" class="btn btn-warning" disabled>
                                    Bạn đã bị từ chối cho thuê trọ
                                </button>
                                <a class="btn btn-primary" href="{{ route('chat') . '/' . $hostel->user->id }}">Chat trực
                                    tiếp với chủ
                                    trọ</a>
                            @elseif (in_array(Auth::user()->id, $hostel->hostel_users->pluck('user_id')->toArray()))
                                <button type="button" class="btn btn-danger" disabled>
                                    Đã đăng ký thuê trọ
                                </button>
                            @else
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#rent_registration">
                                    Đăng ký thuê trọ
                                </button>
                            @endif
                        </div>
                        {{-- <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button type="button" class="accordion-button collapsed p-0"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#accordion_attribute_{{ $hostel->id }}" aria-expanded="false"
                                    aria-controls="accordion_attribute_{{ $hostel->id }}">
                                    Thông tin phòng trọ
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
        <div class="card mb-3">
            <div class="row g-0">
                <div>
                    <h5 class="card-header">Thông tin chủ trọ</h5>
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
                                <a href="{{ route('chat') . '/' . $hostel->user->id }}"
                                    class="btn btn-outline-secondary mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Chat</span>
                                </a>

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
                                            {{ $hostel->user->getRoleNames()[0] == 'host' ? 'checked' : '' }} disabled />
                                        <label class="form-check-label" for="role1">host</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="role2"
                                            value="host"
                                            {{ $hostel->user->getRoleNames()[0] == 'host' ? 'checked' : '' }} disabled />
                                        <label class="form-check-label" for="role2">Chủ trọ</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="role3"
                                            value="user"
                                            {{ $hostel->user->getRoleNames()[0] == 'user' ? 'checked' : '' }} disabled />
                                        <label class="form-check-label" for="role3">Sinh viên</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="role" class="form-label">Giới tính</label>
                                <div class="form-check">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender1"
                                            value="1" {{ $hostel->user->gender == '1' ? 'checked' : '' }} disabled />
                                        <label class="form-check-label" for="gender1">Nam</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender2"
                                            value="0" {{ $hostel->user->gender == '0' ? 'checked' : '' }} disabled />
                                        <label class="form-check-label" for="gender2">Nữ</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender3"
                                            value="2" {{ $hostel->user->gender == '2' ? 'checked' : '' }} disabled />
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
                                        <a href="{{ asset('storage/' . $hostel->user->student_card) }}" target="_blank">
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
        </div>
        <div class="card mb-3">
            <div class="row g-0 p-4">
                @if ($hostel->feedback_hostels->isNotEmpty())
                    <h3 class="title">
                        Tổng đánh giá:
                        {{ $hostel->feedback_hostels->sum('rate') / $hostel->feedback_hostels->count() }} Sao /
                        {{ $hostel->feedback_hostels->count() }} Đánh giá
                    </h3>
                @endif
                @foreach ($hostel->feedback_hostels->sortByDesc('created_at') as $feedback)
                    <hr>
                    <div class="w-100 mb-3 row">
                        <div class="row">
                            <div class="col-1">
                                <a href="{{ route('user.user.find', $feedback->user->id) }}">
                                    <img src="{{ $feedback->user->avatar ? asset('storage/' . $feedback->user->avatar) : asset('assets/img/avatars/default.png') }}"
                                        alt class="w-px-40 h-auto rounded-circle me-1" />
                                </a>
                            </div>
                            <div class="col-11">
                                <div>{{ $feedback->user->id == Auth::user()->id ? 'Bạn' : $feedback->user->name }}</div>
                                <small>{!! \App\Helpers\Helper::calTimeNotifi($feedback->created_at) !!}</small>
                                <h5 class="mt-3">
                                    {{ $feedback->content }}
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach
                <hr>
                <div class="chat-history-footer">
                    <form class="form-send-message d-flex justify-content-between align-items-center mb-0" method="POST"
                        action=" {{ route('user.feedback.store', $hostel->id) }}">
                        @csrf
                        <select class="selectpicker" data-style="btn-default" name="rate">
                            <option disable selected>Đánh giá</option>
                            <option value=1>1 sao</option>
                            <option value=2>2 sao</option>
                            <option value=3>3 sao</option>
                            <option value=4>4 sao</option>
                            <option value=5>5 sao</option>
                        </select>
                        <input class="form-control message-input border-0 me-3 shadow-none"
                            placeholder="Vui lòng nhập đánh giá" name="content">
                        <div class="message-actions d-flex align-items-center">
                            <button class="btn btn-primary d-flex send-msg-btn" type="submit">
                                <i class="bx bx-paper-plane me-md-2 me-0"></i>
                                <span class="align-middle d-md-inline-block d-none">Gửi</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if ($hostel->user->hostels->count() > 1)
            <h4 class="fw-bold py-3 mb-4">Những phòng trọ khác cùng chủ</h4>
            <div class="row">
                @foreach ($hostel->user->hostels as $index => $hostel_item)
                    <div class="card p-0 m-2 {{ $hostel->id == $hostel_item->id ? 'd-none' : '' }}"
                        style="width: 18rem;">
                        <img class="p-0 card-img-top" src="{{ asset('storage/' . $hostel_item->thumbnail) }}"
                            alt="Card image cap" style="height: 18rem;">
                        <div class="card-body p-3">
                            <h5 class="card-title">{{ $hostel_item->title }}</h5>
                            <p class="card-text">{{ $hostel_item->description }}</p>
                            <a href="{{ route('user.hostel.detail', $hostel_item->id) }}" class="btn btn-primary">Chi
                                tiết</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if ($hostels_by_ward->count() > 1)
            <h4 class="fw-bold py-3 mb-4">Những phòng trọ khác cùng vị trí</h4>
            <div class="row">
                @foreach ($hostels_by_ward as $index => $hostel_item)
                    <div class="card p-0 m-2 {{ $hostel->id == $hostel_item->id ? 'd-none' : '' }}"
                        style="width: 18rem;">
                        <img class="p-0 card-img-top" src="{{ asset('storage/' . $hostel_item->thumbnail) }}"
                            alt="Card image cap" style="height: 18rem;">
                        <div class="card-body p-3">
                            <h5 class="card-title">{{ $hostel_item->title }}</h5>
                            <p class="card-text">{{ $hostel_item->description }}</p>
                            <a href="{{ route('user.hostel.detail', $hostel_item->id) }}" class="btn btn-primary">Chi
                                tiết</a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $hostels_by_ward->links() }}
        @endif
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
                                action="{{ route('user.booking.store', ['time_id' => $time->id, 'hostel_id' => $hostel->id]) }}"
                                method="POST" class="d-none">@csrf</form>
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
    <div class="modal fade" id="rent_registration" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Bạn chắc chắn chứ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>Sau khi ấn đăng ký sẽ gửi thông báo tới cho chủ trọ, và đợi chủ trọ xét duyệt</div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <a href="{{ route('user.register-hostel.store', $hostel) }}" class="btn btn-success text-white">Thuê
                        trọ</a>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Hủy
                    </button>
                </div>
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
