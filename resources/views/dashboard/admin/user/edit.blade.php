@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Edit User') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="text-primary">{{ __('Edit User') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/admin') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('/admin/users') }}">{{ __('Users') }}</a></div>
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
                                        <form action="{{ url('/admin/user/' . $user->id) }}" method="POST"
                                            enctype="multipart/form-data" class="instructor__profile-form user-form">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputName">{{ __('Full Name') }} <code>*</code></label>
                                                        <input id="inputName" name="name" type="text"
                                                            class="form-control" placeholder="{{ __('Enter full name') }}"
                                                            value="{{ $user->name }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputEmail">{{ __('Email Address') }}
                                                            <code>*</code></label>
                                                        <input id="inputEmail" name="email" type="email"
                                                            class="form-control" placeholder="{{ __('Enter email') }}"
                                                            value="{{ $user->email }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputPassword">{{ __('Password') }}</label>
                                                        <input id="inputPassword" name="password" type="password"
                                                            class="form-control" placeholder="{{ __('Enter password') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputFile">{{ __('Profile Photo') }}</label>
                                                        <figure class="figure">
                                                            <img src="{{ url('/storage/user_profile_photos/' . $user->profile_photo) }}"
                                                                class="figure-img img-fluid rounded img-thumbnail"
                                                                alt="Profile photo">
                                                        </figure>
                                                        <input id="inputFile" name="profile_photo" type="file"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputRole">{{ __('Role') }} <code>*</code></label>
                                                        <select id="inputRole" name="role" class="form-control select2"
                                                            required>
                                                            @if (count($roles) > 0)
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role['id'] }}"
                                                                        {{ $user->hasRole($role->id) ? 'selected' : '' }}>
                                                                        {{ $role['name'] }}</option>
                                                                @endforeach
                                                            @else
                                                                <option value="0">{{ __('No role available') }}
                                                                </option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputStatus">{{ __('Status') }} <code>*</code></label>
                                                        <select id="inputStatus" name="status"
                                                            class="form-control select2">
                                                            <option value="1"
                                                                {{ $user->status == 1 ? 'selected' : '' }}>
                                                                {{ __('Active') }}</option>
                                                            <option value="0"
                                                                {{ $user->status == 0 ? 'selected' : '' }}>
                                                                {{ __('Inactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                                            <a href="{{ url('/admin/users') }}"
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
    <script src="{{ asset('backend/js/default/users.js') }}"></script>
@endpush

@push('css')
    <style>
        .max-h-400 {
            min-height: 400px;
        }
    </style>
@endpush
