<?php $__env->startSection('content'); ?>
<section class="home-text">
    <div class="home-text-left">
        <div class="Line"></div>
        <div class="recent-event-prompt">Recent event</div>
        <div class="all-event-prompt">All event</div>
    </div>
    <div class="home-text-right">
        <div class="recent-event">
            <div class="recent-event-upload">
                <a href="<?php echo e(url('upload')); ?>">
                <img src="<?php echo e(asset('image/shangchuan.png')); ?>" alt="">
                    <p>Upload a new event</p>
                    <span>Similar to the collective activities of the group photo</span>
                </a>
            </div>
            <ul class="clickEvent"></ul>
        </div>
        <div class="all-event">
            <ul class="clickEvent"></ul>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageEnd'); ?>
    @parent
    <script>
        $(function(){
            $(".recent-event").find("ul").html('');
            $(".all-event").find("ul").html('');

            $.ajax({
                url: "list",
                type:"get",
                dataType:"json",
                headers:{'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')},
                success:function(data){
                    $.each(data.round,function (key,val) {
                        var html = "<li id='" + val.id + "' class='recent"+val.id+"'>" +
                            '<img  src="'+val.path+'" alt="">'+
                            "<p>"+val.title+"</p>" +
                            "<span>"+val.created_at+"</span>" +
                            "<div class='progressBar'>" +
                             "<div class='progressBarStyle'> " +
                             "<div class='progressBackground'></div>" +
                             "<span class='progressBarNumber'>0</span>" +
                             "</div>" +
                             "</div>" +
                            "<div class='recent-event-delete'>" +
                            "<img src='<?php echo e(asset('image/delete.png')); ?>' alt=''>" +
                            "<a href='<?php echo e(url("/detail")); ?>/"+val.id+"'>"+ "</a>"+
                            "</div>" +
                            "</li>";
                        $(".recent-event").find("ul").append(html);
                        $(".all-event").find("ul").append(html);
                        if(val.schedule >= 100){
                            $(".recent"+val.id+"").find(".progressBar").css({display:'none'});
                        }else {
                            setout();
                            function setout() {
                                $.ajax({
                                    url: "list",
                                    type:"get",
                                    dataType:"json",
                                    headers:{'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')},
                                    success:function(data){
                                        $.each(data.round,function (e,v) {
                                            if(v.schedule >= 100) {
                                                $(".recent" + v.id + "").find(".progressBar").css({display: 'none'});
                                            }
                                            var progress = $("#"+val.id+"").find(".progressBarNumber").html();
                                            var numl = progress.substring(0,2);
                                            doProgress(numl,v.schedule,v.id);
                                            setTimeout(function(){setout();},2000);
                                        })
                                    },
                                    error: function () {
                                        alert("Delete failed")
                                    }
                                })

                            }
                        }
                    });
                    RecentClick();
                },
                error:function(){
                    alert("Failed to load")
                }
            });

        });
        function RecentClick() {
            blockNone(".clickEvent");
            $(".recent-event-delete").find("img").on("click", function () {
                var id=$(this).parents('li').attr("id");
                $.ajax({
                    url: '/move/'+id,
                    type: "get",
                    dataType: "json",
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    success: function () {
                        $(".all"+id+"").remove();
                        $(".recent"+id+"").remove();
                    },
                    error: function () {
                        alert("Delete failed")
                    }
                });
            });
        }
        function blockNone(sele){
            $(sele).find("li").hover(function () {
                $(this).find(".recent-event-delete").css({"display": "block"})
            }, function () {
                $(this).find(".recent-event-delete").css({"display": "none"})
            });
        }
        //这部分是显示进度条效果
        function SetProgress(progress,id) {
            if (progress) {
                var ids=$(".recent"+id+"");
                ids.find(".progressBarNumber").css("width", String(progress) + "%"); //控制#loading div宽度
                ids.find(".progressBarNumber").html(String(progress) + "%"); //显示百分比
            }
        }
        function doProgress(initial,Final,id) {i=initial;j=Final;num(id);}
        function num(id) {
            if (i <=100) {
                if (i<=j){
                    setTimeout("num("+id+")", 100);
                    SetProgress(i,id);
                    i++;
                }
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>