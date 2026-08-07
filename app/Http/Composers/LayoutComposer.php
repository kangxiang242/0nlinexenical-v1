<?php


namespace App\Http\Composers;


use App\Handlers\DeviceTypeHandlers;

use App\Repositories\ArticleCateRepository;
use App\Repositories\BannerRepository;

use App\Repositories\SeoRepository;

use App\Services\ConfigService;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class LayoutComposer
{
    private $view;

    private $uri;

    private $path;

    private $data = [];


    public function all(View $view){

        $this->view = $view;

        $this->path = request()->path();

        if(request()->route()){
            $this->uri = request()->route()->uri();
        }

        $this->seo();

        $this->getArticleCate();

        $this->getBanners();

        $this->view->with('layout',$this->data);
    }

    /**
     * 獲取seo三大標簽
     */
    protected function seo(){

        $seo = app(SeoRepository::class)->findPath('/'.trim($this->path,'/'));

        if($seo && $seo->title_tail == 1){
            $seo->title = $seo->title.ConfigService::get('seo_title_tail');
        }
        $this->data['seo'] = $seo;

    }


    public function getArticleCate(){
        $this->data['global-article-cate'] = app(ArticleCateRepository::class)->getAll();
    }


    public function getBanners(){

        $this->data['banners'] = app(BannerRepository::class)->getPageBanner($this->path,0);

    }

}
