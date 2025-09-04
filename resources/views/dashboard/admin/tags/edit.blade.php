@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Tags')

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Tags') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Edit Tags') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="dashboard__content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('tags.update', $tags->id) }}" method="POST" class="tag-form">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="title">{{ __('Title') }}</label>
                                                    <input type="text" name="title" class="form-control" id="title"
                                                        value="{{ $tags->title }}"
                                                        placeholder="{{ __('Enter Tag Title') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="link">{{ __('Link') }}</label>
                                                    <input type="text" name="link" class="form-control" id="link"
                                                        value="{{ $tags->link }}"
                                                        placeholder="{{ __('Enter Tag link') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" name="is_active" class="form-check-input"
                                                        id="is_active" value="1"
                                                        {{ $tags->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="is_active">{{ __('Active') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                                        <a href="{{ route('tags.index') }}"
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
