@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Edit Role') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="text-primary">{{ __('Edit Role') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item"><a href="{{ url('/admin/roles-permissions') }}">{{ __('Roles') }}</a></div>
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
                                        <form action="{{ route('role.update', $role->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <!-- Role Name -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputName">{{ __('Role Name') }}</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="inputName" placeholder="{{ __('Enter role name') }}"
                                                            value="{{ $role->name }}">
                                                    </div>
                                                </div>

                                                <!-- Level -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputLevel">{{ __('Level') }}</label>
                                                        <select class="form-control" name="level" id="inputLevel">
                                                            <option value="0"
                                                                @if ($role->level === 0) {{ __('selected') }} @endif>
                                                                {{ __('Level 0') }}</option>
                                                            <option value="1"
                                                                @if ($role->level === 1) {{ __('selected') }} @endif>
                                                                {{ __('Level 1') }}</option>
                                                            <option value="2"
                                                                @if ($role->level === 2) {{ __('selected') }} @endif>
                                                                {{ __('Level 2') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- Description -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputDescription">{{ __('Description') }}</label>
                                                        <textarea name="description" id="inputDescription" rows="3" class="form-control">{{ $role->description }}</textarea>
                                                    </div>
                                                </div>

                                                <!-- Status -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputStatus">{{ __('Status') }}</label>
                                                        <select class="form-control" name="status" id="inputStatus">
                                                            <option value="1"
                                                                @if ($role->status === 1) {{ __('selected') }} @endif>
                                                                {{ __('Active') }}</option>
                                                            <option value="0"
                                                                @if ($role->status === 0) {{ __('selected') }} @endif>
                                                                {{ __('Deactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Permissions -->
                                            <div class="form-group">
                                                <h4>{{ __('Permissions') }}</h4>
                                                <div class="row">
                                                    @forelse ($permissions as $index => $permission)
                                                        <div class="col-md-4 mb-3">
                                                            <!-- Add some margin to the bottom of each column -->
                                                            <div class="form-check p-3 border rounded">
                                                                <!-- Add padding, border, and rounded corners -->
                                                                <input class="form-check-input" name="permissions[]"
                                                                    type="checkbox"
                                                                    {{ $role->checkPermission($permission) ? 'checked' : '' }}
                                                                    value="{{ $permission->id }}">
                                                                <label
                                                                    class="form-check-label">{{ $permission->name }}</label>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <p class="text-center">{{ __('Permission Not Found') }}</p>
                                                    @endforelse
                                                </div>
                                            </div>

                                            <!-- Form Actions -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ __('Update') }}</button>
                                                        <a href="{{ url('/admin/roles-permissions') }}"
                                                            class="btn btn-secondary">{{ __('Cancel') }}</a>
                                                    </div>
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
    <script src="{{ asset('backend/js/default/roles.js') }}"></script>
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
