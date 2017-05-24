<?php $__env->startSection('content'); ?>
    <a class="back" href="javascript:history.go(-1);">
        <img src="<?php echo e(asset('image/fanhui.png')); ?>" alt=""><span>Back</span>
    </a>
    <form method="POST" action="<?php echo e(url('/login')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="register-center">
            <div>
                <img src="<?php echo e(asset('image/name.png')); ?>" alt="">
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Please enter your email">
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
            <div>
                <img src="<?php echo e(asset('image/password.png')); ?>" alt="">
                <input id="password" type="password" class="form-control" name="password" placeholder="Please input a password">
                <?php if($errors->has('password')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
            <?php /*<input type="checkbox" name="remember"> Remember Me*/ ?>
        </div>
        <div class="login-foot">
            <button type="submit" id="login">Login</button>
            <a href="<?php echo e(url('/password/reset')); ?>" id="retrieve">Forget password</a>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>