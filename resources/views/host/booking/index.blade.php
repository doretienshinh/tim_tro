@extends('host.layouts.host_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh sách /</span> lịch hẹn</h4>
        @foreach ($hostels as $hostel)
        <div class="card mb-3">
            <div class="card-header d-flex align-items-center navbar">
                <h5>{{ $hostel->title }}</h5>
            </div>
            @if ($hostel->bookings->isNotempty())
                <div class="table-responsive text-nowrap" style="overflow-x: inherit;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Từ</th>
                                <th>Tới</th>
                                <th>Ngày</th>
                                <th>Hằng tuần</th>
                                <th>Người dùng</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($hostel->bookings as $index => $booking)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $booking->time->start_at }}</strong></td>
                                <td>{{ $booking->time->end_at }}</td>
                                <td>{{ $booking->time->day }}</td>
                                <td>{{ $booking->time->weekly_at }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('host.booking.edit', $booking) }}"><i class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
                                            {{-- <a class="dropdown-item" href="{{ route('host.time.delete', $time) }}"><i class="bx bx-trash me-1"></i>
                                                Delete</a> --}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else

            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
