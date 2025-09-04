@extends('dashboard.admin.layouts.app')

@section('page_title', 'Manage Sliders')

@section('head_style')
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('admin_dashboard/assets/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_dashboard/assets/css/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_dashboard/assets/css/buttons.bootstrap4.css') }}">
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
                <h1>{{ __('Manage Sliders') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Manage Sliders') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Slider List') }}</h4>
                                <div>
                                    <a href="{{ route('sliders.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> {{ __('Add New Slider') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive max-h-400">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('#') }}</th>
                                                <th>{{ __('Article Title') }}</th>
                                                <th>{{ __('Custom Title') }}</th>
                                                <th>{{ __('Priority') }}</th>
                                                <th>{{ __('Image') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th class="text-center">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sliders as $key => $slider)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $slider->article->title }}</td>
                                                    <td>{{ $slider->custom_title ?? 'Default Title' }}</td>
                                                    <td>{{ $slider->priority }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $slider->image) }}"
                                                            alt="Slider Image" class="img-thumbnail" width="50">
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $slider->is_active ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $slider->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('sliders.edit', $slider->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="javascript:;" class="btn btn-danger btn-sm"
                                                            data-toggle="modal" data-target="#deleteModal"
                                                            onclick="setDeleteUrl('{{ route('sliders.destroy', ['id' => $slider->id]) }}')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
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
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('Delete Blog Slider') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this Blog Slider?') }}
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
        function setDeleteUrl(url) {
            document.getElementById('confirmDeleteBtn').setAttribute('href', url);
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


@section('bottom_script')
    <script src="{{ asset('admin_dashboard/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/assets/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/assets/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $('#slidersTable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });
    </script>
@endsection
