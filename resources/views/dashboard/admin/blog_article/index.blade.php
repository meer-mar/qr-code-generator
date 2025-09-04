@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Blog Articles') }}</title>
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
                <h1>{{ __('Blog Articles') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Blog Articles List') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    {{-- Blog Articles Table --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Blog Articles List') }}</h4>
                                <div>
                                    <a href="{{ route('blog.article.create', ['id' => $category->id]) }}"
                                        class="btn btn-primary">
                                        <i class="fa fa-plus"></i> {{ __('Add New') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive max-h-400">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Page Title') }}</th>
                                                <th>{{ __('Meta Description') }}</th>
                                                <th>{{ __('Image') }}</th>
                                                <th>{{ __('Approval') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th class="text-center">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($articles as $key => $article)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $article->title }}</td>
                                                    <td>{{ $article->page_title }}</td>
                                                    <td>{{ $article->meta_desc }}</td>
                                                    <td>
                                                        @if ($article->image)
                                                            <img src="{{ asset('storage/' . $article->image) }}"
                                                                alt="Article Image" class="img-thumbnail" width="50">
                                                        @else
                                                            {{ __('No Image') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <select class="form-control approval-select"
                                                            onchange="updateBlogArticleApproval({{ $article->id }}, this.value)"
                                                            data-id="{{ $article->id }}">
                                                            <option value="Pending"
                                                                {{ $article->approval == 'Pending' ? 'selected' : '' }}>
                                                                {{ __('Pending') }}
                                                            </option>
                                                            <option value="Approved"
                                                                {{ $article->approval == 'Approved' ? 'selected' : '' }}>
                                                                {{ __('Approved') }}
                                                            </option>
                                                            <option value="Failed"
                                                                {{ $article->approval == 'Failed' ? 'selected' : '' }}>
                                                                {{ __('Failed') }}
                                                            </option>
                                                        </select>
                                                    </td>


                                                    <td>
                                                        <input class="change-status"
                                                            data-url="{{ route('article.updateStatus') }}"
                                                            data-id="{{ $article->id }}" type="checkbox"
                                                            {{ $article->status == 1 ? 'checked' : '' }}
                                                            data-toggle="toggle" data-on="{{ __('Active') }}"
                                                            data-off="{{ __('Inactive') }}" data-onstyle="success"
                                                            data-offstyle="danger"
                                                            onchange="updateCourseStatus({{ $article->id }}, this.checked ? 1 : 0)">
                                                    </td>


                                                    <td class="text-center">
                                                        <a href="{{ route('blog.article.update', ['id' => $article->id]) }}"
                                                            class="btn btn-warning btn-sm"><i class="fa fa-edit"
                                                                aria-hidden="true"></i></a>
                                                        <a href="javascript:;" class="btn btn-danger btn-sm"
                                                            data-toggle="modal" data-target="#deleteModal"
                                                            onclick="setDeleteUrl('{{ route('blog.article.delete', ['id' => $article->id]) }}')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">
                                                        {{ __('No Blog Articles Found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{-- Pagination --}}
                                    {{ $articles->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('Delete Article') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this Article?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <!-- Dynamically set href for the delete action -->
                    <a href="javascript:;" class="btn btn-danger" id="confirmDeleteBtn">{{ __('Delete') }}</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Function to set the delete URL in the modal
        function setDeleteUrl(url) {
            document.getElementById('confirmDeleteBtn').setAttribute('href', url);
        }
    </script>
    <script src="{{ asset('backend/js/sweetalert.js') }}"></script>


    <script>
        function updateBlogArticleApproval(articleId, newApproval) {
            fetch('{{ route('blog-articles.updateApproval') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        article_id: articleId,
                        approval: newApproval
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        console.error('Failed to update approval status');
                    } else {
                        console.log('Approval status updated successfully');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
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
        function updateCourseStatus(courseId, newStatus) {
            fetch('{{ route('article.updateStatus') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        article_id: courseId,
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        console.error('Failed to update status');
                    } else {
                        console.log('Status updated successfully');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
