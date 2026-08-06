<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/message.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/js/xie.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/api.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script>

        setInterval(function(){
            if(messageVerify() == true){
                $('.form-btn').addClass('activate-btn');
            }else{
                $('.form-btn').removeClass('activate-btn');
            }

        },1000);
        function messageVerify(){
            var name = $("input[name='name']").val();
            var phone = $("input[name='phone']").val();
            var email = $("input[name='email']").val();
            var content = $("textarea[name='content']").val();
            if(!name){
                return false;
            }
            if(!phone){
                return false;
            }
            if(!(/^09\d{8}$/.test(phone))){
                return false;
            }
            if(!email){
                return false;
            }
            if(email.search(/^([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+\.(?:com|cn|tw|info|net)$/) == -1){
                return false;
            }
            if(!content){
                return false;
            }
            return true;
        }
    </script>
    <script>
        bgHeight()
        function bgHeight(){
            $('.container-bg').css('height',$(window).height()-80);

        }
        window.onresize = function(){
            bgHeight()
        }


        $(window).scroll(function() {
            bgEffect()

        });

        function bgEffect(){
            let top = document.scrollingElement.scrollTop; //触发滚动条，记录数值
            let banner_height = $('.container-bg').height()-60;
            let opacity = 1-top/banner_height;
            $('.container-bg').css('opacity',opacity);
            if(opacity<=0.6){
                $('.page-title').css('color','rgba(0,0,0,'+top/banner_height+')');
            }else{
                $('.page-title').css('color','#fff');
            }

            if(($(window).scrollTop() + $(window).height()).toFixed(0) == $(document).height()){
                $('.container-bg').css('opacity',0);
            }


        }

        $('.fqa li').each(function(){
            var height = $(this).find('.answers').innerHeight();
            $(this).css('--_height',height+'px');

        });
        $('.fqa li').click(function(){
            if($(this).hasClass('show')){
                $(this).removeClass('show');
            }else{
                $(this).addClass('show');
            }
        })
    </script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<section class="message-container" data-track-section="message" data-track-section-view data-track-section-label="取得協助">
    <div class="container-bg" style="background-image: url('<?php echo e(asset_upload(app('cache.config')->get('page_message_back_img_pc'))); ?>')">
        <p class="bg-text"><?php echo app('cache.config')->get('page_message_title'); ?></p>
        <p class="beat"><i class="iconfont">&#xe784;</i></p>
    </div>
    <div class="page-main">
        <h1 class="page-title">取得協助</h1>
    </div>
    <div class="side">
        <div class="left-side">
            <div class="head">
                <p class="title">快速協助</p>
                <p class="desc">
                    <?php echo app('cache.config')->get('page_message_desc'); ?>

                </p>
            </div>
            <div class="body">
                <ul class="fqa">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <p class="questions"><a href="javascript:;">Q：<?php echo e($item->questions); ?></a></p>
                            <p class="answers"><?php echo e($item->answers); ?></p>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="right-side">
            <div class="head">
                <p class="title">聯絡我們</p>
                <p class="desc">
                    <?php echo app('cache.config')->get('page_lianluo_desc'); ?>

                </p>
            </div>
            <div class="body">
                <form action="" method="post" onsubmit="return messageStore()" id="message-form">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-main">
                        <div class="form-group">
                            <label>你的稱呼：</label>
                            <input class="form-control" type="text" name="name" placeholder="請輸入你的稱呼">
                        </div>
                        <div class="form-group">
                            <label>聯絡電話：</label>
                            <input class="form-control" type="tel" name="phone" placeholder="請輸入聯絡你的電話號碼" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        </div>
                        <div class="form-group">
                            <label>電子信箱：</label>
                            <input class="form-control" type="text" name="email" placeholder="請輸入聯絡你的電子信箱">
                        </div>
                        <div class="form-group">
                            <label>協助類型：</label>
                            <select class="form-control" name="type">
                                <option value="1">療程咨詢</option>
                                <option value="2">退換貨</option>
                                <option value="3">修改訂單資訊</option>
                                <option value="4">修改/新增訂單備注</option>
                                <option value="5">意見或建議</option>
                                <option value="0" selected>其他</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>問題詳述：</label>
                            <textarea class="form-control form-textarea" name="content" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="form-btn" type="submit" data-track-section="message" data-track-name="message.submit" data-observer="留言提交">確認送出</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/web/message.blade.php ENDPATH**/ ?>