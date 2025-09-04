@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Blog Categories') }}</title>
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
                <h1>{{ __('Blog Categories') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Blog Categories List') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    {{-- Blog Categories Table --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Blog Categories List') }}</h4>
                                <div>
                                    <a href="{{ route('blog.category.create') }}" class="btn btn-primary">
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
                                                <th>{{ __('Image') }}</th>
                                                <th>{{ __('Approval') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th class="text-center">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($categories as $key => $category)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $category->title }}</td>
                                                    <td>
                                                        @if ($category->image)
                                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                                alt="Category Image" class="img-thumbnail" width="50">
                                                        @else
                                                            {{ __('No Image') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <select class="form-control approval-select"
                                                            onchange="updateBlogCategoryApproval({{ $category->id }}, this.value)">
                                                            <option value="Pending"
                                                                {{ $category->approval == 'Pending' ? 'selected' : '' }}>
                                                                {{ __('Pending') }}
                                                            </option>
                                                            <option value="Approved"
                                                                {{ $category->approval == 'Approved' ? 'selected' : '' }}>
                                                                {{ __('Approved') }}
                                                            </option>
                                                            <option value="Failed"
                                                                {{ $category->approval == 'Failed' ? 'selected' : '' }}>
                                                                {{ __('Failed') }}
                                                            </option>
                                                        </select>
                                                    </td>


                                                    <td>
                                                        <input class="change-status"
                                                            data-url="{{ route('blogCategory.updateStatus') }}"
                                                            data-id="{{ $category->id }}" type="checkbox"
                                                            {{ $category->status == 1 ? 'checked' : '' }}
                                                            data-toggle="toggle" data-on="{{ __('Active') }}"
                                                            data-off="{{ __('Inactive') }}" data-onstyle="success"
                                                            data-offstyle="danger"
                                                            onchange="updateBlogCategoryStatus({{ $category->id }}, this.checked ? 1 : 0)">
                                                    </td>


                                                    <td class="text-center">
                                                        <a href="{{ route('blog.article.view', ['id' => $category->id]) }}"
                                                            class="btn btn-info btn-sm">
                                                            Articles </a>
                                                        <a href="{{ route('blog.category.update', $category->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="javascript:;" class="btn btn-danger btn-sm"
                                                            data-toggle="modal" data-target="#deleteModal"
                                                            onclick="setDeleteUrl('{{ route('blog.category.delete', ['id' => $category->id]) }}')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>


                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">
                                                        {{ __('No Blog Categories Found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{-- Pagination --}}
                                    {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Delete Modal -->
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" id="deleteForm">
            @csrf
            @method('DELETE')

            <input type="hidden" name="action" id="deleteAction">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('Delete Blog Category') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to delete this blog category?</p>
                    <p class="text-danger">You can either delete all related articles or move them to the "Uncategorized" category.</p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="deleteOption" id="deleteAll" value="delete" checked>
                        <label class="form-check-label" for="deleteAll">
                            Delete all related articles
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="deleteOption" id="moveArticles" value="move">
                        <label class="form-check-label" for="moveArticles">
                            Move articles to "Uncategorized"
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Set the form action dynamically based on the delete button
    function setDeleteUrl(url) {
        document.getElementById('deleteForm').setAttribute('action', url);
    }

    // On submit, add the selected delete option to the hidden input
    document.getElementById('deleteForm').addEventListener('submit', function (e) {
        let selectedOption = document.querySelector('input[name="deleteOption"]:checked').value;
        document.getElementById('deleteAction').value = selectedOption;
    });
</script>

    <script src="{{ asset('backend/js/sweetalert.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <!--Status Update-->

    <script>
        function updateBlogCategoryStatus(blogCategoryId, newStatus) {
            fetch('{{ route('blogCategory.updateStatus') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        blog_category_id: blogCategoryId,
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




    <script>
        function updateBlogCategoryApproval(blogCategoryId, newApproval) {
            fetch('{{ route('blogCategory.updateApproval') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        blog_category_id: blogCategoryId,
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
@endsection
