<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vmaxx</title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/reset.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/index.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/Response.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/image-crop-styles.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/goalProgress.css')); ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body id="app-layout">
<header class="insidePageHeader">
    <div class="insidePageHeaderLeft">
        <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('image/vmaxx_newlogo.png')); ?>" alt=""></a>
    </div>
    <div class="insidePageHeaderRight">
        <?php if(Auth::guest()): ?>
            <p></p>
            <span>
                    <a class="inside-page-header-register" id="header-register">Register</a>&numsp;&numsp;|&numsp; &numsp;<a class="header-login" id="header-login">Login</a>
                </span>
        <?php else: ?>
            <p>Welcome, <?php echo e(Auth::user()->name); ?> !</p>&nbsp;
            <span><a class="headerRegister">My Profile</a></span>&numsp;&numsp;|&numsp;&numsp;
            <span><a class="insidePageHeaderLogin" href="<?php echo e(url('/logout')); ?>">Logout</a></span>
        <?php endif; ?>
    </div>
</header>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('auth.setting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('pageEnd'); ?>
    <?php echo $__env->make('pageEnd', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldSection(); ?>
</body>
</html>

