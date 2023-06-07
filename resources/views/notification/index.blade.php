@extends('layouts.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Notification Tables</h4>

    <div class="card">
        <div class="card-header d-flex align-items-center navbar">
            <h5>Table Basic</h5>
            <button type="button" onclick="window.location='{{ URL::route('admin.notification.create'); }}'" class="btn btn-icon btn-primary">
                <span class="tf-icons bx bx-bell-plus"></span>
            </button>
        </div>
        <div class="table-responsive text-nowrap" style="overflow-x: inherit;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Verify</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($notifications as $index => $notification)
                    <tr>
                        {{-- <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $notification->name }}</strong></td>
                        <td>{{ $notification->email }}</td>
                        <td>{{ $notification->getRoleNames()[0] }}</td>
                        <td>
                            @if ($notification->hasVerifiedEmail())
                                <span class="badge bg-label-primary me-1">Verified</span>
                            @else
                                <span class="badge bg-label-warning me-1">Not verified</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.notification.detail', $user->id) }}"><i class="bx bx-search-alt me-1"></i>
                                        Detail</a>
                                    <a class="dropdown-item" href="{{ route('admin.user.edit', $user->id) }}"><i class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td> --}}
                        a
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
