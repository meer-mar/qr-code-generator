@extends('dashboard.admin.layouts.app')
@section('title')
    <title>Edit Section - {{ $section->section_title }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Section</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="">Sections</a></div>
                    <div class="breadcrumb-item active">Edit Section</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('sections.update', $section->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="section_title">Section Title <code>*</code></label>
                                <input type="text" name="section_title" class="form-control"
                                    value="{{ old('section_title', $section->section_title) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="section_content">Section Content <code>*</code></label>
                                <textarea name="section_content" class="form-control" rows="4" required>{{ old('section_content', $section->section_content) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="sort_order">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', $section->sort_order) }}">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $section->status ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$section->status ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Section</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
