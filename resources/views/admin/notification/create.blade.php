@extends('admin.layouts.admin_layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Notification Create</span></h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form id="formAccountSettings" method="POST" action=" {{ route('admin.notification.store') }}"
                        enctype='multipart/form-data'>
                        @csrf
                        <h5 class="card-header">Notification Details</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="title" class="form-label">Tiêu đề</label>
                                    <input class="form-control" type="text" id="html5-time-input" name="title" />
                                    @if ($errors->has('title'))
                                        <span id="title-error" class="error text-danger"
                                            for="input-title">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="content" class="form-label">Nội dung</label>
                                    <textarea class="form-control" id="html5-time-input" rows="5" name="content"></textarea>
                                    @if ($errors->has('content'))
                                        <span id="content-error" class="error text-danger"
                                            for="input-content">{{ $errors->first('content') }}</span>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <div class="col-md">
                                    <small class="fw-semibold d-block">Người gửi</small>
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input send_type_all" type="radio" name="send_type"
                                            value="1" checked />
                                        <label class="form-check-label" for="inlineRadio2">Tất cả</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input send_type_user" type="radio" name="send_type"
                                            id="inlineRadio2" value="2" />
                                        <label class="form-check-label" for="inlineRadio2">Người dùng chỉ định</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="mb-3 row" id="choose_user">
                                <label for="choose_user" class="form-label">Chọn người dùng</label>
                                <div class="col-md-12">
                                    <select id="weekly" class="selectpicker w-100" data-style="btn-default"
                                        data-live-search="true" data-show-subtext="true" name="user_id">
                                        <option selected disabled>Chọn người dùng</option>
                                        @foreach ($users as $user)
                                            @if ($user->id == Auth::user()->id)
                                                <option data-tokens="Tất cả" value="{{ $user->id }}" data-subtext="">Tất
                                                    cả</option>
                                            @else
                                                <option data-tokens="{{ $user->email . '-' . $user->name }}"
                                                    value="{{ $user->id }}" data-subtext="{{ $user->name }}">
                                                    {{ $user->email }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('user_id'))
                                    <span id="user_id-error" class="error text-danger"
                                        for="input-user_id">{{ $errors->first('user_id') }}</span>
                                @endif
                            </div>
                            <hr>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Gửi</button>
                                <button type="reset"
                                    onclick="window.location='{{ URL::route('admin.notification.index') }}'"
                                    class="btn btn-outline-secondary">Trở về</button>
                            </div>
                    </form>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
