<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title><?php if($webSettings): ?> <?php echo e($webSettings->site_title); ?> <?php else: ?> <?php echo e(config('app.name', 'Laravel')); ?> <?php endif; ?></title>

  <!-- Styles -->
  <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Scripts -->
  <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

</head>

<body>
  <div id="app">
    <?php echo $__env->make('includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="py-4">
      <div class="container">
        <?php echo e($slot); ?>

      </div>
    </main>
  </div>
</body>

</html><?php /**PATH D:\laragon\www\lara_cms\resources\views/layouts/app.blade.php ENDPATH**/ ?>