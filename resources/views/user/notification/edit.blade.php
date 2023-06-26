@extends('user.layouts.user_layout')
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
                    <form id="formAccountSettings" method="POST" action=" {{ route('host.hostel.update', $hostel) }}"
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
                                        accept="image/*" multiple />
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
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Sửa</button>
                                <button type="reset" onclick="window.location='{{ URL::route('host.hostel.index') }}'"
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
