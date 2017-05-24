<?php $__env->startSection('content'); ?>
    <div class="register-center">
        <form method="POST" action="<?php echo e(url('/password/reset')); ?>">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="token" value="<?php echo e($token); ?>">
            <div>
                <img src="<?php echo e(asset('image/mailbox.png')); ?>" alt="">
                <input id="email" type="email" name="email" value="<?php echo e(isset($email) ? $email : old('email')); ?>" >
                <?php if($errors->has('email')): ?> <?php echo e($errors->first('email')); ?> <?php endif; ?>
            </div>
            <div>
                <img src="<?php echo e(asset('image/password.png')); ?>" alt="">
                <input id="password" type="password" name="password" placeholder="Please enter a new password">
                <?php if($errors->has('password')): ?> <?php echo e($errors->first('password')); ?> <?php endif; ?>
            </div>
            <div>
                <img src="<?php echo e(asset('image/password.png')); ?>" alt="">
                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Please confirm your new password">
                <?php if($errors->has('password_confirmation')): ?> <?php echo e($errors->first('password_confirmation')); ?> <?php endif; ?>
            </div>
            <button type="submit"> Reset Password</button>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>