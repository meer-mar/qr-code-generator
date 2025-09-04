@extends('dashboard.admin.layouts.app')
@section('title')
    <title>{{ __('Blog Article Edit') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Blog Article Edit') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item"><a
                            href="{{ route('blog.article.view', ['id' => $category->id]) }}">{{ __('Blog Articles') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Blog Article Edit') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="dashboard__content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="instructor__profile-form-wrap mt-4">
                                        <form action="{{ route('blog.article.update', ['id' => $article->id]) }}"
                                            method="POST" enctype="multipart/form-data"
                                            class="instructor__profile-form blog-article-form">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="blog_category_id" value="{{ $category->id }}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="page_title">{{ __('Page Title') }}
                                                            <code>*</code></label>
                                                        <input id="page_title" name="page_title" type="text"
                                                            class="form-control"
                                                            value="{{ old('page_title', $article->page_title) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="meta_desc">{{ __('Meta Description') }}</label>
                                                        <textarea id="meta_desc" name="meta_desc" class="form-control">{{ old('meta_desc', $article->meta_desc) }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="title">{{ __('Meta Title') }} <code>*</code></label>
                                                        <input id="title" name="title" type="text"
                                                            class="form-control"
                                                            value="{{ old('title', $article->title) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
    <div class="form-group">
        <label for="image">{{ __('Image') }}</label>
        <input id="image" name="image" type="file" class="form-control">

        <img id="image-preview"
            src="{{ $article->image ? asset('storage/' . $article->image) : '' }}"
            alt="Current Image"
            class="mt-2"
            style="max-height: 100px; {{ $article->image ? '' : 'display:none;' }}"
        >
    </div>
</div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">{{ __('Description') }}</label>
                                                        <textarea name="description" class="form-control summernote">{{ old('description', $article->description) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="status">{{ __('Status') }} <code>*</code></label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="1"
                                                                {{ old('status', $article->status) == 1 ? 'selected' : '' }}>
                                                                {{ __('Active') }}</option>
                                                            <option value="0"
                                                                {{ old('status', $article->status) == 0 ? 'selected' : '' }}>
                                                                {{ __('Inactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <button class="btn btn-primary"
                                                type="submit">{{ __('Save Changes') }}</button>
                                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>

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
    <script>
    document.getElementById('image').addEventListener('change', function(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // show preview if hidden
            }

            reader.readAsDataURL(input.files[0]);
        }
    });
</script>
@endsection

@push('js')
    <script src="{{ asset('backend/js/default/blog_articles.js') }}"></script>
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
