

<?php $__env->startSection('page_title', 'Add Role'); ?>

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
            <li class="breadcrumb-item"><a href="<?php echo e(secure_url('/admin/roles-permissions')); ?>">Roles</a></li>
            <li class="breadcrumb-item active">Add</li>
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
          <?php echo $__env->make('dashboard.admin.includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <!-- general form elements -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Add Role</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="<?php echo e(route('role.save')); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Role Name</label>
                  <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter role name">
                </div>

                <div class="form-group">
                  <label for="inputLevel">Level</label>
                  <select class="form-control" name="level" id="inputLevel">
                    <option value="0">Level 0</option>
                    <option value="1">Level 1</option>
                    <option value="2">Level 2</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="inputDescription">Description</label>
                  <textarea name="description" id="inputDescription" rows="3" class="form-control"></textarea>
                </div>

                <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <select class="form-control" name="status" id="inputStatus">
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?php echo e(url('/admin/roles-permissions')); ?>" class="btn btn-default float-right">Cancel</a>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bottom_script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\lara_cms\resources\views/dashboard/admin/role/add.blade.php ENDPATH**/ ?>