<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/message.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/js/api.js')); ?>"></script>
    <script>

        setInterval(function(){
            if(messageVerify() == true){
                $('.form-btn').addClass('activate-btn');
            }else{
                $('.form-btn').removeClass('activate-btn');
            }

        },1000);
        function messageVerify(){
            var name = $("input[name='name").val();
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
        document.addEventListener("DOMContentLoaded", function () {
            const bgEl = document.getElementById("bg-container");
            const pcBg = bgEl.dataset.bgPc;
            const mBg = bgEl.dataset.bgM;

            function updateBackground() {
            const bgUrl = window.innerWidth > 1024 ? pcBg : mBg;
            bgEl.style.backgroundImage = `url('${bgUrl}')`;
            }

            updateBackground();

            window.addEventListener('resize', function () {
            updateBackground();
            });
        });
    </script>
    <script>
        bgHeight()
        function bgHeight(){

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
        }
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="bg-container" class="container-bg"
        data-bg-pc="<?php echo e(asset_upload(app('cache.config')->get('page_message_back_img_pc'))); ?>"
        data-bg-m="<?php echo e(asset_upload(app('cache.config')->get('page_message_back_img'))); ?>">
    </div>
    <h1 class="main-title page-title"><?php echo app('cache.config')->get('page_message_title'); ?></h1>
    <div class="main">
        <section class="quick">
            <h2 class="title">快速協助</h2>
            <p class="desc"><?php echo app('cache.config')->get('page_message_desc'); ?></p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <details class="faq-item" open>
                    <summary class="faq-question">
                        <span class="question-text">Q：<?php echo e($item->questions); ?></span>
                        <i class="iconfont faq-icon">&#xeca2;</i>
                    </summary>
                    <p class="faq-answer">A：<?php echo e($item->answers); ?></p>
                </details>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </section>
        <section class="contact">
            <h2 class="title">聯絡我們</h2>
            <p class="desc"><?php echo app('cache.config')->get('page_lianluo_desc'); ?></p>
            <form action="" method="post" onsubmit="return messageStore()" id="message-form">
                <?php echo e(csrf_field()); ?>

                <div class="form-main">
                    <div class="form-group">
                        <label for="name">你的稱呼：</label>
                        <input class="form-control" type="text" id="name" name="name" autocomplete="name" placeholder="請留下你的稱呼" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">聯絡電話：</label>
                        <input class="form-control" type="tel" id="phone" name="phone" autocomplete="tel" placeholder="請留下你的電話號碼" required>
                    </div>
                    <div class="form-group">
                        <label for="email">電子郵箱：</label>
                        <input class="form-control" type="text" id="email" name="email" autocomplete="email" placeholder="請留下你的電子郵箱" required>
                    </div>
                    <div class="form-group">
                        <label for="type">協助類型：</label>
                        <select class="form-control" id="type" name="type">
                            <option value="1">療程咨詢</option>
                            <option value="2">退換貨</option>
                            <option value="3">修改訂單信息</option>
                            <option value="4">修改/新增訂單備注</option>
                            <option value="5">意見或建議</option>
                            <option value="0" selected>其它</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="content">問題詳述：</label>
                        <textarea class="form-control form-textarea" id="content" name="content" cols="30" rows="10"></textarea>
                    </div>
                    <button class="form-btn">確認送出</button>
                </div>
            </form>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">取得協助</li>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/web/message.blade.php ENDPATH**/ ?>