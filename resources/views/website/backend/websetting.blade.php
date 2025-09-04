@extends('dashboard.admin.layouts.app')
@section('title')
    <title>{{ __('Website Setting') }}</title>
@endsection
<div id="alert-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; max-width: 300px;">
    @if (session('success'))
        <div class="alert-message"
            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #47C363; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-message"
            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #ff0018; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
            {{ session('error') }}
        </div>
    @endif

    @if (session('info'))
        <div class="alert-message"
            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #17a2b8; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
            {{ session('info') }}
        </div>
    @endif
</div>
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Website Setting') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Website Setting') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills flex-column" id="generalTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link show active" id="general-tab" data-toggle="tab"
                                            href="#general_tab" role="tab" aria-controls="general" aria-selected="true">
                                            General Settings
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="site-info-tab" data-toggle="tab" href="#site_info_tab"
                                            role="tab" aria-controls="site-info" aria-selected="false">Site Info</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="logo-favicon-tab" data-toggle="tab" href="#logo_favicon_tab"
                                            role="tab" aria-controls="logo-favicon" aria-selected="false">
                                            Logo & Favicon
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="social-media-tab" data-toggle="tab" href="#social_media_tab"
                                            role="tab" aria-controls="social-media" aria-selected="false">
                                            Social Media Links
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="copyright-text" data-toggle="tab" href="#copyright_text_tab"
                                            role="tab" aria-controls="copyright" aria-selected="false">Copyright
                                            Text</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent2">
                                    <!-- General Settings -->
                                    <div class="tab-pane fade active show" id="general_tab" role="tabpanel">
                                        <form action="{{ url('/admin/web-setting/' . $webSettings->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label>Site Title</label>
                                                <input type="text" name="site_title" class="form-control"
                                                    value="{{ old('site_title', $settings->site_title) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Meta Description</label>
                                                <textarea name="meta_description" class="form-control" rows="4">{{ old('meta_description', $settings->meta_description) }}</textarea>
                                            </div>



                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </form>
                                    </div>
                                    <!-- Site Info Tab -->
                                    <div class="tab-pane fade" id="site_info_tab" role="tabpanel">
                                        <form action="{{ url('/admin/web-setting/' . $webSettings->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label>Site Url</label>
                                                <input type="text" name="site_url" class="form-control"
                                                    value="{{ old('site_url', $settings->site_url) }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Site Address</label>
                                                <input type="text" name="site_address" class="form-control"
                                                    value="{{ old('site_address', $settings->site_address) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Site Email</label>
                                                <input type="email" name="site_email" class="form-control"
                                                    value="{{ old('site_email', $settings->site_email) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Site Phone</label>
                                                <input type="text" name="site_phone" class="form-control"
                                                    value="{{ old('site_phone', $settings->site_phone) }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Site Author</label>
                                                <input type="text" name="site_author" class="form-control"
                                                    value="{{ $settings->site_author }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Site Author Description</label>
                                                <input type="text" name="site_author_desc" class="form-control"
                                                    value="{{ $settings->site_author_desc }}">
                                            </div>

                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </form>
                                    </div>
                                    <!-- Logo & Favicon -->
                                    <div class="tab-pane fade" id="logo_favicon_tab" role="tabpanel">
                                        <form action="{{ url('/admin/web-setting/' . $webSettings->id) }}" method="POST"
                                            enctype="multipart/form-data" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label>Site Logo</label>
                                                    <input type="file" name="site_logo" class="form-control">
                                                    <img src="{{ asset('storage/settings/' . $settings->site_logo) }}"
                                                        width="100">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Fav Logo</label>
                                                    <input type="file" name="site_fav" class="form-control">
                                                    <img src="{{ asset('storage/settings/' . $settings->site_fav) }}"
                                                        width="100">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Footer Logo</label>
                                                    <input type="file" name="site_footer_logo" class="form-control">
                                                    <img src="{{ asset('storage/settings/' . $settings->site_footer_logo) }}"
                                                        width="100">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Dashboard Logo</label>
                                                    <input type="file" name="logo" class="form-control">
                                                    <img src="{{ asset('storage/settings/' . $settings->logo) }}"
                                                        width="100">
                                                </div>
                                            </div>

                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </form>
                                    </div>
                                    <!-- Social Media Links -->
                                    <div class="tab-pane fade" id="social_media_tab" role="tabpanel">
                                        <form action="{{ url('/admin/web-setting/' . $webSettings->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label>Facebook URL</label>
                                                <input type="url" name="site_fb" class="form-control"
                                                    value="{{ old('site_fb', $settings->site_fb) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Instagram URL</label>
                                                <input type="url" name="site_instagram" class="form-control"
                                                    value="{{ old('site_instagram', $settings->site_instagram) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Twitter URL</label>
                                                <input type="url" name="site_twitter" class="form-control"
                                                    value="{{ old('site_twitter', $settings->site_twitter) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>LinkedIn URL</label>
                                                <input type="url" name="site_linkedn" class="form-control"
                                                    value="{{ old('site_linkedn', $settings->site_linkedn) }}">
                                            </div>

                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </form>
                                    </div>
                                    <!-- CopyRight Text -->
                                    <div class="tab-pane fade" id="copyright_text_tab" role="tabpanel">
                                        <form action="{{ url('/admin/web-setting/' . $webSettings->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="">Copyright Text</label>
                                                <textarea name="theme_footer" rows="4" class="form-control">{{ $settings->theme_footer }}</textarea>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <!--Message Time-->
    <script>
        // Hide the alert messages after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert-message').forEach(function(alert) {
                alert.style.transition = "opacity 0.5s";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500); // Remove after fade-out
            });
        }, 5000);
    </script>
@endsection
