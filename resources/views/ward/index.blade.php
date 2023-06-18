@extends('layouts.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Ward tables</span></h4>

    <div class="card">
        <div class="card-header d-flex align-items-center navbar">
            <h5>Table Basic</h5>
            <button type="button" onclick="window.location='{{ URL::route('admin.ward.create'); }}'" class="btn btn-icon btn-primary">
                <span class="tf-icons bx bx-user-plus"></span>
            </button>
        </div>
        <div class="table-responsive text-nowrap" style="overflow-x: inherit;">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($wards as $index => $ward)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $ward->id }}</strong></td>
                        <td>{{ $ward->name }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.ward.detail', $ward->id) }}"><i class="bx bx-search-alt me-1"></i>
                                        Detail</a>
                                    <a class="dropdown-item" href="{{ route('admin.ward.edit', $ward->id) }}"><i class="bx bx-edit-alt me-1"></i>
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
