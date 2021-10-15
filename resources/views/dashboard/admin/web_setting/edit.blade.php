@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Website Settings')

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
            <li class="breadcrumb-item active">Web Settings</li>
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
              <h3 class="card-title">Web Settings</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ secure_url('/admin/web-setting/'.$webSettings->id) }}" method="POST"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Website Title</label>
                  <input type="text" name="site_title" value="{{ $webSettings->site_title }}" class="form-control"
                    id="inputName" placeholder="Enter site title">
                </div>

                <div class="form-group">
                  <label for="inputDesc">Meta Description</label>
                  <textarea name="meta_description" id="inputDesc" rows="3"
                    class="form-control">{{ $webSettings->meta_description }}</textarea>
                </div>

                <div class="form-group">
                  <label for="inputFile">Logo</label><br>
                  <figure class="figure">
                    <img src="{{ url('/storage/settings/'.$webSettings->logo) }}"
                      class="figure-img img-fluid rounded img-thumbnail" alt="Profile photo" width="300">
                  </figure>
                  <input type="file" name="logo" class="form-control" id="inputFile">
                  <input type="hidden" name="logo2" value="{{ $webSettings->logo }}">
                </div>

                <div class="form-group">
                  <label for="inputName">Website Url</label>
                  <input type="text" name="site_url" value="{{ $webSettings->site_url }}" class="form-control"
                    id="inputName" placeholder="https://www.sitename.com/">
                </div>

                <div class="form-group">
                  <label for="inputStatus">Site Status</label>
                  <select class="form-control" name="status" id="inputStatus">
                    <option value="1" @if($webSettings->status == 1) {{ __('selected') }} @endif>Active</option>
                    <option value="0" @if($webSettings->status == 2) {{ __('selected') }} @endif>Deactive</option>
                  </select>
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