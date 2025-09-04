@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Edit App Settings') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="text-primary">{{ __('Edit App Settings') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('App Settings') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="dashboard__content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="instructor__profile-form-wrap mt-4">
                                        <form action="{{ secure_url('/admin/app-setting/' . $setting->id) }}" method="POST"
                                            enctype="multipart/form-data" class="instructor__profile-form">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                <!-- App Name -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputName">{{ __('App Name') }}</label>
                                                        <input type="text" name="name" id="inputName"
                                                            class="form-control" value="{{ $setting->name }}"
                                                            placeholder="{{ __('Enter app name') }}" required>
                                                    </div>
                                                </div>

                                                <!-- Logo -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputFile">{{ __('Logo') }}</label>
                                                        @if ($setting->logo)
                                                            <img src="{{ url('/storage/settings/' . $setting->logo) }}"
                                                                alt="{{ $setting->name }}" width="100"
                                                                class="mb-3 img-thumbnail">
                                                        @endif
                                                        <input type="file" name="logo" id="inputFile"
                                                            class="form-control">
                                                        <input type="hidden" name="logo2" value="{{ $setting->logo }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Buttons -->
                                            <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                                            <a href="{{ url('/admin/') }}"
                                                class="btn btn-secondary">{{ __('Cancel') }}</a>
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
    <script src="{{ asset('backend/js/default/settings.js') }}"></script>
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
