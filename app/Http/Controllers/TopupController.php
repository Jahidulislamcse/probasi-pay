<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use App\Models\User;
use Illuminate\Http\Request;

class TopupController extends Controller
{
    //

   
    public function topup_list(Request $request){

        $lists = Topup::orderBy('id', 'desc')->get() ;

        return view('admin.topup_list', compact('lists')) ;

    }
    public function topup_approve($id){

        
        $data = Topup::find($id) ;
        $data->status = 1 ;
        if ($data->save()) {
                $user = User::find($data->user_id) ;
                $user->balance = $user->balance + $data->amount ;
                $user->save();
            return back()->with(['response' => true, 'msg' => 'Topup Approved!']);
        }
       
        return back()->with(['response' => false, 'msg' => 'Topup Not Approved!']);

    }
    public function topup_reject($id){

       
        $data = Topup::find($id) ;
        $data->status = 2 ;
        if ($data->save()) {
            
            return back()->with(['response' => true, 'msg' => 'Topup Rejected!']);
        }
       
        return back()->with(['response' => false, 'msg' => 'Topup Not Rejected!']);

    }
    public function topup_delete($id){

        
            $data = Topup::find($id) ;
            if ($data->delete()) {
                return redirect(back())->with(['response' => true, 'msg' => 'Topup Deleted!']);
            }
        
        return redirect(back())->with(['response' => false, 'msg' => 'Topup Not Deleted!']);

    }
   

   
    public function bank_topup(Request $request){

        if ($request->post()) {
            
            $data = new Topup() ;
            $data->type = $request->type ;
  
            if ($request->hasFile('file')) {
                $data->file = imageUpload($request->file) ;
            }
            $data->amount = $request->amount ;
            $data->account = $request->account ;
            $data->status = 0 ;
            $data->user_id = auth()->user()->id ;
            if ($data->save()) {
                    return redirect(route('admin.index'))->with(['response' => true, 'msg' => 'Topup Request Success!Please wait for approval!']);
             }

        }

        return view('admin.bank_topup') ;

    }


    public function topup(Request $request){

        if ($request->post()) {
            
           
            
            $data = new Topup() ;
            $data->type = $request->type ;
            $data->amount = $request->amount ;
            $data->account = $request->account ;
            $data->mobile = $request->pin ;
            $data->user_id = auth()->user()->id ;

            if ($request->hasFile('file')) {
                $data->file = imageUpload($request->file) ;
            }
            $data->status = $request->amount >= 25000 ? 1 : 0 ;
            if ($data->save()) {
                            if($request->amount >= 25000){
                                        $user = auth()->user() ;
                                        $user->balance = $user->balance + $request->amount ;
                                        $user->save();
                            }
            

                    return redirect(route('admin.index'))->with(['response' => true, 'msg' => 'Topup Request Success!']);
             }

        }

        return view('admin.topup') ;

    }

}
