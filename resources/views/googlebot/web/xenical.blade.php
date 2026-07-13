@extends('web::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/index.css') }}?ver={{ config('app.asset_version') }}"/>
    <style>
        .about{
            margin-top: 200px;
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
@stop

@section('content')
    <section class="about wrapper column" aria-labelledby="about-title">
        <header class="wow">
            <h1 class="main-title" id="about-title">{!! app('cache.config')->get('home_about_title_gb') !!}</h1>
            <div class="title-sub">{!! app('cache.config')->get('home_about_gb') !!}</div>
            <div class="xl-main">
                <p class="xl-title">羅氏鮮減肥藥上市至今累計銷量突破</p>
                <div class="text">
                    <span class="num" id="use-num">25,000,000</span><span class="em">盒</span>
                </div>
            </div>
            <a class="go-btn btn-ef1" href="/product">線上訂購羅氏鮮減肥藥<i class="iconfont">&#xe684;</i></a>
        </header>
        <div class="suit-sec">
            <header class="suit">
                <h3 class="main-title">{!! app('cache.config')->get('home_about_title2_gb') !!}</h3>
                <div class="title-sub">{!! app('cache.config')->get('home_about2_gb') !!}</div>
            </header>
            <ul class="suit-content">

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
            <a class="go-btn btn-ef1" href="/bmi">測一測你的BMI指數<i class="iconfont">&#xe684;</i></a>
        </div>
    </section>
    <section class="how wrapper column">
        <h2 class="main-title wow animate__animated animate__fadeInUp">羅氏鮮減肥藥降低BMI作用機轉</h2>
        <div class="how-body">
            <div class="how-resolve">
                <div class="picker appear-1">
                    <span class="min-zf left-more"></span>
                    <span class="min-zf left-more"></span>
                    <span class="min-zf right-more"></span>
                    <span class="min-zf right-more"></span>
                    <img src="/static/img/how-1.jpg" alt="羅氏鮮減肥藥降低BMI作用機轉示意圖一">
                </div>
                <p class="introduce appear-2">{!! app('cache.config')->get('how_to_work_1_gb') !!}</p>
            </div>

            <div class="how-resolve restrain ">
                <div class="picker appear-3">
                    <span class="max-zf bottom-more"></span>
                    <img src="/static/img/how-2.jpg" alt="羅氏鮮減肥藥降低BMI作用機轉示意圖二">
                </div>
                <p class="introduce appear-4">{!! app('cache.config')->get('how_to_work_2_gb') !!}</p>
            </div>

        </div>
        <a class="go-btn btn-ef1" href="/product">線上訂購羅氏鮮減肥藥<i class="iconfont">&#xe684;</i></a>
    </section>
    <section class="reviews wrapper column">
        <h2 class="main-title wow animate__animated animate__fadeInUp">輕鬆降低BMI，看看她們的減肥心得</h2>
        @if($trade_show)
        <div class="reviews-body wow animate__animated animate__fadeInUp">
            <ul class="evaluate">
                @foreach(array_values($trade_show) as $key=>$item)
                    @if($key>5)
                        @break
                    @endif

                    <li class="sef {{ $key==0?"sef-activate":"" }}">
                        <img src="{{ asset_upload($item['img']) }}" alt="{{ isset($item['text'])?$item['text']:'' }}">
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['desc'] }}</p>
                    </li>

                @endforeach
            </ul>
            <button class="switch prev-btn" onclick="rotate(1)"><i class="iconfont">&#xe779;</i></button>
            <button class="switch next-btn" onclick="rotate(2)"><i class="iconfont">&#xe775;</i></button>
        </div>
        @endif
        <a class="go-btn btn-ef1" href="/product">線上訂購羅氏鮮減肥藥<i class="iconfont">&#xe684;</i></a>
    </section>
    <section class="chooseline wrapper column">
        <header class="modal wow animate__animated animate__fadeInUp" id="ts-svg">
            <h2 class="main-title">羅氏鮮減肥藥幫助妳解決BMI困擾</h2>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 170" preserveAspectRatio="none">
                <path d="M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7">
                </path>
            </svg>
        </header>
        <div class="chooseline-body wow animate__animated animate__fadeInUp" id="loopWrap">
            <ul class="group">
                @foreach($trouble as $item)
                <li class="item">
                    <p class="p1">{{ $item->text }}</p>
                    <p class="p2"><span class="num">{{ $item->number }}</span><span class="unit">{{ $item->unit }}</span></p>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section class="fqa wrapper column">
        <h2 class="main-title">BMI管理與減肥常見疑問</h2>
        @foreach($faqs as $key=>$faq)

            <details class="faq-item wow animate__animated animate__fadeInUp" open>
                <summary class="faq-question">
                    <span class="question-text">Q：{{ $faq->questions_gb }}</span>
                    <i class="iconfont faq-icon">&#xeca2;</i>
                </summary>
                <p class="faq-answer">A：{{ $faq->answers_gb }}</p>
            </details>
        @endforeach

    </section>
@endsection

@section('breadcrumb')
    <li class="active">{{ $title }}</li>
@stop
