<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <meta http-equiv="content-language" content="zh-tw">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="canonical" href="<?php echo e(config('app.url')); ?>/<?php echo e(trim(request()->path(),'/')); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(config('app.m_url')): ?>
        <link rel="alternate" media="only screen and (max-width: 640px)" href="<?php echo e(config('app.m_url')); ?>/<?php echo e(trim(request()->path(),'/')); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <link rel="shortcut icon" href="<?php echo e(\App\Services\ConfigService::get('favicon')?asset('uploads/'.\App\Services\ConfigService::get('favicon')):'/favicon.ico'); ?>">
    <?php $__env->startSection('style'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/css/style.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/css/common.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/global.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!is_googlebot()): ?>
        <link rel="stylesheet" href="<?php echo e(asset('static/font/iconfont.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <link rel="stylesheet" href="<?php echo e(asset('static/swiper4/swiper.min.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('static/less/section.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/wow/animate.min.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
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
    <script src="<?php echo e(asset('static/js/jquery.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/observer.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/wow/wow.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/jquery_lazyload/jquery.lazyload.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script>
        new WOW({
            offset:150,
        }).init();
    </script>

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
<body class=" <?php echo e(request()->is('/')?"page-index -loading":""); ?> ">

    <header class="main-header">
        <div class="wrapper">
            <a class="logo" href="<?php echo e(url('/')); ?>">
                <img class="fra fra-1" src="<?php echo e(asset('static/img/lg/fra-1.png')); ?>" alt="logo">
                <img class="fra fra-2" src="<?php echo e(asset('static/img/lg/fra-2.png')); ?>" alt="logo">
                <img class="fra fra-3"  src="<?php echo e(asset('static/img/lg/fra-3.png')); ?>" alt="logo">
            </a>
            <div class="base-sec">
                <ul class="base">
                    <li><a href="<?php echo e(url('/')); ?>">首頁</a></li>
                    <li><a href="<?php echo e(url('xenical')); ?>">瞭解羅氏鮮</a></li>
                    <li><a href="<?php echo e(url('faq')); ?>">常見疑問解答Q&A</a></li>
                    <li><a href="<?php echo e(url('news')); ?>">減肥知識分享</a></li>
                    <li class="has-dropdown">
                        <span class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">健康計算器</span>
                        <ul class="dropdown">
                            <li><a class="btn btn-ef2" href="<?php echo e(url('bmi')); ?>" data-observer="頂部-瘦身計算機">BMI計算機<i class="iconfont">&#xe684;</i></a></li>
                            <li><a class="btn btn-ef2" href="<?php echo e(url('bmr')); ?>" data-observer="頂部-瘦身計算機">BMR計算機<i class="iconfont">&#xe684;</i></a></li>
                            <li><a class="btn btn-ef2" href="<?php echo e(url('body-fat')); ?>" data-observer="頂部-瘦身計算機">體脂肪率計算機<i class="iconfont">&#xe684;</i></a></li>
                        </ul>
                    </li>
                    <li><a class="btn shop-btn go-btn" href="<?php echo e(url('product')); ?>" data-observer="頂部-線上訂購">訂購羅氏鮮<i class="iconfont">&#xe684;</i></a></li>
                </ul>
            </div>
            <div class="show-menu"><i class="iconfont">&#xe62c;</i></div>
        </div>
    </header>

    <?php $__env->startSection('menu'); ?>
        <div class="main-menu">
            <div class="close-menu"><i class="iconfont">&#xeca0;</i></div>
            <div class="menu">
                <p class="en-title">Home</p>
                <p class="nav-title nav-home"><a href="<?php echo e(url('/')); ?>">首頁<i class="iconfont">&#xe775;</i></a></p>
            </div>
            <div class="menu">
                <p class="en-title">Product</p>
                <ul class="nav">
                    <li><a href="<?php echo e(url('xenical')); ?>">瞭解羅氏鮮<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="<?php echo e(url('product')); ?>">羅氏鮮線上訂購<i class="iconfont">&#xe775;</i></a></li>
                </ul>
            </div>
            <div class="menu">
                <p class="en-title">Slimming</p>
                <ul class="nav">
                    <li><a href="<?php echo e(url('bmi')); ?>">BMI計算機<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="<?php echo e(url('bmr')); ?>">BMR與TEDD計算機<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="<?php echo e(url('body-fat')); ?>">體脂肪率計算機<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="<?php echo e(url('faq')); ?>">減肥常見疑問解答<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="<?php echo e(url('news')); ?>">減肥知識分享<i class="iconfont">&#xe775;</i></a></li>
                </ul>
            </div>
            <div class="menu">
                <p class="en-title">Service</p>
                <ul class="nav">
                    <li><a href="<?php echo e(url('guide')); ?>">減肥藥訂購指南<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="<?php echo e(url('payment-delivery')); ?>">付款與配送說明<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="<?php echo e(url('after-sales')); ?>">售後服務<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="<?php echo e(url('check')); ?>">訂單追蹤<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="<?php echo e(url('message')); ?>">取得協助<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="<?php echo e(url('privacy')); ?>">隱私權政策<i class="iconfont">&#xe775;</i></a></li>
                </ul>
            </div>
        </div>
    <?php echo $__env->yieldSection(); ?>

    <div class="main-wrapper">
        <?php $__env->startSection('banners'); ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($layout['banners'] && !$layout['banners']->isEmpty()): ?>
                <div class="banner-section">
                    <?php echo $__env->yieldContent('embed-banner'); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $layout['banners']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->img): ?>
                                <picture class="banner-img">
                                    <source media="(max-width: 1024px)" srcset="<?php echo e(asset_upload($item->m_img)); ?>">
                                    <source media="(min-width: 1025px)" srcset="<?php echo e(asset('uploads/'.$item->img)); ?>">
                                    <img src="<?php echo e(asset('uploads/'.$item->img)); ?>" alt="<?php echo e($item->alt); ?>">
                                </picture>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php echo $__env->yieldSection(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php if (! empty(trim($__env->yieldContent('breadcrumb')))): ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!request()->is('/')): ?>
            <ul class="breadcrumb">
                <li ><a href="<?php echo e(url('/')); ?>">首頁</a></li>
                <?php echo $__env->yieldContent('breadcrumb'); ?>
            </ul>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <footer>
        <div class="wrapper column">
            <div class="footer-menu">
                <div class="menu">
                    <p class="en-title">Product</p>
                    <p class="footer-title">減肥產品</p>
                    <ul class="nav">
                        <li><a href="<?php echo e(url('xenical')); ?>">瞭解羅氏鮮<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="<?php echo e(url('product')); ?>">訂購羅氏鮮減肥藥<i class="iconfont">&#xe775;</i></a></li>
                    </ul>
                </div>
                <div class="menu">
                    <p class="en-title">Slimming</p>
                    <p class="footer-title">減肥專欄</p>
                    <ul class="nav">
                        <li><a href="<?php echo e(url('bmi')); ?>">BMI計算機<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="<?php echo e(url('bmr')); ?>">BMR與TEDD計算機<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="<?php echo e(url('body-fat')); ?>">體脂肪率計算機<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="<?php echo e(url('faq')); ?>">減肥常見疑問解答Q&A<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="<?php echo e(url('news')); ?>">減肥知識分享<i class="iconfont">&#xe775;</i></a></li>
                    </ul>
                </div>
                <div class="menu">
                    <p class="en-title">Service</p>
                    <p class="footer-title">購物服務</p>
                    <ul class="nav">
                        <li><a href="<?php echo e(url('guide')); ?>">減肥藥訂購指南<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="<?php echo e(url('payment-delivery')); ?>">付款與配送說明<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="<?php echo e(url('after-sales')); ?>">售後服務<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="<?php echo e(url('check')); ?>">訂單追蹤<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="<?php echo e(url('message')); ?>">取得協助<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="<?php echo e(url('privacy')); ?>">隱私權政策<i class="iconfont">&#xe775;</i></a></li>
                    </ul>
                </div>
                <a class="buy" href="<?php echo e(url('product')); ?>">
                    <i class="icon iconfont">&#xe64f;</i>
                    <div class="text">
                        <p class="en-title">Buy Online</p>
                        <p class="footer-title">羅氏鮮線上訂購<i class="arrow-right iconfont">&#xe613;</i></p>
                    </div>
                </a>
            </div>


            <div class="description">
                <div class="partner">
                    <div class="icon"><img style="width: 126px" src="<?php echo e(asset('static/img/fdausa.png')); ?>" alt="fda-usa"></div>
                    <div class="icon"><img style="width: 152px" src="<?php echo e(asset('static/img/ema.png')); ?>" alt="ema"></div>
                    <div class="icon"><img style="width: 60px" src="<?php echo e(asset('static/img/ROCHE.png')); ?>" alt="ROCHE"></div>
                    <div class="icon"><img style="width: 140px" src="<?php echo e(asset('static/img/CHEPLA.png')); ?>" alt="CHEPLA"></div>
                    <div class="icon"><img style="width: 52px" src="<?php echo e(asset('static/img/ssl.png')); ?>" alt="ssl"></div>
                </div>
                <p class="copyright"><?php echo app('cache.config')->get('copyright'); ?></p>
            </div>



        </div>
        <div class="back-top" id="back-top">
            <a>
                <div class="line" ></div>
                <div class="icon"></div>
                <div class="text ">T<br>O<br>P</div>
            </a>
        </div>
    </footer>
</body>


<?php $__env->startSection('script'); ?>


<script src="<?php echo e(asset('static/swiper4/swiper.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>


<script src="<?php echo e(asset('static/js/xie.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
<?php echo \App\Services\ConfigService::get('google_ga'); ?>

<?php echo $__env->yieldSection(); ?>
<script>
    $(function(){
        setTimeout(function(){
            $('body').removeClass('-loading');
        },2000);

    })
</script>
<script>
    $('#back-top').click(function (event) {
        event.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 500);
    })
</script>
<script type="text/javascript" charset="utf-8">
    $(function() {
        $("img.lazy").lazyload({effect: "fadeIn",placeholder:'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAIAAAACCAYAAABytg0kAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAHYcAAB2HAY/l8WUAAAASSURBVBhXY/g/2+4/CEMZdv8BZwgLXT+0H34AAAAASUVORK5CYII='});
    });
</script>

<script>
    $('.show-menu').click(function () {
        $('.main-menu').addClass('-show');
        $('body').append('<div class="shade"></div>');
        $('body').css('overflow', 'hidden');
    });
    $('.close-menu').click(function(){
        $('.main-menu').removeClass('-show');
        $('.shade').remove();
        $('body').css('overflow', 'auto')
    });

    $('body').on('click','.shade',function(){
        $('.main-menu').removeClass('-show');
        $('.shade').remove();
        $('body').css('overflow', 'auto')
    });
</script>
</html>
<?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/web/layout.blade.php ENDPATH**/ ?>