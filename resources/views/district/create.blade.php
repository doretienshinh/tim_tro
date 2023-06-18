@extends('layouts.admin_layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">District insert</span></h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <form id="formAccountSettings" method="POST" action=" {{ route('admin.district.store') }}"
                        enctype='multipart/form-data'>
                        @csrf
                        <h5 class="card-header">District Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="selectpickerLiveSearch" class="form-label">Choose City</label>
                                <select id="selectpickerLiveSearch" class="selectpicker w-100" data-style="btn-default"
                                    data-live-search="true">
                                    <option selected="selected" disabled>Choose City</option>
                                    @foreach ($cities as $index => $city)
                                        <option data-tokens="{{ $city->name }}" value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-3">
                                <label for="district" class="form-label">District Name</label>
                                <input class="form-control" type="text" id="district" name="district"
                                    placeholder="District Name" autofocus />
                                @if ($errors->has('district'))
                                    <span id="first-name-error" class="error text-danger"
                                        for="input-name">{{ $errors->first('district') }}</span>
                                @endif
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Tạo</button>
                                <button type="reset" onclick="window.location='{{ URL::route('admin.district.index') }}'"
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
<script type="text/javascript" src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function(e) {
        $(".selectpicker").select2();
    });
</script>
