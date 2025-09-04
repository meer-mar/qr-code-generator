@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Edit Website Settings') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Website Settings') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Website Settings') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="dashboard__content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="instructor__profile-form-wrap mt-4">
                                        @include('dashboard.admin.includes.messages')
                                        <form action="{{ secure_url('/admin/web-setting/' . $webSettings->id) }}"
                                            method="POST" enctype="multipart/form-data" class="instructor__profile-form">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                <!-- Website Title -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputName">{{ __('Website Title') }}</label>
                                                        <input type="text" name="site_title"
                                                            value="{{ $webSettings->site_title }}" class="form-control"
                                                            id="inputName" placeholder="{{ __('Enter site title') }}"
                                                            required>
                                                    </div>
                                                </div>

                                                <!-- Meta Description -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputDesc">{{ __('Meta Description') }}</label>
                                                        <textarea name="meta_description" id="inputDesc" rows="3" class="form-control"
                                                            placeholder="{{ __('Enter meta description') }}">{{ $webSettings->meta_description }}</textarea>
                                                    </div>
                                                </div>

                                                <!-- Theme Footer Text -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="themeFooter">{{ __('Theme Footer Text') }}</label>
                                                        <input type="text" name="theme_footer"
                                                            value="{{ $webSettings->theme_footer }}" class="form-control"
                                                            id="themeFooter" placeholder="{{ __('Enter footer text') }}">
                                                    </div>
                                                </div>

                                                <!-- Logos and Images -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="logo">{{ __('Logo') }}</label>
                                                        @if ($webSettings->logo)
                                                            <img src="{{ url('/storage/settings/' . $webSettings->logo) }}"
                                                                alt="{{ $webSettings->site_title }}" width="100"
                                                                class="mb-3 img-thumbnail">
                                                        @endif
                                                        <input type="file" name="logo" id="logo"
                                                            class="form-control">
                                                        <input type="hidden" name="logo2"
                                                            value="{{ $webSettings->logo }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="siteLogo">{{ __('Website Logo') }}</label>
                                                        @if ($webSettings->site_logo)
                                                            <img src="{{ url('/storage/settings/' . $webSettings->site_logo) }}"
                                                                alt="{{ $webSettings->site_title }}" width="100"
                                                                class="mb-3 img-thumbnail">
                                                        @endif
                                                        <input type="file" name="site_logo" id="siteLogo"
                                                            class="form-control">
                                                        <input type="hidden" name="site_logo2"
                                                            value="{{ $webSettings->site_logo }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="siteLogo">{{ __('Website Footer Logo') }}</label>
                                                        @if ($webSettings->site_footer_logo)
                                                            <img src="{{ url('/storage/settings/' . $webSettings->site_footer_logo) }}"
                                                                alt="{{ $webSettings->site_title }}" width="100"
                                                                class="mb-3 img-thumbnail">
                                                        @endif
                                                        <input type="file" name="site_footer_logo" id="siteLogo"
                                                            class="form-control">
                                                        <input type="hidden" name="site_footer_logo2"
                                                            value="{{ $webSettings->site_footer_logo }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="siteFav">{{ __('Website Fav') }}</label>
                                                        @if ($webSettings->site_fav)
                                                            <img src="{{ url('/storage/settings/' . $webSettings->site_fav) }}"
                                                                alt="{{ $webSettings->site_title }}" width="100"
                                                                class="mb-3 img-thumbnail">
                                                        @endif
                                                        <input type="file" name="site_fav" id="siteFav"
                                                            class="form-control">
                                                        <input type="hidden" name="site_fav2"
                                                            value="{{ $webSettings->site_fav }}">
                                                    </div>
                                                </div>

                                                <!-- Social Links -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="siteFacebook">{{ __('Website Facebook') }}</label>
                                                        <input type="text" name="site_fb"
                                                            value="{{ $webSettings->site_fb }}" class="form-control"
                                                            id="siteFacebook" placeholder="{{ __('Facebook URL') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="site_linkedn">{{ __('Website Linkedn') }}</label>
                                                        <input type="text" name="site_linkedn"
                                                            value="{{ $webSettings->site_linkedn }}" class="form-control"
                                                            id="site_linkedn" placeholder="{{ __('Linkedn URL') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="siteTwitter">{{ __('Website Twitter') }}</label>
                                                        <input type="text" name="site_twitter"
                                                            value="{{ $webSettings->site_twitter }}" class="form-control"
                                                            id="siteTwitter" placeholder="{{ __('Twitter URL') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="site_instagram">{{ __('Website Instagram') }}</label>
                                                        <input type="text" name="site_instagram"
                                                            value="{{ $webSettings->site_instagram }}"
                                                            class="form-control" id="site_instagram"
                                                            placeholder="{{ __('Instagram URL') }}">
                                                    </div>
                                                </div>

                                                <!-- Other Settings -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="siteUrl">{{ __('Website URL') }}</label>
                                                        <input type="text" name="site_url"
                                                            value="{{ $webSettings->site_url }}" class="form-control"
                                                            id="siteUrl" placeholder="https://www.example.com">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="siteEmail">{{ __('Website Email') }}</label>
                                                        <input type="email" name="site_email"
                                                            value="{{ $webSettings->site_email }}" class="form-control"
                                                            id="siteEmail" placeholder="{{ __('Email Address') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="site_address">{{ __('Website Address') }}</label>
                                                        <input type="text" name="site_address"
                                                            value="{{ $webSettings->site_address }}" class="form-control"
                                                            id="site_address" placeholder="{{ __('Site Address') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="site_phone">{{ __('Website Phone') }}</label>
                                                        <input type="text" name="site_phone"
                                                            value="{{ $webSettings->site_phone }}" class="form-control"
                                                            id="site_phone" placeholder="{{ __('Site Address') }}">
                                                    </div>
                                                </div>

                                                <!-- Status -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="status">{{ __('Site Status') }}</label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="1"
                                                                @if ($webSettings->status == 1) selected @endif>
                                                                {{ __('Active') }}</option>
                                                            <option value="0"
                                                                @if ($webSettings->status == 0) selected @endif>
                                                                {{ __('Deactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
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
