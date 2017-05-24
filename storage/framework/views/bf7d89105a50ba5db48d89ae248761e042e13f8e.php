<?php $__env->startSection('content'); ?>
    <a class="back" href="javascript:history.go(-1);">
        <img src="<?php echo e(asset('image/fanhui.png')); ?>" alt=""><span>Back</span>
    </a>
    <form method="GET" action="<?php echo e(url('/settings/'.Auth::user()->id)); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="register-center">
            <div>
                <img src="<?php echo e(asset('image/name.png')); ?>" alt="">
                <input type="text" name="name" value="<?php echo e(old('name',Auth::user()->name)); ?>" placeholder="Please enter your new name">
            </div>
            <div>
                <img src="<?php echo e(asset('image/password.png')); ?>" alt="">
                <input type="password" name="password" value="<?php echo e(old('password',Auth::user()->password)); ?>" placeholder="Please enter your new password">
            </div>
            <div>
                <img src="<?php echo e(asset('image/address.png')); ?>" alt="">
                <input type="text" name="address" value="<?php echo e(old('address',Auth::user()->address)); ?>" placeholder="Please enter your new address">
            </div>
            <div>
                <img src="<?php echo e(asset('image/mailbox.png')); ?>" alt="">
                <input type="text" name="email" value="<?php echo e(old('email',Auth::user()->email)); ?>" placeholder="Please enter your new email address">
            </div>
            <div>
                <img src="<?php echo e(asset('image/Telephone.png')); ?>" alt="">
                <input type="text" name="number" value="<?php echo e(old('number',Auth::user()->number)); ?>" placeholder="Please enter your new bank card number">
            </div>
            <div>
                <img src="<?php echo e(asset('image/identity.png')); ?>" alt="">
                <input type="text" name="holder" value="<?php echo e(old('holder',Auth::user()->holder)); ?>" placeholder="Please enter the name of your new card">
            </div>
        </div>
        <button id="registerSubmit" type="submit">Update</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>