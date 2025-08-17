<?php

namespace App\Http\Controllers;

use App\Models\Announc;
use App\Models\Image;
use App\Models\Partner;
use App\Models\Promo;
use App\Models\Section;
use App\Models\Service;
use App\Models\Subscriber;
use App\Models\MobileRecharge;
use App\Models\BillPay;
use App\Models\BankPay;
use App\Models\MobileBanking;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    
   

   public function success($id,$page){
       
       
    switch($page){
        case 'recharge':
            $title = "মোবাইল রিচার্জ";
            $get = MobileRecharge::find($id);
            if($get){
            $data = [
                "সিম" => $get->operator,
                "ধরণ" => $get->type,
                "নাম্বার" => $get->mobile,
                "টাকা" => $get->amount,
                  "তারিখ"=> $get->created_at
            ]; }else{
                $data = [];
            }
            break;
        case 'billpay':
            $title = "বিল পে";
            $get = BillPay::find($id);
            if($get){
               $data = [
                "বিল" => $get->operator,
                "বিল নাম্বার" => $get->mobile,
                "টাকা" => $get->amount,
                  "তারিখ"=> $get->created_at
            ]; 
            }else{
                $data = [];
            }
            
            break;
        case 'bankpay':
            $title = "ব্যাংক পে";
            $get = BankPay::find($id);
            if($get){
               $data = [
                "ব্যাংক নাম" => $get->operator,
                "শাখা" => $get->branch,
                "একাউন্ট হোল্ডার" => $get->achold,
                "একাউন্ট নং" => $get->mobile,
                "টাকা" => $get->amount,
                "তারিখ"=> $get->created_at
            ]; 
            }else{
                $data = [];
            }
            
            break;
        case 'mobilebanking':
            $title = "মোবাইল ব্যাংকিং";
            $get = MobileBanking::find($id);
            if($get){
               $data = [
                "কোম্পানি" => $get->operator,
                "ধরন" => $get->type,
                "একাউন্ট নং" => $get->mobile,
                "টাকা" => $get->amount,
                "তারিখ"=> $get->created_at
            ]; 
            }else{
                $data = [];
            }
            
            break;
        default:
            $title = "অজানা পৃষ্ঠা";
            $data = [];
            break;
    }
        
        
        return view('admin.success',compact(['data','title']));
   }
  


    public function page(Request $request , $id = ''){
        if($request->isMethod('post')){

            if($id){
                $data = Section::find($id);

            }else{
                $data = new Section() ;
               
            }
            $request->validate([
                'key'=>'required',
            ]);

            $data->key = $request->key ; 
            $data->value = $request->value ; 

                       
         
            if ($data->save()) {
                
                if($request->hasFile('files')) {

                    foreach ($request->file('files') as $key => $file) {
                        dd($file);
                        $filename = imageUpload($file);
                        $image = new Image();
                        $image->parent_id = $data->id;
                        $image->path = $filename;
                        $image->type = in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'video/mp4', 'video/mpeg']) ? (str_starts_with($file->getMimeType(), 'image/') ? 'image' : 'video') : 'other';
                        $image->save();
                        
                    }
                  
                }
                return back()->with(['response' => true, 'msg' => 'Page Create Success']);
            } else {
                return back()->with(['response' => false, 'msg' => 'Page Create Fail!']);
            }
        }
        $list = Section::all() ;
        if(!empty($id)){
            $page = Section::find($id);
            
        }else{
            $page = '';
        }

        return view('admin.content',compact(['list','page','id']));
    }

    public function pagedelete($id){
        $data= Section::find($id) ;

        if ($data->delete()) {
            return back()->with(['response' => true, 'msg' => 'Page Delete Success']);
        } else {
            return back()->with(['response' => false, 'msg' => 'Page Delete Fail!']);
        }
    }


    
}
