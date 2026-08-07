<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/news.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/pagination.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/js/jquery.waypoints.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script>
        $(function(){
            $('.item').waypoint(function(){
                this.element.classList.add('show');
            },{
                offset: '90%'
            });
        });
        $(window).scroll(function() {
            bgEffect()

        });

        function bgEffect(){
            let top = document.scrollingElement.scrollTop; //触发滚动条，记录数值
            let banner_height = $('.container-bg').height()-60;
            let opacity = 1-top/banner_height;
            $('.container-bg').css('opacity',opacity);

            if(($(window).scrollTop() + $(window).height()).toFixed(0) == $(document).height()){
                $('.container-bg').css('opacity',0);
            }


        }
    </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="container-bg" style="background-image: url('<?php echo e(asset_upload(app('cache.config')->get('page_news_back_img_pc'))); ?>')">
    </div>
    <h1 class="main-title page-title"><?php echo app('cache.config')->get('page_news_title'); ?></h1>
    
    <div class="news-wrap">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <a class="info" href="<?php echo e(url('news/'.$item->id)); ?>">
                    <div class="Img"><img src="<?php echo e(asset('uploads/'.$item->img)); ?>" alt="<?php echo e($item->title); ?>"></div>
                    <div class="Txt">
                        <div class="newsInfoIdxBox">
                            <p class="newsDateBox">
                                <span class="day"><?php echo e($item->release_at->format('d')); ?></span>
                                <span class="ym"><?php echo e($item->release_at->format('M')); ?></span>
                            </p>
                            <h2 class="title"><?php echo e($item->title); ?></h2>
                        </div>
                        <p class="sub"><?php echo e(\Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),680)); ?></p>
                        <span class="go">閱讀全文<i class="iconfont">&#xe684;</i></span>
                    </div>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php echo e($news->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active"><?php echo app('cache.config')->get('page_news_title'); ?></li>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/web/news/index.blade.php ENDPATH**/ ?>