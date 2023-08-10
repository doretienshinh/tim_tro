@extends('host.layouts.host_layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Booking Edit</span></h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form id="formAccountSettings" method="POST" action="{{ route('host.booking.update', $booking) }}"
                        enctype='multipart/form-data'>
                        @csrf
                        <h5 class="card-header">Booking Details</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="start_at" class="form-label">Thời gian bắt đầu</label>
                                    <input class="form-control" type="time" id="html5-time-input" name="start_at" value="{{ $booking->time->start_at }}" readonly/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="end_at" class="form-label">Thời gian kết thúc</label>
                                    <input class="form-control" type="time" id="html5-time-input" name="end_at" value="{{ $booking->time->end_at }}" readonly/>
                                </div>
                            </div>
                            <div class="mb-3 row {{ $booking->time->day == '' ? 'd-none' : '' }}" id="day_choose">
                                <label for="day" class="form-label">Ngày</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="date" id="day"
                                        name="day" value="{{ $booking->time->day }}" readonly/>
                                </div>
                            </div>
                            <div class="mb-3 row {{ $booking->time->weekly_at == '' ? 'd-none' : '' }}" id="weekly_choose">
                                <label for="weekly_choose" class="form-label">Trong tuần</label>
                                <div class="col-md-12">
                                    <select id="weekly" class="selectpicker w-100" data-style="btn-default"
                                        data-live-search="true" data-show-subtext="true" name="weekly_at" disabled>
                                        <option data-tokens="Thứ hai" value="Thứ 2" data-subtext="Thứ 2" {{ $booking->time->weekly_at == 'Thứ 2' ? 'selected' : '' }}>Thứ Hai</option>
                                        <option data-tokens="Thứ ba" value="Thứ 3" data-subtext="Thứ 3" {{ $booking->time->weekly_at == 'Thứ 3' ? 'selected' : '' }}>Thứ Ba</option>
                                        <option data-tokens="Thứ tư" value="Thứ 4" data-subtext="Thứ 4" {{ $booking->time->weekly_at == 'Thứ 4' ? 'selected' : '' }}>Thứ Tư</option>
                                        <option data-tokens="Thứ năm" value="Thứ 5" data-subtext="Thứ 5" {{ $booking->time->weekly_at == 'Thứ 5' ? 'selected' : '' }}>Thứ Năm</option>
                                        <option data-tokens="Thứ sáu" value="Thứ 6" data-subtext="Thứ 6" {{ $booking->time->weekly_at == 'Thứ 6' ? 'selected' : '' }}>Thứ Sáu</option>
                                        <option data-tokens="Thứ bảy" value="Thứ 7" data-subtext="Thứ 7" {{ $booking->time->weekly_at == 'Thứ 7' ? 'selected' : '' }}>Thứ Bảy</option>
                                        <option data-tokens="Chủ nhật" value="Chủ nhật" data-subtext="CN" {{ $booking->time->weekly_at == 'Chủ nhật' ? 'selected' : '' }}>Chủ nhật</option>
                                    </select>
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
                                <button type="submit" class="btn btn-primary me-2">Tạo</button>
                                <button type="reset" onclick="window.location='{{ URL::route('host.booking.index') }}'"
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
<script>
    document.addEventListener('DOMContentLoaded', function(e) {
        $(".selectpicker").selectpicker();
    });
</script>
