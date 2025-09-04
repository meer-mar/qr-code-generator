@extends('dashboard.admin.layouts.app')
@section('title')
    <title>{{ __('Add Section') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="text-primary">{{ __('Add Section to') }} {{ $page->page_name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/admin') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ url('/admin/pages') }}">{{ __('Pages') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Add Section') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('sections.store', $page->id) }}" method="POST">
                            @csrf

                            <div id="sections-wrapper">
                                <div class="section-item mb-3">
                                    <input type="text" name="sections[0][title]" class="form-control mb-2"
                                        placeholder="Section Title" required>
                                    <textarea name="sections[0][content]" class="form-control mb-2" placeholder="Section Content" required></textarea>
                                    <input type="number" name="sections[0][sort_order]" class="form-control mb-2"
                                        placeholder="Sort Order" value="0">
                                    <select name="sections[0][status]" class="form-control mb-2">
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Inactive') }}</option>
                                    </select>
                                    <button type="button" class="btn btn-danger remove-section">Remove</button>
                                </div>
                            </div>

                            <button type="button" id="add-section" class="btn btn-secondary mt-2">Add Section</button>
                            <hr>
                            <button type="submit" class="btn btn-primary mt-3">{{ __('Save') }}</button>
                            <a href="{{ url('/admin/pages') }}"
                                class="btn btn-default float-right">{{ __('Cancel') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        let sectionCount = 1;

        document.getElementById('add-section').addEventListener('click', function() {
            const sectionWrapper = document.createElement('div');
            sectionWrapper.classList.add('section-item', 'mb-3');

            sectionWrapper.innerHTML = `
            <input type="text" name="sections[${sectionCount}][title]" class="form-control mb-2" placeholder="Section Title" required>
            <textarea name="sections[${sectionCount}][content]" class="form-control mb-2" placeholder="Section Content" required></textarea>
            <input type="number" name="sections[${sectionCount}][sort_order]" class="form-control mb-2" placeholder="Sort Order" value="0">
            <select name="sections[${sectionCount}][status]" class="form-control mb-2">
                <option value="1">{{ __('Active') }}</option>
                <option value="0">{{ __('Inactive') }}</option>
            </select>
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
@endsection
