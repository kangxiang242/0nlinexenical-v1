<?php


namespace App\Http\Controllers\Web;


use App\Handlers\DeviceTypeHandlers;
use App\Models\Article;
use App\Models\Compute;
use App\Models\Faq;
use App\Models\Product;
use App\Repositories\FaqRepository;
use App\Services\VehicleService;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    public function bmi(Request $request){

        if($request->ajax() && $request->isMethod('POST')){
            $interpretation = app('cache.config')->get('interpretation');
            if($interpretation){
                $interpretation = json_decode($interpretation,true);
                $bmi_status = 2;
                if($request->bmi <= 18.4){
                    $bmi_status = 1;
                }elseif ($request->bmi >= 18.5 && $request->bmi <= 23.9){
                    $bmi_status = 2;
                }elseif ($request->bmi >= 24.0 && $request->bmi <= 27.9){
                    $bmi_status = 3;
                }elseif ($request->bmi >= 28){
                    $bmi_status = 4;
                }

                $inter = [];
                foreach ($interpretation as $item){
                    if($item['bmi'] == $bmi_status && $item['activity'] == $request->activityLevel){
                        $inter = $item;
                        break;
                    }
                }

                $goods = null;
                if($inter['goods']){
                    $goods = Product::with('attr')->where('id',$inter['goods'])->where('status',1)->first();
                }



                Compute::create([
                    'sex'=>$request->sex,
                    'age'=>$request->age,
                    'height'=>$request->height,
                    'weight'=>$request->weight,
                    'motion_level'=>$request->activityLevel,
                    'bmi'=>$request->bmi,
                    'bmr'=>$request->bmr,
                    'tdee'=>$request->tdee,
                    'ip'=>VehicleService::IP(),
                    'user_agent'=>$request->userAgent()
                ]);

                return template('evaluate-result',compact('inter','goods'))->with('bmi',$request->bmi)->with('tdee',$request->tdee)->with('bmr',$request->bmr);

            }
            return "";

        }
        $faqs = app(FaqRepository::class)->all()->where('category_id',-3);
        $article_ids = app('cache.config')->get('page_bmi_article_ids');
        $news = [];
        if($article_ids){
            $article_ids = json_decode($article_ids,true);
            $news = Article::whereIn('id',$article_ids)->where('status',1)->get();
        }


        return template('bmi',compact('faqs','news'));
    }

    public function bmr(Request $request){
        $faqs = app(FaqRepository::class)->all()->where('category_id',-4);
        $article_ids = app('cache.config')->get('page_bmr_article_ids');
        $news = [];
        if($article_ids){
            $article_ids = json_decode($article_ids,true);
            $news = Article::whereIn('id',$article_ids)->where('status',1)->get();
        }
        return template('bmr',compact('faqs','news'));
    }

    public function bodyfat(Request $request){
        $faqs = app(FaqRepository::class)->all()->where('category_id',-5);
        $article_ids = app('cache.config')->get('page_bodyfat_article_ids');
        $news = [];
        if($article_ids){
            $article_ids = json_decode($article_ids,true);
            $news = Article::whereIn('id',$article_ids)->where('status',1)->get();
        }
        return template('bodyfat',compact('faqs','news'));
    }

    public function faq(){
        $faq = app(FaqRepository::class)->all();
        return template('faq',compact('faq'));
    }

    public function about(Request $request){
        $title = app('cache.config')->get('about_title');
        $title_gb = app('cache.config')->get('about_title_gb');
        $title_en = app('cache.config')->get('about_title_en');
        $content = app('cache.config')->get('about_content');
        $content_gb = app('cache.config')->get('about_content_gb');
        $html_code = app('cache.config')->get('about_html_code');
        $for_people_untreated = app('cache.config')->get('for_people');
        $for_people = [];
        if($for_people_untreated){
            $for_people = json_decode($for_people_untreated);
        }


        $trouble_untreated = app('cache.config')->get('trouble');
        $trouble = [];
        if($trouble_untreated){
            $trouble = json_decode($trouble_untreated);
        }

        $trade_show_untreated = app('cache.config')->get('trade_show');
        if($request->attributes->get('is_googlebot')){
            $trade_show_untreated = app('cache.config')->get('trade_show_gb');
        }
        $trade_show = [];
        if($trade_show_untreated){
            $trade_show = json_decode($trade_show_untreated,true);
        }

        $faqs = app(FaqRepository::class)->all()->where('category_id',-1);


        return template('xenical',compact('title','title_gb','title_en','content','content_gb','html_code','trade_show','trouble','for_people','faqs'));
    }

    public function guide(){
        $title = app('cache.config')->get('notes_buy_title');
        $title_gb = app('cache.config')->get('notes_buy_title_gb');
        $title_en = app('cache.config')->get('notes_buy_title_en');
        $content = app('cache.config')->get('notes_buy_content');
        $content_gb = app('cache.config')->get('notes_buy_content_gb');
        return template('page',compact('title','title_en','title_gb','content','content_gb'));
    }

    public function paymentDelivery(){
        $title = app('cache.config')->get('page_payment_title');
        $title_gb = app('cache.config')->get('page_payment_title_gb');
        $title_en = app('cache.config')->get('page_payment_title_en');
        $content = app('cache.config')->get('page_payment_delivery');
        $content_gb = app('cache.config')->get('page_payment_delivery_gb');
        return template('page',compact('title','title_en','title_gb','content','content_gb'));
    }

    public function afterSales(){
        $title = app('cache.config')->get('page_after_sales_title');
        $title_gb = app('cache.config')->get('page_after_sales_title_gb');
        $title_en = app('cache.config')->get('page_after_sales_title_en');
        $content = app('cache.config')->get('page_after_sales');
        $content_gb = app('cache.config')->get('page_after_sales_gb');
        return template('page',compact('title','title_en','title_gb','content','content_gb'));
    }

    public function privacy(){
        $title = app('cache.config')->get('page_privacy_title');
        $title_gb = app('cache.config')->get('page_privacy_title_gb');
        $title_en = app('cache.config')->get('page_privacy_title_en');
        $content = app('cache.config')->get('page_privacy_article');
        $content_gb = app('cache.config')->get('page_privacy_article_gb');
        return template('page',compact('title','title_en','title_gb','content','content_gb'));
    }

}
