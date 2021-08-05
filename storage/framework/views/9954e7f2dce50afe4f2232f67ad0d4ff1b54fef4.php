

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
            <form action="<?php echo e(url('/admin/page/'.$page->id)); ?>" method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <?php echo method_field('PUT'); ?>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputTitle">Title</label>
                  <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Enter title"
                    value="<?php echo e($page->title); ?>">
                </div>

                <div class="form-group">
                  <label for="inputMeta">Meta Description</label>
                  <textarea name="meta_desc" id="inputMeta" rows="3"
                    class="form-control"><?php echo e($page->meta_desc); ?></textarea>
                </div>

                <div class="form-group">
                  <label for="inputPageName">Page Name</label>
                  <input type="text" name="page_name" class="form-control" id="inputPageName"
                    placeholder="Enter page name" value="<?php echo e($page->page_name); ?>">
                </div>

                <div class="form-group">
                  <label for="editor">Page Description</label>
                  <textarea name="page_desc" id="editor" rows="3" class="form-control"><?php echo e($page->page_desc); ?></textarea>
                </div>

                <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <select class="form-control" name="status" id="inputStatus">
                    <option value="1" <?php if($page->status == 1): ?> <?php echo e(__('selected')); ?> <?php endif; ?>>Active</option>
                    <option value="0" <?php if($page->status == 0): ?> <?php echo e(__('selected')); ?> <?php endif; ?>>Deactive</option>
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
<?php echo $__env->make('dashboard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\lara_cms\resources\views/dashboard/site_pages/edit.blade.php ENDPATH**/ ?>