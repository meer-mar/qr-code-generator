@extends('dashboard.admin.layouts.app')

@section('page_title', 'Add Slider')

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Add Slider') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Add Slider') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="dashboard__content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="instructor__profile-form-wrap mt-4">
                                        <form action="{{ route('sliders.store') }}" method="POST"
                                            enctype="multipart/form-data" class="instructor__profile-form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="blog_article_id">{{ __('Article') }}</label>
                                                        <select name="blog_article_id" id="blog_article_id"
                                                            class="form-control">
                                                            <option value="">{{ __('Select Article') }}</option>
                                                            @foreach ($articles as $article)
                                                                <option value="{{ $article->id }}">{{ $article->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="custom_title">{{ __('Custom Title') }}</label>
                                                        <input type="text" name="custom_title" class="form-control"
                                                            id="custom_title" placeholder="Enter Custom Title">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="priority">{{ __('Priority') }}</label>
                                                        <input type="number" name="priority" class="form-control"
                                                            id="priority" placeholder="Enter Priority" min="0"
                                                            value="0">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="image">{{ __('Image') }}</label>
                                                        <input type="file" name="image" class="form-control"
                                                            id="image">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" name="is_active" class="form-check-input"
                                                            id="is_active" value="1" checked>
                                                        <label class="form-check-label"
                                                            for="is_active">{{ __('Active') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                                            <a href="{{ route('sliders.index') }}" class="btn btn-secondary"
                                                style="color:black;">{{ __('Cancel') }}</a>
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
