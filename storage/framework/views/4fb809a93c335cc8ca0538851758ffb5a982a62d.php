<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>"/>
    <title>Vmaxx</title>
    <!-- Styles -->
    <link href="<?php echo e(asset('css/index.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/reset.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/goalProgress.css')); ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body id="app-layout">
<header>
    <div class="header-left">
        <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('image/vmaxx_newlogo.png')); ?>" alt=""></a>
    </div>
    <div class="header-right">
        <?php if(Auth::guest()): ?>
            <p></p>
            <span>
                <a class="header-register" id="header-register">Register</a>&numsp;&numsp;|&numsp; &numsp;
                <a class="header-login" id="header-login">Login</a>
            </span>
        <?php else: ?>
            <p>Welcome, <?php echo e(Auth::user()->name); ?> !</p>&nbsp;
            <span><a class="header-register settingDate" >My Profile</a></span>&numsp;&numsp;
            |&numsp;&numsp;
            <span><a class="header-login" href="<?php echo e(url('/logout')); ?>">Logout</a></span>
        <?php endif; ?>
    </div>
</header>
<div class="index-header">
    <img src="<?php echo e(asset('image/People_edited_crop.jpg')); ?>" alt="">
    <div class="index-header-middle">
        <h1>Demographics in 3 simple steps</h1>
        <div class="index-header-middle-link">
            <a>Start Here</a>
        </div>
    </div>
</div>
<div class="index-center">
    <div>
        <img src="<?php echo e(asset('image/step_upload.png')); ?>" alt="">
        <h4>Step&nbsp;1:</h4>
        <p>Upload images</p>
    </div>
    <div>
        <img src="<?php echo e(asset('image/step_select.png')); ?>" alt="">
        <h4>Step&nbsp;2:</h4>
        <p> Select metrices</p>
    </div>
    <div>
        <img src="<?php echo e(asset('image/step_download.png')); ?>" alt="">
        <h4>Step&nbsp;3:</h4>
        <p>View and download results</p>
    </div>
</div>
<div id="LoginText">
    <div class="Background-shadow"></div>
    <div id="login-style">
        <?php echo $__env->make('auth.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div id="register-style">
        <?php echo $__env->make('auth.register', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div id="Agreement-style">
        <?php echo $__env->make('auth.agreement', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div id="forgetPassword">
        <?php echo $__env->make('auth.passwords.email', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</div>
<?php echo $__env->make('auth.setting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="token">
<footer>
    <div></div>
    Property of Vmaxx inc.
</footer>
</body>
</html>
<!-- JavaScripts -->
<script type="text/javascript" src="<?php echo e(asset('js/jquery-1.9.1.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/index.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/jquery.cookie.js')); ?>"></script>

<?php $__env->startSection('content'); ?>
