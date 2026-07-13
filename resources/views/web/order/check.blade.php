@extends('web::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/check.css') }}?ver={{ config('app.asset_version') }}"/>
@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/api.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const bgEl = document.getElementById("bg-container");
            const pcBg = bgEl.dataset.bgPc;
            const mBg = bgEl.dataset.bgM;

            function updateBackground() {
            const bgUrl = window.innerWidth > 1024 ? pcBg : mBg;
            bgEl.style.backgroundImage = `url('${bgUrl}')`;
            }

            updateBackground();

            window.addEventListener('resize', function () {
            updateBackground();
            });
        });
    </script>
    <script>

        setInterval(function(){
            if(checkVerify() == true){
                $('.form-btn').addClass('activate-btn');
            }else{
                $('.form-btn').removeClass('activate-btn');
            }

        },1000);
        function checkVerify(){
            var phone = $("input[name='phone']").val();
            var email = $("input[name='email']").val();
            var captcha_code = $("input[name='captcha_code']").val();

            if(!phone){
                return false;
            }
            if(!(/^09\d{8}$/.test(phone))){
                return false;
            }
            if(!email){
                return false;
            }
            if(email.search(/^([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+\.(?:com|cn|tw|info|net)$/) == -1){
                return false;
            }
            if(!captcha_code){
                return false;
            }
            return true;
        }

        bgHeight()
        function bgHeight(){

        }
        window.onresize = function(){
            bgHeight()
        }

        $(window).scroll(function() {
            bgEffect()

        });

        function bgEffect(){
            let top = document.scrollingElement.scrollTop; //触发滚动条，记录数值
            let banner_height = $('.container-bg').height()-60;
            let opacity = 1-top/banner_height;
            $('.container-bg').css('opacity',opacity);
        }
    </script>
@stop


@section('content')

    <div id="bg-container" class="container-bg"
        data-bg-pc="{{ asset_upload(app('cache.config')->get('page_check_back_img_pc')) }}"
        data-bg-m="{{ asset_upload(app('cache.config')->get('page_check_back_img')) }}">
    </div>
    <h1 class="main-title page-title">{!! app('cache.config')->get('page_check_title') !!}</h1>

    <div class="main">
        <p class="desc">{!! app('cache.config')->get('page_check_desc') !!}</p>
        <form action="" id="check-form" method="post" onsubmit="return orderCheck()">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="phone">訂單電話：</label>
                <input class="form-control" type="tel" id="phone" name="phone" autocomplete="tel" placeholder="請輸入訂購的電話號碼" required>
            </div>
            <div class="form-group">
                <label for="email">訂單郵箱：</label>
                <input class="form-control" type="email" id="email" name="email" autocomplete="email" placeholder="請輸入預留的電子郵箱" required>
            </div>
            <div class="form-group">
                <label for="captcha_code">我不是機器人：</label>
                <input class="form-control" type="text" id="captcha_code" name="captcha_code" autocomplete="off" placeholder="請輸入驗證碼">
                <div class="code"><img class="thumbnail captcha mt-3 mb-2" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码"></div>
            </div>
            <button class="form-btn">確認送出</button>
        </form>
    </div>
    <div class="foot">
        <p>如您想再次確認訂單，您可以</p>
        <p class="li">· 通過上面輸入訂單中預留的聯繫電話以及電子信箱查詢您的訂單。</p>
        <p>如果無法查詢結果，可能是由於以下原因</p>
        <p>· 輸入訂單中預留的聯繫電話或電子信箱有誤，請仔細檢查無誤後再次查詢</p>
        <p>· 系統生成訂單延遲，請稍候片刻後再次查詢</p>
        <p class="li">· 網絡波動及其他外界影響導致當時沒有下單成功，請再次下單</p>
        <p>物流狀態更新延遲</p>
        <p class="li">我們收到您的訂單後，物流部門會收到您的信息，然後他們會處理您的訂單並將其整裝待發，最後將它
        們轉發給運輸公司，然後由運輸公司運送。由於此過程涉及內部和外部各方之間的多個協調步驟，因此物
        流狀態更新會有延遲。</p>
        <p>派送和交貨時間</p>
        <p>目前，我們通過主要物流供應商提供運輸服務。我們在每週一到週六上班時間（台北時間上午 9:00 至 下午 18:00）處理所有訂單。</p>
        <p>我們的物流合作夥伴是黑貓宅急便以及7-ELEVEN便利店，可保證快速安全的交付。</p>
        <p>免責聲明：此處顯示的交貨時間可能有例外，具體取決於您所在的位置。即使是主要的物流供應商也沒有全面覆蓋，有時需要聘請分包商來處理他們的交付。</p>
    </div>
@endsection
