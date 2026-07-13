<?php


namespace App\Services;


class GoogleService
{


    public static function getPC(){
        $content = '';
        if(file_exists(public_path('googlebot/index_page.html'))){
            $content = file_get_contents(public_path('googlebot/index_page.html'));
        }
        return $content;
    }

    public static function getM(){
        $content = '';
        if(file_exists(public_path('googlebot/index_page_m.html'))){
            $content = file_get_contents(public_path('googlebot/index_page_m.html'));
        }
        return $content;
    }

    public static function putPC($content){
        if(!is_dir(public_path('googlebot'))){
            mkdir(public_path('googlebot'));
        }
        file_put_contents(public_path('googlebot/index_page.html'),$content);
        return true;
    }

    public static function putM($content){
        if(!is_dir(public_path('googlebot'))){
            mkdir(public_path('googlebot'));
        }
        file_put_contents(public_path('googlebot/index_page_m.html'),$content);
        return $content;
    }
}
