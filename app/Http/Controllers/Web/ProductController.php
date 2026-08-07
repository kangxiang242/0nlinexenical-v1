<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\Brand;
use App\Models\Comment;
use App\Models\CommentImage;
use App\Models\CommentLabel;
use App\Models\Product;
use App\Models\ProductCate;
use App\Models\ProductTag;
use App\Models\Spu;
use App\Models\Theme;
use App\Repositories\BrandRepository;
use App\Repositories\CateRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TagRepository;
use App\Services\CartService;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ProductController extends Controller
{
    public function index(ProductRepository $productRepository){
        $products = $productRepository->all();

        return template('product.index',compact('products'));
    }


    public function show($id){
        $goods = Product::where('id',$id)->where('status',1)->first();

        if(!$goods){
            abort(404);
        }

        $skus = Product::where('status',1)->where('id','<>',$id)->get();

        $comment = Comment::where('status',1)->get()->shuffle();

        $comment_images = CommentImage::where('status',0)->get()->shuffle();

        foreach ($comment as $key => $item) {

            if($item->is_comment_image == 1 && !$item->comment_image && $comment_images->isNotEmpty()){
                $comment_image = $comment_images->pop();
                $item->comment_image = $comment_image->image;
                $item->save();

            }


            if ($key == 0) {
                $item->time_at = mt_rand(1, 10) . '分钟前';
            } elseif ($key == 1) {
                $item->time_at = mt_rand(30, 59) . '分钟前';
            } elseif ($key == 2) {
                $item->time_at = mt_rand(1, 12) . '小时前';
            } elseif ($key == 3) {
                $item->time_at = mt_rand(13, 24) . '小时前';
            } elseif ($key == 4) {
                $item->time_at = '昨天';
            } else {
                // 计算减少的天数
                $days = floor(($key - 4) / 4);
                // 获取当前日期，并减去相应的天数
                $date = Carbon::now()->subDays($days);
                $item->time_at = $date->format('m月d日');
            }
        }



        $comment_labels = CommentLabel::orderBy('sort')->get();

        $un_product_details_gb = app('cache.config')->get('product_details_gb');
        $product_details_gb = [];
        if($un_product_details_gb){
            $product_details_gb = json_decode($un_product_details_gb,true);
        }

        $un_product_details = app('cache.config')->get('product_details');
        $product_details = [];
        if($un_product_details){
            $product_details = json_decode($un_product_details,true);
        }


        return template('product.show',compact('goods','skus','comment','comment_labels','product_details_gb','product_details'));
    }


    public function commentUp(Request $request){
        $comment = Comment::find($request->id);
        if($request->like == 1){
            $comment->up = $comment->up+1;
        }else{
            $comment->up = $comment->up-1;
        }
        if($comment->up < 0){
            $comment->up = 0;
        }

        $comment->save();
    }
}
