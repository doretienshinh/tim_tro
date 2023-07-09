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
                                    <input class="form-control" type="text" id="html5-time-input" name="title"
                                        value="{{ $notification->title }}" disabled />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="content" class="form-label">Nội dung</label>
                                    <textarea class="form-control" id="html5-time-input" rows="5" name="content" disabled>{{ $notification->content }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row" id="choose_user">
                                <label for="choose_user" class="form-label">Tới người dùng</label>
                                <div class="col-md-12">
                                    <select id="weekly" class="selectpicker w-100" data-style="btn-default"
                                        data-live-search="true" data-show-subtext="true" name="user_id" disabled>
                                        @if ($notification->user->id == Auth::user()->id)
                                            <option data-tokens="Tất cả" value="{{ $notification->user->id }}" data-subtext="">Tất
                                                cả</option>
                                        @else
                                            <option
                                                data-tokens="{{ $notification->user->email . '-' . $notification->user->name }}"
                                                value="{{ $notification->user->id }}"
                                                data-subtext="{{ $notification->user->name }}">
                                                {{ $notification->user->email }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <label for="choose_user" class="form-label">Thời gian</label>
                                    <input class="form-control" type="datetime" value="{{ $notification->created_at }}" disabled/>
                                </div>
                            </div>
                            <hr>
                            <div class="mt-2">
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
