@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Add Role') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="text-primary">{{ __('Add Role') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item"><a
                            href="{{ secure_url('/admin/roles-permissions') }}">{{ __('Roles') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Add') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="dashboard__content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="instructor__profile-form-wrap mt-4">
                                        <form action="{{ route('role.save') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <!-- Role Name -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputName">{{ __('Role Name') }}</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="inputName" placeholder="{{ __('Enter role name') }}">
                                                    </div>
                                                </div>

                                                <!-- Level -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputLevel">{{ __('Level') }}</label>
                                                        <select class="form-control" name="level" id="inputLevel">
                                                            <option value="0">{{ __('Level 0') }}</option>
                                                            <option value="1">{{ __('Level 1') }}</option>
                                                            <option value="2">{{ __('Level 2') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- Description -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputDescription">{{ __('Description') }}</label>
                                                        <textarea name="description" id="inputDescription" rows="3" class="form-control"></textarea>
                                                    </div>
                                                </div>

                                                <!-- Status -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputStatus">{{ __('Status') }}</label>
                                                        <select class="form-control" name="status" id="inputStatus">
                                                            <option value="1">{{ __('Active') }}</option>
                                                            <option value="0">{{ __('Deactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Form Actions -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ __('Save') }}</button>
                                                        <a href="{{ url('/admin/roles-permissions') }}"
                                                            class="btn btn-secondary">{{ __('Cancel') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/js/default/roles.js') }}"></script>
@endpush

@push('css')
    <style>
        .dd-custom-css {
            position: absolute;
            will-change: transform;
            top: 0px;
            left: 0px;
            transform: translate3d(0px, -131px, 0px);
        }

        .max-h-400 {
            min-height: 400px;
        }
    </style>
@endpush
