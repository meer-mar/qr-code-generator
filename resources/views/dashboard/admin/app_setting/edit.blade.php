@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit App Settings')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Hi Admin Welcome Back</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">App Settings</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- Messages -->
          @include('dashboard.admin.includes.messages')

          <!-- general form elements -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">App Settings</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ secure_url('/admin/app-setting/'.$setting->id) }}" method="POST"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">App name</label>
                  <input type="text" name="name" value="{{ $setting->name }}" class="form-control" id="inputName"
                    placeholder="Enter app name">
                </div>
                <div class="form-group">
                  <label for="inputFile">Logo</label><br>
                  <figure class="figure">
                    <img src="{{ url('/storage/settings/'.$setting->logo) }}"
                      class="figure-img img-fluid rounded img-thumbnail" alt="Profile photo" width="100">
                  </figure>
                  <input type="file" name="logo" class="form-control" id="inputFile">
                  <input type="hidden" name="logo2" value="{{ $setting->logo }}">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('/admin/') }}" class="btn btn-default float-right">Cancel</a>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection

@section('bottom_script')

@endsection