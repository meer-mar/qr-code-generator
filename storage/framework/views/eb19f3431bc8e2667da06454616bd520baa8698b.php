

<?php $__env->startSection('page_title', 'Edit Website Settings'); ?>

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
          <?php echo $__env->make('dashboard.admin.includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <!-- general form elements -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Web Settings</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="<?php echo e(secure_url('/admin/web-setting/'.$webSettings->id)); ?>" method="POST"
              enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <?php echo method_field('PUT'); ?>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Website Title</label>
                  <input type="text" name="site_title" value="<?php echo e($webSettings->site_title); ?>" class="form-control"
                    id="inputName" placeholder="Enter site title">
                </div>

                <div class="form-group">
                  <label for="inputDesc">Meta Description</label>
                  <textarea name="meta_description" id="inputDesc" rows="3"
                    class="form-control"><?php echo e($webSettings->meta_description); ?></textarea>
                </div>

                <div class="form-group">
                  <label for="inputFile">Logo</label><br>
                  <figure class="figure">
                    <img src="<?php echo e(url('/storage/settings/'.$webSettings->logo)); ?>"
                      class="figure-img img-fluid rounded img-thumbnail" alt="Profile photo" width="300">
                  </figure>
                  <input type="file" name="logo" class="form-control" id="inputFile">
                  <input type="hidden" name="logo2" value="<?php echo e($webSettings->logo); ?>">
                </div>

                <div class="form-group">
                  <label for="inputName">Website Url</label>
                  <input type="text" name="site_url" value="<?php echo e($webSettings->site_url); ?>" class="form-control"
                    id="inputName" placeholder="https://www.sitename.com/">
                </div>

                <div class="form-group">
                  <label for="inputStatus">Site Status</label>
                  <select class="form-control" name="status" id="inputStatus">
                    <option value="1" <?php if($webSettings->status == 1): ?> <?php echo e(__('selected')); ?> <?php endif; ?>>Active</option>
                    <option value="0" <?php if($webSettings->status == 2): ?> <?php echo e(__('selected')); ?> <?php endif; ?>>Deactive</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo e(url('/admin/')); ?>" class="btn btn-default float-right">Cancel</a>
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
<?php echo $__env->make('dashboard.admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\lara_cms\resources\views/dashboard/admin/web_setting/edit.blade.php ENDPATH**/ ?>