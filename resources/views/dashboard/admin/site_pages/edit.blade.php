@extends('dashboard.admin.layouts.app')
@section('title')
    <title>{{ __('Edit Page') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Page') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/admin') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('/admin/pages') }}">{{ __('Pages') }}</a></div>
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
                                        <form action="{{ url('/admin/page/' . $page->id) }}" method="POST"
                                            enctype="multipart/form-data" class="instructor__profile-form">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputTitle">{{ __('Title') }} <code>*</code></label>
                                                        <input type="text" name="title" class="form-control"
                                                            id="inputTitle" value="{{ $page->title }}"
                                                            placeholder="{{ __('Enter title') }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputMeta">{{ __('Meta Description') }}</label>
                                                        <textarea name="meta_desc" id="inputMeta" rows="3" class="form-control" required>{{ $page->meta_desc }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputPageName">{{ __('Page Name') }}
                                                            <code>*</code></label>
                                                        <input type="text" name="page_name" class="form-control"
                                                            id="inputPageName" value="{{ $page->page_name }}"
                                                            placeholder="{{ __('Enter page name') }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputSlug">{{ __('Slug') }} <code>*</code></label>
                                                        <input type="text" name="slug" class="form-control"
                                                            id="inputSlug" value="{{ $page->slug }}"
                                                            placeholder="{{ __('Enter slug') }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="editor">{{ __('Page Description') }}</label>
                                                        <textarea name="page_desc" id="editor" rows="3" class="text-editor form-control" required>{{ $page->page_desc }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputStatus">{{ __('Status') }} <code>*</code></label>
                                                        <select class="form-control select2" name="status" id="inputStatus"
                                                            required>
                                                            <option value="1"
                                                                @if ($page->status == 1) selected @endif>
                                                                {{ __('Active') }}</option>
                                                            <option value="0"
                                                                @if ($page->status == 0) selected @endif>
                                                                {{ __('Inactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Sections -->
                                                <div class="col-md-12">
                                                    <label>{{ __('Sections') }}</label>
                                                    <div id="sections-wrapper">
                                                        @foreach ($page->sections as $index => $section)
                                                            <div class="section-item mb-3">
                                                                <input type="text"
                                                                    name="sections[{{ $index }}][title]"
                                                                    class="form-control mb-2"
                                                                    value="{{ $section->section_title }}"
                                                                    placeholder="Section Title" required>
                                                                <textarea name="sections[{{ $index }}][content]" class="form-control mb-2" placeholder="Section Content"
                                                                    required>{{ $section->section_content }}</textarea>
                                                                <button type="button"
                                                                    class="btn btn-danger remove-section">Remove</button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button type="button" id="add-section"
                                                        class="btn btn-secondary mt-2">Add Section</button>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                            <a href="{{ url('/admin/pages') }}"
                                                class="btn btn-default float-right">{{ __('Cancel') }}</a>
                                        </form>

                                        <script>
                                            let sectionCount = {{ $page->sections->count() }}; // Start from existing count

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
