@extends('web::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/bmi.css') }}?ver={{ config('app.asset_version') }}"/>
    <style>
        blockquote{
            border-left: 5px solid rgba(0,0,0,.05);
            padding: 20px;
            font-style: italic;
            position: relative;
            margin: 1.5em 1em 1.5em 3em;
            font-size: 1.2em;
            line-height: inherit;

        }

    </style>
@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.leoTextAnimate.js') }}?ver={{ config('app.asset_version') }}"></script>
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
@stop



@section('embed-banner')
    <div class="embed-banner wrapper column">
        <h1 class="page-title main-title">{!! app('cache.config')->get('page_evaluate_title') !!}</h1>
        <div class="title-sub">{!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_evaluate_desc')) !!}</div>
    </div>
@stop

@section('content')
    
    <div class="editor">
        {!! app('cache.config')->get('page_evaluate_article') !!}
    </div>
    <div class="bmi-wrapper">
        <div class="calculate column">
            <div class="bmi-modal">
                <p class="bmi-title">BMI計算器</p>
                <p class="bmi-sub">{!! app('cache.config')->get('page_bmi_subdesc') !!}</p>
            </div>
            <form class="evaluate-form" onsubmit="return false;">
                <div class="form-group">
                    <label class="form-title" for="height">你的身高：</label>
                    <input class="form-control" type="number" id="height" name="height" placeholder="公分" inputmode="decimal">
                </div>
                <div class="form-group">
                    <label class="form-title" for="weight">你的體重：</label>
                    <input class="form-control" type="number" id="weight" name="weight" placeholder="公斤" inputmode="decimal">
                </div>
                <div class="btns">
                    <button class="btn reset" type="reset">重設</button>
                    <button class="btn count btn-ef1" type="button">開始計算</button>
                </div>
                <p class="privacy-note">本計算器僅於瀏覽器端運算，不會傳送或儲存任何輸入資料。如需更多資訊，請參閱<a href="/privacy"">隱私權政策</a>。</p>
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
                <p class="bmi-sub">{!! app('cache.config')->get('page_bmi_subdesc2') !!}</p>
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
    <div class="fqa wrapper column">
        <p class="main-title">BMI常見疑問</p>
        @foreach($faqs as $key=>$faq)
            <div class="faq-item wow animate__animated animate__fadeInUp">
                <div class="faq-question">
                    <span class="question-text">Q：{{ $faq->questions }}</span>
                    <i class="iconfont faq-icon">&#xeca2;</i>
                </div>
                <p class="faq-answer">A：{{ $faq->answers }}</p>
            </div>
        @endforeach

    </div>
    <div class="page-news wrapper column">
        <p class="main-title">延伸閱讀</p>
        @foreach($news as $item)
            <div class="item">
                <a class="info" href="{{ URL::to('news/'.$item->id) }}">
                    <div class="Img"><img src="{{ asset('uploads/'.$item->img) }}" alt="{{ $item->title }}"></div>
                    <div class="Txt">
                        <div class="newsInfoIdxBox">
                            <p class="newsDateBox">
                                <span class="day">{{ $item->release_at->format('d') }}</span>
                                <span class="ym">{{ $item->release_at->format('M') }}</span>
                            </p>
                            <p class="title">{{ $item->title }}</p>
                        </div>
                        <p class="sub">
                            {{ \Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),680) }}
                        </p>
                        <span class="go">閱讀全文<i class="iconfont">&#xe684;</i></span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
@section('breadcrumb')
    <li class="active">{!! app('cache.config')->get('page_evaluate_title') !!}</li>
@stop