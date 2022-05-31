@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Role')

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
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ secure_url('/admin/roles-permissions') }}">Roles</a></li>
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
              <h3 class="card-title">Edit Role</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('role.update', $role->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Role Name</label>
                  <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter role name"
                    value="{{ $role->name }}">
                </div>

                <div class="form-group">
                  <label for="inputLevel">Level</label>
                  <select class="form-control" name="level" id="inputLevel">
                    <option value="0" @if($role->level === 0) {{ __('selected') }} @endif>Level 0</option>
                    <option value="1" @if($role->level === 1) {{ __('selected') }} @endif>Level 1</option>
                    <option value="2" @if($role->level === 2) {{ __('selected') }} @endif>Level 2</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="inputDescription">Description</label>
                  <textarea name="description" id="inputDescription" rows="3"
                    class="form-control">{{ $role->description }}</textarea>
                </div>

                <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <select class="form-control" name="status" id="inputStatus">
                    <option value="1" @if($role->status === 1) {{ __('selected') }} @endif>Active</option>
                    <option value="0" @if($role->status === 0) {{ __('selected') }} @endif>Deactive</option>
                  </select>
                </div>

                <h4>Permissions</h4>
                <div class="form-group">
                  @forelse ($permissions as $permission)
                  <div class="form-check">
                    <input class="form-check-input" name="permissions[]" type="checkbox" {{
                      ($role->checkPermission($permission)) ?
                    'checked': ''}} value="{{ $permission->id }}">
                    <label class="form-check-label">{{ $permission->name }}</label>
                  </div>
                  @empty
                  <p class="text-center">Permission Not Found</p>
                  @endforelse
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('/admin/roles-permissions') }}" class="btn btn-default float-right">Cancel</a>
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