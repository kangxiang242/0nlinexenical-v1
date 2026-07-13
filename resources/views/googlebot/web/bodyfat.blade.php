@extends('web::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/bodyfat.css') }}?ver={{ config('app.asset_version') }}"/>

@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.leoTextAnimate.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script>
        let lastDigits = ['?', '?', '?'];

        function animateDigit(el, num, alwaysSpin = false) {
            const digitHeight = 44;
            const inner = el.querySelector('.digit-inner');
            const targetIndex = num === '?' ? 0 : (parseInt(num, 10) + 1);
            let currentTransform = inner.style.transform || 'translateY(0)';
            let currentIndex = 0;
            const match = currentTransform.match(/-([0-9]+)px/);
            if (match) currentIndex = Math.round(parseInt(match[1], 10) / digitHeight);
            if (!alwaysSpin && currentIndex === targetIndex) return;
            const rounds = alwaysSpin ? 1 : 0;
            const totalIndex = targetIndex + (rounds * 11);
            inner.style.transition = 'none';
            inner.style.transform = `translateY(0)`;
            void inner.offsetWidth;
            inner.style.transition = 'transform 1s ease-out';
            inner.style.transform = `translateY(-${totalIndex * digitHeight}px)`;
        }

        function animateBodyFatDisplay(bf) {
            const fixedBF = bf.toFixed(1);
            const [intPartRaw, decPartRaw] = fixedBF.split('.');
            const intPart = intPartRaw.padStart(2, '0');
            const decPart = decPartRaw ? decPartRaw[0] : '0';
            animateDigit(document.getElementById('int1'), intPart[0]);
            animateDigit(document.getElementById('int2'), intPart[1]);
            animateDigit(document.getElementById('dec1'), decPart);
            lastDigits = [intPart[0], intPart[1], decPart];
        }

        window.addEventListener('DOMContentLoaded', function () {
            ['int1', 'int2', 'dec1'].forEach(id => animateDigit(document.getElementById(id), '?'));
            lastDigits = ['?', '?', '?'];
        });

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('.count').addEventListener('click', function () {
                const height = parseFloat(document.getElementById('height').value);
                const weight = parseFloat(document.getElementById('weight').value);
                const age = parseFloat(document.getElementById('age').value);
                const gender = document.querySelector('input[name="gender"]:checked')?.value;

                if (!height || !weight || !age || !gender || height <= 0 || weight <= 0 || age <= 0) {
                    alert("請正確輸入所有欄位");
                    return;
                }

                const bmi = weight / ((height / 100) ** 2);
                const bf = gender === 'male'
                    ? (1.20 * bmi + 0.23 * age - 16.2)
                    : (1.20 * bmi + 0.23 * age - 5.4);

                animateBodyFatDisplay(bf);
            });

            document.querySelector('.reset').addEventListener('click', function () {
                ['height', 'weight', 'age'].forEach(id => document.getElementById(id).value = '');
                ['int1', 'int2', 'dec1'].forEach(id => animateDigit(document.getElementById(id), '?'));
                lastDigits = ['?', '?', '?'];
            });
        });
    </script>
@stop



