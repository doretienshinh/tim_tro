@extends('layouts.admin_layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hostel Create</span></h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form id="formAccountSettings" method="POST" action=" {{ route('admin.hostel.store') }}"
                        enctype='multipart/form-data'>
                        @csrf
                        <h5 class="card-header">Hostel Details</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input class="form-control" type="text" id="title" name="title"
                                        placeholder="Input title" autofocus />
                                    @if ($errors->has('title'))
                                        <span id="title-error" class="error text-danger"
                                            for="input-title">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    @if ($errors->has('last_name'))
                                        <span id="last-name-error" class="error text-danger"
                                            for="input-name">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail image</label>
                                    <input class="form-control" type="file" id="thumbnail-upload" name="thumbnail" />
                                    <div class="" id="thumbnail_show">
                                        {{-- <label for="formFile" class="form-label">Thẻ sinh viên</label> --}}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="selectpickerLiveSearch" class="form-label">Choose tag</label>
                                    <select id="selectpickerLiveSearch" class="selectpicker w-100" data-style="btn-default"
                                        data-live-search="true" data-show-subtext="true" multiple>
                                        {{-- <option selected="selected" disabled>Choose tag</option> --}}
                                        @foreach ($tags as $index => $tag)
                                            <option data-tokens="{{ $tag->name }}" value="{{ $tag->id }}"
                                                data-subtext="{{ $tag->description }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('email'))
                                        <span id="email-error" class="error text-danger"
                                            for="input-name">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="city_select" class="form-label">Choose city</label>
                                    <select id="city_select" class="w-100" data-style="btn-default" data-live-search="true"
                                        data-show-subtext="true" name="city_select">
                                    </select>
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
                                        data-show-subtext="true" name="ward">
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="birthday" class="form-label">Ngày sinh</label>
                                    <input class="form-control" type="date" value="2021-06-18" id="birthday"
                                        name="birthday" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="school" class="form-label">Trường</label>
                                    <input type="text" class="form-control" id="school" name="school"
                                        placeholder="Trường đại học xxx" maxlength="100" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="student_card" class="form-label">Thẻ sinh viên</label>
                                    <input class="form-control" type="file" id="student-card-upload"
                                        name="student_card" />
                                    <div class="mt-5" id="student_card_show">
                                        {{-- <label for="formFile" class="form-label">Thẻ sinh viên</label> --}}
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="citizen_identification" class="form-label">CCCD/CMT</label>
                                    <input class="form-control" type="file" id="citizen-identification-upload"
                                        name="citizen_identification" />
                                    <div class="mt-5" id="citizen_identification_show">
                                        {{-- <label for="formFile" class="form-label">CCCD/CMT</label> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Tạo</button>
                                <button type="reset" onclick="window.location='{{ URL::route('admin.user.index') }}'"
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
                url: 'https://provinces.open-api.vn/api/p/'+city_id+'?depth=2',
                method: 'get',
                success: function(response) {
                    var districts = response.districts;
                    $("#district_select").selectpicker('destroy');
                    $('#district_select').empty().append('<option selected="selected" disabled>Choose district</option>');
                    $.each(districts, function(index, item) {
                        $('#district_select').append('<option data-tokens=" ' + item
                        .name + ' " value="' + item.code + '">' + item.name +
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
                url: 'https://provinces.open-api.vn/api/d/'+district_id+'?depth=2',
                method: 'get',
                success: function(response) {
                    var wards = response.wards;
                    $("#ward_select").selectpicker('destroy');
                    $('#ward_select').append('<option selected="selected" disabled>Choose ward</option>');
                    $.each(wards, function(index, item) {
                        $('#ward_select').append('<option data-tokens=" ' + item
                        .name + ' " value="' + item.code + '">' + item.name +
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
