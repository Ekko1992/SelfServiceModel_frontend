
<i id="register-return" class="material-icons character-Close">clear</i>
<form method="POST" action="<?php echo e(url('/register')); ?>" id="register">
    <?php echo e(csrf_field()); ?>

    <div class="register-center">

        <div class="register-first">
            <i class="material-icons">person</i>
            <input  id="registerName" type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder=" First Name">
            <div class="clearfix"></div>
            <p></p>
            <?php if($errors->has('name')): ?> <?php echo e($errors->first('name')); ?> <?php endif; ?>
        </div>
        <div class="register-last">
            <input id="registerLastName" type="text" name="last_name" value="<?php echo e(old('last_name')); ?>" placeholder="Last Name">
            <div class="clearfix"></div>
            <p style="bottom: -34px;"></p>
            <?php if($errors->has('last_name')): ?> <?php echo e($errors->first('last_name')); ?> <?php endif; ?>
        </div>
        <div class="clearfix"></div>
        <div>
            <i class="material-icons">work</i>
            <input id="registerCompany" type="text" name="company" value="<?php echo e(old('last_name')); ?>" placeholder="Company Name">
            <div class="clearfix"></div>
            <p></p>
            <?php if($errors->has('company')): ?> <?php echo e($errors->first('company')); ?> <?php endif; ?>
        </div>
        <div>
            <i class="material-icons">phone</i>
            <input id="registerPhone" type="text" name="phone" value="<?php echo e(old('Phone')); ?>" placeholder="Phone number">
            <div class="clearfix"></div>
            <p></p>
            <?php if($errors->has('company')): ?> <?php echo e($errors->first('company')); ?> <?php endif; ?>
        </div>
        <div>
            <i class="material-icons">mail_outline</i>
            <input id="registerEmail" type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email">
            <div class="clearfix"></div>
            <p></p>
            <?php if($errors->has('email')): ?> <?php echo e($errors->first('email')); ?> <?php endif; ?>
        </div>
        <div>
            <i class="material-icons">vpn_key</i>
            <input id="registerPassword" type="password" name="password" placeholder="Password">
            <div class="clearfix"></div>
            <p></p>
            <?php if($errors->has('password')): ?> <?php echo e($errors->first('password')); ?> <?php endif; ?>
        </div>
        <div>
            <i class="material-icons">vpn_key</i>
            <input id="registerPasswordConfirm" type="password" name="password_confirmation"
                   placeholder="Confirm password">
            <div class="clearfix"></div>
            <p></p>
            <?php if($errors->has('password_confirmation')): ?> <?php echo e($errors->first('password_confirmation')); ?> <?php endif; ?>
        </div>
    </div>
    <p id="Prompt-login"><input  class="Agreement" type="checkbox" name="checkboxs">I agree to the <span>Terms of Service</span></p>
    <div class="registerLogin">
        <button id="registerSubmit" type="button">Register</button>
        <span>Login instead</span>
    </div>
</form>
<?php $__env->startSection('content'); ?>

<?php $__env->stopSection(); ?>
