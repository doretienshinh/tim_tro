@extends('admin.layouts.admin_layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Time Edit</span></h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form id="formAccountSettings" method="POST" action="{{ route('admin.time.update', $time) }}"
                        enctype='multipart/form-data'>
                        @csrf
                        <h5 class="card-header">Time Details</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="start_at" class="form-label">Thời gian bắt đầu</label>
                                    <input class="form-control" type="time" id="html5-time-input" name="start_at" value="{{ $time->start_at }}"/>
                                    @if ($errors->has('start_at'))
                                        <span id="start_at-error" class="error text-danger"
                                            for="input-start_at">{{ $errors->first('start_at') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="end_at" class="form-label">Thời gian kết thúc</label>
                                    <input class="form-control" type="time" id="html5-time-input" name="end_at" value="{{ $time->end_at }}"/>
                                    @if ($errors->has('end_at'))
                                        <span id="end_at-error" class="error text-danger"
                                            for="input-end_at">{{ $errors->first('end_at') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <small class="fw-semibold d-block">Chọn kiểu lịch</small>
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input choose_day" type="radio" name="time_type"
                                            value="1" {{ $time->day == '' ? '' : 'checked' }} />
                                        <label class="form-check-label" for="inlineRadio2">1 Lần</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input choose_weekly" type="radio" name="time_type"
                                            id="inlineRadio2" value="2" {{ $time->weekly_at == '' ? '' : 'checked' }} />
                                        <label class="form-check-label" for="inlineRadio2">Hằng tuần</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row {{ $time->day == '' ? 'd-none' : '' }}" id="day_choose">
                                <label for="day" class="form-label">Chọn ngày</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="date" id="day"
                                        name="day" value="{{ $time->day }}"/>
                                </div>
                                @if ($errors->has('day'))
                                    <span id="day-error" class="error text-danger"
                                        for="input-day">{{ $errors->first('day') }}</span>
                                @endif
                            </div>
                            <div class="mb-3 row {{ $time->weekly_at == '' ? 'd-none' : '' }}" id="weekly_choose">
                                <label for="weekly_choose" class="form-label">Chọn thứ</label>
                                <div class="col-md-12">
                                    <select id="weekly" class="selectpicker w-100" data-style="btn-default"
                                        data-live-search="true" data-show-subtext="true" name="weekly_at">
                                        <option selected disabled>Chọn ngày</option>
                                        <option data-tokens="Thứ hai" value="Thứ 2" data-subtext="Thứ 2" {{ $time->weekly_at == 'Thứ 2' ? 'selected' : '' }}>Thứ Hai</option>
                                        <option data-tokens="Thứ ba" value="Thứ 3" data-subtext="Thứ 3" {{ $time->weekly_at == 'Thứ 3' ? 'selected' : '' }}>Thứ Ba</option>
                                        <option data-tokens="Thứ tư" value="Thứ 4" data-subtext="Thứ 4" {{ $time->weekly_at == 'Thứ 4' ? 'selected' : '' }}>Thứ Tư</option>
                                        <option data-tokens="Thứ năm" value="Thứ 5" data-subtext="Thứ 5" {{ $time->weekly_at == 'Thứ 5' ? 'selected' : '' }}>Thứ Năm</option>
                                        <option data-tokens="Thứ sáu" value="Thứ 6" data-subtext="Thứ 6" {{ $time->weekly_at == 'Thứ 6' ? 'selected' : '' }}>Thứ Sáu</option>
                                        <option data-tokens="Thứ bảy" value="Thứ 7" data-subtext="Thứ 7" {{ $time->weekly_at == 'Thứ 7' ? 'selected' : '' }}>Thứ Bảy</option>
                                        <option data-tokens="Chủ nhật" value="Chủ nhật" data-subtext="CN" {{ $time->weekly_at == 'Chủ nhật' ? 'selected' : '' }}>Chủ nhật</option>
                                    </select>
                                </div>
                                @if ($errors->has('weekly_at'))
                                    <span id="weekly_at-error" class="error text-danger"
                                        for="input-weekly_at">{{ $errors->first('weekly_at') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Ghi chú</label>
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                                @if ($errors->has('note'))
                                    <span id="note-error" class="error text-danger"
                                        for="input-note">{{ $errors->first('note') }}</span>
                                @endif
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Tạo</button>
                                <button type="reset" onclick="window.location='{{ URL::route('admin.time.index') }}'"
                                    class="btn btn-outline-secondary">Trở về</button>
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

        $('.choose_day').click(function() {
            $('#day_choose').removeClass('d-none');
            $('#day_choose').removeAttr("disabled");
            $('#weekly_choose').addClass('d-none');
            $('#weekly').val('null');
            $('#weekly_choose').attr('disabled', 'disabled');
            console.log($('#weekly'))
        });

        $('.choose_weekly').click(function() {
            $('#day_choose').addClass('d-none');
            $('#day_choose').attr('disabled', 'disabled');
            $('#day').val('');
            $('#weekly_choose').removeClass('d-none');
            $('#weekly_choose').removeAttr("disabled");
        });
    });
</script>
