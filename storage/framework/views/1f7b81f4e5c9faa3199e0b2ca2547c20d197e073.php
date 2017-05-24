<?php $__env->startSection('content'); ?>
    <div>
        <form action="<?php echo e(url('/payment')); ?>" method="post" autocomplete="off">
            <?php echo e(csrf_field()); ?>

            <label for="item">
                产品名称
                <input type="text" name="product" value="">
            </label>
            <br>
            <label for="amount">
                价格
                <input type="text" name="price" value="">
            </label>
            <br>
            <input type="submit" value="去付款">
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>