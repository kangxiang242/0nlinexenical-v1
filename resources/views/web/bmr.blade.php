@extends('web::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/bmr.css') }}?ver={{ config('app.asset_version') }}"/>
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
        function animateDigit(el, num, alwaysSpin = false) {
            const digitHeight = 44;
            const inner = el.querySelector('.digit-inner');
            const targetIndex = num === '?' ? 0 : (parseInt(num, 10) + 1);
            let currentIndex = 0;
            const match = inner.style.transform?.match(/-([0-9]+)px/);
            if (match) currentIndex = Math.round(parseInt(match[1], 10) / digitHeight);
            if (!alwaysSpin && currentIndex === targetIndex) return;
            const totalIndex = targetIndex + (alwaysSpin ? 11 : 0);
            inner.style.transition = 'none';
            inner.style.transform = `translateY(0)`;
            void inner.offsetWidth;
            inner.style.transition = 'transform 1s ease-out';
            inner.style.transform = `translateY(-${totalIndex * digitHeight}px)`;
        }

        function animateBMRDisplay(bmr) {
            const fixedBMR = bmr.toFixed(1).padStart(5, '0');
            const [intPartRaw, decPartRaw] = fixedBMR.split('.');
            const intPart = intPartRaw.padStart(4, '0');
            const decPart = decPartRaw ? decPartRaw[0] : '0';

            animateDigit(document.getElementById('int1'), intPart[0]);
            animateDigit(document.getElementById('int2'), intPart[1]);
            animateDigit(document.getElementById('int3'), intPart[2]);
            animateDigit(document.getElementById('int4'), intPart[3]);
            animateDigit(document.getElementById('dec1'), decPart);
        }

        function updateTDEEValues(bmr) {
            document.querySelectorAll('.tdee-item').forEach(item => {
            const formulaEl = item.querySelector('.tdee-formula');
            const resultWrapper = item.querySelector('.tdee-result');
            const resultNum = item.querySelector('.tdee-num');

            if (!formulaEl || !resultWrapper || !resultNum) return;

            const match = formulaEl.textContent.match(/×\s*([\d.]+)/);
            if (!match) return;

            const factor = parseFloat(match[1]);
            if (isNaN(factor)) return;

            const tdee = (bmr * factor).toFixed(1);
            resultNum.textContent = tdee;
            resultWrapper.classList.add('show');
            });
        }

        window.addEventListener('DOMContentLoaded', () => {
            
            ['int1', 'int2', 'int3', 'int4', 'dec1'].forEach(id => {
            animateDigit(document.getElementById(id), '?');
            });

            
            const genderRadios = document.querySelectorAll('.gender-toggle input[type="radio"]');
            const activeBg = document.querySelector('.gender-toggle .active-bg');

            genderRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                const index = Array.from(genderRadios).indexOf(radio);
                activeBg.style.transform = `translateX(${index * 100}%)`;
            });
            });

            const initialChecked = document.querySelector('.gender-toggle input[type="radio"]:checked');
            if (initialChecked) {
            const index = Array.from(genderRadios).indexOf(initialChecked);
            activeBg.style.transform = `translateX(${index * 100}%)`;
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.count').addEventListener('click', () => {
            const gender = document.querySelector('input[name="gender"]:checked')?.value;
            const age = parseFloat(document.getElementById('age').value);
            const height = parseFloat(document.getElementById('height').value);
            const weight = parseFloat(document.getElementById('weight').value);

            if (!gender || !age || !height || !weight || age <= 0 || height <= 0 || weight <= 0) {
                alert("請正確輸入所有欄位");
                return;
            }

            const sexValue = gender === 'male' ? 1 : 0;
            const bmr = 9.99 * weight + 6.25 * height - 4.92 * age + (166 * sexValue - 161);

            animateBMRDisplay(bmr);
            updateTDEEValues(bmr);
            });

            document.querySelector('.reset').addEventListener('click', () => {
            // 清空欄位
            ['age', 'height', 'weight'].forEach(id => document.getElementById(id).value = '');
            // 重設動畫
            ['int1', 'int2', 'int3', 'int4', 'dec1'].forEach(id => {
                animateDigit(document.getElementById(id), '?');
            });
            // 清除 TDEE 顯示
            document.querySelectorAll('.tdee-result').forEach(el => {
                el.classList.remove('show');
                const numEl = el.querySelector('.tdee-num');
                if (numEl) numEl.textContent = '';
            });
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
        <h1 class="page-title main-title">{!! app('cache.config')->get('page_bmr_title') !!}</h1>
        <div class="title-sub">{!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_bmr_desc')) !!}</div>
    </div>
@stop

@section('content')
    
    <div class="editor">
        {!! app('cache.config')->get('page_bmr_article') !!}
    </div>
    <div class="bmr-wrapper">
        <h2 class="visually-hidden">立即計算你的BMR指數及TDEE</h2>
        <div class="calculate column">
            <div class="bmr-modal">
                <p class="bmr-title">BMR計算器</p>
                <p class="bmr-sub">{!! app('cache.config')->get('page_bmr_subdesc') !!}</p>
            </div>
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
                <p class="privacy-note">本計算器僅於瀏覽器端運算，不會傳送或儲存任何輸入資料。如需更多資訊，請參閱<a href="/privacy"">隱私權政策</a>。</p>
            </form>
            <div class="result">
                <p class="result-title">你的BMR結果為</p>
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
                    <span class="digit" id="int3" aria-hidden="true">
                        <span class="digit-inner">
                            <span>?</span><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span>
                        </span>
                    </span>
                    <span class="digit" id="int4" aria-hidden="true">
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
            <div class="tdee-modal">
                <p class="tdee-title">你的每日TDEE（總熱量消耗）</p>
                <p class="tdee-sub">{!! app('cache.config')->get('page_bmr_subdesc2') !!}</p>
            </div>
            <div class="tdee-list">
                <div class="tdee-item">
                    <div class="tdee-item-wrap">
                        <img src="/static/img/lv1.webp" alt="TDEE靜態活動等級">
                        <div class="tdee-item-info">
                            <p class="tdee-item-name"><strong class="tdee-item-title">身體活動趨於靜態</strong>（幾乎沒有在運動）</p>
                            <p class="tdee-item-sub">坐式生活型態，如：靜臥、久坐、看電視</p>
                            <p class="tdee-formula">TDEE = BMR × 1.2</p>
                            <p class="tdee-result">TDEE = <strong class="tdee-num"></strong></p>
                        </div>
                    </div>
                </div>

                <div class="tdee-item">
                    <div class="tdee-item-wrap">
                        <img src="/static/img/lv2.webp" alt="TDEE較低活動等級">
                        <div class="tdee-item-info">
                            <p class="tdee-item-name"><strong class="tdee-item-title">身體活動程度較低</strong>（每週有運動 1~3 天）</p>
                            <p class="tdee-item-sub">不太費力的基本活動，如：開車、烹飪、散步</p>
                            <p class="tdee-formula">TDEE = BMR × 1.375</p>
                            <p class="tdee-result">TDEE = <strong class="tdee-num"></strong></p>
                        </div>
                    </div>
                </div>

                <div class="tdee-item">
                    <div class="tdee-item-wrap">
                        <img src="/static/img/lv3.webp" alt="TDEE中等活動等級">
                        <div class="tdee-item-info">
                        <p class="tdee-item-name"><strong class="tdee-item-title">身體活動程度正常</strong>（每週有運動 3~5 天）</p>
                        <p class="tdee-item-sub">呼吸及心跳些微加快的活動，如：掃地、拖地、逛街、健走</p>
                        <p class="tdee-formula">TDEE = BMR × 1.55</p>
                        <p class="tdee-result">TDEE = <strong class="tdee-num"></strong></p>
                        </div>
                    </div>
                </div>

                <div class="tdee-item">
                    <div class="tdee-item-wrap">
                        <img src="/static/img/lv4.webp" alt="TDEE較高活動等級">
                        <div class="tdee-item-info">
                            <p class="tdee-item-name"><strong class="tdee-item-title">身體活動程度較高</strong>（每週有運動 6~7 天）</p>
                            <p class="tdee-item-sub">呼吸及心跳快速且大量流汗的活動，如：打球、騎腳踏車、有氧運動、游泳、登山</p>
                            <p class="tdee-formula">TDEE = BMR × 1.72</p>
                            <p class="tdee-result">TDEE = <strong class="tdee-num"></strong></p>
                        </div>
                    </div>
                </div>

                <div class="tdee-item">
                    <div class="tdee-item-wrap">
                        <img src="/static/img/lv5.webp" alt="TDEE激烈活動等級">
                        <div class="tdee-item-info">
                            <p class="tdee-item-name"><strong class="tdee-item-title">身體活動程度激烈</strong>(長時間運動或體力勞動工作)</p>
                            <p class="tdee-item-sub">長時間耗費體力的活動，如：長跑、運動訓練、競賽型運動</p>
                            <p class="tdee-formula">TDEE = BMR × 1.9</p>
                            <p class="tdee-result">TDEE = <strong class="tdee-num"></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fqa wrapper column">
        <p class="main-title">BMR常見疑問</p>
        @foreach($faqs as $key=>$faq)
            @if($key>5)
                @break
            @endif
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
    <li class="active">{!! app('cache.config')->get('page_bmr_title') !!}</li>
@stop