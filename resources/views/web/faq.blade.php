@extends('web::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/faq.css') }}?ver={{ config('app.asset_version') }}"/>

@stop

@section('script')
    @parent


@stop

@section('content')
    <h1 class="main-title">BMI與減肥常見疑問解答</h1>
    @foreach($faq as $item)
        <details class="faq-item" open>
            <summary class="faq-question">
                <span class="question-text">Q：{{ $item->questions }}</span>
                <i class="iconfont faq-icon">&#xeca2;</i>
            </summary>
            <p class="faq-answer">A：{{ $item->answers }}</p>
        </details>
    @endforeach
@endsection
@section('breadcrumb')
    <li class="active">BMI與減肥常見疑問解答Q&A</li>
@endsection