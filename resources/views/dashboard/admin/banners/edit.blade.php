@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Edit Banners') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Banners') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item"><a href="{{ route('banners.manage') }}">{{ __('Banners') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Edit') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="dashboard__content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="instructor__profile-form-wrap mt-4">
                                        <form action="{{ route('banners.update', $banner->id) }}" method="POST"
                                            enctype="multipart/form-data" class="instructor__profile-form banner-form">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="title">{{ __('Title') }} <code>*</code></label>
                                                        <input id="title" name="title" type="text"
                                                            class="form-control" placeholder="Enter title"
                                                            value="{{ old('title', $banner->title) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="meta_desc">{{ __('Meta Description') }}</label>
                                                        <textarea id="meta_desc" name="meta_desc" class="form-control">{{ old('meta_desc', $banner->meta_desc) }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="image">{{ __('Image') }} <code>*</code></label>
                                                        <input id="image" name="image" type="file"
                                                            class="form-control">
                                                        <figure class="figure mt-2">
                                                            <img src="{{ url('/storage/' . $banner->image) }}"
                                                                class="figure-img img-fluid rounded img-thumbnail"
                                                                alt="Photo">
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                                            <a href="{{ route('banners.manage') }}"
                                                class="btn btn-default float-right">{{ __('Cancel') }}</a>
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
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector("#meta_desc"))
            .then((editor) => {
                console.log(editor);
            })
            .catch((error) => {
                console.error(error);
            });
    </script>
@endpush
