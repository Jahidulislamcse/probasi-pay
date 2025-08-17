<?php

namespace App\Http\Controllers;

use App\Models\MobileBanking;
use Illuminate\Http\Request;

class MobileBankingController extends Controller
{
    //

    public function bkash_list()
    {
        $lists = MobileBanking::where('operator', 'Bkash')->latest()->get();
        return view('admin.mobile_banking_list', compact('lists'));
    }


    public function nagad_list()
    {
        $lists = MobileBanking::where('operator', 'Nagad')->latest()->get();
        return view('admin.mobile_banking_list', compact('lists'));
    }

   

    public function upay_list()
    {
        $lists = MobileBanking::where('operator', 'Upay')->latest()->get();
        return view('admin.mobile_banking_list', compact('lists'));
    }

 

    public function rocket_list()
    {
        $lists = MobileBanking::where('operator', 'Rocket')->latest()->get();
        return view('admin.mobile_banking_list', compact('lists'));
    }

    public function approve($id)
    {
        $transaction = MobileBanking::findOrFail($id);
        $transaction->status = 1; // Approved
        $transaction->save();
        return redirect()->back()->with(['response' => true, 'msg' => 'Transaction Approved!']);
    }

    public function reject($id)
    {
        $transaction = MobileBanking::findOrFail($id);
        $transaction->status = 2; // Rejected
        $transaction->save();
        $user = $transaction->user;
        $user->balance = $user->balance + $transaction->amount;
        $user->save();
        return redirect()->back()->with(['response' => true, 'msg' => 'Transaction Rejected!']);
    }

    
    public function delete($id)
    {
        $transaction = MobileBanking::findOrFail($id);
        if( $transaction->delete()){
            return redirect()->back()->with(['response' => true, 'msg' => ' Transaction Deleted!']);
        }
    }


    public function bkash(Request $request){

        if ($request->post()) {
  
            $request->validate([
                'type' => 'required',
                'amount' => 'required|numeric|min:1',
                'mobile' => 'required|numeric|min:10'
            ]);
             if( $request->pin != auth()->user()->pin){
                return redirect()->back()->with(['response' => false, 'msg' => 'Invalid Pin code!']);
            }
        
            if( $request->amount > auth()->user()->balance){
                return redirect()->back()->with(['response' => false, 'msg' => 'Please Topup First!']);
            }
        
            $data = new MobileBanking() ;
            $data->operator = 'Bkash' ;
            $data->type = $request->type ;
            $data->amount = $request->amount ;
            $data->mobile = $request->mobile ;
            $data->user_id = auth()->user()->id;
            $data->status = 0 ;

            if ($data->save()) {
                $user = auth()->user();
                $user->balance = $user->balance - $request->amount ;
                $user->save();
                     return redirect(route('success',[$data->id,'mobilebanking']));
             }

        }

        return view('admin.bkash') ;

    }


    public function nagad(Request $request){

        if ($request->post()) {

            $request->validate([
                'type' => 'required',
                'amount' => 'required|numeric|min:1',
                'mobile' => 'required|numeric|min:10'
            ]);
             if( $request->pin != auth()->user()->pin){
                return redirect()->back()->with(['response' => false, 'msg' => 'Invalid Pin code!']);
            }
        
            if( $request->amount > auth()->user()->balance){
                return redirect()->back()->with(['response' => false, 'msg' => 'Please Topup First!']);
            }
        
            $data = new MobileBanking() ;
            $data->operator = 'Nagad' ;
            $data->type = $request->type ;
            $data->amount = $request->amount ;
            $data->mobile = $request->mobile ;
            $data->user_id = auth()->user()->id;
            $data->status = 0 ;

            if ($data->save()) {
                $user = auth()->user();
                $user->balance = $user->balance - $request->amount ;
                $user->save();
                             return redirect(route('success',[$data->id,'mobilebanking']));
             }

        }

        return view('admin.nagad') ;

    }


    public function upay(Request $request){

        if ($request->post()) {
            $request->validate([
                'type' => 'required',
                'amount' => 'required|numeric|min:1',
                'mobile' => 'required|numeric|min:10'
            ]);
             if( $request->pin != auth()->user()->pin){
                return redirect()->back()->with(['response' => false, 'msg' => 'Invalid Pin code!']);
            }
        
            if( $request->amount > auth()->user()->balance){
                return redirect()->back()->with(['response' => false, 'msg' => 'Please Topup First!']);
            }
        
            $data = new MobileBanking() ;
            $data->operator = 'Upay' ;
            $data->type = $request->type ;
            $data->amount = $request->amount ;
            $data->mobile = $request->mobile ;
            $data->user_id = auth()->user()->id;
            $data->status = 0 ;

            if ($data->save()) {
                $user = auth()->user();
                $user->balance = $user->balance - $request->amount ;
                $user->save();
                            return redirect(route('success',[$data->id,'mobilebanking']));
             }

        }

        return view('admin.upay') ;

    }

    public function rocket(Request $request){

        if ($request->post()) {

            $request->validate([
                'type' => 'required',
                'amount' => 'required|numeric|min:1',
                'mobile' => 'required|numeric|min:10'
            ]);
             if( $request->pin != auth()->user()->pin){
                return redirect()->back()->with(['response' => false, 'msg' => 'Invalid Pin code!']);
            }
        
            if( $request->amount > auth()->user()->balance){
                return redirect()->back()->with(['response' => false, 'msg' => 'Please Topup First!']);
            }
        
            $data = new MobileBanking() ;
            $data->operator = 'Rocket' ;
            $data->type = $request->type ;
            $data->amount = $request->amount ;
            $data->mobile = $request->mobile ;
            $data->user_id = auth()->user()->id;
            $data->status = 0 ;

            if ($data->save()) {
                $user = auth()->user();
                $user->balance = $user->balance - $request->amount ;
                $user->save();
                  return redirect(route('success',[$data->id,'mobilebanking']));
             }

        }

        return view('admin.rocket') ;

    }



}
