@extends('user.layouts.user_layout')

@section('content')
    <div class="card border-bottom p-3">
        <h5 class="card-title">Bộ Lọc Tìm Kiếm</h5>
        <form id="filter_hostel" method="POST" action=" {{ route('filter.index') }}" enctype='multipart/form-data'>
            @csrf
            <h6 class="mb-3 card-title">Địa chỉ</h6>
            <div class="row mb-3">
                <div class="mb-3 col-4">
                    <select id="city_select" class="w-100" data-style="btn-default" data-live-search="true"
                        data-show-subtext="true">
                    </select>
                </div>
                <div class="mb-3 district_select col-4 d-none">
                    <select id="district_select" class="w-100" data-style="btn-default"
                        data-live-search="true" data-show-subtext="true">
                    </select>
                </div>
                <div class="mb-3 ward_select col-4 d-none">
                    <select id="ward_select" class="w-100" data-style="btn-default" data-live-search="true"
                        data-show-subtext="true" name="ward_id">
                    </select>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <label for="min_acreage" class="form-label">Giá trọ</label>
                <div class="col-1 d-flex justify-content-center align-items-center">
                    TỪ
                </div>
                <div class="col-5">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="10" aria-describedby="min_price"
                            id="min_price" name="min_price" value="{{ intval($request_data['min_price']) }}"/>
                        <span class="input-group-text" id="min_price_note">Đồng</span>
                    </div>
                </div>
                <div class="col-1 d-flex justify-content-center align-items-center">
                    ĐẾN
                </div>
                <div class="col-5">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="10" aria-describedby="max_price"
                            id="max_price" name="max_price" value="{{ intval($request_data['max_price']) }}"/>
                        <span class="input-group-text" id="max_price_note">Đồng</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <label for="min_acreage" class="form-label">Diện tích</label>
                <div class="col-1 d-flex justify-content-center align-items-center">
                    TỪ
                </div>
                <div class="col-5">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="10" aria-describedby="min_acreage"
                            id="min_acreage" name="min_acreage" value="{{ intval($request_data['min_acreage']) }}"/>
                        <span class="input-group-text" id="min_acreage_note">Mét vuông</span>
                    </div>
                </div>
                <div class="col-1 d-flex justify-content-center align-items-center">
                    ĐẾN
                </div>
                <div class="col-5">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="10" aria-describedby="max_acreage"
                            id="max_acreage" name="max_acreage" value="{{ intval($request_data['max_acreage']) }}"/>
                        <span class="input-group-text" id="max_acreage_note">Mét vuông</span>
                    </div>
                </div>
            </div>
            <hr>
            <h6 class="mb-3 card-title">Chọn thêm thông tin</h6>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="amount_of_people" class="form-label">Số người ở</label>
                    <input class="form-control" type="number" id="amount_of_people" name="amount_of_people"
                        placeholder="Nhập số người ở" value="{{ intval($request_data['amount_of_people']) }}"/>
                </div>
                <div class="col-6">
                    <label for="tag" class="form-label">Chọn tag</label>
                    <select id="tag" class="selectpicker w-100" data-style="btn-default" data-live-search="true"
                        data-show-subtext="true" name="tag_id">
                        <option value=""> Chọn tag </option>
                        @foreach ($tags as $index => $tag)
                            <option data-tokens="{{ $tag->name }}" value="{{ $tag->id }}"
                                data-subtext="{{ $tag->description }}" {{$request_data['tag_id'] == $tag->id ? ' selected' : ''}}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="stay_with_host" name="stay_with_host" {{ isset($request_data['stay_with_host']) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="stay_with_host">Chung chủ</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="deposit" name="deposit" {{ isset($request_data['deposit']) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="deposit">Phải cọc</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="air_conditional" name="air_conditional" {{ isset($request_data['air_conditional']) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="air_conditional">Điều hòa</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="heater" name="heater" {{ isset($request_data['heater']) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="heater">Bình nóng lạnh </label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="washing_machine" name="washing_machine" {{ isset($request_data['washing_machine']) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="washing_machine">Máy giặt</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="closed_room" name="closed_room" {{ isset($request_data['closed_room']) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="closed_room">Khép kín</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="parking_area" name="parking_area" {{ isset($request_data['parking_area']) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="parking_area">Chỗ gửi xe</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="elevator" name="elevator" {{ isset($request_data['elevator']) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="elevator">Thang máy</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="kitchen" name="kitchen" {{ isset($request_data['kitchen']) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="kitchen">Nhà bếp</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="balcony" name="balcony" {{ isset($request_data['balcony']) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="balcony">Ban công</label>
                    </div>
                </div>

            </div>
            <div class="col-md-3 button">
                <button type="Submit" class="btn btn-primary" onclick="applyFilters()">
                    Áp Dụng
                </button>
            </div>
    </div>
    </form>
    </div>
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
                                            data-bs-target="#accordion_desciption_{{ $hostel->id }}"
                                            aria-expanded="false"
                                            aria-controls="accordion_desciption_{{ $hostel->id }}">
                                            Mô tả
                                        </button>
                                    </h2>
                                    <div id="accordion_desciption_{{ $hostel->id }}"
                                        class="accordion-collapse collapse" aria-labelledby="headingThree"
                                        data-bs-parent="#accordionExample">
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
                                {{-- <div class="accordion-item">
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
                                </div> --}}
                            </div>
                            <div class="card-footer d-flex flex-row-reverse">
                                <a href="{{ route('user.hostel.detail', $hostel) }}" class="btn btn-outline-primary">Xem
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

    // function applyFilters_template() {
    //     var priceRange = document.getElementById('priceRange').value;
    //     var tag = document.getElementById('tag').value;
    //     var keyword = {
    //         priceRange: priceRange,
    //         tag: tag
    //     };
    //     // Chuyển đổi object keyword thành chuỗi JSON
    //     var keywordJSON = JSON.stringify(keyword);
    //     // Chuyển hướng đến trang tìm kiếm với keyword
    //     window.location.href = "{{ route('filter.index') }}" + "?keyword=" + encodeURIComponent(keywordJSON);
    // }

    document.addEventListener('DOMContentLoaded', function(e) {
        $.ajax({
            url: 'https://provinces.open-api.vn/api/p/',
            method: 'get',
            success: function(response) {
                var provinces = response;
                $('#city_select').append(
                    '<option selected="selected" disabled>Chọn tỉnh / thành phố</option>');
                $.each(provinces, function(index, item) {
                    $('#city_select').append('<option data-tokens=" ' + item
                        .name + ' " value="' + item.code + '">' + item.name +
                        '</option>');
                });
                $("#city_select").selectpicker();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        $('#city_select').change(function() {
            var city_id = $('#city_select').val()
            if ($(this).val() != null) {
                $('.district_select').removeClass('d-none');
                $('#ward_select').val(null);
                $('.ward_select').addClass('d-none');
            } else {
                $('.district_select').addClass('d-none');
            }

            $.ajax({
                url: 'https://provinces.open-api.vn/api/p/' + city_id + '?depth=2',
                method: 'get',
                success: function(response) {
                    var districts = response.districts;
                    $("#district_select").selectpicker('destroy');
                    $('#district_select').empty().append(
                        '<option selected="selected" disabled>Chọn thành phố / quận / huyện</option>');
                    $.each(districts, function(index, item) {
                        $('#district_select').append('<option data-tokens=" ' + item
                            .name + ' " value="' + item.code + '">' + item
                            .name +
                            '</option>');
                    })
                    $("#district_select").selectpicker();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
        $('#district_select').change(function() {
            $('#ward_select').empty();
            $("#ward_select").selectpicker('render');
            var district_id = $('#district_select').val();
            if ($(this).val() != null) {
                $('.ward_select').removeClass('d-none');
            } else {
                $('.ward_select').addClass('d-none');
            }

            $.ajax({
                url: 'https://provinces.open-api.vn/api/d/' + district_id + '?depth=2',
                method: 'get',
                success: function(response) {
                    var wards = response.wards;
                    $("#ward_select").selectpicker('destroy');
                    $('#ward_select').append(
                        '<option selected="selected" disabled>Chọn phường / xã</option>');
                    $.each(wards, function(index, item) {
                        $('#ward_select').append('<option data-tokens=" ' + item
                            .name + ' " value="' + item.code + '">' + item
                            .name +
                            '</option>');
                    });
                    $("#ward_select").selectpicker();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
