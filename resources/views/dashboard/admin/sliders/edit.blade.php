@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Slider')

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Slider') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Edit Slider') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="dashboard__content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('sliders.update', $slider->id) }}" method="POST"
                                        enctype="multipart/form-data" class="slider-form">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="blog_article_id">{{ __('Article') }}</label>
                                                    <select name="blog_article_id" id="blog_article_id"
                                                        class="form-control">
                                                        <option value="">{{ __('Select Article') }}</option>
                                                        @foreach ($articles as $article)
                                                            <option value="{{ $article->id }}"
                                                                {{ $slider->blog_article_id == $article->id ? 'selected' : '' }}>
                                                                {{ $article->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="custom_title">{{ __('Custom Title') }}</label>
                                                    <input type="text" name="custom_title" class="form-control"
                                                        id="custom_title" value="{{ $slider->custom_title }}"
                                                        placeholder="{{ __('Enter Custom Title') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="priority">{{ __('Priority') }}</label>
                                                    <input type="number" name="priority" class="form-control"
                                                        id="priority" value="{{ $slider->priority }}"
                                                        placeholder="{{ __('Enter Priority') }}" min="0">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="image">{{ __('Image') }}</label>
                                                    <input type="file" name="image" class="form-control"
                                                        id="image">
                                                    @if ($slider->image)
                                                        <div class="mt-2">
                                                            <img src="{{ asset($slider->image) }}" alt="Slider Image"
                                                                class="img-thumbnail" style="max-width: 200px;">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" name="is_active" class="form-check-input"
                                                        id="is_active" value="1"
                                                        {{ $slider->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="is_active">{{ __('Active') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                                        <a href="{{ route('sliders.index') }}"
                                            class="btn btn-default float-right">{{ __('Cancel') }}</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
