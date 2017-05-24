<?php $__env->startSection('content'); ?>
<a class="back" href="javascript:history.go(-1);">
    <img src="<?php echo e(asset('image/fanhui.png')); ?>" alt=""><span>Back</span>
</a>
<form method="POST" action="<?php echo e(url('/register')); ?>">
    <?php echo e(csrf_field()); ?>

    <div class="register-center">
        <div>
            <img src="<?php echo e(asset('image/name.png')); ?>" alt="">
            <input id="name" type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="Please enter your name">
            <?php if($errors->has('name')): ?> <?php echo e($errors->first('name')); ?> <?php endif; ?>
        </div>
        <div>
            <img src="<?php echo e(asset('image/password.png')); ?>" alt="">
            <input id="password" type="password" name="password" placeholder="Please input a password">
            <?php if($errors->has('password')): ?> <?php echo e($errors->first('password')); ?> <?php endif; ?>
        </div>
        <div>
            <img src="<?php echo e(asset('image/address.png')); ?>" alt="">
            <input id="address" type="text" name="address" value="<?php echo e(old('address')); ?>" placeholder="Please enter your address">
            <?php if($errors->has('address')): ?> <?php echo e($errors->first('address')); ?> <?php endif; ?>
        </div>
        <div>
            <img src="<?php echo e(asset('image/mailbox.png')); ?>" alt="">
            <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Please enter your email address">
            <?php if($errors->has('email')): ?> <?php echo e($errors->first('email')); ?> <?php endif; ?>
        </div>
        <div>
            <img src="<?php echo e(asset('image/password.png')); ?>" alt="">
            <input id="password-confirm" type="password" name="password_confirmation" placeholder="Please confirm your password">
            <?php if($errors->has('password_confirmation')): ?> <?php echo e($errors->first('password_confirmation')); ?> <?php endif; ?>
        </div>
    </div>
    <button id="registerSubmit" type="submit">Register</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>