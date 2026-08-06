<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/product.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/a/js/jquery.parallax-scroll.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>">首頁</a></li>
        <li class="active">線上訂購</li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('embed-banner'); ?>
    <div class="embed-banner wrapper">
        <h1 class="embed-title"><?php echo app('cache.config')->get('page_product_title'); ?></h1>
        <div class="embed-desc"><?php echo str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_product_desc')); ?></div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<section class="product-container" data-track-section="product_list" data-track-section-view data-track-section-label="商品列表">
    <div class="wrapper">

        <div class="product-main">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$goods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="goods wow animate__animated animate__fadeInUp <?php echo e($key%2==0?"even":"odd"); ?>">
                    <div class="img-wrap" data-parallax='{"y": <?php echo e($key%2==0?"-":""); ?>100,"duration": 100}'>
                        <img src="<?php echo e(asset('uploads/'.$goods->img)); ?>?ver=<?php echo e(config('app.asset_version')); ?>" alt="<?php echo e($goods->name); ?>" loading="lazy" decoding="async">
                    </div>
                    <div class="info" data-parallax='{"y": <?php echo e($key%2==0?"":"-"); ?>100}'>
                        <div class="info-boa">
                            <p class="line"></p>
                            <div class="title">
                                <h2><?php echo e($goods->name); ?></h2>
                                <p><?php echo e($goods->quantity); ?><?php echo e($goods->quantity == 1?"盒標準裝":"盒優惠套裝"); ?></p>
                            </div>
                            <div class="tags">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($goods->label): ?>
                                    <p class="tags">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = explode('|',$goods->label); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span><?php echo e($label); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($goods->attr): ?>
                                <div class="attr">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $goods->attr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p class="list">
                                            <span class="attr-name"><?php echo e($attr->name); ?>：</span>
                                            <span class="attr-value"><?php echo e($attr->value); ?></span>
                                        </p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="price">
                                <span class="now">$<?php echo e(round($goods->price)); ?></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($goods->market_price-$goods->price > 0): ?>
                                    <span class="discount deline">$<?php echo e($goods->market_price); ?></span>
                                <?php else: ?>
                                    <span class="discount">官方標準售價</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div class="btn">
                                <a class="checkout" data-track-section="product_list" data-track-name="product.list.checkout" href="<?php echo e(url('checkout/'.$goods->id)); ?>" data-observer="立即訂購-<?php echo e($goods->name); ?>">立即訂購</a>
                                <a class="goinfo" data-track-section="product_list" data-track-name="product.list.detail" href="<?php echo e(url('product/'.$goods->id)); ?>" data-observer="詳情-<?php echo e($goods->name); ?>">更多詳情</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



        </div>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/web/product/index.blade.php ENDPATH**/ ?>