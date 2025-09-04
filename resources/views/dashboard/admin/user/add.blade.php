@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Add User') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="text-primary">{{ __('Add User') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/admin') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('/admin/users') }}">{{ __('Users') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Add') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="dashboard__content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="instructor__profile-form-wrap mt-4">
                                        <form action="{{ url('/admin/user/save') }}" method="POST"
                                            enctype="multipart/form-data" class="instructor__profile-form user-form">
                                            @csrf
                                            <div class="row">
                                                <!-- Full Name -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputName">{{ __('Full Name') }} <code>*</code></label>
                                                        <input id="inputName" name="name" type="text"
                                                            class="form-control" placeholder="{{ __('Enter full name') }}"
                                                            value="{{ old('name') }}" required>
                                                    </div>
                                                </div>

                                                <!-- Email -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputEmail">{{ __('Email Address') }}
                                                            <code>*</code></label>
                                                        <input id="inputEmail" name="email" type="email"
                                                            class="form-control" placeholder="{{ __('Enter email') }}"
                                                            value="{{ old('email') }}" required>
                                                    </div>
                                                </div>

                                                <!-- Password -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputPassword">{{ __('Password') }}
                                                            <code>*</code></label>
                                                        <input id="inputPassword" name="password" type="password"
                                                            class="form-control" placeholder="{{ __('Enter password') }}"
                                                            required>
                                                    </div>
                                                </div>

                                                <!-- Profile Photo -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputFile">{{ __('Profile Photo') }}</label>
                                                        <input id="inputFile" name="profile_photo" type="file"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <!-- About -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputAbout">{{ __('About') }}</label>
                                                        <textarea id="inputAbout" name="about" class="form-control" placeholder="{{ __('Write something about the user') }}">{{ old('about') }}</textarea>
                                                    </div>
                                                </div>

                                                <!-- Slug -->
                                                {{-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputSlug">{{ __('Slug') }}</label>
                                                        <input id="inputSlug" name="slug" type="text" class="form-control" placeholder="{{ __('Enter slug') }}" value="{{ old('slug') }}">
                                                    </div>
                                                </div> --}}

                                                <!-- Biography -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputBiography">{{ __('Biography') }}</label>
                                                        <textarea id="inputBiography" name="biography" class="form-control" placeholder="{{ __('Enter biography') }}">{{ old('biography') }}</textarea>
                                                    </div>
                                                </div>

                                                <!-- Social Media Links -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputFb">{{ __('Facebook') }}</label>
                                                        <input id="inputFb" name="fb" type="text"
                                                            class="form-control"
                                                            placeholder="{{ __('Enter Facebook profile link') }}"
                                                            value="{{ old('fb') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputInsta">{{ __('Instagram') }}</label>
                                                        <input id="inputInsta" name="insta" type="text"
                                                            class="form-control"
                                                            placeholder="{{ __('Enter Instagram profile link') }}"
                                                            value="{{ old('insta') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputTwitter">{{ __('Twitter') }}</label>
                                                        <input id="inputTwitter" name="twitter" type="text"
                                                            class="form-control"
                                                            placeholder="{{ __('Enter Twitter profile link') }}"
                                                            value="{{ old('twitter') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputLinkden">{{ __('LinkedIn') }}</label>
                                                        <input id="inputLinkden" name="linkden" type="text"
                                                            class="form-control"
                                                            placeholder="{{ __('Enter LinkedIn profile link') }}"
                                                            value="{{ old('linkden') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputWhatsapp">{{ __('WhatsApp') }}</label>
                                                        <input id="inputWhatsapp" name="whatsapp" type="text"
                                                            class="form-control"
                                                            placeholder="{{ __('Enter WhatsApp number') }}"
                                                            value="{{ old('whatsapp') }}">
                                                    </div>
                                                </div>

                                                <!-- Role -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputRole">{{ __('Role') }} <code>*</code></label>
                                                        <select id="inputRole" name="role"
                                                            class="form-control select2" required>
                                                            @if (count($roles) > 0)
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role['id'] }}">
                                                                        {{ $role['name'] }}</option>
                                                                @endforeach
                                                            @else
                                                                <option value="0">{{ __('No role available') }}
                                                                </option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Status -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputStatus">{{ __('Status') }}
                                                            <code>*</code></label>
                                                        <select id="inputStatus" name="status"
                                                            class="form-control select2">
                                                            <option value="1">{{ __('Active') }}</option>
                                                            <option value="0">{{ __('Inactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <button class="btn btn-primary"
                                                        type="submit">{{ __('Save') }}</button>
                                                    <a href="{{ url('/admin/users') }}"
                                                        class="btn btn-secondary">{{ __('Cancel') }}</a>
                                                </div>
                                            </div>
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
