@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('Add Multiple Education Records') }}</title>
@endsection

@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Add Multiple Education Records') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Add Multiple Education Records') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Add New Education Records') }}</h4>
                        </div>
                        <div class="card-body">
                            @include('dashboard.admin.includes.messages')
                            <form action="{{ route('education.store') }}" method="POST">
                                @csrf
                                <div id="education-records-container">
                                    <div class="education-record">
                                        <h5>{{ __('Education Record 1') }}</h5>
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="organization">{{ __('Organization') }}</label>
                                                <input type="text" name="education[0][organization]" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="degree">{{ __('Degree') }}</label>
                                                <input type="text" name="education[0][degree]" class="form-control" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="start_date">{{ __('Start Date') }}</label>
                                                <input type="date" name="education[0][start_date]" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="end_date">{{ __('End Date') }}</label>
                                                <input type="date" name="education[0][end_date]" class="form-control">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="current">{{ __('Currently Enrolled?') }}</label>
                                                <select name="education[0][current]" class="form-control" required>
                                                    <option value="1">{{ __('Yes') }}</option>
                                                    <option value="0">{{ __('No') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" id="add-record-button" class="btn btn-success">{{ __('Add Another Record') }}</button>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">{{ __('Save All') }}</button>
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
        let recordIndex = 1;

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
