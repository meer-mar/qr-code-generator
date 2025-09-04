@extends('dashboard.admin.layouts.app')
@section('title')
    <title>{{ __('Blog Category Edit') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Blog Category') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Blog Category') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="dashboard__content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="instructor__profile-form-wrap mt-4">
                                        <form action="{{ route('blog.category.update', $category->id) }}" method="POST"
                                            enctype="multipart/form-data"
                                            class="instructor__profile-form blog-category-form">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="page_title">{{ __('Page Title') }}
                                                            <code>*</code></label>
                                                        <input id="page_title" name="page_title" type="text"
                                                            class="form-control"
                                                            value="{{ old('page_title', $category->page_title) }}">
                                                    </div>
                                                </div>



                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="meta_desc">{{ __('Meta Description') }}</label>
                                                        <textarea id="meta_desc" name="meta_desc" class="form-control">{{ old('meta_desc', $category->meta_desc) }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="title">{{ __('Title') }} <code>*</code></label>
                                                        <input id="title" name="title" type="text"
                                                            class="form-control"
                                                            value="{{ old('title', $category->title) }}">
                                                    </div>
                                                </div>

                                                <!-- <div class="col-md-12">
                                                                                                                            <div class="form-group">
                                                                                                                                <label for="slug">{{ __('Slug') }} <code>*</code></label>
                                                                                                                                <input id="slug" name="slug" type="text" class="form-control" value="{{ old('slug', $category->slug) }}">
                                                                                                                            </div>
                                                                                                                        </div> -->

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="image">{{ __('Image') }} <code>*</code></label>
                                                        <input id="image" name="image" type="file"
                                                            class="form-control">
                                                        @if ($category->image)
                                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                                alt="Category Image" class="mt-2" width="150">
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">{{ __('Description') }}</label>
                                                        <textarea name="description" class="text-editor form-control summernote">{{ old('description', $category->description) }}</textarea>
                                                    </div>
                                                </div>

                                                {{--  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="approval">{{ __('Approval') }} <code>*</code></label>
                                                        <select name="approval" id="approval" class="form-control select2">
                                                            <option value="Pending"
                                                                {{ $category->approval == 'Pending' ? 'selected' : '' }}>
                                                                {{ __('Pending') }}</option>
                                                            <option value="Approved"
                                                                {{ $category->approval == 'Approved' ? 'selected' : '' }}>
                                                                {{ __('Approved') }}</option>
                                                            <option value="Failed"
                                                                {{ $category->approval == 'Failed' ? 'selected' : '' }}>
                                                                {{ __('Failed') }}</option>
                                                        </select>
                                                    </div>
                                                </div> --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="status">{{ __('Status') }} <code>*</code></label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="1"
                                                                {{ old('status', $category->status) == 1 ? 'selected' : '' }}>
                                                                {{ __('Active') }}</option>
                                                            <option value="0"
                                                                {{ old('status', $category->status) == 0 ? 'selected' : '' }}>
                                                                {{ __('Inactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <button class="btn btn-primary"
                                                type="submit">{{ __('Save Changes') }}</button>
                                            <a href="{{ url('/admin/blog/category') }}"
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
    <script src="{{ asset('backend/js/default/blog_categories.js') }}"></script>
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
