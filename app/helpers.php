<?php

use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\Section;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

if (! function_exists('imageUpload')) {

    function imageUpload($imagefile)
    {

        $image = time() . rand(1, 100) . '.' . $imagefile->getClientOriginalExtension();
        $destinationPath = public_path('fileManager');
        $imagefile->move($destinationPath, $image);
        return 'fileManager/' . $image;
    }

}

if (! function_exists('menus')) {


    function menus(){
        return Category::where('cat_parent',null)->where('menu',1)->where('status',1)->get();
    }

}
 function hiddnum($mobile){
    return str_repeat('*', strlen($mobile) - 4) . substr($mobile, -4) ;
}

if (!function_exists('is_serialized')) {
    function is_serialized($data)
    {
        // If it isn't a string, it isn't serialized
        if (!is_string($data)) {
            return false;
        }

        // Trim the data to remove any extra whitespace
        $data = trim($data);

        // Check if the data is empty
        if ($data === '') {
            return false;
        }

        // Check if the data matches a serialized format
        if (preg_match('/^(a|O|s|b|i|d|N):/', $data) === 1) {
            // Attempt to unserialize the data
            $unserialized = @unserialize($data);
            // If unserialization succeeded, it is serialized data
            return $unserialized !== false || $data === 'b:0;';
        }

        return false;
    }
}
if (!function_exists('section')) {

    function section($key){

            $section = Section::where('key',$key)->first();

            if($section ){
                return $section->value ;
            }else{
                return '' ;
            }

    }


}


if (!function_exists('site_phone')) {
    function site_phone(){
      $site_phones =  json_decode(siteInfo()->phone) ;
      $phones = '' ;

      foreach( $site_phones as $phone){
        $phones .= $phone->value.' , ' ;
      }
      return $phones ;
    }
}

if (! function_exists('siteInfo')) {

    function siteInfo()
    {

        $data = GeneralSetting::first();
        return $data ;

    }

}

if (! function_exists('currency')) {

    function currency($value = '',$c='')
    {
        $symbol = '' ;
        if(!empty($c)){
            if($c == 'bdt'){
                $symbol = '৳' ;
            }

            if($c == 'usd'){
                $symbol = '$' ;
            }
        }else{

                $symbol = '৳' ;

        }


        return  $symbol.number_format($value,2) ;

    }

}

if (! function_exists('currency_code')) {

    function currency_code($value = '')
    {

        $code = '' ;
        if(Session::get('currency_code')){
            $code = Session::get('currency_code') ;
        }else{
            $code = 'usd' ;
        }

        return   $code ;

    }

}


if (! function_exists('country')) {

    function country()
    {


        return   Country::find(auth()->user()->location)  ;

    }

}

