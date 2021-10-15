<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3"><?php echo e($title); ?></h1>
      <p>Welcome to my first project</p>
      <p>
        <a class="btn btn-primary btn-lg" href="<?php echo e(route('login')); ?>" role="button">Login</a>
        <a class="btn btn-success btn-lg" href="<?php echo e(route('register')); ?>" role="button">Register</a>
      </p>
    </div>
  </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH D:\laragon\www\lara_cms\resources\views/pages/index.blade.php ENDPATH**/ ?>