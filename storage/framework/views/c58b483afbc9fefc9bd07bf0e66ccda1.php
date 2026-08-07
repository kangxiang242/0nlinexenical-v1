<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->seo_title): ?>
    <?php $__env->startSection('title', $news->seo_title); ?>
<?php else: ?>
    <?php $__env->startSection('title', $news->title); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->seo_keyword): ?>
    <?php $__env->startSection('keywords', $news->seo_keyword); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->seo_description): ?>
    <?php $__env->startSection('description', $news->seo_description); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/news-desc.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script>
        document.domain = "0nlinexenical.com";
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

<?php $__env->startSection('content'); ?>
    <p class="time">發佈日期：<?php echo e($news->release_at->format('Y')); ?>-<?php echo e($news->release_at->format('d')); ?>-<?php echo e($news->release_at->format('m')); ?></p>
    <div class="fluid">
        <h1 class="news-title"><?php echo e($news->title); ?></h1>
        <div class="news-content">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->html_file): ?>
                <iframe  id="external-frame" width="100%" style="min-height: 100vh" src="<?php echo e(asset_upload(str_replace('.zip','',$news->html_file).'/index.html')); ?>"  frameborder="0" scrolling="no" onload="setIframeHeight(this)"></iframe>
            <?php else: ?>
                <?php echo $news->content; ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <div class="relatednav">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prev): ?>
            <a class="relatednav-prev" href="<?php echo e(url('news/'.$prev->id)); ?>">
                <span class="relatednav-arrow"></span>
                <span class="relatednav-title  h4 h4-mb fw-bolder"><?php echo e($prev->title); ?></span>
            </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($next): ?>
            <a class="relatednav-next" href="<?php echo e(url('news/'.$next->id)); ?>">
                <span class="relatednav-arrow"></span>
                <span class="relatednav-title  h4 h4-mb fw-bolder"><?php echo e($next->title); ?></span>
            </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(url('news')); ?>">BMI管理與減肥知識分享</a></li>
    <li class="active"><?php echo e($news->title); ?></li>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/web/news/show.blade.php ENDPATH**/ ?>