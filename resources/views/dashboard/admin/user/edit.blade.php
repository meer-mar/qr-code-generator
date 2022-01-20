@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit User')

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
            <li class="breadcrumb-item"><a href="{{ url('/admin/users') }}">Users</a></li>
            <li class="breadcrumb-item active">Edit</li>
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
              <h3 class="card-title">Edit User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('/admin/user/'.$user->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Full name</label>
                  <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="inputName"
                    placeholder="Enter full name">
                </div>
                <div class="form-group">
                  <label for="inputEmail">Email address</label>
                  <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="inputEmail"
                    placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="inputPassword">Password</label>
                  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="inputFile">Profile photo</label><br>
                  <figure class="figure">
                    <img src="{{ url('/storage/user_profile_photos/'.$user->profile_photo) }}"
                      class="figure-img img-fluid rounded img-thumbnail" alt="Profile photo">
                  </figure>
                  <input type="file" name="profile_photo" class="form-control" id="inputFile">
                </div>
                <div class="form-group">
                  <label for="inputRole">Role</label>
                  <select class="form-control" name="role" id="inputRole">
                    @if (count($roles) > 0)
                    @foreach ($roles as $role)
                    <option value="{{ $role['id'] }}" {{ ($user->hasRole($role->id)) ? 'selected' : '' }}>{{
                      $role['name'] }}
                    </option>
                    @endforeach
                    @else
                    <option value="0">No role available</option>
                    @endif
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <select class="form-control" name="status" id="inputStatus">
                    <option value="1" @if($user->status == 1) {{ 'Selected '}} @endif>Active</option>
                    <option value="0" @if($user->status == 0) {{ 'Selected '}} @endif>Deactive</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('/admin/users') }}" class="btn btn-default float-right">Cancel</a>
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