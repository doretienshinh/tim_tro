@extends('user.layouts.user_layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">

            <div class="row">
                @foreach ($hostels as $hostel)
                    <div class="col-md-6 col-lg-4 order-1 mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{ asset('storage/' . $hostel->thumbnail) }}" alt="Card image cap" />
                            <div class="card-body">
                                <h5 class="card-title">{{ $hostel->title }}</h5>
                                <p class="card-text">
                                    {{ $hostel->description }}
                                </p>
                                <a href="{{ route('user.hostel.detail', $hostel) }}" class="btn btn-outline-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
