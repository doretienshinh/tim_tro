@extends('host.layouts.host_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh sách /</span> yêu cầu thuê trọ</h4>
    @foreach ($hostels as $hostel)
    <div class="card mb-3">
        <div class="card-header d-flex align-items-center navbar">
            <h5>{{ $hostel->title }}</h5>
        </div>
        <div class="table-responsive text-nowrap" style="overflow-x: inherit;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Trọ</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($hostel->hostel_users as $index => $requestHostel)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $requestHostel->hostel->title }}</strong></td>
                        <td>{{ $requestHostel->user->name }}</td>
                        <td>{{ $requestHostel->user->email }}</td>

                        <td>{{ $requestHostel->created_at }}</td>
                        <td>{{ $requestHostel->status == null ? 'Yêu cầu' :  $requestHostel->status}}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('host.request.edit', $requestHostel->id) }}"><i class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    {{-- <a class="dropdown-item" href="{{ route('host.time.delete', $time) }}"><i class="bx bx-trash me-1"></i>
                                        Delete</a> --}}
                                </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>
@endsection
