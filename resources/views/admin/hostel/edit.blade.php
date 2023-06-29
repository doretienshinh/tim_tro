@extends('admin.layouts.admin_layout')
<style>
    .preview-image {
        width: 300px;
        height: 300px;
        object-fit: cover;
    }

    .preview-container {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        font-size: 30px;
        text-align: center;
    }

    #preview {
        display: grid;
        grid-template-columns: auto auto auto;
        padding: 10px;
    }
</style>
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hostel Edit</span></h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form id="formAccountSettings" method="POST" action=" {{ route('admin.hostel.update', $hostel) }}"
                        enctype='multipart/form-data'>
                        @csrf
                        <h5 class="card-header">Hostel Details</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input class="form-control" type="text" id="title" name="title"
                                        placeholder="Input title" autofocus value="{{ $hostel->title }}" />
                                    @if ($errors->has('title'))
                                        <span id="title-error" class="error text-danger"
                                            for="input-title">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $hostel->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span id="description-error" class="error text-danger"
                                            for="input-description">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail image</label>
                                    <input class="form-control" type="file" id="thumbnail-upload" name="thumbnail" />
                                    @if ($errors->has('thumbnail'))
                                        <span id="thumbnail-error" class="error text-danger"
                                            for="input-thumbnail">{{ $errors->first('thumbnail') }}</span>
                                    @endif
                                    <div class="" id="thumbnail_show">
                                        <div class="w-100 d-flex justify-content-center mt-3">
                                            <img src="{{ asset('storage/' . $hostel->thumbnail) }}" width="250px">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="tag" class="form-label">Choose tag</label>
                                    <select id="tag" class="selectpicker w-100" data-style="btn-default"
                                        data-live-search="true" data-show-subtext="true" name="tag_id">
                                        {{-- <option selected="selected" disabled>Choose tag</option> --}}
                                        @foreach ($tags as $index => $tag)
                                            <option data-tokens="{{ $tag->name }}" value="{{ $tag->id }}"
                                                data-subtext="{{ $tag->description }}"
                                                {{ $hostel->tag->id == $tag->id ? 'selected' : '' }}>{{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('tag_id'))
                                        <span id="email-error" class="error text-danger"
                                            for="tag_id">{{ $errors->first('tag_id') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="preview_location" class="form-label">Ward</label>
                                    <input class="form-control" id="preview_location" type="text" readonly/>
                                </div>
                                <div class="mb-3 d-none">
                                    <label for="city_select" class="form-label">Choose city</label>
                                    <select id="city_select" class="w-100" data-style="btn-default" data-live-search="true"
                                        data-show-subtext="true" name="city_select">
                                    </select>
                                    @if ($errors->has('ward_id'))
                                        <span id="ward_id-error" class="error text-danger"
                                            for="input-ward_id">{{ $errors->first('ward_id') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 district_select d-none">
                                    <label for="district_select" class="form-label">Choose district</label>
                                    <select id="district_select" class="w-100" data-style="btn-default"
                                        data-live-search="true" data-show-subtext="true" name="district_select">
                                    </select>
                                </div>
                                <div class="mb-3 ward_select d-none">
                                    <label for="ward" class="form-label">Choose ward</label>
                                    <select id="ward_select" class="w-100" data-style="btn-default" data-live-search="true"
                                        data-show-subtext="true" name="ward_id">
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Address Detail</label>
                                    <input class="form-control" type="text" id="address_detail" name="address_detail"
                                        placeholder="Input Address Detail" autofocus
                                        value="{{ $hostel->address_detail }}" />
                                    @if ($errors->has('address_detail'))
                                        <span id="title-error" class="error text-danger"
                                            for="input-address_detail">{{ $errors->first('address_detail') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="upload-images" class="form-label custom-file-label">Images</label>
                                    <input class="form-control" type="file" id="upload-images" name="image[]"
                                        accept="image/*, video/*" multiple />
                                    @if ($errors->has('image'))
                                        <span id="images-error" class="error text-danger"
                                            for="input-image">{{ $errors->first('image') }}</span>
                                    @endif
                                    <div id="preview">
                                        @php
                                            $images = explode(';', $hostel->image);
                                            $images = array_filter($images, function ($value) {
                                                return !empty($value);
                                            });
                                        @endphp
                                        @foreach ($images as $index => $image)
                                            <div class="preview-container">
                                                <img class="preview-image" src="{{ asset('storage/' . $image) }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="price" class="form-label">Giá trọ</label>
                                        <input class="form-control" type="text" id="price" name="price"
                                            placeholder="Nhập giá tiền thuê trọ" autofocus value="{{ $hostel->price }}"/>
                                        @if ($errors->has('price'))
                                            <span id="price-error" class="error text-danger"
                                                for="input-price">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="payment_note" class="form-label">Thông tin thanh toán</label>
                                        <input class="form-control" type="text" id="payment_note" name="payment_note"
                                            placeholder="Ví dụ: 3 tháng / lần, 1 tháng / lần" autofocus value="{{ $hostel->payment_note }}"/>
                                        @if ($errors->has('payment_note'))
                                            <span id="payment_note-error" class="error text-danger"
                                                for="input-payment_note">{{ $errors->first('payment_note') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="deposit_price" class="form-label">Giá tiền cọc</label>
                                        <input class="form-control" type="text" id="deposit_price"
                                            name="deposit_price" placeholder="Nhập giá tiền cọc" autofocus value="{{ $hostel->deposit_price }}"/>
                                        @if ($errors->has('deposit_price'))
                                            <span id="deposit_price-error" class="error text-danger"
                                                for="input-deposit_price">{{ $errors->first('deposit_price') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="electricity_price" class="form-label">Tiền điện</label>
                                        <input class="form-control" type="text" id="electricity_price"
                                            name="electricity_price" placeholder="Nhập giá tiền điện / 1 kWh" autofocus value="{{ $hostel->electricity_price }}"/>
                                        @if ($errors->has('electricity_price'))
                                            <span id="electricity_price-error" class="error text-danger"
                                                for="input-electricity_price">{{ $errors->first('electricity_price') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="water_price" class="form-label">Tiền nước</label>
                                        <input class="form-control" type="text" id="water_price" name="water_price"
                                            placeholder="Nhập tiền nước" autofocus value="{{ $hostel->water_price}}"/>
                                        @if ($errors->has('water_price'))
                                            <span id="water_price-error" class="error text-danger"
                                                for="input-water_price">{{ $errors->first('water_price') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="water_note" class="form-label">Cách tính</label>
                                        <input class="form-control" type="text" id="water_note" name="water_note"
                                            placeholder="Nhập cách tính ví dụ: người/tháng, giá nước/số khối" autofocus value="{{ $hostel->water_note }}"/>
                                        @if ($errors->has('title'))
                                            <span id="title-error" class="error text-danger"
                                                for="input-title">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="internet_price" class="form-label">Giá internet</label>
                                        <input class="form-control" type="text" id="internet_price"
                                            name="internet_price" placeholder="Nhập giá / tháng" autofocus value="{{ $hostel->internet_price }}"/>
                                        @if ($errors->has('internet_price'))
                                            <span id="internet_price-error" class="error text-danger"
                                                for="input-internet_price">{{ $errors->first('internet_price') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="internet_note" class="form-label">Chú thích internet</label>
                                        <input class="form-control" type="text" id="internet_note"
                                            name="internet_note" placeholder="Người/tháng, phòng/tháng" autofocus value="{{ $hostel->internet_note }}"/>
                                        @if ($errors->has('internet_note'))
                                            <span id="internet_note-error" class="error text-danger"
                                                for="input-internet_note">{{ $errors->first('internet_note') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="acreage" class="form-label">Diện tích</label>
                                        <input class="form-control" type="text" id="acreage" name="acreage"
                                            placeholder="Nhập diện tích tính theo mét vuông" autofocus value="{{ $hostel->acreage }}"/>
                                        @if ($errors->has('acreage'))
                                            <span id="acreage-error" class="error text-danger"
                                                for="input-acreage">{{ $errors->first('acreage') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="stay_with_host" class="form-label">Ở chung chủ</label>
                                        <select id="stay_with_host" class="selectpicker w-100" data-style="btn-default"
                                            name="stay_with_host">
                                            <option value=1 {{ $hostel->stay_with_host == 1 ? 'selected' : '' }}>Chung chủ</option>
                                            <option value=0 {{ $hostel->stay_with_host == 0 ? 'selected' : '' }}>Không chung chủ</option>
                                        </select>
                                        @if ($errors->has('stay_with_host'))
                                            <span id="stay_with_host-error" class="error text-danger"
                                                for="input-stay_with_host">{{ $errors->first('stay_with_host') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="air_conditional" class="form-label">Điều hòa</label>
                                        <select id="air_conditional" class="selectpicker w-100" data-style="btn-default"
                                            name="air_conditional">
                                            <option value=1 {{ $hostel->air_conditional == 1 ? 'selected' : '' }}>Có điều hòa</option>
                                            <option value=0 {{ $hostel->air_conditional == 0 ? 'selected' : '' }}>Không có điều hòa</option>
                                        </select>
                                        @if ($errors->has('air_conditional'))
                                            <span id="air_conditional-error" class="error text-danger"
                                                for="input-air_conditional">{{ $errors->first('air_conditional') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="heater" class="form-label">Nóng lạnh</label>
                                        <select id="heater" class="selectpicker w-100" data-style="btn-default"
                                            name="heater">
                                            <option value=1  {{ $hostel->heater == 1 ? 'selected' : '' }}>Có bình nóng lạnh</option>
                                            <option value=0  {{ $hostel->heater == 0 ? 'selected' : '' }}>Không có bình nóng lạnh</option>
                                        </select>
                                        @if ($errors->has('heater'))
                                            <span id="heater-error" class="error text-danger"
                                                for="input-heater">{{ $errors->first('heater') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="washing_machine" class="form-label">Máy giặt</label>
                                        <select id="washing_machine" class="selectpicker w-100" data-style="btn-default"
                                            name="washing_machine">
                                            <option value=1  {{ $hostel->washing_machine == 1 ? 'selected' : '' }}>Có máy giặt</option>
                                            <option value=0  {{ $hostel->washing_machine == 0 ? 'selected' : '' }}>Không có máy giặt</option>
                                        </select>
                                        @if ($errors->has('washing_machine'))
                                            <span id="washing_machine-error" class="error text-danger"
                                                for="input-washing_machine">{{ $errors->first('washing_machine') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="amount_of_people" class="form-label">Số người ở</label>
                                        <input class="form-control" type="number" id="amount_of_people"
                                            name="amount_of_people" placeholder="Nhập số người ở" autofocus value="{{ $hostel->amount_of_people }}"/>
                                        @if ($errors->has('amount_of_people'))
                                            <span id="amount_of_people-error" class="error text-danger"
                                                for="input-amount_of_people">{{ $errors->first('amount_of_people') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="closed_room" class="form-label">Khép kín</label>
                                        <select id="closed_room" class="selectpicker w-100" data-style="btn-default"
                                            name="closed_room">
                                            <option value=1  {{ $hostel->closed_room == 1 ? 'selected' : '' }}>Khép kín</option>
                                            <option value=0  {{ $hostel->closed_room == 0 ? 'selected' : '' }}>Không khép kín</option>
                                        </select>
                                        @if ($errors->has('closed_room'))
                                            <span id="closed_room-error" class="error text-danger"
                                                for="input-closed_room">{{ $errors->first('closed_room') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="parking_area" class="form-label">Chỗ đổ xe</label>
                                        <select id="parking_area" class="selectpicker w-100" data-style="btn-default"
                                            name="parking_area">
                                            <option value=1  {{ $hostel->parking_area == 1 ? 'selected' : '' }}>Có chỗ đổ xe</option>
                                            <option value=0  {{ $hostel->parking_area == 0 ? 'selected' : '' }}>Không có chỗ đổ xe</option>
                                        </select>
                                        @if ($errors->has('parking_area'))
                                            <span id="parking_area-error" class="error text-danger"
                                                for="input-parking_area">{{ $errors->first('parking_area') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="floor" class="form-label">Nằm ở tầng mấy</label>
                                        <input class="form-control" type="number" id="floor"
                                            name="floor" placeholder="Nằm ở tầng mấy" value="{{ $hostel->floor }}"/>
                                        @if ($errors->has('floor'))
                                            <span id="floor-error" class="error text-danger"
                                                for="input-floor">{{ $errors->first('floor') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="elevator" class="form-label">Có thang máy không</label>
                                        <select id="elevator" class="selectpicker w-100" data-style="btn-default"
                                            name="elevator">
                                            <option value=1  {{ $hostel->elevator == 1 ? 'selected' : '' }}>Có thang máy</option>
                                            <option value=0  {{ $hostel->elevator == 0 ? 'selected' : '' }}>Không có thang máy</option>
                                        </select>
                                        @if ($errors->has('elevator'))
                                            <span id="elevator-error" class="error text-danger"
                                                for="input-elevator">{{ $errors->first('elevator') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="kitchen" class="form-label">Chỗ nấu ăn</label>
                                        <select id="kitchen" class="selectpicker w-100" data-style="btn-default"
                                            name="kitchen">
                                            <option value=1  {{ $hostel->kitchen == 1 ? 'selected' : '' }}>Có chỗ nấu ăn</option>
                                            <option value=0  {{ $hostel->kitchen == 0 ? 'selected' : '' }}>Không có chỗ nấu ăn</option>
                                        </select>
                                        @if ($errors->has('kitchen'))
                                            <span id="kitchen-error" class="error text-danger"
                                                for="input-kitchen">{{ $errors->first('kitchen') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="balcony" class="form-label">Ban công</label>
                                        <select id="balcony" class="selectpicker w-100" data-style="btn-default"
                                            name="balcony">
                                            <option value=1  {{ $hostel->balcony == 1 ? 'selected' : '' }}>Có ban công</option>
                                            <option value=0  {{ $hostel->balcony == 0 ? 'selected' : '' }}>Không có ban công</option>
                                        </select>
                                        @if ($errors->has('balcony'))
                                            <span id="balcony-error" class="error text-danger"
                                                for="input-balcony">{{ $errors->first('balcony') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Sửa</button>
                                <button type="reset" onclick="window.location='{{ URL::route('admin.hostel.index') }}'"
                                    class="btn btn-outline-secondary">Trở về</button>
                            </div>
                        </div>
                    </form>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript" src="{{ asset('assets/js/hostel/create.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function(e) {
        $(".selectpicker").selectpicker();
    });
    document.addEventListener('DOMContentLoaded', function(e) {

        $.ajax({
            url: 'https://provinces.open-api.vn/api/w/{{ $hostel->ward_id }}',
            method: 'get',
            success: function(response) {
                var provinces = response;
                $('#preview_location').val(response.name);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        $('#preview_location').click(function() {
            $('#preview_location').parent().hide();
            $('#city_select').parent().parent().removeClass('d-none');
        });

        $.ajax({
            url: 'https://provinces.open-api.vn/api/p/',
            method: 'get',
            success: function(response) {
                var provinces = response;
                $('#city_select').append(
                    '<option selected="selected" disabled>Choose city</option>');
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
                        '<option selected="selected" disabled>Choose district</option>');
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
                        '<option selected="selected" disabled>Choose ward</option>');
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
<script>
    document.addEventListener('DOMContentLoaded', function(e) {

        var files = []; // Store selected files
        var currentLabelText = 'Choose images'; // Store current label text

        // Handle file input change event
        $('#upload-images').on('change', function(e) {
            var newFiles = Array.from(e.target.files);

            if (newFiles.length > 0) {
                for (var i = 0; i < newFiles.length; i++) {
                    var file = newFiles[i];
                    var reader = new FileReader();
                    $('#preview').empty();
                    reader.onload = (function(file) {
                        return function(e) {
                            var image = $('<img>').addClass('preview-image');
                            image.attr('src', e.target.result);

                            var previewContainer = $('<div>').addClass('preview-container');
                            previewContainer.append(image);
                            $('#preview').append(previewContainer);
                        };
                    })(file);

                    reader.readAsDataURL(file);
                }

                files = newFiles; // Replace the files array with the newly selected files
            } else {
                files = []; // No files selected, reset the files array
            }

            updateFileInputLabel();
        });

        // Update the file input label
        function updateFileInputLabel() {
            var fileInput = $('#upload-images');
            var label = fileInput.next('.custom-file-label');
            var labelText = files.length > 0 ? files.length + ' images selected' : currentLabelText;
            label.text(labelText);
        }
    });
</script>
