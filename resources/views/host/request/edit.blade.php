@extends('host.layouts.host_layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Request Edit</span></h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form id="formAccountSettings" method="POST"  action="{{ route('host.request.update', $Hostel_user) }}"
                        enctype='multipart/form-data'>
                        @csrf
                        <h5 class="card-header">Chi tiết yêu cầu</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Tên người yêu cầu thuê</label>
                                    <input class="form-control" type="text" id="html5-time-input" value="{{ $Hostel_user->user->name }}" readonly/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email người yêu cầu thuê</label>
                                    <input class="form-control" type="text" id="html5-time-input" value="{{ $Hostel_user->user->email }}" readonly/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Đổi trạng thái</label>
                                <div class="col-md-12">
                                    <select id="status" class="selectpicker w-100" data-style="btn-default" name="status">
                                        <option value="accept">Chấp nhận</option>
                                        <option value="eject">Từ chối</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Cập nhật</button>
                                <button type="reset" onclick="window.location='{{ URL::route('host.request.index') }}'"
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
