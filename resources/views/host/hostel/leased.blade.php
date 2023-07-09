@extends('host.layouts.host_layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Hostels Tables</h4>

        <div class="card">
            <div class="card-header d-flex align-items-center navbar">
                <h5>Hostels Tables</h5>
            </div>
            <div class="table-responsive text-nowrap" style="overflow-x: inherit;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Address Detail</th>
                            <th>Người thuê</th>
                            {{-- <th>Role</th>
                            <th>Verify</th> --}}
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($hostels as $index => $hostel)
                            @if ($hostel->hostel_users->where('status', '=', 'accept')->isNotEmpty())
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $hostel->title }}</strong>
                                    </td>
                                    <td>{{ $hostel->address_detail }}</td>
                                    <td>{{ $hostel->hostel_users->where('status', '=', 'accept')->first()->user->name }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('host.hostel.detail', $hostel) }}"><i
                                                        class="bx bx-search-alt me-1"></i>
                                                    Detail</a>
                                                <a class="dropdown-item" href="{{ route('host.hostel.edit', $hostel) }}"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
