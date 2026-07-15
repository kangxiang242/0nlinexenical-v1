@extends('web::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/news.css') }}?ver={{ config('app.asset_version') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/pagination.css') }}?ver={{ config('app.asset_version') }}"/>
@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.waypoints.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script>
        $(function(){
            $('.item').waypoint(function(){
                this.element.classList.add('show');
            },{
                offset: '90%'
            });
        });
        $(window).scroll(function() {
            bgEffect()

        });

        function bgEffect(){
            let top = document.scrollingElement.scrollTop; //触发滚动条，记录数值
            let banner_height = $('.container-bg').height()-60;
            let opacity = 1-top/banner_height;
            $('.container-bg').css('opacity',opacity);

            if(($(window).scrollTop() + $(window).height()).toFixed(0) == $(document).height()){
                $('.container-bg').css('opacity',0);
            }


        }
    </script>
@stop


@section('content')
    <div class="container-bg" style="background-image: url('{{ asset_upload(app('cache.config')->get('page_news_back_img_pc')) }}')">
    </div>
    <h1 class="main-title page-title">{!! app('cache.config')->get('page_news_title') !!}</h1>
    
    <div class="news-wrap">
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
        {{ $news->links() }}
    </div>
@endsection
@section('breadcrumb')
    <li class="active">{!! app('cache.config')->get('page_news_title') !!}</li>
@endsection