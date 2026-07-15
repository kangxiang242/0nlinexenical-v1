@extends('web::layout')
@if($news->seo_title)
    @section('title', $news->seo_title)
@else
    @section('title', $news->title)
@endif

@if($news->seo_keyword)
    @section('keywords', $news->seo_keyword)
@endif

@if($news->seo_description)
    @section('description', $news->seo_description)
@endif
@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/news-desc.css') }}?ver={{ config('app.asset_version') }}"/>
@stop

@section('script')
    @parent
    <script>
        document.domain = "0nlinexenical.com";
        function setIframeHeight(iframe) {
            if (iframe) {
                var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
                if (iframeWin.document.body) {
                    iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
                }}
        };
        window.onload = function () {
            setIframeHeight(document.getElementById('external-frame'));
        };
    </script>
@stop

@section('content')
    <p class="time">發佈日期：{{ $news->release_at->format('Y') }}-{{ $news->release_at->format('d') }}-{{ $news->release_at->format('m') }}</p>
    <div class="fluid">
        <h1 class="news-title">{{ $news->title }}</h1>
        <div class="news-content">
            @if($news->html_file)
                <iframe  id="external-frame" width="100%" style="min-height: 100vh" src="{{ asset_upload(str_replace('.zip','',$news->html_file).'/index.html') }}"  frameborder="0" scrolling="no" onload="setIframeHeight(this)"></iframe>
            @else
                {!! $news->content !!}
            @endif
        </div>
        <nav class="relatednav">
            @if($prev)
            <a class="relatednav-prev" href="{{ URL::to('news/'.$prev->id) }}">
                <span class="relatednav-arrow"></span>
                <span class="relatednav-title  h4 h4-mb fw-bolder">{{ $prev->title }}</span>
            </a>
            @endif

            @if($next)
            <a class="relatednav-next" href="{{ URL::to('news/'.$next->id) }}">
                <span class="relatednav-arrow"></span>
                <span class="relatednav-title  h4 h4-mb fw-bolder">{{ $next->title }}</span>
            </a>
            @endif
        </nav>
    </div>
    
@endsection
@section('breadcrumb')
    <li><a href="{{ URL::to('news') }}">BMI管理與減肥知識分享</a></li>
    <li class="active">{{ $news->title }}</li>
@endsection