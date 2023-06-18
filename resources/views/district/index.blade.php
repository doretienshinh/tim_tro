@extends('layouts.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">District tables</span></h4>

    <div class="card">
        <div class="card-header d-flex align-items-center navbar">
            <h5>Table Basic</h5>
            <button type="button" onclick="window.location='{{ URL::route('admin.district.create'); }}'" class="btn btn-icon btn-primary">
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
                    @foreach ($districts as $index => $district)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $district->id }}</strong></td>
                        <td>{{ $district->name }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.district.detail', $district->id) }}"><i class="bx bx-search-alt me-1"></i>
                                        Detail</a>
                                    <a class="dropdown-item" href="{{ route('admin.district.edit', $district->id) }}"><i class="bx bx-edit-alt me-1"></i>
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
    {!! $districts->links() !!}
</div>
@endsection
