@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Add FAQs') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="text-primary">{{ __('Add FAQs') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item"><a href="{{ route('faqs.manage') }}">{{ __('FAQs') }}</a></div>
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
                                        <form action="{{ route('faqs.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="question">{{ __('Question') }} <code>*</code></label>
                                                        <input type="text" name="question" id="question"
                                                            class="form-control" placeholder="{{ __('Enter Question') }}"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="answer">{{ __('Answer') }} <code>*</code></label>
                                                        <textarea name="answer" id="editor" class="form-control" placeholder="{{ __('Enter Answer') }}" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit"
                                                onclick="this.form.submit();">{{ __('Submit') }}</button>

                                            <a href="{{ route('faqs.manage') }}"
                                                class="btn btn-secondary">{{ __('Cancel') }}</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
    <script>
        // CKEditor configuration //
        ClassicEditor.create(document.querySelector("#editor"))
            .then((editor) => {
                console.log(editor);
            })
            .catch((error) => {
                console.error(error);
            });
    </script>
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            alert('Form is submitting!');
        });
    </script>
@endsection
