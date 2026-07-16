<?php

function asset_upload($path='',$default=null){

    return asset('uploads/'.$path);

}

function img_field($src,$blur=null,$size=null,$alt='',$class=''){
    $src = '/'.ltrim($src,'/');

    $pathinfo = pathinfo($src);
    $extension = \Illuminate\Support\Arr::get($pathinfo,'extension');
    $filename = \Illuminate\Support\Arr::get($pathinfo,'filename');
    $dirname = \Illuminate\Support\Arr::get($pathinfo,'dirname');

    if(!is_null($size)){
        $resizeName = $filename.'-'.$size.'.'.$extension;
        $size_path = $dirname.'/'.$resizeName;
    }else{
        $size_path = $src;
    }

    if(!is_null($blur)){
        $blurName = $filename.'-'.$blur.'.'.$extension;
        $blur_path = $dirname.'/'.$blurName;
    }else{
        $blur_path = $src;
    }

    if(config('global.image_url')){
        $size_path = config('global.image_url').$size_path;
        $blur_path = config('global.image_url').$blur_path;
    }


    return '<img class="lazyload '.$class.'" src="'.$blur_path.'" data-src="'.$size_path.'" alt="'.$alt.'">';
}

function get_img_resize($path,$size){

    $pathinfo = pathinfo($path);

    $extension = \Illuminate\Support\Arr::get($pathinfo,'extension');
    $filename = \Illuminate\Support\Arr::get($pathinfo,'filename');
    $dirname = \Illuminate\Support\Arr::get($pathinfo,'dirname');
    if($extension && $filename){
        $resizeName = $filename.'-'.$size.'.'.$extension;
        $resize_image_path = public_path('uploads'.$dirname.'/'.$resizeName);

        if(!is_file($resize_image_path)){
            $img = Intervention\Image\Facades\Image::make(public_path('uploads'.$path))->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $saveName = $img->filename.'-'.$size.'.'.$img->extension;
            $img->save($img->dirname.'/'.$saveName);
        }
        return $dirname.'/'.$resizeName;

    }


    return $path;
}

function replaceCodeHtml($html,$size=68){

    try {
        preg_match_all('/<img[^>]*?src="([^"]*?)"[^>]*?>/i',$html,$match);
        if(isset($match[1]) && $match[1]){
            foreach($match[1] as $v){
                $info = pathinfo($v);
                if($info['extension'] != 'gif'){
                    $new_path = $info['dirname'].'/'.$info['filename'].'-'.$size.'.'.$info['extension'];
                    $replace = asset_upload($new_path).'" data-src="'.asset_upload($v).'';
                    $html = str_replace($v,$replace,$html);

                }else{
                    $replace = asset_upload($v);
                    $html = str_replace($v,$replace,$html);

                }
            }
        }
    }catch (\Exception $exception){
    }
    return $html;
}

function array_get($array,$key,$default=null){
    return \Illuminate\Support\Arr::get($array,$key,$default);
}

if (! function_exists('template')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null  $view
     * @param  \Illuminate\Contracts\Support\Arrayable|array  $data
     * @param  array  $mergeData
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function template($view = null, $data = [], $mergeData = []){
        //$device = \App\Handlers\DeviceTypeHandlers::isMobile()?"mobile":"web";
        $device = 'web';
        return view($device.'::'.$view,$data,$mergeData);
    }
}

function configToArray($content){

    $data = [];
    if($content){
        $data = json_decode($content,true);
    }

    return $data;
}


function is_googlebot(){
    $user_agent = request()->header('user-agent');
    return preg_match("/(Googlebot|Chrome-Lighthouse)/i", $user_agent);
}

function is_mobile(){
    return \App\Handlers\DeviceTypeHandlers::isMobile();
}

// Alias for backward compatibility with old Rizhou namespace
class_alias(\App\Services\StoreSynchronizing::class, 'Rizhou\Control\Supply\StoreSynchronizing');
