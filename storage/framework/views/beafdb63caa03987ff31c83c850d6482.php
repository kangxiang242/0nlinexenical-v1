<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/index.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/js/jquery.textAnimation.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/jquery.waypoints.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/countUp.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/a/js/jquery.parallax-scroll.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/jquery.parallax.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/jquery.marquee.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
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
        function loadVideo(video) {
            if (!video || video.querySelector('source')) {
                return;
            }
            
            const isMobile = window.innerWidth <= 1024;
            const pcSrc = video.getAttribute('data-pc');
            const mSrc = video.getAttribute('data-m');
            const src = isMobile ? mSrc : pcSrc;

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
        
        function playVideo(video) {
            if (!video) return;
            
            if (!video.querySelector('source')) {
                loadVideo(video);
                
                video.addEventListener('canplay', function playVideoHandler() {
                    video.play().catch(() => {});
                    video.removeEventListener('canplay', playVideoHandler);
                }, { once: true });
            } else {
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
            initSwiperVideo();
            
            const loadFirstVideo = () => {
                const initialVideoEls = document.querySelectorAll('.video-el');
                const firstVideo = initialVideoEls[0];
                
                if (firstVideo) {
                    setTimeout(() => {
                        loadVideo(firstVideo);
                        firstVideo.addEventListener('canplay', function() {
                            playVideo(firstVideo);
                        }, { once: true });
                    }, 100);
                }
            };
            
            if ('requestIdleCallback' in window) {
                requestIdleCallback(loadFirstVideo, { timeout: 2000 });
            } else {
                setTimeout(loadFirstVideo, 500);
            }
        });

        function initSwiperVideo() {
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
                        const firstSlide = this.slides[this.activeIndex];
                        const firstVideo = firstSlide?.querySelector("video");
                        if (firstVideo) {
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
                            const isMobile = window.innerWidth <= 1024;
                            const posterPc = video.getAttribute('data-poster-pc');
                            const posterM = video.getAttribute('data-poster-m');
                            if (posterPc && posterM) {
                                video.poster = isMobile ? posterM : posterPc;
                            }
                            
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
            deviation:600,
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this;
                    const args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }

            const faqItems = document.querySelectorAll('.faq-item');

            function calculateHeights() {
                faqItems.forEach(item => {
                    const question = item.querySelector('.faq-question');
                    const answer = item.querySelector('.faq-answer');

                    const wasOpen = item.classList.contains('open');
                    if (!wasOpen) {
                        item.classList.add('open');
                        item.offsetHeight;
                    }

                    const questionHeight = question.offsetHeight;
                    const fullHeight = item.offsetHeight;

                    item.style.setProperty('--collapsed-height', `${questionHeight}px`);
                    item.style.setProperty('--expanded-height', `${fullHeight}px`);

                    if (!wasOpen) {
                        item.classList.remove('open');
                    }
                });
            }

            calculateHeights();

            if (faqItems.length > 0) {
                faqItems[0].classList.add('open');
            }

            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                question.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isOpen = item.classList.contains('open');
                    
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('open')) {
                            otherItem.classList.remove('open');
                        }
                    });

                    if (isOpen) {
                        item.classList.remove('open');
                    } else {
                        item.classList.add('open');
                    }
                });
            });

            window.addEventListener('resize', debounce(calculateHeights, 250));
        });
    </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="index-banner">
        <p class="slogan"> 找到專屬妳的減肥方法<i class="iconfont beat">&#xe784;</i></p>
        <div class="video-main">
            <div class="swiper-container" id="swiper-video3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-inner" data-bind-text="text-banner-0">
                            <video class="video-el"
                                data-pc="<?php echo e(asset('static/video/1.mp4')); ?>"
                                data-m="<?php echo e(asset('static/video/m1.mp4')); ?>"
                                data-poster-pc="<?php echo e(asset('static/video/poster1.webp')); ?>"
                                data-poster-m="<?php echo e(asset('static/video/poster1-m.webp')); ?>"
                                poster="<?php echo e(asset('static/video/poster1.webp')); ?>"
                                width="100%" height="100%" loop muted playsinline
                                preload="none" aria-hidden="true"></video>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="slide-inner" data-bind-text="text-banner-1">
                            <video class="video-el"
                                data-pc="<?php echo e(asset('static/video/2.mp4')); ?>"
                                data-m="<?php echo e(asset('static/video/m2.mp4')); ?>"
                                data-poster-pc="<?php echo e(asset('static/video/poster2.webp')); ?>"
                                data-poster-m="<?php echo e(asset('static/video/poster2-m.webp')); ?>"
                                poster="<?php echo e(asset('static/video/poster2.webp')); ?>"
                                width="100%" height="100%" loop muted playsinline
                                preload="none" aria-hidden="true"></video>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="slide-inner" data-bind-text="text-banner-2">
                            <video class="video-el"
                                data-pc="<?php echo e(asset('static/video/3.mp4')); ?>"
                                data-m="<?php echo e(asset('static/video/m3.mp4')); ?>"
                                data-poster-pc="<?php echo e(asset('static/video/poster3.webp')); ?>"
                                data-poster-m="<?php echo e(asset('static/video/poster3-m.webp')); ?>"
                                poster="<?php echo e(asset('static/video/poster3.webp')); ?>"
                                width="100%" height="100%" loop muted playsinline
                                preload="none" aria-hidden="true"></video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="progress"></div>
            <div class="text-effect" id="text-banner-0">
                <p class="text-effect-p1">Safety&nbsp;</p>
                <p class="text-effect-p2">安全減肥</p>
                <p class="text-effect-p3">穩定減重不傷身</p>
            </div>
            <div class="text-effect" id="text-banner-1" >
                <p class="text-effect-p1">Effective&nbsp;</p>
                <p class="text-effect-p2">有效減肥</p>
                <p class="text-effect-p3">找到適合自己的減重方法</p>
            </div>
            <div class="text-effect" id="text-banner-2" >
                <p class="text-effect-p1">Healthy&nbsp;</p>
                <p class="text-effect-p2">健康減肥</p>
                <p class="text-effect-p3">減重減脂不再復胖</p>
            </div>
        </div>
        
    </div>

    <div class="bmi wrapper column">
        <h2 class="main-title">BMI計算工具</h2>
        <p class="title-sub"><?php echo app('cache.config')->get('home_bmi_desc'); ?></p>
        <div class="bmi-wrapper">
            <div class="calculate column">
                <div class="bmi-modal">
                    <p class="bmi-title">BMI計算器</p>
                    <p class="bmi-sub"><?php echo app('cache.config')->get('page_bmi_subdesc'); ?></p>
                </div>
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
                    <p class="privacy-note">本計算器僅於瀏覽器端運算，不會傳送或儲存任何輸入資料。如需更多資訊，請參閱<a href="/privacy">隱私權政策</a>。</p>
                </form>
                <div class="result">
                    <p class="result-title">你的BMI結果為</p>
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
                <div class="bmi-modal">
                    <p class="bmi-title">BMI參照表</p>
                    <p class="bmi-sub"><?php echo app('cache.config')->get('page_bmi_subdesc2'); ?></p>
                </div>
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
        <p class="more">想了解更多關於 BMI 的知識？<a href="/bmi" class="go-btn btn-ef1">前往BMI詳細介紹<i class="iconfont">&#xe684;</i></a></p>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="method wrapper column">
        <h2 class="main-title"><?php echo e($cate->name); ?></h2>
        
        <div class="method-intro">
            <div class="method-intro-main">
                <div class="title-sub"><?php echo $cate->desc; ?></div>
                <div class="comparison">
                    <div class="comparison-block">
                        <p class="comparison-title">優點</p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cate->advantage): ?>
                        <div class="comparison-list">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = explode(PHP_EOL,$cate->advantage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="comparison-item"><?php echo e($v); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div class="comparison-block">
                        <p class="comparison-title">缺點</p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cate->shortcoming): ?>
                            <div class="comparison-list">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = explode(PHP_EOL,$cate->shortcoming); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p class="comparison-item"><?php echo e($v); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cate->options): ?>
                <div class="suitability">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cate->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="suitability-title"><?php echo e($v['title']); ?></span>
                    <span class="suitability-item"><?php echo e($v['content']); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="method-faq">
                    <p class="method-faq-title"><?php echo e($cate->name); ?>常見疑問</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cate->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($key<3): ?>
                        <div class="faq-item">
                            <div class="faq-question">
                                <span class="question-text">Q：<?php echo e($faq->questions); ?></span>
                                <i class="iconfont faq-icon">&#xeca2;</i>
                            </div>
                            <p class="faq-answer">A：<?php echo e($faq->answers); ?></p>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>
            </div>

            <img class="method-pic" src="<?php echo e(asset('uploads/'.$cate->image)); ?>" alt="">
        </div>

        <div class="method-articles">
            <p class="method-articles-title">延伸閱讀：<?php echo e($cate->name); ?>推薦文章</p>

            <div class="articles-list">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cate->article; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($key<3): ?>
                <div class="articles-item">
                    <a href="<?php echo e(url('news/'.$item->id)); ?>">
                        <img src="<?php echo e(asset('uploads/'.$item->img)); ?>" alt="<?php echo e($item->title); ?>">
                        <p class="articles-title"><?php echo e($item->title); ?></p>
                    </a>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="compare wrapper column">
        <h2 class="main-title">減肥方式比較</h2>
        <p class="title-sub"><?php echo e(app('cache.config')->get('compare_desc')); ?></p>
        <div class="compare-wrapper">
            <div class="compare-head">
                <div class="compare-item">
                    <p class="compare-item-title">減肥方式</p>
                    <p class="compare-item-content">飲食減肥</p>
                    <p class="compare-item-content">運動減肥</p>
                    <p class="compare-item-content">手術減肥</p>
                    <p class="compare-item-content">藥物減肥</p>
                </div>
            </div>
            <div class="compare-body">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = configToArray(app('cache.config')->get('compare')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="compare-item">
                        <p class="compare-item-title"><?php echo e($v['text']); ?></p>
                        <p class="compare-item-content"><?php echo e($v['diet']); ?></p>
                        <p class="compare-item-content"><?php echo e($v['sports']); ?></p>
                        <p class="compare-item-content"><?php echo e($v['operation']); ?></p>
                        <p class="compare-item-content"><?php echo e($v['drug']); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

    </div>

    <div class="about wrapper column">
        <div class="wow animate__animated animate__fadeInUp">
            <h2 class="main-title"><?php echo app('cache.config')->get('home_about_title'); ?></h2>
            <div class="title-sub"><?php echo app('cache.config')->get('home_about'); ?></div>
            <div class="xl-main">
                <p class="xl-title">上市至今累計銷量突破</p>
                <div class="text">
                    <span class="num" id="use-num">25,000,000</span><span class="em">盒</span>
                </div>
            </div>
            <a class="go-btn btn-ef1" href="/xenical">查看羅氏鮮詳細介紹<i class="iconfont">&#xe684;</i></a>
        </div>
        <div class="suit-sec">
            <div class="suit">
                <p class="main-title wow animate__animated animate__fadeInUp"><?php echo app('cache.config')->get('home_about_title2'); ?></p>
                <div class="title-sub wow animate__animated animate__fadeInUp"><?php echo app('cache.config')->get('home_about2'); ?></div>
            </div>
            <div class="suit-content wow animate__animated animate__fadeInUp">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $for_people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
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
                    ?>
                    <div class="item" data-parallax='{"y": <?php echo e($y); ?>}'>
                        <img src="<?php echo e(asset('uploads/'.$item->img)); ?>" alt="<?php echo e($item->text); ?>">
                        <p class="text"><?php echo e($item->text); ?></p>
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
    <div class="product wrapper column">
        <div class="buy">
            <h2 class="main-title wow animate__animated animate__fadeInUp" id="product-title">線上訂購羅氏鮮</h2>
            <p class="title-sub wow animate__animated animate__fadeInUp"><?php echo app('cache.config')->get('home_product_desc'); ?></p>
        </div>
        <div class="goods wow animate__animated animate__fadeInUp">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($key < 6): ?>
                <div class="item">
                    <img class="goods-img" src="<?php echo e(asset('uploads/'.$item->img)); ?>?ver=<?php echo e(config('app.asset_version')); ?>" alt="<?php echo e($item->sub_name); ?> <?php echo e($item->name_en); ?><?php echo e($item->name); ?><?php echo e($item->quantity); ?><?php echo e($item->id == 1 ? '盒標準裝' : '盒優惠裝'); ?>">
                    <div class="info">
                        <div class="goods-title">
                            <p><span style="letter-spacing: -1px;margin-right: 4px;"><?php echo e($item->name_en); ?></span><?php echo e($item->name); ?></p>
                            <p><?php echo e($item->quantity); ?><?php echo e($item->id == 1 ? '盒標準裝' : '盒優惠裝'); ?></p>
                        </div>
                        <p class="price-sec">
                            <?php
                                $diff = $item->market_price - $item->price;
                                $percent = $item->market_price > 0 ? round(($diff / $item->market_price) * 100) : 0;
                            ?>
                            <span class="price"><span class="twd">NT$</span><?php echo e(number_format(round($item->price))); ?></span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($diff > 0): ?>
                                <span class="market-price"><span class="twd">NT$</span><?php echo e(number_format($item->market_price)); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <span class="discount">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($diff > 0): ?>
                                    優惠<?php echo e($percent); ?>%
                                <?php else: ?>
                                    官方售價
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>
                        </p>
                        <div class="btn-sec">
                            <a class="shop-btn go-btn btn-ef1" href="<?php echo e(url('checkout/'.$item->id)); ?>"  data-observer="立即訂購-<?php echo e($item->name); ?>">立即訂購<i class="iconfont">&#xe684;</i></a>
                            <a class="go-info btn-ef2" href="<?php echo e(url('product/'.$item->id)); ?>" data-observer="詳情-<?php echo e($item->name); ?>">詳情</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
    <div class="news">
        <h2 class="main-title wow animate__animated animate__fadeInUp">最新減肥知識分享</h2>
        <div class="news-main">
            <div class="image-wrap wow animate__animated animate__fadeInUp">
                <div class="box epilogue-img" style="background-image: url(<?php echo e(asset('uploads/'.app('cache.config')->get('promote_image'))); ?>)"></div>
            </div>
            <div class="news-wrap">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item wow animate__animated animate__fadeInUp">
                        <a class="info" href="<?php echo e(url('news/'.$item->id)); ?>">
                            <div class="newsInfoIdxBox">
                                <p class="newsDateBox">
                                    <span class="day"><?php echo e($item->release_at->format('d')); ?></span>
                                    <span class="ym"><?php echo e($item->release_at->format('M')); ?></span>
                                </p>
                                <p class="news-title"><?php echo e($item->title); ?></p>
                            </div>
                            <p class="sub">
                                <?php echo e(\Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),120)); ?>

                            </p>
                            <span class="go btn-ef1">閱讀全文<i class="iconfont">&#xe684;</i></span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/web/index.blade.php ENDPATH**/ ?>