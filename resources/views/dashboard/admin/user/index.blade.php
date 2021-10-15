@extends('dashboard.admin.layouts.app')

@section('page_title', 'Users')

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
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- Messages -->
          @include('dashboard.admin.includes.messages')

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manage Users</h3>
              <div class="card-tools">
                <a href="{{ secure_url('/admin/user/add') }}" class="btn btn-primary">
                  <i class="fa fa-user mr-2"></i> Register new user
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $key=>$user)
                  <tr>
                    <td>{{ ++$key }}. </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      @foreach ($user->getRoles() as $role)
                      {{ $role->slug }}
                      @endforeach
                    </td>
                    <td>
                      @if ($user->status == 1)
                      <span class="badge bg-success">{{ __('Active') }}</span>
                      @else
                      <span class="badge bg-danger">{{ __('Deactive') }}</span>
                      @endif
                    </td>
                    <td style="width: 11rem">
                      <a href="{{ secure_url('/admin/user/edit/'.$user->id) }}" class="btn btn-info btn-sm"><i
                          class="fas fa-edit mr-2"></i> Edit</a>

                      <a href="{{ secure_url('/admin/user/delete/'.$user->id) }}" class="btn btn-danger btn-sm"><i
                          class="fa fa-trash mr-2"></i> Delete</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection

@section('bottom_script')
<script src="{{ asset('admin_dashboard/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/js/responsive.bootstrap4.min.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    });
  });
</script>
@endsection