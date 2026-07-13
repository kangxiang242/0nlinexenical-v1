@php if(!isset($layout)) $layout = []; $layout["banners"] = $layout["banners"] ?? []; $layout["seo"] = $layout["seo"] ?? null; @endphp<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <meta http-equiv="content-language" content="zh-tw">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(isset($layout['seo']))
    <title>{{ isset($layout['seo'])?$layout['seo']->title:"" }}</title>
    @else
    @hasSection('title')
    <title>@yield('title')</title>
    @else
    <title>{{ isset($layout['seo'])?$layout['seo']->title:"" }}</title>
    @endif
    @endif

    @hasSection('keywords')
    <meta name="keywords" content="@yield('keywords')"/>
    @else
    <meta name="keywords" content="{{ isset($layout['seo'])?$layout['seo']->key_word:"" }}"/>
    @endif

    @hasSection('description')
    <meta name="description" content="@yield('description')"/>
    @else
    <meta name="description" content="{{ isset($layout['seo'])?$layout['seo']->description:"" }}"/>
    @endif
    <link rel="canonical" href="{{ config('app.url') }}/{{ trim(request()->path(),'/') }}">
    @if(config('app.m_url'))
        <link rel="alternate" media="only screen and (max-width: 640px)" href="{{ config('app.m_url') }}/{{ trim(request()->path(),'/') }}">
    @endif
    <link rel="shortcut icon" href="{{ \App\Services\ConfigService::get('favicon')?asset('uploads/'.\App\Services\ConfigService::get('favicon')):'/favicon.ico' }}">
    @section('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('static/css/style.css') }}?ver={{ config('app.asset_version') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('static/css/common.css') }}?ver={{ config('app.asset_version') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('static/less/global.css') }}?ver={{ config('app.asset_version') }}"/>
        @if(!is_googlebot())
        <link rel="stylesheet" href="{{ asset('static/font/iconfont.css') }}?ver={{ config('app.asset_version') }}">
        @endif
        <link rel="stylesheet" href="{{ asset('static/swiper4/swiper.min.css') }}?ver={{ config('app.asset_version') }}">
        <link rel="stylesheet" href="{{ asset('static/less/section.css') }}?ver={{ config('app.asset_version') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('static/wow/animate.min.css') }}?ver={{ config('app.asset_version') }}"/>
    @show

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
    <script src="{{ asset('static/js/jquery.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/observer.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/wow/wow.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/jquery_lazyload/jquery.lazyload.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script>
        new WOW({
            offset:150,
        }).init();
    </script>

    <script>
        var is_ajax_get_cart = 0;
        var flash_data = '{!! session()->get('flash') !!}';

        if(flash_data){
            flash_data = JSON.parse('{!! session()->get('flash') !!}');

        }else{
            flash_data = false;
        }

        var province = [];

        var free_shipping_where = parseInt("{{ \App\Services\ConfigService::get('freight_where',0) }}");
        var free_shipping_freight = parseInt("{{ \App\Services\ConfigService::get('freight',0) }}");

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
<body class=" {{ request()->is('/')?"page-index -loading":"" }} ">

    <header class="main-header">
        <div class="wrapper">
            <a class="logo" href="{{ URL::to('/') }}">
                <img class="fra fra-1" src="{{ asset('static/img/lg/fra-1.png') }}" alt="logo">
                <img class="fra fra-2" src="{{ asset('static/img/lg/fra-2.png') }}" alt="logo">
                <img class="fra fra-3"  src="{{ asset('static/img/lg/fra-3.png') }}" alt="logo">
            </a>
            <div class="base-sec">
                <ul class="base">
                    <li><a href="{{ URL::to('/') }}">首頁</a></li>
                    <li><a href="{{ URL::to('xenical') }}">瞭解羅氏鮮</a></li>
                    <li><a href="{{ URL::to('faq') }}">常見疑問解答Q&A</a></li>
                    <li><a href="{{ URL::to('news') }}">減肥知識分享</a></li>
                    <li class="has-dropdown">
                        <span class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">健康計算器</span>
                        <ul class="dropdown">
                            <li><a class="btn btn-ef2" href="{{ URL::to('bmi') }}" data-observer="頂部-瘦身計算機">BMI計算機<i class="iconfont">&#xe684;</i></a></li>
                            <li><a class="btn btn-ef2" href="{{ URL::to('bmr') }}" data-observer="頂部-瘦身計算機">BMR計算機<i class="iconfont">&#xe684;</i></a></li>
                            <li><a class="btn btn-ef2" href="{{ URL::to('body-fat') }}" data-observer="頂部-瘦身計算機">體脂肪率計算機<i class="iconfont">&#xe684;</i></a></li>
                        </ul>
                    </li>
                    <li><a class="btn shop-btn go-btn" href="{{ URL::to('product') }}" data-observer="頂部-線上訂購">訂購羅氏鮮<i class="iconfont">&#xe684;</i></a></li>
                </ul>
            </div>
            <div class="show-menu"><i class="iconfont">&#xe62c;</i></div>
        </div>
    </header>

    @section('menu')
        <div class="main-menu">
            <div class="close-menu"><i class="iconfont">&#xeca0;</i></div>
            <div class="menu">
                <p class="en-title">Home</p>
                <p class="nav-title nav-home"><a href="{{ URL::to('/') }}">首頁<i class="iconfont">&#xe775;</i></a></p>
            </div>
            <div class="menu">
                <p class="en-title">Product</p>
                <ul class="nav">
                    <li><a href="{{ URL::to('xenical') }}">瞭解羅氏鮮<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="{{ URL::to('product') }}">羅氏鮮線上訂購<i class="iconfont">&#xe775;</i></a></li>
                </ul>
            </div>
            <div class="menu">
                <p class="en-title">Slimming</p>
                <ul class="nav">
                    <li><a href="{{ URL::to('bmi') }}">BMI計算機<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="{{ URL::to('bmr') }}">BMR與TEDD計算機<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="{{ URL::to('body-fat') }}">體脂肪率計算機<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="{{ URL::to('faq') }}">減肥常見疑問解答<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="{{ URL::to('news') }}">減肥知識分享<i class="iconfont">&#xe775;</i></a></li>
                </ul>
            </div>
            <div class="menu">
                <p class="en-title">Service</p>
                <ul class="nav">
                    <li><a href="{{ URL::to('guide') }}">減肥藥訂購指南<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="{{ URL::to('payment-delivery') }}">付款與配送說明<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="{{ URL::to('after-sales') }}">售後服務<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="{{ URL::to('check') }}">訂單追蹤<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="{{ URL::to('message') }}">取得協助<i class="iconfont">&#xe775;</i></a></li>
                    <li><a href="{{ URL::to('privacy') }}">隱私權政策<i class="iconfont">&#xe775;</i></a></li>
                </ul>
            </div>
        </div>
    @show

    <div class="main-wrapper">
        @section('banners')
            @if($layout['banners'] && !$layout['banners']->isEmpty())
                <div class="banner-section">
                    @yield('embed-banner')
                        @foreach($layout['banners'] as $item)
                            @if($item->img)
                                <picture class="banner-img">
                                    <source media="(max-width: 1024px)" srcset="{{ asset_upload($item->m_img) }}">
                                    <source media="(min-width: 1025px)" srcset="{{ asset('uploads/'.$item->img) }}">
                                    <img src="{{ asset('uploads/'.$item->img) }}" alt="{{ $item->alt }}">
                                </picture>
                            @endif
                        @endforeach
                </div>
            @endif
        @show
        @yield('content')
    </div>

    @hasSection('breadcrumb')
        @if(!request()->is('/'))
            <ul class="breadcrumb">
                <li ><a href="{{ URL::to('/') }}">首頁</a></li>
                @yield('breadcrumb')
            </ul>
        @endif
    @endif

    <footer>
        <div class="wrapper column">
            <div class="footer-menu">
                <div class="menu">
                    <p class="en-title">Product</p>
                    <p class="footer-title">減肥產品</p>
                    <ul class="nav">
                        <li><a href="{{ URL::to('xenical') }}">瞭解羅氏鮮<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ URL::to('product') }}">訂購羅氏鮮減肥藥<i class="iconfont">&#xe775;</i></a></li>
                    </ul>
                </div>
                <div class="menu">
                    <p class="en-title">Slimming</p>
                    <p class="footer-title">減肥專欄</p>
                    <ul class="nav">
                        <li><a href="{{ URL::to('bmi') }}">BMI計算機<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ URL::to('bmr') }}">BMR與TEDD計算機<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ URL::to('body-fat') }}">體脂肪率計算機<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ URL::to('faq') }}">減肥常見疑問解答Q&A<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ URL::to('news') }}">減肥知識分享<i class="iconfont">&#xe775;</i></a></li>
                    </ul>
                </div>
                <div class="menu">
                    <p class="en-title">Service</p>
                    <p class="footer-title">購物服務</p>
                    <ul class="nav">
                        <li><a href="{{ URL::to('guide') }}">減肥藥訂購指南<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ URL::to('payment-delivery') }}">付款與配送說明<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ URL::to('after-sales') }}">售後服務<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ URL::to('check') }}">訂單追蹤<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ URL::to('message') }}">取得協助<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ URL::to('privacy') }}">隱私權政策<i class="iconfont">&#xe775;</i></a></li>
                    </ul>
                </div>
                <a class="buy" href="{{ URL::to('product') }}">
                    <i class="icon iconfont">&#xe64f;</i>
                    <div class="text">
                        <p class="en-title">Buy Online</p>
                        <p class="footer-title">羅氏鮮線上訂購<i class="arrow-right iconfont">&#xe613;</i></p>
                    </div>
                </a>
            </div>


            <div class="description">
                <div class="partner">
                    <div class="icon"><img style="width: 126px" src="{{ asset('static/img/fdausa.png') }}" alt="fda-usa"></div>
                    <div class="icon"><img style="width: 152px" src="{{ asset('static/img/ema.png') }}" alt="ema"></div>
                    <div class="icon"><img style="width: 60px" src="{{ asset('static/img/ROCHE.png') }}" alt="ROCHE"></div>
                    <div class="icon"><img style="width: 140px" src="{{ asset('static/img/CHEPLA.png') }}" alt="CHEPLA"></div>
                    <div class="icon"><img style="width: 52px" src="{{ asset('static/img/ssl.png') }}" alt="ssl"></div>
                </div>
                <p class="copyright">{!! app('cache.config')->get('copyright') !!}</p>
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


@section('script')
{{--<script src="{{ asset('static/js/less.min.js') }}?ver={{ config('app.asset_version') }}"></script>--}}

<script src="{{ asset('static/swiper4/swiper.min.js') }}?ver={{ config('app.asset_version') }}"></script>
{{--<script src="{{ asset('static/js/jquery.cookie.js') }}?ver={{ config('app.asset_version') }}"></script>--}}
{{--<script src="{{ asset('static/js/cart.js') }}?ver={{ config('app.asset_version') }}"></script>--}}
<script src="{{ asset('static/js/xie.js') }}?ver={{ config('app.asset_version') }}"></script>
{!! \App\Services\ConfigService::get('google_ga') !!}
@show
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
