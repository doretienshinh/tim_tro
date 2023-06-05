@extends('layouts.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Hostels Tables</h4>

    <div class="card">
        <div class="card-header d-flex align-items-center navbar">
            <h5>Table Basic</h5>
            <button type="button" onclick="window.location='{{ URL::route('admin.hostel.create'); }}'" class="btn btn-icon btn-primary">
                <i class='bx bx-layer-plus'></i>
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
                    @foreach ($hostels as $index => $hostel)
                    <div>1</div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
