<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/check.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/js/xie.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/api.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script>

        setInterval(function(){
            if(checkVerify() == true){
                $('.form-btn').addClass('activate-btn');
            }else{
                $('.form-btn').removeClass('activate-btn');
            }

        },1000);
        function checkVerify(){
            var phone = $("input[name='phone']").val();
            var email = $("input[name='email']").val();
            var captcha_code = $("input[name='captcha_code']").val();

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
            if(!captcha_code){
                return false;
            }
            return true;
        }

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
    </script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="check-container" data-track-section="order_check" data-track-section-view data-track-section-label="訂單追蹤">
        <div class="container-bg" style="background-image: url('<?php echo e(asset_upload(app('cache.config')->get('page_check_back_img_pc'))); ?>')">
            <p class="bg-text"><?php echo app('cache.config')->get('page_check_title'); ?></p>
            <p class="beat"><i class="iconfont">&#xe784;</i></p>
        </div>

        <div class="check-wrap">
            <div class="page-main">
                <h1 class="page-title">訂單追蹤</h1>
            </div>
            <div class="check-main">

                <p class="desc">
                    <?php echo app('cache.config')->get('page_check_desc'); ?>

                </p>

                <div class="form-main">
                    <form action="" id="check-form" method="post" onsubmit="return orderCheck()">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label>訂單行動電話：</label>
                            <input class="form-control" type="tel" name="phone" placeholder="請輸入訂購時留下的電話號碼" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label>訂單電子信箱：</label>
                            <input class="form-control" type="email" name="email" placeholder="請輸入訂購時留下的電子信箱">
                        </div>
                        <div class="form-group">
                            <label>我不是機器人：</label>
                            <input class="form-control" type="text" name="captcha_code" placeholder="請輸入驗證碼">
                            <div class="code"><img class="thumbnail captcha mt-3 mb-2" src="<?php echo e(captcha_src('flat')); ?>" onclick="this.src='/captcha/flat?'+Math.random()" title="點擊圖片重新獲取驗證碼" loading="lazy" decoding="async"></div>
                        </div>

                        <div class="form-group">
                            <button class="form-btn" type="submit" data-track-section="order_check" data-track-name="order_check.submit" data-observer="查單提交">確認送出</button>
                        </div>
                    </form>
                </div>
                
                
                <?php
                    $qaList = json_decode(app('cache.config')->get('page_check_qa', '[]'), true);
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($qaList): ?>
                <div class="order-help">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $qaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="order-help-card">
                        <div class="order-help-icon">
                            <svg viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        </div>
                        <h3><?php echo e($item['title'] ?? ''); ?></h3>
                        <?php $lines = explode("\n", $item['content'] ?? ''); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lines): ?>
                        <ul>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(trim($line)): ?>
                            <li><?php echo e(trim($line)); ?></li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ul>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/web/order/check.blade.php ENDPATH**/ ?>