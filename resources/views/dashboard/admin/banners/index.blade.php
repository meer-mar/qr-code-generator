@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Manage Banners') }}</title>
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
                <h1>{{ __('Manage Banners') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Banners List') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    {{-- Banners Table --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Banners List') }}</h4>
                                <div>
                                    <a href="{{ route('banners.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> {{ __('Add New') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive max-h-400">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('ID') }}</th>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Meta Description') }}</th>
                                                <th>{{ __('Image') }}</th>
                                                <th class="text-center">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($banners as $bc)
                                                <tr>
                                                    <td>{{ $bc->id }}</td>
                                                    <td>{{ $bc->title }}</td>
                                                    <td>{{ $bc->meta_desc }}</td>
                                                    <td>
                                                        @if ($bc->image)
                                                            <img src="{{ asset('storage/' . $bc->image) }}"
                                                                alt="{{ $bc->title }}" class="img-thumbnail"
                                                                width="50">
                                                        @else
                                                            {{ __('No Image') }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('banners.edit', $bc->id) }}"
                                                            class="btn btn-warning">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger delete-btn"
                                                            data-delete-url="{{ route('banners.destroy', $bc->id) }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">{{ __('No Banners Found') }}
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{-- Pagination --}}
                                    {{-- {{ $categories->links() }} --}}
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
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('Delete Banners') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this Banners?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a href="javascript:;" class="btn btn-danger" id="confirmDeleteBtn">{{ __('Delete') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
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
<script src="{{ asset('backend/js/sweetalert.js') }}"></script>
