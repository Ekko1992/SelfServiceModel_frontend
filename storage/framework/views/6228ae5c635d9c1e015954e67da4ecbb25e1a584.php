<!-- Main Content -->
<?php $__env->startSection('content'); ?>
    <a class="back" href="javascript:history.go(-1);">
        <img src="<?php echo e(asset('image/fanhui.png')); ?>" alt=""><span>Back</span>
    </a>
    <?php if(session('status')): ?>
        <div class="alert alert-success">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <form method="POST" action="<?php echo e(url('/password/email')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="register-center">
            <div>
                <img src="<?php echo e(asset('image/mailbox.png')); ?>" alt="">
                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="Please enter your email address">
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="modify-foot">
            <?php /*<button type="submit" id="modifyPassword">Send Password Reset Link</button>*/ ?>
            <button type="submit" id="modifyPassword">Retset password</button>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>