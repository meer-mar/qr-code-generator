<?php if (isset($component)) { $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\GuestLayout::class, []); ?>
<?php $component->withName('guest-layout'); ?>
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
 <?php if (isset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015)): ?>
<?php $component = $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015; ?>
<?php unset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH E:\laragon\www\lara_cms\resources\views/pages/index.blade.php ENDPATH**/ ?>