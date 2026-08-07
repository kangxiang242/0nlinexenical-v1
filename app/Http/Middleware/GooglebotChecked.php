<?php


namespace App\Http\Middleware;


use App\Handlers\DeviceTypeHandlers;
use App\Services\ConfigService;
use App\Services\GoogleService;


class GooglebotChecked
{
    public function handle($request, \Closure $next){


        if($request->path() == '/'){
            $user_agent  = $request->userAgent();
            if(strpos(strtolower($user_agent),'googlebot') !== false){
                $close_googlebot = ConfigService::get('close_googlebot');
                if($close_googlebot){
                    return response('','500');
                }else{
                    if(DeviceTypeHandlers::isMobile()){
                        $googlebot_index_page = GoogleService::getM();
                    }else{
                        $googlebot_index_page = GoogleService::getPC();
                    }

                    if($googlebot_index_page){
                        echo $googlebot_index_page;exit;
                    }
                }

            }

        }

        return $next($request);

    }
}
