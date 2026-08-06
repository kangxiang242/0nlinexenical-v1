<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/page.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($css) && $css): ?>
    <style type="text/css">
        <?php echo $css; ?>

    </style>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script>
        function setIframeHeight(iframe) {
            if (iframe) {
                var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
                if (iframeWin.document.body) {
                    iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
                }}
        };
        window.onload = function () {
            setIframeHeight(document.getElementById('external-frame'));
        };
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>">首頁</a></li>
        <li class="active"><?php echo e($title); ?></li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="page-container" data-track-section="cms" data-track-section-view data-track-section-label="<?php echo e($title); ?>">
        <div class="page-main">
            <h1 class="title"><?php echo e($title); ?></h1>
            <div class="page-body" data-track-scroll-target>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($html_code) && $html_code): ?>
                    <iframe  id="external-frame" width="100%" style="min-height: 100vh" src="<?php echo e(asset_upload('article_html/'.str_replace('.zip','',$html_code).'/index.html')); ?>"  frameborder="0" scrolling="no" onload="setIframeHeight(this)"></iframe>
                <?php else: ?>
                    <?php echo $content; ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/web/page.blade.php ENDPATH**/ ?>