<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/product.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/a/js/jquery.easing.1.3.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/a/js/jquery.parallax-scroll.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script>
        $(document).ready(function() {
            $('.goods').hover(function() {
                var $discount = $(this).find('.discount');
                if ($discount.length === 0) {
                    console.error('没有找到 .discount 元素');
                    return;
                }
                var discount = parseInt($discount.data('discount'));
                if (isNaN(discount) || discount <= 0) {
                    return;
                }
                $discount.data('orig-text', $discount.text());
                $discount.text('0%');
                $({ counter: 0 }).animate({ counter: discount }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function(now) {
                        $discount.text('為妳優惠 ' + Math.ceil(now) + '%');
                    },
                    complete: function() {
                        $discount.text('為妳優惠 ' + discount + '%');
                    }
                });
            }, function() {
                var $discount = $(this).find('.discount');
                var discount = parseInt($discount.data('discount'));
                if ($discount.length > 0 && discount > 0) {
                    $discount.text($discount.data('orig-text'));
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.innerWidth > 1024) {
            document.querySelectorAll('.img-wrap').forEach(function (el, index) {
                const direction = index % 2 === 0 ? '-' : '';
                el.setAttribute('data-parallax', `{"y": ${direction}100, "duration": 100}`);
            });

            document.querySelectorAll('.info').forEach(function (el, index) {
                const direction = index % 2 === 0 ? '' : '-';
                el.setAttribute('data-parallax', `{"y": ${direction}100}`);
            });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startSection('embed-banner'); ?>
    <div class="embed-banner wrapper column">
        <h1 class="page-title main-title"><?php echo app('cache.config')->get('page_product_title'); ?></h1>
        <div class="title-sub"><?php echo str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_product_desc')); ?></div>
    </div>
    <?php $__env->stopSection(); ?>
    <div class="product-container wrapper product-main">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$goods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="goods wow animate__animated animate__fadeInUp <?php echo e($key%2==0?"even":"odd"); ?>">
                <img class="img-wrap" src="<?php echo e(asset('uploads/'.$goods->img)); ?>?ver=<?php echo e(config('app.asset_version')); ?>" alt="<?php echo e($goods->sub_name); ?> <?php echo e($goods->name_en); ?><?php echo e($goods->name); ?><?php echo e($goods->quantity); ?><?php echo e($goods->quantity == 1?"盒標準裝":"盒優惠裝"); ?>">
                <div class="info">
                    <div class="title">
                        <span><span style="letter-spacing: -1px; margin-right: 4px;"><?php echo e($goods->name_en); ?></span><?php echo e($goods->name); ?></span>
                        <p><?php echo e($goods->quantity); ?><?php echo e($goods->quantity == 1?"盒標準裝":"盒優惠裝"); ?></p>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($goods->label): ?>
                        <p class="tags">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = explode('|',$goods->label); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span><?php echo e($label); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($goods->attr): ?>
                        <div class="attr">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $goods->attr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="attr-name"><?php echo e($attr->name); ?>：</span>
                                <span class="attr-value"><?php echo e($attr->value); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <p class="price-sec">
                        <span class="price"><span class="twd">NT$</span><?php echo e(number_format(round($goods->price))); ?></span>
                        <?php
                            $diff = $goods->market_price - $goods->price;
                            $percent = $goods->market_price > 0 ? round(($diff / $goods->market_price) * 100) : 0;
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($diff > 0): ?>
                            <span class="market-price"><span class="twd">NT$</span><?php echo e(number_format($goods->market_price)); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <span class="discount" data-discount="<?php echo e($percent); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($diff > 0): ?>
                                為妳優惠 <?php echo e($percent); ?>%
                            <?php else: ?>
                                官方售價
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </span>
                    </p>

                    <div class="btn">
                        <a class="checkout go-btn" href="<?php echo e(url('checkout/'.$goods->id)); ?>" data-observer="立即購買-<?php echo e($goods->name); ?>">立即訂購<i class="iconfont">&#xe684;</i></a>
                        <a class="goinfo" href="<?php echo e(url('product/'.$goods->id)); ?>" data-observer="詳情-<?php echo e($goods->name); ?>">詳情</a>
                    </div>
                    
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <div class="bmi wrapper column">
        <p class="main-title wow animate__animated animate__fadeInUp"><?php echo e(app('cache.config')->get('page_product_bmi_title')); ?></p>
        <p class="title-sub  wow animate__animated animate__fadeInUp"><?php echo str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_product_bmi_desc')); ?></p>
        <a class="go-btn btn-ef1" href="<?php echo e(url('bmi')); ?>" data-observer="測試你的數據按鈕">測一測你的BMI<i class="iconfont">&#xe684;</i></a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active"><?php echo app('cache.config')->get('page_product_title'); ?></li>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/web/product/index.blade.php ENDPATH**/ ?>