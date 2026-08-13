<?php


namespace App\Repositories;


use App\Models\Seo;
use Illuminate\Support\Facades\Cache;
class SeoRepository extends Repository
{
    protected $modelClass = Seo::class;

    public function get($is_cache = true){
        if (Cache::has(config('global.cache.seo')) && $is_cache){
            $seo = Cache::get(config('global.cache.seo'));
        }else{
            $seo = $this->model()->get();
            Cache::set(config('global.cache.seo'),$seo);
        }
        return $seo;
    }

    /**
     * 根据uri获取对应的seo标签
     * @param $uri
     * @return mixed
     */
    public function findPath($uri){
        $seo = $this->get()->keyBy('path');
        // 动态路径(如 /check/{no})无精确 SEO 时逐级回退父路径，最后回退首页，避免 TDK 为空
        $path = $uri;
        while ($path !== '') {
            $matched = $seo->get($path);
            if ($matched) {
                return $matched;
            }
            $pos = strrpos($path, '/');
            if ($pos === false || $pos === 0) {
                break;
            }
            $path = substr($path, 0, $pos);
        }
        return $seo->get('/');
    }



}
