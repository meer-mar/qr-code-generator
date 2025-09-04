@extends('dashboard.admin.layouts.app')

@section('page_title', 'Add Tags')

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Add Tags') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Add Tags') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="dashboard__content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="instructor__profile-form-wrap mt-4">
                                        <form action="{{ route('tags.store') }}" method="POST"
                                            enctype="multipart/form-data" class="instructor__profile-form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="title">{{ __('Title') }}</label>
                                                        <input type="text" name="title" class="form-control"
                                                            id="title" placeholder="Enter Custom Title">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="link">{{ __('Link') }}</label>
                                                        <input type="text" name="link" class="form-control"
                                                            id="link" placeholder="Enter Link">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                                            <a href="{{ route('tags.index') }}" class="btn btn-secondary"
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
