@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Manage FAQs') }}</title>
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
                <h1>{{ __('Manage FAQs') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('FAQs') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Manage FAQs') }}</h4>
                                <div>
                                    <a href="{{ route('faqs.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> {{ __('Add New Question') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="faq-accordion">
                                    @forelse ($faqs as $key => $faq)
                                        <div class="card faq-item mb-3">
                                            <div class="card-header" id="heading-{{ $faq->id }}"
                                                style="cursor: pointer;">
                                                <h5 class="mb-0">
                                                    <a class="d-flex align-items-center justify-content-between question-toggle"
                                                        data-toggle="collapse" data-target="#answer-{{ $faq->id }}"
                                                        aria-expanded="false" aria-controls="answer-{{ $faq->id }}">
                                                        <span class="d-flex align-items-center">
                                                            <span class="faq-id mr-2">{{ $key + 1 }}.</span>
                                                            <span class="faq-question">{{ $faq->question }}</span>
                                                        </span>
                                                        <i class="fas fa-chevron-down"></i>
                                                    </a>
                                                    <div class="ml-2">
                                                        <a href="{{ route('faqs.edit', $faq->id) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger delete-btn"
                                                            data-delete-url="{{ route('faqs.destroy', $faq->id) }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </h5>
                                            </div>
                                            <div id="answer-{{ $faq->id }}" class="collapse mt-2"
                                                aria-labelledby="heading-{{ $faq->id }}" data-parent="#faq-accordion">
                                                <div class="card-body">
                                                    {!! $faq->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">{{ __('No FAQs Found') }}</p>
                                    @endforelse
                                </div>
                                <div class="float-right mt-4">
                                    {{ $faqs->links() }}
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
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('Delete FAQs') }}

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this FAQs?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a href="javascript:;" class="btn btn-danger" id="confirmDeleteBtn">{{ __('Delete') }}</a>
                </div>
            </div>
        </div>
    </div>
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
