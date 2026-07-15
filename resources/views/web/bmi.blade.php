@extends('web::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/bmi.css') }}?ver={{ config('app.asset_version') }}"/>

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
@stop



@section('embed-banner')
    <div class="embed-banner wrapper column">
        <h1 class="embed-title">{!! app('cache.config')->get('page_evaluate_title') !!}</h1>
        <p class="embed-desc">{!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_evaluate_desc')) !!}</p>
    </div>
@stop

@section('content')
    
    <section class="editor">
        {!! app('cache.config')->get('page_evaluate_article') !!}
    </section>
    <section class="bmi-wrapper">
        <h2 class="visually-hidden">立即計算你的BMI指數</h2>
        <div class="calculate column">
            <header class="bmi-modal">
                <h3 class="bmi-title">BMI計算器</h3>
                <p class="bmi-sub">{!! app('cache.config')->get('page_bmi_subdesc') !!}</p>
            </header>
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
                <p class="bmi-sub">{!! app('cache.config')->get('page_bmi_subdesc2') !!}</p>
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
    </section>
    <section class="fqa wrapper column">
        <h2 class="main-title">BMI管理與減肥常見疑問</h2>
        @foreach($faqs as $key=>$faq)
            <details class="faq-item wow animate__animated animate__fadeInUp" open>
                <summary class="faq-question">
                    <span class="question-text">Q：{{ $faq->questions }}</span>
                    <i class="iconfont faq-icon">&#xeca2;</i>
                </summary>
                <p class="faq-answer">A：{{ $faq->answers }}</p>
            </details>
        @endforeach

    </section>
    <section class="page-news wrapper column">
        <h2 class="main-title">BMI知識延伸閱讀</h2>
        @foreach($news as $item)
            <article class="item">
                <a class="info" href="{{ URL::to('news/'.$item->id) }}">
                    <div class="Img"><img src="{{ asset('uploads/'.$item->img) }}" alt="{{ $item->title }}"></div>
                    <div class="Txt">
                        <div class="newsInfoIdxBox">
                            <p class="newsDateBox">
                                <span class="day">{{ $item->release_at->format('d') }}</span>
                                <span class="ym">{{ $item->release_at->format('M') }}</span>
                            </p>
                            <h2 class="title">{{ $item->title }}</h2>
                        </div>
                        <p class="sub">
                            {{ \Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),680) }}
                        </p>
                        <span class="go">閱讀全文<i class="iconfont">&#xe684;</i></span>
                    </div>
                </a>
            </article>
        @endforeach
    </section>
@endsection
@section('breadcrumb')
    <li class="active">{!! app('cache.config')->get('page_evaluate_title') !!}</li>
@stop