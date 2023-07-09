@extends('host.layouts.host_layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">

            @foreach ($hostels as $hostel)
                <div class="card mb-3 col-md hostel-item" data-ward_id={{ $hostel->ward_id }}>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="card-img card-img-left h-100" style="object-fit: cover;"
                                src="{{ asset('storage/' . $hostel->thumbnail) }}" alt="Card image" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">{{ $hostel->title }}</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                        data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true"
                                        title="<i class='bx bx-trending-up bx-xs' ></i> <span>{{ $hostel->tag->description }}</span>">
                                        {{ $hostel->tag->name }}
                                    </button>
                                </div>
                                <hr>
                                <p class="card-text">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button type="button" class="accordion-button collapsed p-0"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#accordion_desciption_{{ $hostel->id }}" aria-expanded="false"
                                            aria-controls="accordion_desciption_{{ $hostel->id }}">
                                            Mô tả
                                        </button>
                                    </h2>
                                    <div id="accordion_desciption_{{ $hostel->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body pt-4">
                                            {{ $hostel->description }}
                                        </div>
                                    </div>
                                </div>
                                </p>
                                <hr>
                                <h6 class="card-title">Thông tin địa chỉ</h6>
                                <p class="card-text">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input class="form-control" id="address" type="text" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlReadOnlyInput1" class="form-label">Địa chỉ chi
                                        tiết</label>
                                    <input class="form-control" type="text" readonly
                                        value="{{ $hostel->address_detail }}" />
                                </div>
                                </p>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button type="button" class="accordion-button collapsed p-0"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#accordion_attribute_{{ $hostel->id }}" aria-expanded="false"
                                            aria-controls="accordion_attribute_{{ $hostel->id }}">
                                            Thông tin nhà trọ
                                        </button>
                                    </h2>
                                    <div id="accordion_attribute_{{ $hostel->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body pt-4">
                                            {{ $hostel->description }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex flex-row-reverse">
                                <a href="{{ route('host.hostel.detail', $hostel) }}" class="btn btn-outline-primary">Xem
                                    chi
                                    tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function(e) {
        $('.hostel-item').each(function() {
            var ward_id = $(this).data('ward_id');
            var address_show = $(this).find('#address');
            var district_id;
            var province_id;
            var address;
            $.ajax({
                url: 'https://provinces.open-api.vn/api/w/' + ward_id,
                method: 'get',
                success: function(response) {

                    district_id = response.district_code;
                    address = response.name;

                    $.ajax({
                        url: 'https://provinces.open-api.vn/api/d/' + district_id,
                        method: 'get',
                        success: function(response) {
                            province_id = response.province_code;
                            address = address + ' - ' + response.name;

                            $.ajax({
                                url: 'https://provinces.open-api.vn/api/p/' +
                                    province_id,
                                method: 'get',
                                success: function(response) {

                                    address = address + ' - ' +
                                        response.name;
                                    address_show.val(address);
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
