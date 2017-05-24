<?php $__env->startSection('content'); ?>
    <div class="index-header">
        <img src="<?php echo e(asset('image/index-1.png')); ?>" alt="">
        <div class="index-header-text">
            <h1>WELCOME  TO  VMAXX</h1>
            <p>Demographics in three simple steps</p>
            <a href="<?php echo e(url('/home')); ?>">Click here to start</a>
        </div>
    </div>
    <div class="index-center">
        <div>
            <h4>Step1:</h4>
            <p>Upload recent image (jpg or png) or images(zip) to Vmaxx</p>
        </div>
        <img src="<?php echo e(asset('image/jiantou.png')); ?>" alt="">
        <div>
            <h4>Step2:</h4>
            <p> Images  gets processed on Vmaxx  cloud automatically</p>
        </div>
        <img src="<?php echo e(asset('image/jiantou.png')); ?>" alt="">
        <div>
            <h4>Step1:</h4>
            <p> Download the result in XML and  visulization</p>
        </div>
    </div>
    <div class="index-center-foot">
        <p>Automatically extrac demographics  from your event photos including</br>
            people count, age, gender, ethnicity, loyalty, etc
        </p>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageEnd'); ?>
    @parent
    <script>
        $(function() {
            var  HH=($(".index-header").height()-$(".index-header-text").height())/2;
            var  HW=( $(window).width() - $(".index-header-text").width())/2;
            $(".index-header-text").css({left:HW, top:HH,display:"block"});
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>