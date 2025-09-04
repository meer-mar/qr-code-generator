@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Manage Education Records') }}</title>
@endsection
<div id="alert-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; max-width: 300px;">
    @if (session('success'))
        <div class="alert-message"
            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #47C363; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-message"
            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #ff0018; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
            {{ session('error') }}
        </div>
    @endif

    @if (session('info'))
        <div class="alert-message"
            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #17a2b8; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
            {{ session('info') }}
        </div>
    @endif
</div>
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Manage Education Records') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Education Records') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Education Records List') }}</h4>
                                <div>
                                    <a href="{{ route('education.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> {{ __('Add Education Record') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive max-h-400">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('User ID') }}</th>
                                                <th>{{ __('Organization') }}</th>
                                                <th>{{ __('Degree') }}</th>
                                                <th>{{ __('Start Date') }}</th>
                                                <th>{{ __('End Date') }}</th>
                                                <th>{{ __('Current') }}</th>
                                                <th class="text-center">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($education as $index => $record)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $record->user_id }}</td>
                                                    <td>{{ $record->organization }}</td>
                                                    <td>{{ $record->degree }}</td>
                                                    <td>{{ $record->start_date }}</td>
                                                    <td>{{ $record->end_date ?? __('N/A') }}</td>
                                                    <td>{{ $record->current ? __('Yes') : __('No') }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('education.edit', ['userId' => Auth::id(), 'id' => $record->id]) }}"
                                                            class="btn btn-warning ">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-danger delete-btn"
                                                            data-delete-url="{{ route('education.destroy', ['userId' => Auth::id(), 'id' => $record->id]) }}">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{-- Pagination --}}
                                    {{-- {{ $education->links() }} --}}
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
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('Delete Eduction') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this Eduction?') }}
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
    <!--Message Time-->
    <script>
        // Hide the alert messages after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert-message').forEach(function(alert) {
                alert.style.transition = "opacity 0.5s";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500); // Remove after fade-out
            });
        }, 5000);
    </script>
@endsection
