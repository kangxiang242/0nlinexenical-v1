@extends('web::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/index.css') }}?ver={{ config('app.asset_version') }}"/>

    <style>
        .swiper-container {
            height: 100vh;
        }

        .swiper-slide {
            overflow: hidden;
        }

        .slide-inner {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background-size: cover;
            background-position: center;
        }

        .splitting.-aos-active .char {
            -webkit-animation: splitting 1.2s cubic-bezier(.245,.495,0,.99) forwards;
            animation: splitting 1.2s cubic-bezier(.245,.495,0,.99) forwards;
            -webkit-animation-delay: calc(30ms*var(--char-index));
            animation-delay: calc(30ms*var(--char-index))
        }

        .splitting .word {
            display: inline-block;
            overflow: hidden;
            padding-right: 10px;
        }

        .splitting .char {
            display: inline-block;
            -webkit-transform: translate3d(0,100%,0);
            transform: translate3d(0,100%,0);
            opacity: 0
        }

        @-webkit-keyframes splitting {
            to {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }
        }

        @keyframes splitting {
            to {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }
        }

        @-webkit-keyframes splitting-in {
            0% {
                opacity: 1;
                -webkit-transform: translate3d(0,100%,0);
                transform: translate3d(0,100%,0)
            }

            to {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }
        }

        @keyframes splitting-in {
            0% {
                opacity: 1;
                -webkit-transform: translate3d(0,100%,0);
                transform: translate3d(0,100%,0)
            }

            to {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }
        }

        @-webkit-keyframes splitting-out {
            0% {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }

            to {
                opacity: 0;
                -webkit-transform: translate3d(0,-100%,0);
                transform: translate3d(0,-100%,0)
            }
        }

        @keyframes splitting-out {
            0% {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }

            to {
                opacity: 0;
                -webkit-transform: translate3d(0,-100%,0);
                transform: translate3d(0,-100%,0)
            }
        }



        .text-animation-main {
            width: 100%;
            height: 100%;

            top: 0;
            left: 0;
            display: block;
            opacity: 0;
            -webkit-transition: opacity 3s;
            transition: opacity 3s
        }

        .text-animation-main .splitting.-aos-active .char {
            -webkit-transform: translate(0) scaleY(1) rotateX(0) rotate(0);
            transform: translate(0) scaleY(1) rotateX(0) rotate(0);
            -webkit-animation: none;
            animation: none;
            -webkit-animation-delay: calc(30ms*var(--char-index));
            animation-delay: calc(30ms*var(--char-index))
        }

        .text-animation-main.-show {
            opacity: 1;
            z-index: 2;
            -webkit-transition: opacity 2s;
            transition: opacity 2s;
            pointer-events: all
        }

        .text-animation-main.-show .splitting.-aos-active .char {
            opacity: 0;
            -webkit-animation: splitting-in 1.2s cubic-bezier(.99,0,.755,.505) forwards;
            animation: splitting-in 1.2s cubic-bezier(.99,0,.755,.505) forwards;
            -webkit-animation-delay: calc(30ms*var(--char-index));
            animation-delay: calc(30ms*var(--char-index))
        }

        .text-animation-main:not(.-show) {
            pointer-events: none;
            z-index: 1
        }

        .text-animation-main:not(.-show) .splitting.-aos-active .char {
            opacity: 1;
            -webkit-animation: splitting-out .8s cubic-bezier(.99,0,.755,.505) forwards;
            animation: splitting-out .8s cubic-bezier(.99,0,.755,.505) forwards;
            -webkit-animation-delay: calc(30ms*var(--char-index));
            animation-delay: calc(30ms*var(--char-index))
        }



    </style>
