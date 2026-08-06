<!DOCTYPE html>
<?php
    $needsSwiper = request()->is('/');
    $needsWow = request()->is('/') || request()->is('product');
?>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <meta http-equiv="content-language" content="zh-tw">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
    <link rel="alternate" hreflang="zh-TW" href="<?php echo e(url()->current()); ?>" />
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(config('app.m_url')): ?>
        <link rel="alternate" media="only screen and (max-width: 640px)" href="<?php echo e(config('app.m_url')); ?>/<?php echo e(trim(request()->path(),'/')); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <link rel="shortcut icon" href="<?php echo e(\App\Services\ConfigService::get('favicon')?asset('uploads/'.\App\Services\ConfigService::get('favicon')):'/favicon.ico'); ?>">

    
    <meta property="og:site_name" content="<?php echo e(config('app.name')); ?>" />
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', $layout['seo']->title ?? ''); ?>" />
    <meta property="og:description" content="<?php echo $__env->yieldContent('og_description', $layout['seo']->description ?? ''); ?>" />
    <meta property="og:url" content="<?php echo e(url()->current()); ?>" />
    <meta property="og:type" content="<?php echo $__env->yieldContent('og_type', 'website'); ?>" />
    <meta property="og:locale" content="zh_TW" />
    <?php $__env->startSection('og_image'); ?>
    <?php echo $__env->yieldSection(); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($layout['seo']->img)): ?>
    <meta property="og:image" content="<?php echo e(asset('uploads/' . $layout['seo']->img)); ?>" />
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "<?php echo e(config('app.name')); ?>",
        "url": "<?php echo e(url('/')); ?>",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "<?php echo e(url('/')); ?>/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
    <?php echo $__env->yieldContent('jsonld'); ?>
    <?php $__env->startSection('style'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/css/style.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/css/common.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/global.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!is_googlebot()): ?>
        <link rel="stylesheet" href="<?php echo e(asset('static/font/iconfont.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($needsSwiper): ?>
        <link rel="stylesheet" href="<?php echo e(asset('static/swiper4/swiper.min.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($needsWow): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/wow/animate.min.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php echo $__env->yieldSection(); ?>

    <style>html{--color-red:red}body.-ajax .o-loading__ajax{opacity:.5}body.-loading #wrapper,body:not(.-ajax) .o-loading__ajax{opacity:0}body.-loading .o-loading__content{opacity:1}body.-loading.page-index .o-loading__box.-start:before{-webkit-animation:marginLeftIn .5s .5s forwards;animation:marginLeftIn .5s .5s forwards}body.-loading.page-index .o-loading__box.-main:before{-webkit-animation:marginRightIn .5s 1s forwards;animation:marginRightIn .5s 1s forwards}body.-loading.page-index .o-loading__box.-cover:before{-webkit-animation:marginRightIn .5s 1.5s forwards;animation:marginRightIn .5s 1.5s forwards}body:not(.-loading) .o-loading__content:before{margin-left:0}body:not(.-loading).page-index .o-loading__box.-cover:before{margin-right:100vw}.o-loading{width:100vw;height:100vh;position:fixed;top:0;left:0;z-index:100000;pointer-events:none}.page-index .o-loading__box.-start{opacity:1;visibility:visible}.page-index .o-loading__box.-start:before{margin-left:0}.page-index .o-loading__box.-main:before{margin-right:0}.page-index .o-loading__box.-cover{opacity:1;visibility:visible}.page-index .o-loading__box.-cover:before{margin-right:0}.o-loading__ajax{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;width:100%;height:100%;background:#fff;opacity:.5;-webkit-transition:opacity .3s;transition:opacity .3s}.o-loading__ajax span{width:80px;height:80px;border-radius:50%;border-left:3px solid #ec7021;-webkit-animation:rotate 2s linear infinite;animation:rotate 2s linear infinite}@-webkit-keyframes rotate{to{-webkit-transform:rotate(0);transform:rotate(0)}0%{-webkit-transform:rotate(-1turn);transform:rotate(-1turn)}}@keyframes rotate{to{-webkit-transform:rotate(0);transform:rotate(0)}0%{-webkit-transform:rotate(-1turn);transform:rotate(-1turn)}}.o-loading__content{width:auto;height:100%;position:absolute;top:0;right:0;display:block;overflow:hidden;background:#fff;opacity:0;-webkit-transition:opacity .6s ease 1s;transition:opacity .6s ease 1s}.o-loading__content:before{width:auto;height:100%;content:"";position:relative;display:block;margin-left:100vw;-webkit-transition:margin-left .5s cubic-bezier(.9,0,.1,1) 0s;transition:margin-left .5s cubic-bezier(.9,0,.1,1) 0s}.o-loading__content-frame{width:100vw;height:100%;position:absolute;top:0;right:0;display:block;z-index:1}.o-loading__content-frame-bg{width:100%;height:100%;position:relative;z-index:5}.o-loading__box{width:auto;height:100%;position:absolute;top:0;left:0;display:block;overflow:hidden}.o-loading__box.-start{right:0;left:auto;opacity:0;visibility:hidden}.o-loading__box.-start:before{margin-left:0}.o-loading__box.-main:before{margin-right:100vw}.o-loading__box.-cover{opacity:0;visibility:hidden}.o-loading__box:before{width:auto;height:100%;content:"";position:relative;display:block}.o-loading__logo{width:100%;height:100%;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;padding:20px}.o-loading__logo svg{display:block;max-width:100%;max-height:100%}@media (max-width:767px){.o-loading__logo svg{width:176px;height:auto}}.o-loading__cover,.o-loading__main,.o-loading__start{width:100vw;height:100%;position:absolute;top:0;left:0;display:block}.o-loading__cover:before,.o-loading__main:before,.o-loading__start:before{width:100%;height:100%;content:"";position:absolute;top:0;left:0;display:block;background-color:#ff893d;z-index:-1}.o-loading__main:before{background-color:#fff}@-webkit-keyframes marginLeftIn{0%{margin-left:0}to{margin-left:100vw}}@keyframes marginLeftIn{0%{margin-left:0}to{margin-left:100vw}}@-webkit-keyframes marginLeftOut{0%{margin-left:100vw}to{margin-left:0}}@keyframes marginLeftOut{0%{margin-left:100vw}to{margin-left:0}}@-webkit-keyframes marginRightIn{0%{margin-right:0}to{margin-right:100vw}}@keyframes marginRightIn{0%{margin-right:0}to{margin-right:100vw}}@-webkit-keyframes marginRightOut{0%{margin-right:100vw}to{margin-right:0}}@keyframes marginRightOut{0%{margin-right:100vw}to{margin-right:0}}</style>
    <style>

        .o-three-line__static{
            position: absolute;
            z-index: 999999;
            animation-name: line__static_effect;
            animation-duration: 2s;
            animation-timing-function: linear;

            animation-iteration-count: infinite;
            animation-direction: alternate;
            animation-play-state: running;
            /* Safari 与 Chrome: */
            -webkit-animation-name: line__static_effect;
            -webkit-animation-duration: 2s;
            -webkit-animation-timing-function: linear;
            -webkit-animation-iteration-count: infinite;
            -webkit-animation-direction: alternate;
            -webkit-animation-play-state: running;
            left: 50%;
            top: 0;
        }
        @keyframes line__static_effect
        {
            from {
                transform: translateX(-50%)scale(1.5)rotateY(0);
            }
            to {
                transform: translateX(-50%)scale(1.5)rotateY(148deg);
            }
        }

        @-webkit-keyframes line__static_effect /* Safari 与 Chrome */
        {
            from {
                transform: translateX(-50%)scale(1.5)rotateY(0);
            }
            to {
                transform: translateX(-50%)scale(1.5)rotateY(148deg);
            }
        }
    </style>
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
    <script>
        new WOW({
            offset:150,
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
    <!-- Hotjar Tracking Code for https://www.xenicalofficial.com -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:3344599,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
</head>
<body class=" <?php echo e(request()->is('/')?"page-index":""); ?> ">



<header>
    <div class="wrapper">
        <div class="logo-sec">
            <a href="<?php echo e(url('/')); ?>">
                <div class="logo-wrap hover-logo">
                    <div class="place">
                        <div class="compose">
                            <img class="fra-1" src="<?php echo e(asset('static/img/lg/fra-1.png')); ?>" alt="logo" decoding="async">
                            <img class="fra-2" src="<?php echo e(asset('static/img/lg/fra-2.png')); ?>" alt="logo" decoding="async">
                            <img class="fra-3"  src="<?php echo e(asset('static/img/lg/fra-3.png')); ?>" alt="logo" decoding="async">
                        </div>
                        <div class="intact">
                            <img class="xenical-logo" src="<?php echo e(asset('static/img/lg/xenical-1.png')); ?>" alt="xenical" decoding="async">
                            <p class="text">全球領先健康減肥藥</p>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        <div class="nav-sec">
            <ul class="base">
                <li><a href="<?php echo e(url('/')); ?>" data-track-section="nav.top" data-track-name="nav.top.home" data-observer="頂部-首頁">首頁</a></li>
                <li><a href="<?php echo e(url('about')); ?>" data-track-section="nav.top" data-track-name="nav.top.about" data-observer="頂部-認識羅氏鮮">認識羅氏鮮</a></li>
                <li><a href="<?php echo e(url('faq')); ?>" data-track-section="nav.top" data-track-name="nav.top.faq" data-observer="頂部-營養師解答">營養師解答</a></li>
                <li><a href="<?php echo e(url('news')); ?>" data-track-section="nav.top" data-track-name="nav.top.news" data-observer="頂部-瘦身專欄">瘦身專欄</a></li>
            </ul>
            <div class="aks">
                <a class="btn slim-btn btn-ef2" href="<?php echo e(url('compute')); ?>" data-track-section="header" data-track-name="header.compute_btn" data-observer="頂部-瘦身計算機">瘦身計算機</a>
                <a class="btn shop-btn btn-ef1" href="<?php echo e(url('product')); ?>" data-track-section="header" data-track-name="header.order_btn" data-observer="頂部-線上訂購">線上訂購</a>
            </div>
        </div>
    </div>
</header>

<?php $__env->startSection('banners'); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($layout['banners'] && !$layout['banners']->isEmpty()): ?>
        <section class="banner-section">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $layout['banners']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->img): ?>
                            <div class="swiper-slide">
                                <a href="<?php echo e($item->href?url($item->href):"javascript:;"); ?>"><img src="<?php echo e(asset('uploads/'.$item->img)); ?>" alt="<?php echo e($item->alt); ?>" loading="lazy" decoding="async"></a>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php echo $__env->yieldContent('embed-banner'); ?>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php echo $__env->yieldSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>

<?php echo $__env->yieldSection(); ?>

<main>
    <?php echo $__env->yieldContent('content'); ?>
</main>
<footer>
    <div class="wrapper">

        <div class="main">
            <div class="menu-column">
                <div class="menu">
                    <p class="title">Sale</p>
                    <ul class="nav">
                        <li><a href="<?php echo e(url('product')); ?>" data-track-section="footer.sale" data-track-name="footer.sale.order" data-observer="底部-線上訂購">羅氏鮮線上訂購</a></li>
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
                                    <p class="cn"><span>線上訂購</span></p>
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
        </div>


        <div class="description">
            <div class="partner">
                <div class="icon"><img style="width: 126px" src="<?php echo e(asset('static/img/fdausa.webp')); ?>" alt="fda-usa" loading="lazy" decoding="async"></div>
                <div class="icon"><img style="width: 152px" src="<?php echo e(asset('static/img/ema.webp')); ?>" alt="ema" loading="lazy" decoding="async"></div>

                <div class="icon"><img style="width: 60px" src="<?php echo e(asset('static/img/ROCHE.webp')); ?>" alt="ROCHE" loading="lazy" decoding="async"></div>
                <div class="icon"><img style="width: 140px" src="<?php echo e(asset('static/img/CHEPLA.webp')); ?>" alt="CHEPLA" loading="lazy" decoding="async"></div>

                <div class="icon"><img style="width: 52px" src="<?php echo e(asset('static/img/ssl.webp')); ?>" alt="ssl" loading="lazy" decoding="async"></div>
            </div>
            <p class="copyright"><?php echo app('cache.config')->get('copyright'); ?></p>
        </div>



    </div>
    <div class="back-top" id="back-top" data-track-section="footer" data-track-name="footer.back_top" data-observer="回到頂部">
        <a href="javascript:;">
            <div class="line" ></div>
            <div class="icon"></div>
            <div class="text ">T<br>O<br>P</div>
        </a>
    </div>
</footer>


</body>

<?php $__env->startSection('script'); ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($needsSwiper): ?>
<script src="<?php echo e(asset('static/swiper4/swiper.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php echo \App\Services\ConfigService::get('google_ga'); ?>

<?php echo $__env->yieldSection(); ?>
<script>// Loading removed - body starts without -loading class
</script>
<script>
    $('#back-top').click(function (event) {
        event.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 500);
    })
</script>
</html>
<?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/web/layout.blade.php ENDPATH**/ ?>