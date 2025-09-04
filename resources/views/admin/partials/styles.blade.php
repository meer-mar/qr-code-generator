<link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-social.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/components.css') }}">

<link rel="stylesheet" href="{{ asset('global/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap4-toggle.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/dev.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/tagify.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/fontawesome-iconpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/clockpicker/dist/bootstrap-clockpicker.css') }}">
<link rel="stylesheet" href="{{ asset('backend/datetimepicker/jquery.datetimepicker.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/iziToast.min.css') }}">
<link rel="stylesheet" href="{{ asset('global/nice-select/nice-select.css') }}">
@if (session()->has('text_direction') && session()->get('text_direction') !== 'ltr')
    <link rel="stylesheet" href="{{ asset('backend/css/rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/dev_rtl.css') }}">
@endif