@section('embed-banner')
    <div class="embed-banner wrapper column">
        <h1 class="embed-title">{!! app('cache.config')->get('page_bodyfat_title') !!}</h1>
        <div class="embed-desc">{!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_bodyfat_desc')) !!}</div>
    </div>
@stop

@section('content')
    
    <section class="editor">
        {!! app('cache.config')->get('page_bodyfat_article') !!}
    </section>
    <section class="fat-wrapper">
        <h2 class="visually-hidden">立即計算你的體脂肪率</h2>
        <div class="calculate column">
            <header class="fat-modal">
                <h3 class="fat-title">體脂肪率計算器</h3>
                <p class="fat-sub">{!! app('cache.config')->get('page_bodyfat_subdesc_gb') !!}</p>
            </header>
            <form class="evaluate-form" onsubmit="return false;">
                <div class="form-group">
                    <label class="form-title visually-hidden" for="gender">生理性別：</label>
                    <div class="gender-toggle" role="radiogroup" id="genderToggle">
                        <input type="radio" name="gender" id="female" value="female" checked>
                        <label for="female">女性</label>
                        <input type="radio" name="gender" id="male" value="male">
                        <label for="male">男性</label>
                        <div class="active-bg"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-title" for="age">年齡：</label>
                    <input class="form-control" type="number" id="age" name="age" placeholder="歲" inputmode="numeric">
                </div>
                <div class="form-group">
                    <label class="form-title" for="height">身高：</label>
                    <input class="form-control" type="number" id="height" name="height" placeholder="公分" inputmode="decimal">
                </div>
                <div class="form-group">
                    <label class="form-title" for="weight">體重：</label>
                    <input class="form-control" type="number" id="weight" name="weight" placeholder="公斤" inputmode="decimal">
                </div>
                <div class="btns">
                    <button class="btn reset" type="reset">重設</button>
                    <button class="btn count btn-ef1" type="button">開始計算</button>
                </div>
                <p class="privacy-note">本體脂肪率計算器僅於瀏覽器端運算，不會傳送或儲存任何輸入資料。如需更多資訊，請參閱<a href="/privacy" rel="nofollow">隱私權政策</a>。</p>
            </form>
            <div class="result">
                <h4 class="result-title">你的體脂肪率結果為</h4>
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
                    <span class="persent" aria-hidden="true">%</span>
                </p>
            </div>
        </div>
        <div class="table-wrap column">
            <header class="fat-modal">
                <h3 class="fat-title">男女體脂率建議值參考</h3>
                <p class="fat-sub">{!! app('cache.config')->get('page_bodyfat_subdesc2_gb') !!}</p>
            </header>
            <table class="bodyfat-table" width="100%" border="1" cellspacing="0" cellpadding="0" aria-label="男性體脂率建議表">
                <caption class="visually-hidden">男性體脂率建議值表</caption>
                <thead>
                    <tr>
                    <th colspan="5" class="table-title male">男性</th>
                    </tr>
                    <tr>
                    <th>年齡</th>
                    <th>消瘦</th>
                    <th>標準</th>
                    <th>微胖</th>
                    <th>肥胖</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">18～39 歲</th>
                    <td>10% 以下</td>
                    <td>11% ~ 21%</td>
                    <td>22% ~ 26%</td>
                    <td>27% 以上</td>
                    </tr>
                    <tr>
                    <th scope="row">40～59 歲</th>
                    <td>11% 以下</td>
                    <td>12% ~ 22%</td>
                    <td>23% ~ 27%</td>
                    <td>28% 以上</td>
                    </tr>
                    <tr>
                    <th scope="row">60 歲以上</th>
                    <td>13% 以下</td>
                    <td>14% ~ 24%</td>
                    <td>25% ~ 29%</td>
                    <td>30% 以上</td>
                    </tr>
                </tbody>
            </table>
            <table class="bodyfat-table" width="100%" border="1" cellspacing="0" cellpadding="0" aria-label="女性體脂率建議表">
                <caption class="visually-hidden">女性體脂率建議值表</caption>
                <thead>
                    <tr>
                    <th colspan="5" class="table-title female">女性</th>
                    </tr>
                    <tr>
                    <th>年齡</th>
                    <th>消瘦</th>
                    <th>標準</th>
                    <th>微胖</th>
                    <th>肥胖</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">18～39 歲</th>
                    <td>20% 以下</td>
                    <td>21% ~ 34%</td>
                    <td>35% ~ 39%</td>
                    <td>40% 以上</td>
                    </tr>
                    <tr>
                    <th scope="row">40～59 歲</th>
                    <td>21% 以下</td>
                    <td>22% ~ 35%</td>
                    <td>36% ~ 40%</td>
                    <td>41% 以上</td>
                    </tr>
                    <tr>
                    <th scope="row">60 歲以上</th>
                    <td>22% 以下</td>
                    <td>23% ~ 36%</td>
                    <td>37% ~ 41%</td>
                    <td>42% 以上</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section class="fqa wrapper column">
        <h2 class="main-title">體脂肪率管理與減肥常見疑問</h2>
        @foreach($faqs as $key=>$faq)
            @if($key>5)
                @break
            @endif
            <details class="faq-item wow animate__animated animate__fadeInUp" open>
                <summary class="faq-question">
                    <span class="question-text">Q：{{ $faq->questions_gb }}</span>
                    <i class="iconfont faq-icon">&#xeca2;</i>
                </summary>
                <p class="faq-answer">A：{{ $faq->answers_gb }}</p>
            </details>
        @endforeach

    </section>
    <section class="page-news wrapper column">
        <h2 class="main-title">體脂肪率知識延伸閱讀</h2>
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
    <li class="active">{!! app('cache.config')->get('page_bodyfat_title') !!}</li>
@stop