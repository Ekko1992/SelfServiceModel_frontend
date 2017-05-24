<?php $__env->startSection('content'); ?>
    <section class="news-text">
        <form action="<?php echo e(url('/payment/')); ?>" method="post" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="news-center-left">
                <div class="news-center-left-head">
                    <span class="news-back"><a href="javascript:history.go(-1);"><img
                                    src="<?php echo e(asset('image/fanhui.png')); ?>" alt=""><span>Back</span></a></span>
                    <span class="delete">Delete</span>
                </div>
                <textarea name="description" id="description">Please simply describe the picture</textarea>
                <div class="select-text">
                    <input type="checkbox" class="Select" name="select"><span class="select-name">Select</span>
                </div>

                <div class="news-center-left-text">
                    <ul class="hx">
                        <li class="news-center-upload">
                            <input type="file" id="file" name="image">
                            <img src="<?php echo e(asset('image/shangchuan.png')); ?>" alt="">
                            <p>Upload a new event</p>
                            <span>just like the company`s recent  activity photos and so on</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="news-center-right">
                <div class="photo-number">
                    <p>Photo number :</p>
                    <input type="text" readOnly="true" name="number" id="number" value="0">
                </div>
                <div class="order-price">
                    <p>Order price :</p>
                    <input type="text" readOnly="true" name="price" id="price" value="">
                </div>
                <div class="result-style">
                    <p>Result style :</p>
                    <div class="result-style-text">
                        <div class="age">
                            <div class="age-left">Age</div>
                            <div class="age-right">
                                <span class="age-open" id="Age"><span class="age-open-round"></span></span>
                                <span class="age-close"></span>
                            </div>
                        </div>
                        <div class="age">
                            <div class="age-left">Gender</div>
                            <div class="age-right">
                                <span class="age-open" id="Gender"><span class="age-open-round"></span></span>
                                <span class="age-close"></span>
                            </div>
                        </div>
                        <div class="age">
                            <div class="age-left">Ethnicity</div>
                            <div class="age-right">
                                <span class="age-open" id="Ethnicity"><span class="age-open-round"></span></span>
                                <span class="age-close"></span>
                            </div>
                        </div>
                        <div class="age">
                            <div class="age-left">Loyalty</div>
                            <div class="age-right">
                                <span class="age-open" id="Loyalty"><span class="age-open-round"></span></span>
                                <span class="age-close"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="purchase" type="submit">Purchase</button>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageEnd'); ?>
    @parent
    <script type="text/javascript" src="<?php echo e(asset('js/uploadify/jquery.uploadify.js')); ?>"></script>
    <script type="text/javascript">
        $(function () {
            var msg = '<?php $msg;?>';
            if (msg) {
                alert(msg);
                return;
            }
            /**
             *  判断是否存在图片
             */
            $(".hx").each(function () {
                if ($(this).find('img').length) {
                    $(this).css('display', 'block');
                }
            });

            $("#file").uploadify({
                'formData': {
                    'timestamp': '<?php echo time();?>',
                    'token': '<?php echo md5('unique_salt' . time())?>'
                },
                'uploader': '/js/uploadify/uploadify.php',
                'swf': '/js/uploadify/uploadify.swf',
                'width': 149,
                'height': 38,
                'fileSizeLimit': '99999KB',
                'fileTypeExts': '*.*',
                'buttonClass': 'uploadify-button',
                'buttonText': 'SELECT FILES',
                'checkExisting': '/js/uploadify/check-exists.php',
                'debug': false,
                'multi': true,
                'onUploadStart': function (file) {
                    var hx = $(".hx").find(".pic_1").length;
                    if (parseInt(hx) >= 10) {
                        alert('You can only upload up to 10 photos');
                        $('#file').uploadify('cancel', file.id);
                    }
                },

                'onUploadError': function (file, errorCode, errorMsg, errorString) {
                    if (errorString != 'Cancelled') {
                        alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
                    }
                },
                'onUploadSuccess': function (file, data, response) {
                    $('#' + file.id).find('.data').html(' Upload completed');
                    /*if (data.length > 50 || data == false) {
                     alert('upload failed');
                     return;
                     }*/
                    var src = '/uploads/' + data;
                    var imgList = '';
                    imgList += '<li class="pic_1">' +
                        '<input type="checkbox" class="checkbox" name="checkboxt">' +
                        '<img class="img-Graphical" src="' + src + '" alt="">' +
                        '<input type="text" value="" placeholder="input your new name" name="pic_title[]">' +
                        '<div class="news-img-delete">' +
                        '<img src="/image/delete.png" alt="">' +
                        '</div>' +
                        '<input type="hidden" name="pic_name[]" value="' + data + '" />' +
                        '<input type="hidden" name="pic_ids[]" value="0" />' +
                        '<input type="hidden" name="pic_url[]" value="/uploads/' + data + '" />' +
                        '</li>';
                    $('.hx').find('li:eq(0)').after(imgList);

                    var agePrice = 52, genderPrice = 30, EthnicityPrice = 69, LoyaltyPrice = 75;
                    var size = $(".news-center-left-text").find("li").size() - 1;
                    $(".photo-number").find("input").val(size);
                    var price = size * (agePrice + genderPrice + EthnicityPrice + LoyaltyPrice );
                    $(".order-price").find("input").val(price);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>