@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.textAnimation.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.waypoints.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/countUp.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/a/js/jquery.parallax-scroll.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.parallax.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.marquee.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script>
        $(window).resize(function(){
            handleVideoResize();
        });

        handleVideoResize();

        function handleVideoResize() {
            if (window.innerWidth > 1024) {
                resizeVideo();
            } else {
                var screenWidth = window.innerWidth;
                var mWidth = Math.round(screenWidth * 0.8);
                $('.video-main').css('width', mWidth + 'px');
            }
        }

        function resizeVideo(){
            var marginLeft = parseInt($('.about.wrapper').css('marginLeft')) || 0;
            var video_width = 1000 + marginLeft;
            $('.video-main').css('width', video_width + 'px');
        }
    </script>

    <script>
        var is_epilogue_waypoints = false;
        $('.epilogue').waypoint(function(direction) {
            if(is_epilogue_waypoints === false){
                is_epilogue_waypoints = true;
                $('.epilogue .text').textAnimation({
                    speed: 600,
                    delay: 100,
                    left: 50,
                    top: 50,
                    scale: 1,
                    rotateY: 0,
                    rotateX: 0,
                    translateZ: 1000,
                    letterSpacing: '10px',
                    easing: "cubic-bezier(0.290, 0.350, 0.460, 1.200)",
                    backgroundColor: "transparent",
                    isRandomScale: false,
                    isRandomPosition: false,
                    isRandomRotateY: false,
                    isRandomRotateX: false,
                    isRandomTranslateZ: false,
                    isRandomSpeed: false,
                    isRandomDelay: false});

            }


        }, {
            offset: '70%'
        })

        setTimeout(function(){

            $('.slogan').textAnimation({
                speed: 600,
                delay: 100,
                left: 10,
                top: 10,
                scale: 1,
                rotateY: 0,
                rotateX: 0,
                translateZ: 1000,
                letterSpacing: '10px',
                easing: "cubic-bezier(0.290, 0.350, 0.460, 1.200)",
                backgroundColor: "transparent",
                isRandomScale: false,
                isRandomPosition: false,
                isRandomRotateY: false,
                isRandomRotateX: false,
                isRandomTranslateZ: false,
                isRandomSpeed: false,
                isRandomDelay: false
            });

        },1000)


        $('#use-num').waypoint(function(direction) {
            let demo = new CountUp('use-num',0, 25000000,0,4,{
                useEasing: true,
                useGrouping: true,
            });
            demo.start();

        }, {
            offset: '100%'
        })

        $('.chooseline').waypoint(function(direction) {

            $('#ts-svg').addClass('ts-svg')

        }, {
            offset: '50%'
        })

        $('.how').waypoint(function(direction) {
            $('.appear-1').addClass('animate__animated animate__fadeInUp')
            setTimeout(function(){
                $('.appear-2').addClass('animate__animated animate__fadeInUp')
            },500)
            setTimeout(function(){
                $('.appear-3').addClass('animate__animated animate__fadeInUp')
            },1000)
            setTimeout(function(){
                $('.appear-4').addClass('animate__animated animate__fadeInUp')
            },1500)


        }, {
            offset: '50%'
        })

    </script>
    <script>
        textAnimation("#text-banner-0 .text-effect-p1");
        textAnimation("#text-banner-0 .text-effect-p2");
        textAnimation("#text-banner-0 .text-effect-p3");

        textAnimation("#text-banner-1 .text-effect-p1");
        textAnimation("#text-banner-1 .text-effect-p2");
        textAnimation("#text-banner-1 .text-effect-p3");

        textAnimation("#text-banner-2 .text-effect-p1");
        textAnimation("#text-banner-2 .text-effect-p2");
        textAnimation("#text-banner-2 .text-effect-p3");

    </script>
    <script>
        var state = 0; //0表示没有进行动画过渡，1表示在进行动画过渡
        function rotate(dir) {

            if (dir == 1 && state == 0) {
                state = 1;
                var origin_elem = $('.sef-activate');

                var last_elem = $('.sef-activate').prev();

                if(last_elem.length <= 0){
                    last_elem = $('.sef').last();
                }



                origin_elem.removeClass('sef-activate');


                last_elem.addClass('sef-activate');


                origin_elem.css({
                    'left':'0px',
                });


                var next1 = origin_elem.next()
                if(next1.length <= 0){
                    next1 = $('.sef').first();

                }
                next1.css({
                    'left': '300px',
                });


                var next2 = next1.next();
                if(next2.length <= 0){
                    next2 = $('.sef').first();
                }



                next2.css({
                    'left': '600px',
                });


                var next3 = next2.next();
                if(next3.length <= 0){
                    next3 = $('.sef').first();
                }
                next3.css({
                    'left': '900px',
                });

                state = 0;


            } else if (dir == 2 && state == 0) {
                state = 1;

                var origin_elem = $('.sef-activate');

                var next_elem = $('.sef-activate').next();

                if(next_elem.length <= 0){
                    next_elem = $('.sef').first();
                }



                origin_elem.removeClass('sef-activate');


                next_elem.addClass('sef-activate');


                origin_elem.css({
                    'left':'900px',
                });


                var prev1 = origin_elem.prev()
                if(prev1.length <= 0){
                    prev1 = $('.sef').last();

                }
                prev1.css({
                    'left': '600px',
                });


               var prev2 = prev1.prev();
                if(prev2.length <= 0){
                    prev2 = $('.sef').last();
                }

                prev2.css({
                    'left': '300px',
                });


                var prev3 = prev2.prev();
               if(prev3.length <= 0){
                   prev3 = $('.sef').last();
               }
               prev3.css({
                   'left': '0px',
               });

                state = 0;



            }
        }
    </script>

    <script>
        // 全局的加載視頻函數，避免重複加載
        function loadVideo(video) {
            if (!video || video.querySelector('source')) {
                return;
            }
            
            const isMobile = window.innerWidth <= 1024;
            const pcSrc = video.getAttribute('data-pc');
            const mSrc = video.getAttribute('data-m');
            const src = isMobile ? mSrc : pcSrc;

            // 更新封面圖（根據設備類型）
            const posterPc = video.getAttribute('data-poster-pc');
            const posterM = video.getAttribute('data-poster-m');
            if (posterPc && posterM) {
                video.poster = isMobile ? posterM : posterPc;
            }

            const source = document.createElement('source');
            source.src = src;
            source.type = 'video/mp4';
            video.appendChild(source);
            video.load();
        }
        
        // 播放視頻（在加載完成後）
        function playVideo(video) {
            if (!video) return;
            
            // 如果視頻還沒有加載，先加載它
            if (!video.querySelector('source')) {
                loadVideo(video);
                
                // 等待視頻可以播放後再播放
                video.addEventListener('canplay', function playVideoHandler() {
                    video.play().catch(() => {});
                    video.removeEventListener('canplay', playVideoHandler);
                }, { once: true });
            } else {
                // 已經加載，直接播放
                if (video.readyState >= 2) {
                    video.play().catch(() => {});
                } else {
                    video.addEventListener('canplay', function playVideoHandler() {
                        video.play().catch(() => {});
                        video.removeEventListener('canplay', playVideoHandler);
                    }, { once: true });
                }
            }
        }
        
        document.addEventListener("DOMContentLoaded", function () {
            // 立即初始化 Swiper（使用封面圖，不需要等待視頻）
            initSwiperVideo();
            
            // 延遲加載第一個視頻（首屏可見），優化 LCP
            // 使用 requestIdleCallback 或 setTimeout 延遲加載
            const loadFirstVideo = () => {
                const initialVideoEls = document.querySelectorAll('.video-el');
                const firstVideo = initialVideoEls[0];
                
                if (firstVideo) {
                    // 延遲一小段時間後再開始加載視頻，讓封面圖先顯示
                    setTimeout(() => {
                        loadVideo(firstVideo);
                        // 視頻加載完成後自動播放
                        firstVideo.addEventListener('canplay', function() {
                            playVideo(firstVideo);
                        }, { once: true });
                    }, 100);
                }
            };
            
            // 使用 requestIdleCallback 如果可用，否則使用 setTimeout
            if ('requestIdleCallback' in window) {
                requestIdleCallback(loadFirstVideo, { timeout: 2000 });
            } else {
                setTimeout(loadFirstVideo, 500);
            }
        });

        function initSwiperVideo() {
            // 避免重複初始化
            if (window._swiperInitialized) return;
            window._swiperInitialized = true;

            const interleaveOffset = 0.5;
            const bannerImageScale = 1.1;
            
            const swiper = new Swiper("#swiper-video3", {
                loop: true,
                speed: 1000,
                autoplay: {
                    delay: 6000,
                    disableOnInteraction: false
                },
                grabCursor: true,
                watchSlidesProgress: true,
                pagination: {
                    el: '.progress',
                    clickable: true,
                    renderBullet: function (index, className) {
                        return '<div class="bar ' + className + '"></div>';
                    }
                },
                on: {
                    init: function() {
                        // Swiper 初始化時，確保第一個幻燈片的封面圖正確顯示
                        const firstSlide = this.slides[this.activeIndex];
                        const firstVideo = firstSlide?.querySelector("video");
                        if (firstVideo) {
                            // 更新封面圖（根據設備類型）
                            const isMobile = window.innerWidth <= 1024;
                            const posterPc = firstVideo.getAttribute('data-poster-pc');
                            const posterM = firstVideo.getAttribute('data-poster-m');
                            if (posterPc && posterM) {
                                firstVideo.poster = isMobile ? posterM : posterPc;
                            }
                        }
                    },
                    slideChange: function () {
                        const eq = this.activeIndex;
                        const slide = this.slides[eq];
                        const video = slide.querySelector("video");

                        if (video) {
                            // 更新封面圖（根據設備類型）
                            const isMobile = window.innerWidth <= 1024;
                            const posterPc = video.getAttribute('data-poster-pc');
                            const posterM = video.getAttribute('data-poster-m');
                            if (posterPc && posterM) {
                                video.poster = isMobile ? posterM : posterPc;
                            }
                            
                            // 加載並播放當前視頻
                            playVideo(video);
                        }

                        const bindTextId = slide.querySelector(".slide-inner")?.getAttribute("data-bind-text");
                        if (!bindTextId) return;

                        document.querySelectorAll('.text-animation-main').forEach(el => {
                            el.classList.remove('-show');
                        });

                        const currentGroup = document.getElementById(bindTextId);
                        if (currentGroup) {
                            currentGroup.querySelectorAll('.text-animation-main').forEach(el => {
                                el.classList.add('-show');
                            });
                        }
                    },
                    progress: function () {
                        const swiper = this;
                        for (let i = 0; i < swiper.slides.length; i++) {
                            const slideProgress = swiper.slides[i].progress;
                            const innerOffset = swiper.width * interleaveOffset;
                            const innerTranslate = slideProgress * innerOffset;
                            const innerScaleOffset = Math.abs(1 - bannerImageScale);
                            const innerScale = Math.abs(slideProgress * innerScaleOffset) + 1;
                            const inner = swiper.slides[i].querySelector(".slide-inner");
                            if (inner) {
                                inner.style.transform = "translate3d(" + innerTranslate + "px, 0, 0)";
                            }
                        }
                    },
                    touchStart: function () {
                        const swiper = this;
                        Array.from(swiper.slides).forEach(slide => {
                            slide.style.transition = "";
                        });
                    },
                    setTransition: function (speed) {
                        const swiper = this;
                        Array.from(swiper.slides).forEach(slide => {
                            slide.style.transition = speed + "ms";
                            const inner = slide.querySelector(".slide-inner");
                            if (inner) inner.style.transition = speed + "ms";
                        });
                    }
                }
            });
        }
    </script>

    <script>
        var is_marq = false;
        var animation_duration;
        $('#loopWrap').marquee({
            //duration in milliseconds of the marquee

            speed:60,
            //gap in pixels between the tickers
            gap: 0,
            //time in milliseconds before the marquee will start animating
            delayBeforeStart: 0,
            //'left' or 'right'
            direction: 'left',
            //true or false - should the marquee be duplicated to show an effect of continues flow
            duplicated: true,
            pauseOnHover:true,
            startVisible:true,

        });


        $(".epilogue-img").parallax({
            speed:20,
            delay: 1000,
            deviation:300,
        });

    </script>

    <script>
        let lastDigits = ['?', '?', '?'];
        function animateDigit(el, num, alwaysSpin = false) {
            const digitHeight = 44;
            const inner = el.querySelector('.digit-inner');
            let targetIndex = num === '?' ? 0 : (parseInt(num, 10) + 1);
            let currentTransform = inner.style.transform || 'translateY(0)';
            let currentIndex = 0;
            const match = currentTransform.match(/-([0-9]+)px/);
            if (match) currentIndex = Math.round(parseInt(match[1], 10) / digitHeight);

            if (!alwaysSpin && currentIndex === targetIndex) return;
            let rounds = alwaysSpin ? 1 : 0;
            let totalIndex = targetIndex + (rounds * 11);
            inner.style.transition = 'none';
            inner.style.transform = `translateY(0)`;
            void inner.offsetWidth;
            inner.style.transition = 'transform 1s ease-out';
            inner.style.transform = `translateY(-${totalIndex * digitHeight}px)`;
        }

        function animateBMIDisplay(bmi) {
            const fixedBMI = bmi.toFixed(1);
            const [intPartRaw, decPartRaw] = fixedBMI.split('.');
            const intPart = intPartRaw.padStart(2, '0');
            const decPart = decPartRaw ? decPartRaw[0] : '0';
            const digits = [intPart[0], intPart[1], '.', decPart];
            const int1 = document.getElementById('int1');
            const int2 = document.getElementById('int2');
            const dec1 = document.getElementById('dec1');
            animateDigit(int1, digits[0] || '0', false);
            animateDigit(int2, digits[1] || '0', false);
            animateDigit(dec1, digits[3] || '0', false);
            lastDigits = [digits[0] || '0', digits[1] || '0', digits[3] || '0'];
        }

        
        window.addEventListener('DOMContentLoaded', function() {
            animateDigit(document.getElementById('int1'), '?');
            animateDigit(document.getElementById('int2'), '?');
            animateDigit(document.getElementById('dec1'), '?');
            lastDigits = ['?', '?', '?'];
        });

        
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.count').addEventListener('click', function () {
                const height = parseFloat(document.getElementById('height').value);
                const weight = parseFloat(document.getElementById('weight').value);

                if (!height || !weight || height <= 0 || weight <= 0) {
                    alert("請正確輸入身高與體重");
                    return;
                }

                const bmi = weight / ((height / 100) ** 2);
                animateBMIDisplay(bmi);
            });

            document.querySelector('.reset').addEventListener('click', function () {
                document.getElementById('height').value = '';
                document.getElementById('weight').value = '';
                animateDigit(document.getElementById('int1'), '?');
                animateDigit(document.getElementById('int2'), '?');
                animateDigit(document.getElementById('dec1'), '?');
                lastDigits = ['?', '?', '?'];
            });
        });
    </script>
