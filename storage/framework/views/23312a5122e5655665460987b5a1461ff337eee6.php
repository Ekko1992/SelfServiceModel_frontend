

<form id="forgetSubmit" method="POST" action="<?php echo e(url('/password/email')); ?>">
    <?php echo e(csrf_field()); ?>

    <div class="register-center forgetCenter">
        <i id="forget-return" class="material-icons character-Close">clear</i>
        <div>
            <i class="material-icons">mail_outline</i>
            <input id="forgetEmail" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="Please enter your email address">
            <?php if($errors->has('email')): ?>
                <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
            <?php endif; ?>
            <p class="forgetPrompt"></p>
        </div>

    </div>
    <div class="modify-foot">
        <button type="button" id="modifyPassword">Retset password</button>
    </div>
</form>
    <?php $__env->startSection('content'); ?>
<?php $__env->stopSection(); ?>
