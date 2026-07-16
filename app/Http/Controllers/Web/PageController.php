<?php

namespace App\Http\Controllers\Web;

use App\Handlers\DeviceTypeHandlers;
use App\Models\Article;
use App\Models\Compute;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Product;
use App\Repositories\FaqRepository;
use App\Services\VehicleService;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    public function index($uri, Request $request){
        switch($uri) {
            case "product":
                $products = Product::where("status",1)->get();
                return view("web.product.index", compact("products"));
            case "xenical":
                $title = app("cache.config")->get("about_title");
                $for_people_untreated = app("cache.config")->get("for_people");
                $for_people = [];
                if($for_people_untreated){
                    $for_people = json_decode($for_people_untreated);
                }
                $trouble_untreated = app("cache.config")->get("trouble");
                $trouble = [];
                if($trouble_untreated){
                    $trouble = json_decode($trouble_untreated);
                }
                $trade_show_untreated = app("cache.config")->get("trade_show");
                $trade_show = [];
                if($trade_show_untreated){
                    $trade_show = json_decode($trade_show_untreated,true);
                }
                $faqs = app(FaqRepository::class)->all()->where("category_id",-1);
                $faq = app(FaqRepository::class)->all()->where("category_id",1);
                return view("web.xenical", compact("title","for_people","trouble","trade_show","faqs","faq"));
            default:
                $page = Page::where("uri",$uri)->where("status",1)->first();
                if($page) {
                    return view("web.page", compact("page"));
                }
                abort(404);
        }
    }

    public function bmi(Request $request){
        if($request->ajax() && $request->isMethod("POST")){
            $interpretation = app("cache.config")->get("interpretation");
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
                    if($item["bmi"] == $bmi_status && $item["activity"] == $request->activityLevel){
                        $inter = $item;
                        break;
                    }
                }
                $goods = null;
                if($inter["goods"]){
                    $goods = Product::with("attr")->where("id",$inter["goods"])->where("status",1)->first();
                }
                Compute::create([
                    "height" => $request->height,
                    "weight" => $request->weight,
                    "bmi" => $request->bmi,
                    "activity_level" => $request->activityLevel,
                    "ip" => $request->getClientIp(),
                    "goods" => $goods->id ?? 0,
                ]);
                if(DeviceTypeHandlers::isMobile()){
                    return view("mobile.evaluate-result",compact("inter","goods"));
                }
                return view("web.evaluate-result",compact("inter","goods"));
            }
        }
        return view("web.bmi");
    }

    public function bmr(Request $request){
        return view("web.bmr");
    }

    public function bodyfat(Request $request){
        return view("web.bodyfat");
    }

    public function faq(){
        $faqs = app(FaqRepository::class)->all();
        $faq = app(\App\Repositories\FaqRepository::class)->all()->where("category_id",1);
        return view("web.faq", compact("faqs","faq"));
    }

    public function about(Request $request){
        $title = app("cache.config")->get("about_title");
        $title_gb = app("cache.config")->get("about_title_gb");
        $title_en = app("cache.config")->get("about_title_en");
        $content = app("cache.config")->get("about_content");
        $content_gb = app("cache.config")->get("about_content_gb");
        $html_code = app("cache.config")->get("about_html_code");
        $for_people_untreated = app("cache.config")->get("for_people");
        $for_people = [];
        if($for_people_untreated){
            $for_people = json_decode($for_people_untreated);
        }
        $trouble_untreated = app("cache.config")->get("trouble");
        $trouble = [];
        if($trouble_untreated){
            $trouble = json_decode($trouble_untreated);
        }
        $trade_show_untreated = app("cache.config")->get("trade_show");
        if($request->attributes->get("is_googlebot")){
            $trade_show_untreated = app("cache.config")->get("trade_show_gb");
        }
        $trade_show = [];
        if($trade_show_untreated){
            $trade_show = json_decode($trade_show_untreated,true);
        }
        $faqs = app(FaqRepository::class)->all()->where("category_id",-1);
        $faq = app(FaqRepository::class)->all()->where("category_id",1);
        return view("web.about", compact("title","title_gb","title_en","content","content_gb","html_code","for_people","trouble","trade_show","faqs","faq"));
    }

    public function guide(){
        return view("web.guide");
    }

    public function paymentDelivery(){
        return view("web.payment-delivery");
    }

    public function afterSales(){
        return view("web.after-sales");
    }

    public function privacy(){
        return view("web.privacy");
    }
}