@stop


@section('content')
    <section class="index-banner" role="region" aria-labelledby="slogan">
        <h1 class="slogan" id="slogan"> 精準管理BMI，找到專屬妳的減肥減重方法</h1>
        <div class="video-main">
            <div class="swiper-container" id="swiper-video3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-inner" data-bind-text="text-banner-0">
                            <video class="video-el"
                                data-pc="{{ asset('static/video/1.mp4') }}"
                                data-m="{{ asset('static/video/m1.mp4') }}"
                                data-poster-pc="{{ asset('static/video/poster1.webp') }}"
                                data-poster-m="{{ asset('static/video/poster1-m.webp') }}"
                                poster="{{ asset('static/video/poster1.webp') }}"
                                width="100%" height="100%" loop muted playsinline
                                preload="none" aria-hidden="true"></video>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="slide-inner" data-bind-text="text-banner-1">
                            <video class="video-el"
                                data-pc="{{ asset('static/video/2.mp4') }}"
                                data-m="{{ asset('static/video/m2.mp4') }}"
                                data-poster-pc="{{ asset('static/video/poster2.webp') }}"
                                data-poster-m="{{ asset('static/video/poster2-m.webp') }}"
                                poster="{{ asset('static/video/poster2.webp') }}"
                                width="100%" height="100%" loop muted playsinline
                                preload="none" aria-hidden="true"></video>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="slide-inner" data-bind-text="text-banner-2">
                            <video class="video-el"
                                data-pc="{{ asset('static/video/3.mp4') }}"
                                data-m="{{ asset('static/video/m3.mp4') }}"
                                data-poster-pc="{{ asset('static/video/poster3.webp') }}"
                                data-poster-m="{{ asset('static/video/poster3-m.webp') }}"
                                poster="{{ asset('static/video/poster3.webp') }}"
                                width="100%" height="100%" loop muted playsinline
                                preload="none" aria-hidden="true"></video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="progress"></div>
            <div class="text-effect" id="text-banner-0">
                <p class="text-effect-p1">Safety&nbsp;</p>
                <p class="text-effect-p2"><strong>瞭解BMI安全減肥</strong></p>
                <p class="text-effect-p3">從BMI瞭解妳的身體狀況，穩定減重不傷身</p>
            </div>
            <div class="text-effect" id="text-banner-1" >
                <p class="text-effect-p1">Effective&nbsp;</p>
                <p class="text-effect-p2"><strong>降低BMI有效減肥</strong></p>
                <p class="text-effect-p3">從計算BMI開始，找到適合自己的減重方法</p>
            </div>
            <div class="text-effect" id="text-banner-2" >
                <p class="text-effect-p1">Healthy&nbsp;</p>
                <p class="text-effect-p2"><strong>管理BMI健康減肥</strong></p>
                <p class="text-effect-p3">關注BMI變化，減重減脂不再復胖</p>
            </div>
        </div>   
    </section>

    <section class="bmi wrapper column" role="region" aria-labelledby="bmi-calc-title">
        <h2 class="main-title" id="bmi-calc-title">BMI計算工具｜快速評估妳的體重與健康狀態</h2>
        <p class="title-sub">{!! app('cache.config')->get('home_bmi_desc_gb') !!}</p>
        <div class="bmi-wrapper">
            <div class="calculate column">
                <header class="bmi-modal">
                    <h3 class="bmi-title">BMI計算器</h3>
                    <p class="bmi-sub">{!! app('cache.config')->get('page_bmi_subdesc_gb') !!}</p>
                </header>
                <form class="evaluate-form" onsubmit="return false;">
                    <div class="form-group">
                        <label class="form-title" for="height">你的身高：</label>
                        <input class="form-control" type="number" id="height" name="height" placeholder="" inputmode="decimal">
                        <span class="form-title">公分</span>
                    </div>
                    <div class="form-group">
                        <label class="form-title" for="weight">你的體重：</label>
                        <input class="form-control" type="number" id="weight" name="weight" placeholder="" inputmode="decimal">
                        <span class="form-title">公斤</span>
                    </div>
                    <div class="btns">
                        <button class="btn reset" type="reset">重設</button>
                        <button class="btn count btn-ef1" type="button">開始計算</button>
                    </div>
                    <p class="privacy-note">本BMI計算器僅於瀏覽器端運算，不會傳送或儲存任何輸入資料。如需更多資訊，請參閱<a href="/privacy" rel="nofollow">隱私權政策</a>。</p>
                </form>
                <div class="result">
                    <h4 class="result-title">你的BMI結果為</h4>
                    <p class="result-num" >
                        <span class="digit" id="int1" aria-hidden="true">
                            <span class="digit-inner">
                                <span>?</span><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span>
                            </span>
                        </span>
                        <span class="digit" id="int2" aria-hidden="true">
                            <span class="digit-inner">
                                <span>?</span><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span>
                            </span>
                        </span>
                        <span class="dot" aria-hidden="true">.</span>
                        <span class="digit" id="dec1" aria-hidden="true">
                            <span class="digit-inner">
                                <span>?</span><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span>
                            </span>
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="comparison column">
                <header class="bmi-modal">
                    <h3 class="bmi-title">BMI參照表</h3>
                    <p class="bmi-sub">{!! app('cache.config')->get('page_bmi_subdesc2_gb') !!}</p>
                </header>
                <table class="bmi-table">
                    <thead>
                        <tr>
                        <th scope="col">BMI值範圍</th>
                        <th scope="col">體重是否正常</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bmi-underweight">
                        <td>BMI&lt;18.5</td>
                        <td>「體重過輕」，需要多運動，均衡飲食，以增加體能，維持健康！</td>
                        </tr>
                        <tr class="bmi-normal">
                        <td>18.5&le;BMI&lt;24</td>
                        <td>恭喜！「健康體重」，要繼續保持！</td>
                        </tr>
                        <tr class="bmi-overweight">
                        <td>24&le;BMI&lt;27</td>
                        <td>哦！有點「體重過重」了，要小心囉，趕快力行「健康體重管理」！</td>
                        </tr>
                        <tr class="bmi-obese">
                        <td>BMI&ge;27</td>
                        <td>啊～「肥胖」了，需要立刻力行「健康體重管理」囉！</td>
                        </tr>
                    </tbody>
                </table>
                <p class="bmi-sub">資料來源：衛生福利部國民健康署</p>
            </div>
        </div>
        <nav aria-label="延伸閱讀：BMI詳細介紹">
            <p class="more">想了解更多關於 BMI 的知識？<a href="/bmi" class="go-btn btn-ef1">前往BMI詳細介紹<i class="iconfont">&#xe684;</i></a></p>
        </nav>
    </section>

    @foreach($cates as $cate)
    <section class="method wrapper column" aria-labelledby="diet-method-title">
        <h2 class="main-title" id="diet-method-title">{{ $cate->name }}</h2>
        
        <div class="method-intro">
            <div class="method-intro-main">
                <div class="title-sub">{!! $cate->desc_gb !!}</div>
                <div class="comparison">
                    <div class="comparison-block">
                        <h3 class="comparison-title">優點</h3>
                        @if($cate->advantage_gb)
                        <ul class="comparison-list">
                            @foreach(explode(PHP_EOL,$cate->advantage_gb) as $k=>$v)
                            <li class="comparison-item">{{ $v }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <div class="comparison-block">
                        <h3 class="comparison-title">缺點</h3>
                        @if($cate->shortcoming_gb)
                            <ul class="comparison-list">
                                @foreach(explode(PHP_EOL,$cate->shortcoming_gb) as $k=>$v)
                                    <li class="comparison-item">{{ $v }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                @if($cate->options_gb)
                <dl class="suitability">
                    @foreach($cate->options_gb as $v)
                    <dt class="suitability-title">{{ $v['title'] }}</dt>
                    <dd class="suitability-item">{{ $v['content'] }}</dd>
                    @endforeach
                </dl>
                @endif

                <div class="method-faq">
                    <h3 class="method-faq-title">{{ $cate->name }}常見疑問</h3>
                    @foreach($cate->faqs as $key=>$faq)
                        @if($key<3)
                        <details class="faq-item" open>
                            <summary class="faq-question">
                                <span class="question-text">Q：{{ $faq->questions_gb }}</span>
                                <i class="iconfont faq-icon">&#xeca2;</i>
                            </summary>
                            <p class="faq-answer">A：{{ $faq->answers_gb }}</p>
                        </details>
                        @endif
                    @endforeach

                </div>
            </div>

            <img class="method-pic" src="{{ asset('uploads/'.$cate->image) }}" alt="{{ $cate->name }}法調整BMI與體脂的示意圖">
        </div>

        <div class="method-articles">
            <h3 class="method-articles-title">延伸閱讀：{{ $cate->name }}推薦文章</h3>
            <nav aria-label="延伸閱讀：{{ $cate->name }}推薦文章">
                <ul class="articles-list">
                @foreach($cate->article as $key=>$item)
                    @if($key<3)
                    <li class="articles-item">
                        <a href="{{ URL::to('news/'.$item->id) }}">
                            <img src="{{ asset('uploads/'.$item->img) }}" alt="{{ $item->title }}">
                            <h4 class="articles-title">{{ $item->title }}</h4>
                        </a>
                    </li>
                    @endif
                @endforeach
                </ul>
            </nav>
        </div>
    </section>
    @endforeach

    <section class="compare wrapper column" aria-labelledby="compare-title">
        <h2 class="main-title" id="compare-title">減肥方式比較</h2>
        <p class="title-sub">{{ app('cache.config')->get('compare_desc_gb') }}</p>
        <table class="compare-wrapper">
            <caption class="visually-hidden">四種減肥方式比較表</caption>
            <thead class="compare-head">
                <tr class="compare-item">
                    <th class="compare-item-title" scope="col">減肥方式</th>
                    <th class="compare-item-content" scope="col">飲食減肥</th>
                    <th class="compare-item-content" scope="col">運動減肥</th>
                    <th class="compare-item-content" scope="col">手術減肥</th>
                    <th class="compare-item-content" scope="col">藥物減肥</th>
                </tr>
            </thead>
            <tbody class="compare-body">
                @foreach(configToArray(app('cache.config')->get('compare_gb')) as $v)
                    <tr class="compare-item">
                        <th class="compare-item-title" scope="row">{{ $v['text'] }}</th>
                        <td class="compare-item-content">{{ $v['diet'] }}</td>
                        <td class="compare-item-content">{{ $v['sports'] }}</td>
                        <td class="compare-item-content">{{ $v['operation'] }}</td>
                        <td class="compare-item-content">{{ $v['drug'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </section>

    <section class="about wrapper column" aria-labelledby="about-title">
        <header class="wow animate__animated animate__fadeInUp">
            <h2 class="main-title" id="about-title">{!! app('cache.config')->get('home_about_title_gb') !!}</h2>
            <div class="title-sub">{!! app('cache.config')->get('home_about_gb') !!}</div>
            <div class="xl-main">
                <p class="xl-title">羅氏鮮減肥藥上市至今累計銷量突破</p>
                <div class="text">
                    <span class="num" id="use-num">25,000,000</span><span class="em">盒</span>
                </div>
            </div>
            <a class="go-btn btn-ef1" href="/xenical">查看羅氏鮮減肥藥詳細介紹<i class="iconfont">&#xe684;</i></a>
        </header>
        <div class="suit-sec">
            <header class="suit">
                <h3 class="main-title wow animate__animated animate__fadeInUp">{!! app('cache.config')->get('home_about_title2_gb') !!}</h3>
                <div class="title-sub wow animate__animated animate__fadeInUp">{!! app('cache.config')->get('home_about2_gb') !!}</div>
            </header>
            <ul class="suit-content wow animate__animated animate__fadeInUp">
                @foreach($for_people as $key=>$item)
                    @php
                        $people_key = $key+1;
                        if(is_mobile()){
                            if($people_key%3==1){
                               $y = '-80';
                            }elseif ($people_key%3==2){
                               $y = '50';
                            }else{
                                $y = '-30';
                            }

                        }else{
                            $y = $people_key%2==0?'-100':'100';
                        }
                    @endphp
                    <li class="item" data-parallax='{"y": {{ $y }}}'>
                        <img src="{{ asset('uploads/'.$item->img) }}" alt="{{ $item->text }}">
                        <p class="text">{{ $item->text }}</p>
                    </li>

                @endforeach
            </ul>
        </div>
    </section>
    <section class="product wrapper column" aria-labelledby="product-title">
        <header class="buy">
            <h2 class="main-title wow animate__animated animate__fadeInUp" id="product-title">線上訂購減肥藥羅氏鮮，不同BMI階段都有對應的減肥方案</h2>
            <p class="title-sub wow animate__animated animate__fadeInUp">{!! app('cache.config')->get('home_product_desc_gb') !!}</p>
        </header>
        <ul class="goods wow animate__animated animate__fadeInUp">
            @foreach($products as $key=>$item)
                @if($key < 6)
                <li class="item">
                    <img class="goods-img" src="{{ asset('uploads/'.$item->img) }}?ver={{ config('app.asset_version') }}" alt="{{ $item->sub_name }} {{ $item->name_en }}{{ $item->name }}{{ $item->quantity }}{{ $item->id == 1 ? '盒標準裝' : '盒優惠裝' }}">
                    <div class="info">
                        <h3 class="goods-title"><span>{{ $item->sub_name }}</span><span><span style="letter-spacing: -1px;margin-right: 4px;">{{ $item->name_en }}</span>{{ $item->name }}</span><span>{{ $item->quantity }}{{ $item->id == 1 ? '盒標準裝' : '盒優惠裝' }}</span></h3>
                        <p class="price-sec">
                            @php
                                $diff = $item->market_price - $item->price;
                                $percent = $item->market_price > 0 ? round(($diff / $item->market_price) * 100) : 0;
                            @endphp
                            <span class="price"><span class="twd">NT$</span>{{ number_format(round($item->price)) }}</span>
                            @if($diff > 0)
                                <span class="market-price"><span class="twd">NT$</span>{{ number_format($item->market_price) }}</span>
                            @endif
                            
                            <span class="discount">
                                @if($diff > 0)
                                    優惠{{ $percent }}%
                                @else
                                    官方售價
                                @endif
                            </span>
                        </p>
                        <div class="btn-sec">
                            <a class="shop-btn go-btn btn-ef1" href="{{ URL::to('checkout/'.$item->id) }}"  data-observer="立即訂購-{{ $item->name }}">立即訂購<i class="iconfont">&#xe684;</i></a>
                            <a class="go-info btn-ef2" href="{{ URL::to('product/'.$item->id) }}" data-observer="詳情-{{ $item->name }}">詳情</a>
                        </div>
                    </div>
                </li>
                @endif
            @endforeach
        </ul>
    </section>
    <section class="news">
        <h2 class="main-title wow animate__animated animate__fadeInUp">最新減肥知識分享</h2>
        <div class="news-main">
            <div class="image-wrap wow animate__animated animate__fadeInUp">
                <div class="box epilogue-img" style="background-image: url({{ asset('uploads/'.app('cache.config')->get('promote_image')) }})"></div>
            </div>
            <div class="news-wrap">
                @foreach($news as $item)
                    <article class="item wow animate__animated animate__fadeInUp">
                        <a class="info" href="{{ URL::to('news/'.$item->id) }}">
                            <div class="newsInfoIdxBox">
                                <p class="newsDateBox">
                                    <span class="day">{{ $item->release_at->format('d') }}</span>
                                    <span class="ym">{{ $item->release_at->format('M') }}</span>
                                </p>
                                <h3 class="news-title">{{ $item->title }}</h3>
                            </div>
                            <p class="sub">
                                {{ \Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),120) }}
                            </p>
                            <span class="go btn-ef1">閱讀全文<i class="iconfont">&#xe684;</i></span>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
