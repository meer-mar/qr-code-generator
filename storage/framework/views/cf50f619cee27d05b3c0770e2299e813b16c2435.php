

<?php $__env->startSection('content'); ?>
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
            <li class="breadcrumb-item"><a href="<?php echo e(secure_url('/admin')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Roles & Permissions</li>
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
          <?php echo $__env->make('dashboard.includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manage Roles</h3>
              <div class="card-tools">
                <a href="<?php echo e(secure_url('admin/role/add')); ?>" class="btn btn-primary">
                  <i class="fa fa-user mr-2"></i> Add new role
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Permissions</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(count($roles) > 0): ?>
                  <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e(++$key); ?></td>
                    <td><?php echo e($role['name']); ?></td>
                    <td><?php echo e($role['level']); ?></td>
                    <td>

                    </td>
                    <td>
                      <?php if($role->status == 1): ?>
                      <span class="badge bg-success"><?php echo e(__('Active')); ?></span>
                      <?php else: ?>
                      <span class="badge bg-danger"><?php echo e(__('Deactive')); ?></span>
                      <?php endif; ?>
                    </td>
                    <td style="width: 11rem">
                      <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit mr-2"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i> Delete</a>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manage Permissions</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-primary">
                  <i class="fa fa-user mr-2"></i> Add new permission
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Desctiption</th>
                    <th>Roles</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="width: 11rem">
                      <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit mr-2"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i> Delete</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
              </ul>
            </div>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\lara_cms\resources\views/dashboard/pages/roles_permissions.blade.php ENDPATH**/ ?>