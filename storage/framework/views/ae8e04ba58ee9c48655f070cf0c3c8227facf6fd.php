<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vmaxx</title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/index.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/reset.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/uploadify.css')); ?>" rel="stylesheet">
</head>
<body id="app-layout">
    <header>
        <div class="header-left">
            <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('image/logo.png')); ?>" alt=""></a>
        </div>
        <div class="header-right">
            <?php if(Auth::guest()): ?>
                <p></p>
                <span>
                    <a href="<?php echo e(url('/register')); ?>">Register</a> | <a href="<?php echo e(url('/login')); ?>">Login</a>
                </span>
            <?php else: ?>
                <p>Welcome <?php echo e(Auth::user()->name); ?></p>&nbsp;&nbsp;|&nbsp;
                <span><a href="<?php echo e(url('/setting')); ?>">Setting</a></span>&nbsp;&nbsp;|&nbsp;
                <span><a href="<?php echo e(url('/logout')); ?>">Logout</a></span>
            <?php endif; ?>
        </div>
    </header>

    <?php echo $__env->yieldContent('content'); ?>

    <?php $__env->startSection('pageEnd'); ?>
        <?php echo $__env->make('pageEnd', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldSection(); ?>
</body>
</html>
