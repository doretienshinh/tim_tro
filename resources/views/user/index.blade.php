@extends('layouts.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Users Tables</h4>

    <div class="card">
        <div class="card-header d-flex align-items-center navbar">
            <h5>Table Basic</h5>
            <button type="button" onclick="window.location='{{ URL::route('admin.user.create'); }}'" class="btn btn-icon btn-primary">
                <span class="tf-icons bx bx-user-plus"></span>
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
                    @foreach ($users as $index => $user)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleNames()[0] }}</td>
                        <td>
                            @if ($user->hasVerifiedEmail())
                                <span class="badge bg-label-primary me-1">Verified</span>
                            @else
                                <span class="badge bg-label-warning me-1">Not verified</span>
                            @endif
                        </td>
                        {{-- <td><span class="badge bg-label-primary me-1">Active</span></td> --}}
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.user.detail', $user->id) }}"><i class="bx bx-search-alt me-1"></i>
                                        Detail</a>
                                    <a class="dropdown-item" href="{{ route('admin.user.edit', $user->id) }}"><i class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
