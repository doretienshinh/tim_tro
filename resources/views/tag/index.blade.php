@extends('layouts.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Tags Tables</h4>

    <div class="card">
        <div class="card-header d-flex align-items-center navbar">
            <h5>Tags Tables</h5>
            <button type="button" onclick="window.location='{{ URL::route('admin.tag.create'); }}'" class="btn btn-icon btn-primary">
                <i class='bx bx-plus'></i>
            </button>
        </div>
        <div class="table-responsive text-nowrap" style="overflow-x: inherit;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($tags as $index => $tag)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $tag->name }}</strong></td>
                        <td>{{ $tag->description }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.tag.edit', $tag) }}"><i class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <a class="dropdown-item" href="{{ route('admin.tag.delete', $tag) }}"><i class="bx bx-trash me-1"></i>
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
