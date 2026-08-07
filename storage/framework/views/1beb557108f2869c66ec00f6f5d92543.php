<!DOCTYPE html>
<?php
    $needsWow = request()->is('/') || request()->is('product');
?>
<html lang="zh-TW" style="font-size: 62.5%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="content-language" content="zh-tw">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app('cache.config')->get('google_verify_type') == 1): ?>
        <?php echo app('cache.config')->get('google_verify_code'); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($layout['seo'])): ?>
        <title><?php echo e(isset($layout['seo'])?$layout['seo']->title:""); ?></title>
    <?php else: ?>
        <?php if (! empty(trim($__env->yieldContent('title')))): ?>
            <title><?php echo $__env->yieldContent('title'); ?></title>
        <?php else: ?>
            <title><?php echo e(isset($layout['seo'])?$layout['seo']->title:""); ?></title>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (! empty(trim($__env->yieldContent('keywords')))): ?>
        <meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>"/>
    <?php else: ?>
        <meta name="keywords" content="<?php echo e(isset($layout['seo'])?$layout['seo']->key_word:""); ?>"/>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (! empty(trim($__env->yieldContent('description')))): ?>
        <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>"/>
    <?php else: ?>
        <meta name="description" content="<?php echo e(isset($layout['seo'])?$layout['seo']->description:""); ?>"/>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <link rel="alternate" hreflang="zh-TW" href="<?php echo e(config('app.url')); ?>/<?php echo e(trim(request()->path(),'/')); ?>" />
    <link rel="canonical" href="<?php echo e(config('app.url')); ?>/<?php echo e(trim(request()->path(),'/')); ?>">

    <link rel="shortcut icon" href="<?php echo e(asset_upload(app('cache.config')->get('favicon'),'/favicon.ico')); ?>">
    <?php $__env->startSection('style'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/css/style.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!is_googlebot()): ?>
        <link rel="stylesheet" href="<?php echo e(asset('static/font/iconfont.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <link rel="stylesheet" href="<?php echo e(asset('static/mobile/less/global.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($needsWow): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/wow/animate.min.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php echo $__env->yieldSection(); ?>

    <?php
        $trackingWebHost = parse_url(config('app.url'), PHP_URL_HOST);
        $trackingMobileHost = parse_url(config('app.m_url') ?: config('app.url'), PHP_URL_HOST);
    ?>
    <script src="<?php echo e(asset('static/js/jquery.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script>
        window.__TRACKING_CONFIG__ = {
            webHost: <?php echo json_encode($trackingWebHost, 15, 512) ?>,
            mobileHost: <?php echo json_encode($trackingMobileHost, 15, 512) ?>,
            endpoint: '/observer/store',
            enabled: <?php echo json_encode(!app()->environment('local'), 15, 512) ?>,
            debug: <?php echo json_encode(app()->environment('local'), 15, 512) ?>,
            assetVersion: <?php echo json_encode(config('app.asset_version'), 15, 512) ?>,
            pluginBase: <?php echo json_encode(asset('static/js/tracker-plugins') . '/', 15, 512) ?>
        };
    </script>
    <?php echo $__env->make('components.tracking-page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script src="<?php echo e(asset('static/js/tracker.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>" defer></script>
    <script src="<?php echo e(asset('static/js/observer.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>" defer></script>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($needsWow): ?>
    <script src="<?php echo e(asset('static/wow/wow.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <script>
        var clientWidth = document.documentElement.clientWidth;
        ;(function (doc, win, undefined) {
            var docEl = doc.documentElement,
                resizeEvt = 'orientationchange' in win? 'orientationchange' : 'resize',
                recalc = function () {
                    clientWidth = docEl.clientWidth;
                    if(docEl.clientWidth > 768){
                        clientWidth = 768

                    }
                    docEl.style.fontSize = clientWidth / 37.5 + 'px';
                };
            if (doc.addEventListener === undefined) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false)
        })(document, window);
        if(clientWidth > 768){
            clientWidth = 768
        }
        document.documentElement.style.fontSize = clientWidth / 37.5 + 'px';
    </script>
    <script>
        document.addEventListener('dblclick', function (e) {
            e.preventDefault();
        }, { passive: false });
    </script>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($needsWow): ?>
    <script>
        new WOW({
            offset:50,
        }).init();
    </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <script>
        var is_ajax_get_cart = 0;
        var flash_data = '<?php echo session()->get('flash'); ?>';
        if(flash_data){
            flash_data = JSON.parse('<?php echo session()->get('flash'); ?>');
        }else{
            flash_data = false;
        }

        var province = [];

        var free_shipping_where = parseInt("<?php echo e(\App\Services\ConfigService::get('freight_where',0)); ?>");
        var free_shipping_freight = parseInt("<?php echo e(\App\Services\ConfigService::get('freight',0)); ?>");

    </script>


</head>
<body>

<?php $__env->startSection('header'); ?>
    <header>
        <div class="logo-wrap">
            <a href="<?php echo e(url('/')); ?>">
                <img class="logo-img" src="<?php echo e(asset('static/img/m.logo2.webp')); ?>?ver=<?php echo e(config('app.asset_version')); ?>" alt="logo" decoding="async">
            </a>
        </div>
        <div class="right-wrap">
       
            <div class="menu"><a class="show-menu" href="javascript:;" data-track-section="nav" data-track-name="nav.menu.open" data-observer="側欄-打開"><i class="iconfont">&#xe62c;</i></a></div>
        </div>
    </header>
    <div class="online-buy">
        <a href="<?php echo e(url('product')); ?>" data-track-section="header" data-track-name="header.order_btn" data-observer="頂部-線上訂購"><i class="iconfont">&#xe811;</i>線上訂購</a>
    </div>
<?php echo $__env->yieldSection(); ?>

<?php $__env->startSection('menu'); ?>
    <section class="menu-section">
        <div class="menu-head">
            <a href="javascript:;" class="close-menu" data-track-section="nav" data-track-name="nav.menu.close" data-observer="側欄-關閉"><i class="iconfont">&#xe62f;</i></a>
        </div>
        <ul class="menu-list">
            <li class="menu-item">
                <ul class="menu-dropdown">
                    <li>
                        <a href="<?php echo e(url('/')); ?>" data-track-section="nav.drawer" data-track-name="nav.drawer.home" data-observer="側欄-首頁">首頁 <i class="iconfont">&#xe775;</i></a>
                    </li>

                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:;">Sale</a>
                <ul class="menu-dropdown">
                    <li>
                        <a href="<?php echo e(url('product')); ?>" data-track-section="nav.drawer" data-track-name="nav.drawer.product" data-observer="側欄-線上訂購">羅氏鮮網路訂購<i class="iconfont">&#xe775;</i></a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('guide')); ?>" data-track-section="nav.drawer" data-track-name="nav.drawer.guide" data-observer="側欄-購前須知">購前須知<i class="iconfont">&#xe775;</i></a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('payment-delivery')); ?>" data-track-section="nav.drawer" data-track-name="nav.drawer.payment" data-observer="側欄-付款與配送">付款與配送<i class="iconfont">&#xe775;</i></a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('after-sales')); ?>" data-track-section="nav.drawer" data-track-name="nav.drawer.after_sales" data-observer="側欄-售後服務">售後服務<i class="iconfont">&#xe775;</i></a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:;">About</a>
                <ul class="menu-dropdown">
                    <li>
                        <a href="<?php echo e(url('about')); ?>" data-track-section="nav.drawer" data-track-name="nav.drawer.about" data-observer="側欄-認識羅氏鮮">認識羅氏鮮<i class="iconfont">&#xe775;</i></a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:;">Q&A</a>
                <ul class="menu-dropdown">
                    <li>
                        <a href="<?php echo e(url('faq')); ?>" data-track-section="nav.drawer" data-track-name="nav.drawer.faq" data-observer="側欄-營養師解答">營養師解答<i class="iconfont">&#xe775;</i></a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:;">Articles</a>
                <ul class="menu-dropdown">
                    <li>
                        <a href="<?php echo e(url('news')); ?>" data-track-section="nav.drawer" data-track-name="nav.drawer.news" data-observer="側欄-瘦身專欄">瘦身專欄<i class="iconfont">&#xe775;</i></a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:;">Service</a>
                <ul class="menu-dropdown">
                    <li>
                        <a href="<?php echo e(url('check')); ?>" data-track-section="nav.drawer" data-track-name="nav.drawer.check" data-observer="側欄-訂單追蹤">訂單追蹤<i class="iconfont">&#xe775;</i></a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('message')); ?>" data-track-section="nav.drawer" data-track-name="nav.drawer.message" data-observer="側欄-取得協助">取得協助<i class="iconfont">&#xe775;</i></a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('compute')); ?>" data-track-section="nav.drawer" data-track-name="nav.drawer.compute" data-observer="側欄-瘦身計算機">瘦身計算機<i class="iconfont">&#xe775;</i></a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>
<?php echo $__env->yieldSection(); ?>

<main>
<?php $__env->startSection('banner'); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($layout['banners'] && !$layout['banners']->isEmpty()): ?>
        <section class="banner-section">
            <div class="banner-main">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $layout['banners']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->m_img): ?>
                        <a href="<?php echo e($item->href?url($item->href):"javascript:;"); ?>"><img src="<?php echo e(asset_upload($item->m_img)); ?>" alt="<?php echo e($item->alt); ?>" decoding="async"></a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php echo $__env->yieldContent('embed-banner'); ?>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php echo $__env->yieldSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>

<?php echo $__env->yieldSection(); ?>

<?php echo $__env->yieldContent('content'); ?>



<footer>
    

    <div class="main">
        <div class="menu-column">

            <div class="menu">
                <p class="title">Sale</p>
                <ul class="nav">
                    <li><a href="<?php echo e(url('product')); ?>" data-track-section="footer.sale" data-track-name="footer.sale.order" data-observer="底部-線上訂購">羅氏鮮網路訂購</a></li>
                    <li><a href="<?php echo e(url('guide')); ?>" data-track-section="footer.sale" data-track-name="footer.sale.guide" data-observer="底部-購前須知">購前須知</a></li>
                    <li><a href="<?php echo e(url('payment-delivery')); ?>" data-track-section="footer.sale" data-track-name="footer.sale.payment" data-observer="底部-付款與配送">付款與配送</a></li>
                    <li><a href="<?php echo e(url('after-sales')); ?>" data-track-section="footer.sale" data-track-name="footer.sale.after_sales" data-observer="底部-售後服務">售後服務</a></li>
                </ul>
            </div>
            <div class="menu">
                <p class="title">About</p>
                <ul class="nav">
                    <li><a href="<?php echo e(url('about')); ?>" data-track-section="footer.about" data-track-name="footer.about.link" data-observer="底部-認識羅氏鮮">認識羅氏鮮</a></li>
                </ul>
            </div>
            <div class="menu">
                <p class="title">Q&A</p>
                <ul class="nav">
                    <li><a href="<?php echo e(url('faq')); ?>" data-track-section="footer.qa" data-track-name="footer.qa.faq" data-observer="底部-營養師解答">營養師解答</a></li>
                </ul>
            </div>
            <div class="menu">
                <p class="title">Articles</p>
                <ul class="nav">
                    <li><a href="<?php echo e(url('news')); ?>" data-track-section="footer.articles" data-track-name="footer.articles.news" data-observer="底部-瘦身專欄">瘦身專欄</a></li>
                </ul>
            </div>
            <div class="menu">
                <p class="title">Service</p>
                <ul class="nav">
                    <li><a href="<?php echo e(url('check')); ?>" data-track-section="footer.service" data-track-name="footer.service.check" data-observer="底部-訂單追蹤">訂單追蹤</a></li>
                    <li><a href="<?php echo e(url('message')); ?>" data-track-section="footer.service" data-track-name="footer.service.message" data-observer="底部-取得協助">取得協助</a></li>
                    <li><a href="<?php echo e(url('compute')); ?>" data-track-section="footer.service" data-track-name="footer.service.compute" data-observer="底部-瘦身計算機">瘦身計算機</a></li>
                </ul>
            </div>
        </div>

        <div class="contact-column">
            <div class="topic">
                <div class="item">
                    <a href="<?php echo e(url('product')); ?>" data-track-section="footer.contact" data-track-name="footer.contact.order" data-observer="底部-線上訂購">
                        <div class="col">
                            <div class="icon"><i class="iconfont">&#xe64f;</i></div>
                            <div class="text">
                                <p class="en">Buy Online</p>
                                <p class="cn"><span>網路訂購</span></p>
                            </div>
                            <div class="arrow-right"><i class="iconfont">&#xe613;</i></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="address">
                <?php echo str_replace(PHP_EOL,'<br/>',app('cache.config')->get('foot_text')); ?>

            </div>
        </div>

        <div class="description">
            <div class="partner">
                <div class="icon"><img  style="width: 12.6rem" src="<?php echo e(asset('static/img/fdausa.webp')); ?>" alt="fda-usa" loading="lazy" decoding="async"></div>
                <div class="icon"><img style="width: 15.2rem" src="<?php echo e(asset('static/img/ema.webp')); ?>" alt="ema" loading="lazy" decoding="async"></div>
                <!-- <div class="icon"><img  style="width: 14.5rem" src="<?php echo e(asset('static/img/fdataiwan.png')); ?>" alt="台湾fda" loading="lazy" decoding="async"></div> -->
                <div class="icon"><img  style="width: 5rem" src="<?php echo e(asset('static/img/ROCHE.webp')); ?>" alt="ROCHE" loading="lazy" decoding="async"></div>
                <div class="icon"><img  style="width: 12rem" src="<?php echo e(asset('static/img/CHEPLA.webp')); ?>" alt="CHEPLA" loading="lazy" decoding="async"></div>
                <!-- <div class="icon"><img  style="width: 12.2rem" src="<?php echo e(asset('static/img/heimao.png')); ?>" alt="黑猫宅急便" loading="lazy" decoding="async"></div>
                <div class="icon"><img  style="width: 2.6rem" src="<?php echo e(asset('static/img/7-11.png')); ?>" alt="7-11" loading="lazy" decoding="async"></div> -->
                <div class="icon"><img style="width: 5.2rem" src="<?php echo e(asset('static/img/ssl.webp')); ?>" alt="ssl" loading="lazy" decoding="async"></div>
            </div>
            <p class="copyright"><?php echo app('cache.config')->get('copyright'); ?></p>
        </div>
    </div>
</footer>


</main>
</body>


<?php $__env->startSection('script'); ?>
    <?php echo app('cache.config')->get('google_ga'); ?>

    <script>
        $('.show-menu').click(function () {
            $('.menu-section').addClass('-show');
            $('body').append('<div class="shade"></div>');
            $('body').addClass('overflow-hidden')
        });
        $('.close-menu').click(function(){
            $('.menu-section').removeClass('-show');
            $('.shade').remove();
            $('body').removeClass('overflow-hidden')
        });

        $('body').on('click','.shade',function(){
            if (window.XenicalTracker) {
                XenicalTracker.track('click', 'nav.menu.close_shade', { section: 'nav', label: '側欄-遮罩關閉', explain: '側欄-遮罩關閉' });
            }
            $('.menu-section').removeClass('-show');
            $('.shade').remove();
            $('body').removeClass('overflow-hidden')
        });
    </script>

<?php echo $__env->yieldSection(); ?>
</html>
<?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/mobile/layout.blade.php ENDPATH**/ ?>