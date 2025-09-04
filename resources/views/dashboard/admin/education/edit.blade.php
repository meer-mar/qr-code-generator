@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Edit Education Records') }}</title>
@endsection

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Edit Education Records') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Edit Education Records') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Edit Education Records') }}</h4>
                        </div>
                        <div class="card-body">
                            @include('dashboard.admin.includes.messages')
                            <form action="{{ route('education.update', ['userId' => $userId]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div id="education-records-container">
                                    @foreach($educationRecords as $index => $record)
                                        <div class="education-record">
                                            <h5>{{ __('Education Record') }} {{ $index + 1 }}</h5>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="organization">{{ __('Organization') }}</label>
                                                    <input type="text" name="education[{{ $index }}][organization]" class="form-control" value="{{ $record->organization }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="degree">{{ __('Degree') }}</label>
                                                    <input type="text" name="education[{{ $index }}][degree]" class="form-control" value="{{ $record->degree }}" required>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="start_date">{{ __('Start Date') }}</label>
                                                    <input type="date" name="education[{{ $index }}][start_date]" class="form-control" value="{{ $record->start_date }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="end_date">{{ __('End Date') }}</label>
                                                    <input type="date" name="education[{{ $index }}][end_date]" class="form-control" value="{{ $record->end_date }}">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="current">{{ __('Currently Enrolled?') }}</label>
                                                    <select name="education[{{ $index }}][current]" class="form-control" required>
                                                        <option value="1" {{ $record->current ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                                        <option value="0" {{ !$record->current ? 'selected' : '' }}>{{ __('No') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger remove-record-button">{{ __('Remove') }}</button>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <button type="button" id="add-record-button" class="btn btn-success">{{ __('Add Another Record') }}</button>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    let recordIndex = {{ count($educationRecords) }};

    document.getElementById('add-record-button').addEventListener('click', function () {
        const container = document.getElementById('education-records-container');
        const newRecord = `
            <div class="education-record">
                <h5>{{ __('Education Record') }} ${recordIndex + 1}</h5>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="organization">{{ __('Organization') }}</label>
                        <input type="text" name="education[${recordIndex}][organization]" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="degree">{{ __('Degree') }}</label>
                        <input type="text" name="education[${recordIndex}][degree]" class="form-control" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="start_date">{{ __('Start Date') }}</label>
                        <input type="date" name="education[${recordIndex}][start_date]" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="end_date">{{ __('End Date') }}</label>
                        <input type="date" name="education[${recordIndex}][end_date]" class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="current">{{ __('Currently Enrolled?') }}</label>
                        <select name="education[${recordIndex}][current]" class="form-control" required>
                            <option value="1">{{ __('Yes') }}</option>
                            <option value="0">{{ __('No') }}</option>
                        </select>
                    </div>
                </div>
                <button type="button" class="btn btn-danger remove-record-button">{{ __('Remove') }}</button>
                <hr>
            </div>`;
        container.insertAdjacentHTML('beforeend', newRecord);
        recordIndex++;
    });

    document.getElementById('education-records-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-record-button')) {
            e.target.closest('.education-record').remove();
        }
    });
});
</script>
@endsection
