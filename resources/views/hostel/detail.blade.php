@extends('layouts.admin_layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Hostel /</span> {{ $hostel->title }}</h4>
        <div class="card p-4 min-vh-100">
            <div class="card-body row">
                <div class="col-md-6">
                    <div id="carouselExample" class="carousel slide min-vh-50" data-bs-ride="carousel">
                        <ol class="carousel-indicators" style="top:0 !important;bottom:auto;">
                            @php
                                $images = explode(';', $hostel->image);
                                $images = array_filter($images, function ($value) {
                                    return !empty($value);
                                });
                            @endphp
                            @foreach ($images as $index => $image)
                                <li data-bs-target="#carouselExample" data-bs-slide-to="{{ $index - 1 }}"
                                    class="{{ $index == 1 ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner min-vh-50">
                            @foreach ($images as $index => $image)
                                <div class="carousel-item {{ $index == 1 ? 'active' : '' }}">
                                    <img class="d-block w-100 h-100 img-fluid object-fit-contain"
                                        src="{{ asset('storage/' . $image) }}" alt="{{ asset('storage/' . $image) }}" />
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4">
                        {{ $hostel->title }}
                        <button type="button" class="ms-2 btn btn-primary" data-bs-toggle="tooltip" data-bs-offset="0,4"
                            data-bs-placement="right" data-bs-html="true"
                            title="<i class='bx bx-trending-up bx-xs' ></i> <span>{{ $hostel->tag->description }}</span>">
                            {{ $hostel->tag->name }}
                        </button>
                    </h4>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>{{ $hostel->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Địa chỉ chi tiết</label>
                        <input class="form-control" type="text" readonly value="{{ $hostel->address_detail }}" />
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                          <img
                            src="{{ $hostel->user->avatar ? asset('storage/' . $hostel->user->avatar) : asset('assets/img/avatars/default.png') }}"
                            alt="user-avatar"
                            class="d-block rounded"
                            height="100"
                            width="100"
                          />
                          <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                              <span class="d-none d-sm-block">{{ $hostel->user->name }}</span>
                              <i class="bx bx-upload d-block d-sm-none"></i>
                            </label>
                            {{-- <div type="button" class="btn btn-outline-secondary mb-4">
                              <i class="bx bx-reset d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Reset</span>
                            </div> --}}
  
                            {{-- <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> --}}
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- <script>
    document.addEventListener('DOMContentLoaded', function(e) {
        $('#burger').click(function() {
            $('#nava').slideToggle();
            $('#searchform').slideUp();
            $('#mega-menu').slideUp();
        });

        $('#search-click').click(function() {

            $('#mega-menu').slideUp();
            $('#nava').slideUp();
            $('#searchform').slideToggle();
        });

        $('#search-click-list').click(function() {
            $('#mega-menu').slideUp();
            $('#searchform').slideToggle();
        });

        $('#mega-menu-btn').click(function() {
            $('#searchform').slideUp();
            $('#mega-menu').slideToggle();
        });

        $('#myTab a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        $("#main-image").elevateZoom({
            tint: true,

            tintColour: '#F90',

            tintOpacity: 0.5
        });

        $('.side-picture').click(function() {
            var showing = $(this).find("img").attr("src");
            $('.side-picture').removeClass('active');
            $(this).addClass('active');
            $('#main-image').fadeOut(function() {
                $(this).attr('src', showing);
                $(this).fadeIn();
                $(this).elevateZoom();
            });
            //    $('#main-image').attr('src', showing);

        });
    });
</script> --}}
