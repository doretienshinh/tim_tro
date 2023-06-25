@extends('layouts.admin_layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tag Create</span></h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form id="formAccountSettings" method="POST" action=" {{ route('admin.tag.store') }}"
                        enctype='multipart/form-data'>
                        @csrf
                        <h5 class="card-header">Tag Details</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Tên thẻ</label>
                                    <input class="form-control" type="text" id="html5-time-input" name="name" />
                                    @if ($errors->has('name'))
                                        <span id="start_at-error" class="error text-danger"
                                            for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <input class="form-control" type="text" id="html5-time-input" name="description" />
                                    @if ($errors->has('description'))
                                        <span id="description-error" class="error text-danger"
                                            for="input-description">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Tạo</button>
                                <button type="reset" onclick="window.location='{{ URL::route('admin.tag.index') }}'"
                                    class="btn btn-outline-secondary">Trở về</button>
                            </div>
                    </form>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
