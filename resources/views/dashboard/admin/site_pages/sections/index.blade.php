@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Page Sections') }}</title>
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
                <h1>{{ __('Page Sections') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Page Sections') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <!-- Sidebar with Sections -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- Add New Section Button -->
                                <div class="mb-3">
                                    <a href="{{ route('sections.create', $page->id) }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add New Section
                                    </a>
                                </div>
                                <ul class="nav nav-pills flex-column" id="sectionTabs" role="tablist">
                                    @foreach ($page->sections as $index => $section)
                                        <li class="nav-item">
                                            <div class="d-flex align-items-center p-2 border rounded mb-2">
                                                <!-- Section Title -->
                                                <a class="nav-link section-tab {{ $index == 0 ? 'active' : '' }} flex-grow-1"
                                                    data-section-id="{{ $section->id }}" href="#">
                                                    {{ $section->section_title }}
                                                </a>
                                                <!-- Edit Icon -->
                                                <a href="{{ route('sections.edit', $section->id) }}"
                                                    class="text-primary ms-2" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- Remove Icon -->
                                                <form action="{{ route('section.delete', $section->id) }}" method="POST"
                                                    class="d-inline ms-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        style="margin-left:4px;margin-top:15px;"class="btn btn-link text-danger p-0"
                                                        title="Remove"
                                                        onclick="return confirm('Are you sure you want to delete this section?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Section Content Display -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body" id="sectionContent">
                                <h5 class="text-center text-muted">Select a section to view or create content</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Highlight the active section tab
            document.querySelectorAll('.section-tab').forEach(tab => {
                tab.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Remove 'active' class from all tabs
                    document.querySelectorAll('.section-tab').forEach(t => {
                        t.classList.remove('active');
                    });

                    // Add 'active' class to the clicked tab
                    this.classList.add('active');

                    // Load section content
                    let sectionId = this.getAttribute('data-section-id');

                    if (!sectionId) {
                        console.error("Section ID is missing.");
                        return;
                    }

                    let url = `/admin/get-section-content/${sectionId}`;
                    let contentContainer = document.getElementById('sectionContent');
                    contentContainer.innerHTML =
                        '<p class="text-center text-info">Loading content...</p>';

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error || data.length === 0) {
                                contentContainer.innerHTML = `
                                <form id="create-section-form" method="POST" action="/admin/section-content/store/${sectionId}" enctype="multipart/form-data">
                                    @csrf
                                    <div id="dynamic-fields">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Short Title</label>
                                            <input type="text" name="short_title" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                                            <img src="#" alt="Image Preview" class="img-preview mt-2" style="display: none; max-width: 100px;">
                                        </div>
                                    </div>
                                    <button type="button" id="add-new-field-btn" class="btn btn-secondary mt-2">Add New Field</button>
                                    <input type="hidden" name="content_data" id="content_data">
                                    <button type="submit" class="btn btn-success mt-3">Save Content</button>
                                </form>
                            `;

                                setupDynamicFieldHandler();
                                return;
                            }

                            let content = data[0];
                            let parsedData = typeof content.content_data === 'string' ? JSON
                                .parse(content.content_data) : content.content_data;

                            delete parsedData.page_section_id;
                            delete parsedData.alsaesh;

                            let dynamicFieldsHTML = '';
                            Object.keys(parsedData).forEach(field => {
                                if (!['title', 'short_title', 'description', 'image']
                                    .includes(field)) {
                                    dynamicFieldsHTML += `
                                    <div class="form-group">
                                        <label>${field}</label>
                                        <input type="text" name="${field}" class="form-control" value="${parsedData[field]}">
                                        <button type="button" class="btn btn-danger btn-sm remove-field">Remove</button>
                                    </div>
                                `;
                                }
                            });

                            contentContainer.innerHTML = `
                            <form id="edit-section-form" method="POST" action="/admin/section-content/update/${content.id}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div id="dynamic-fields">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" value="${parsedData.title || ''}">
                                    </div>
                                    <div class="form-group">
                                        <label>Short Title</label>
                                        <input type="text" name="short_title" class="form-control" value="${parsedData.short_title || ''}">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control">${parsedData.description || ''}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                                        <br>
                                        ${parsedData.image ? `<img src="/storage/${parsedData.image}" class="img-fluid" width="100">` : ''}
                                    </div>
                                    ${dynamicFieldsHTML}
                                </div>
                                <button type="button" id="add-new-field-btn" class="btn btn-secondary mt-2">Add New Field</button>
                                <input type="hidden" name="content_data" id="content_data">
                                <button type="submit" class="btn btn-primary mt-3">Update Content</button>
                            </form>
                        `;

                            setupDynamicFieldHandler();
                        })
                        .catch(error => {
                            console.error("Fetch error:", error);
                            contentContainer.innerHTML =
                                `<p class="text-danger">Failed to load content.</p>`;
                        });
                });
            });

            // Function to handle dynamic fields
            function setupDynamicFieldHandler() {
                document.getElementById('add-new-field-btn').addEventListener('click', function() {
                    let fieldName = prompt('Enter field name (e.g., "button_text", "video_url")');
                    if (!fieldName) return;

                    let fieldType = prompt('Enter field type (text, url, email, file, number, etc.)',
                        'text');
                    if (!fieldType) return;

                    let acceptedTypes = ['text', 'url', 'email', 'file', 'number'];
                    if (!acceptedTypes.includes(fieldType)) {
                        alert('Invalid field type. Using "text" by default.');
                        fieldType = 'text';
                    }

                    let fieldContainer = document.createElement('div');
                    fieldContainer.classList.add('form-group');

                    if (fieldType === 'file') {
                        fieldContainer.innerHTML = `
                        <label>${fieldName}</label>
                        <input type="file" class="form-control" name="${fieldName}" accept="image/*" onchange="previewImage(event)">
                        <img src="#" alt="Image Preview" class="img-preview mt-2" style="display: none; max-width: 100px;">
                        <button type="button" class="btn btn-danger btn-sm remove-field mt-2">Remove</button>
                    `;
                    } else {
                        fieldContainer.innerHTML = `
                        <label>${fieldName}</label>
                        <input type="${fieldType}" class="form-control" name="${fieldName}">
                        <button type="button" class="btn btn-danger btn-sm remove-field">Remove</button>
                    `;
                    }

                    document.getElementById('dynamic-fields').appendChild(fieldContainer);
                });

                // Remove field handler
                document.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-field')) {
                        event.target.parentElement.remove();
                    }
                });

                // Form submission handler
                document.querySelectorAll('form').forEach(form => {
                    form.addEventListener('submit', function(event) {
                        const formData = new FormData(this);
                        const jsonData = {};

                        formData.forEach((value, key) => {
                            if (value && key !== 'page_section_id' && key !== 'alsaesh' &&
                                key !== 'image') {
                                jsonData[key] = value;
                            }
                        });

                        document.getElementById('content_data').value = JSON.stringify(jsonData);
                    });
                });
            }

            // Function to preview image after selection
            window.previewImage = function(event) {
                const input = event.target;
                const imgPreview = input.parentElement.querySelector('.img-preview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgPreview.src = e.target.result;
                        imgPreview.style.display = 'block';
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    imgPreview.src = '#';
                    imgPreview.style.display = 'none';
                }
            };
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
