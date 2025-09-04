@extends('dashboard.admin.layouts.app')
@section('title')
    <title>{{ __('Add Page') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Add Page') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/admin') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('/admin/pages') }}">{{ __('Pages') }}</a></div>
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
                                        <form action="{{ url('/admin/page/save') }}" method="POST"
                                            enctype="multipart/form-data" class="instructor__profile-form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputTitle">{{ __('Title') }} <code>*</code></label>
                                                        <input type="text" name="title" class="form-control"
                                                            id="inputTitle" placeholder="{{ __('Enter title') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputTitle">{{ __('Slug') }} <code>*</code></label>
                                                        <input type="text" name="slug" class="form-control"
                                                            id="inputslug" placeholder="{{ __('Enter slug') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputMeta">{{ __('Meta Description') }}</label>
                                                        <textarea name="meta_desc" id="inputMeta" rows="3" class="form-control" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputPageName">{{ __('Meta Title') }}
                                                            <code>*</code></label>
                                                        <input type="text" name="page_name" class="form-control"
                                                            id="inputPageName" placeholder="{{ __('Enter page name') }}"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="editor">{{ __('Page Description') }}</label>
                                                        <textarea name="page_desc" id="editor" rows="3" class="text-editor form-control"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputStatus">{{ __('Status') }} <code>*</code></label>
                                                        <select class="form-control select2" name="status" id="inputStatus"
                                                            required>
                                                            <option value="1">{{ __('Active') }}</option>
                                                            <option value="0">{{ __('Inactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Sections -->
                                                <div class="col-md-12">
                                                    <label>{{ __('Sections') }}</label>
                                                    <div id="sections-wrapper">
                                                        <!-- Initial Section -->
                                                        <div class="section-item mb-3">
                                                            <input type="text" name="sections[0][title]"
                                                                class="form-control mb-2" placeholder="Section Title"
                                                                required>
                                                            <textarea name="sections[0][content]" class="form-control mb-2" placeholder="Section Content" required></textarea>
                                                            <button type="button"
                                                                class="btn btn-danger remove-section">Remove</button>
                                                        </div>
                                                    </div>
                                                    <button type="button" id="add-section"
                                                        class="btn btn-secondary mt-2">Add Section</button>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                            <a href="{{ url('/admin/pages') }}"
                                                class="btn btn-default float-right">{{ __('Cancel') }}</a>
                                        </form>

                                        <script>
                                            let sectionCount = 1;

                                            document.getElementById('add-section').addEventListener('click', function() {
                                                const sectionWrapper = document.createElement('div');
                                                sectionWrapper.classList.add('section-item', 'mb-3');

                                                sectionWrapper.innerHTML = `
            <input type="text" name="sections[${sectionCount}][title]" class="form-control mb-2" placeholder="Section Title" required>
            <textarea name="sections[${sectionCount}][content]" class="form-control mb-2" placeholder="Section Content" required></textarea>
            <button type="button" class="btn btn-danger remove-section">Remove</button>
        `;

                                                document.getElementById('sections-wrapper').appendChild(sectionWrapper);
                                                sectionCount++;
                                            });

                                            document.addEventListener('click', function(e) {
                                                if (e.target.classList.contains('remove-section')) {
                                                    e.target.parentElement.remove();
                                                }
                                            });
                                        </script>
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
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector("#editor"))
            .then((editor) => {
                console.log(editor);
            })
            .catch((error) => {
                console.error(error);
            });
    </script>
@endpush
