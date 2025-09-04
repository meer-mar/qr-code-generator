@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Roles & Permissions') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Roles & Permissions') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Roles & Permissions') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('dashboard.admin.includes.messages')

                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Manage Roles') }}</h4>
                                <a href="{{ secure_url('/admin/role/add') }}" class="btn btn-primary">
                                    <i class="fa fa-plus mr-2"></i>{{ __('Add New Role') }}
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Level') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th class="text-center">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $index => $role)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>{{ $role->level }}</td>
                                                    <td>
                                                        @if ($role->status == 1)
                                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('role.edit', $role->id) }}"
                                                            class="btn btn-warning ">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-danger delete-btn"
                                                            data-delete-url="{{ route('role.delete', $role->id) }}">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>{{ __('Manage Permissions') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Slug') }}</th>
                                                <th>{{ __('Description') }}</th>
                                                <th>{{ __('Assigned Roles') }}</th>
                                                <th>{{ __('Status') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permissions as $index => $permission)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $permission->name }}</td>
                                                    <td>{{ $permission->slug }}</td>
                                                    <td>{{ $permission->description }}</td>
                                                    <td>
                                                        @foreach ($permission->roles as $role)
                                                            <span class="badge badge-info">{{ $role->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if ($permission->status == 1)
                                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('Delete Roles') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this Roles?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a href="javascript:;" class="btn btn-danger" id="confirmDeleteBtn">{{ __('Delete') }}</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all delete buttons
            const deleteButtons = document.querySelectorAll('.delete-btn');

            // Get the modal and confirm delete button
            const deleteModal = document.getElementById('deleteModal');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

            // Variable to store the form action URL
            let deleteUrl = '';

            // Add click event listener to each delete button
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get the delete URL from the data attribute
                    deleteUrl = button.getAttribute('data-delete-url');

                    // Show the modal
                    $(deleteModal).modal('show');
                });
            });

            // Add click event listener to the confirm delete button
            confirmDeleteBtn.addEventListener('click', function() {
                if (deleteUrl) {
                    // Create a form dynamically
                    const form = document.createElement('form');
                    form.setAttribute('method', 'POST');
                    form.setAttribute('action', deleteUrl);

                    // Add CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.setAttribute('type', 'hidden');
                    csrfToken.setAttribute('name', '_token');
                    csrfToken.setAttribute('value', '{{ csrf_token() }}');
                    form.appendChild(csrfToken);

                    // Add method spoofing for DELETE
                    const methodInput = document.createElement('input');
                    methodInput.setAttribute('type', 'hidden');
                    methodInput.setAttribute('name', '_method');
                    methodInput.setAttribute('value', 'DELETE');
                    form.appendChild(methodInput);

                    // Append the form to the body and submit it
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    </script>
@endsection
