<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\ArticleCate;
use App\Repositories\ArticleCateRepository;
use App\Repositories\FaqRepository;
use App\Repositories\NewRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(ProductRepository $productRepository,ArticleCateRepository $articleCateRepository,Request $request){
        $products = $productRepository->limit(7)->all();
        $faqs = app(FaqRepository::class)->limit(6)->all();
        //$cates = $articleCateRepository->getAll();

        $cates = ArticleCate::with(['article','faqs'])->where('status',1)->orderBy('sort')->get();


        $for_people_untreated = app('cache.config')->get('for_people');
        $for_people = [];
        if($for_people_untreated){
            $for_people = json_decode($for_people_untreated);
        }


        $trade_show_untreated = app('cache.config')->get('trade_show');

        if($request->attributes->get('is_googlebot')){
            $trade_show_untreated = app('cache.config')->get('trade_show_gb');
        }
        $trade_show = [];
        if($trade_show_untreated){
            $trade_show = json_decode($trade_show_untreated,true);
        }

        $trouble_untreated = app('cache.config')->get('trouble');
        $trouble = [];
        if($trouble_untreated){
            $trouble = json_decode($trouble_untreated);
        }


        $news = app(NewRepository::class)->newNews(3);

        return template('index',compact('products','faqs','for_people','news','cates','trade_show','trouble'));
    }

}
