@extends('host.layouts.host_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh sách /</span> lịch hẹn</h4>
        @foreach ($bookings as $booking)
        <div class="card mb-3">
            <div class="card-header d-flex align-items-center navbar">
                <h5>{{ $booking->hostel->title }}</h5>
            </div>
            <div class="table-responsive text-nowrap" style="overflow-x: inherit;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Từ</th>
                            <th>Tới</th>
                            <th>Thời gian</th>
                            <th>Thứ</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        {{-- @foreach ($hostel->bookings as $index => $booking) --}}
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $booking->time->start_at }}</strong></td>
                            <td>{{ $booking->time->end_at }}</td>
                            @if ($booking->time->day)
                                    <td>{!! \App\Helpers\Helper::renderTimeDay($booking->time) !!}</td>
                            @endif
                            @if ($booking->time->weekly_at)
                                <td>{!! \App\Helpers\Helper::renderTimeWeekly($booking->time) !!}</td>
                            @endif
                            <td>{{ $booking->user->name }}</td>
                            <td>
                                @if ($booking->status == 'confirm')
                                    Đang chờ
                                @elseif ($booking->status == 'accept')
                                    Đồng ý
                                @elseif ($booking->status == 'reject')
                                    Không đồng ý
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('user.hostel.detail', $booking->hostel) }}"><i class="bx bx-edit-alt me-1"></i>
                                            Chi tiết trọ</a>
                                        <a class="dropdown-item" href="{{ route('user.booking.destroy', $booking) }}"><i class="bx bx- me-1"></i>
                                            Xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
