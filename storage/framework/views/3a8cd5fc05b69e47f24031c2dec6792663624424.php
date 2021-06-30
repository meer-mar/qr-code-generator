

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
            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/users')); ?>">Users</a></li>
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
          <?php echo $__env->make('dashboard.includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <!-- general form elements -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Edit User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="<?php echo e(url('/admin/user/'.$user->id)); ?>" method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <?php echo method_field('PUT'); ?>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Full name</label>
                  <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control" id="inputName"
                    placeholder="Enter full name">
                </div>
                <div class="form-group">
                  <label for="inputEmail">Email address</label>
                  <input type="email" name="email" value="<?php echo e($user->email); ?>" class="form-control" id="inputEmail"
                    placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="inputPassword">Password</label>
                  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="inputFile">Profile photo</label><br>
                  <figure class="figure">
                    <img src="<?php echo e(url('/storage/user_profile_photos/'.$user->profile_photo)); ?>"
                      class="figure-img img-fluid rounded img-thumbnail" alt="Profile photo">
                  </figure>
                  <input type="file" name="profile_photo" class="form-control" id="inputFile">
                </div>
                <div class="form-group">
                  <label for="inputRole">Role</label>
                  <select class="form-control" name="role" id="inputRole">
                    <option value="1" <?php if($user->role == 1): ?> <?php echo e('Selected '); ?> <?php endif; ?>>Administrator</option>
                    <option value="2" <?php if($user->role == 2): ?> <?php echo e('Selected '); ?> <?php endif; ?>>User</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <select class="form-control" name="status" id="inputStatus">
                    <option value="1" <?php if($user->status == 1): ?> <?php echo e('Selected '); ?> <?php endif; ?>>Active</option>
                    <option value="2" <?php if($user->status == 2): ?> <?php echo e('Selected '); ?> <?php endif; ?>>Deactive</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo e(url('/admin/users')); ?>" class="btn btn-default float-right">Cancel</a>
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
<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\lara_cms\resources\views/dashboard/user/edit.blade.php ENDPATH**/ ?>