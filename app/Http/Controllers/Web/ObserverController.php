<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Observer;
use App\Services\VehicleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ObserverController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'uri' => 'required',
            'explain' => 'required',
            'event' => 'required',
        ]);
        if ($validator->fails()) {
            return "error!";
        }

        try {
            Observer::create([
                'host'=>$request->getHost(),
                'uri'=>$request->uri,
                'ip'=>VehicleService::IP(),
                'ipcountry'=>request()->header('cf-ipcountry'),
                'explain'=>$request->explain,
                'event'=>$request->event,
                'referer'=>$request->referer,
                'user_agent'=>VehicleService::userAgent(),
                'headers'=>json_encode($request->header(),JSON_UNESCAPED_UNICODE),
            ]);
            return "success";
        }catch (\Exception $exception){
            return $exception->getMessage();
        }



    }


}
