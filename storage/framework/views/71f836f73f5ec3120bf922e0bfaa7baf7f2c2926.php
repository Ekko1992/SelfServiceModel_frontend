
    <i id="login-return" class="material-icons character-Close">clear</i>
    <form method="POST" action="<?php echo e(url('/login')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="register-center">
            <div>
                <i class="material-icons">person</i>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Username">
                <div class="clearfix"></div>
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
            <div>
                <i class="material-icons">vpn_key</i>
                <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                <div class="clearfix"></div>
                <?php if($errors->has('password')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="login-foot">
            <button type="submit" id="login">Login</button>
            <a id="retrieve">Forget password</a>
        </div>
    </form>
    <?php $__env->startSection('content'); ?>
<?php $__env->stopSection(); ?>
