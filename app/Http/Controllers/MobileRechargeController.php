<?php

namespace App\Http\Controllers;

use App\Models\MobileRecharge;
use Illuminate\Http\Request;

class MobileRechargeController extends Controller
{
    //


        public function list()
        {
            $lists = MobileRecharge::latest()->get();
            return view('admin.recharge_list', compact('lists'));
        }

        public function approve($id)
        {
            $recharge = MobileRecharge::findOrFail($id);
            $recharge->status = 1;
            $recharge->save();

            return redirect()->back()->with(['response' => true, 'msg' => 'Recharge Approved!']);
        }

        public function reject($id)
        {
            $recharge = MobileRecharge::findOrFail($id);
            $recharge->status = 2;
            $recharge->save();

            $user = $recharge->user;
            $user->balance += $recharge->amount;
            $user->save();

            return redirect()->back()->with(['response' => true, 'msg' => 'Recharge Rejected and Amount Refunded!']);
        }

        public function delete($id)
        {
            $transaction = MobileRecharge::findOrFail($id);
            if( $transaction->delete()){
                return redirect()->back()->with(['response' => true, 'msg' => ' Recharge Deleted!']);
            }
        }


        public function recharge(Request $request){

            if ($request->post()) {

                $request->validate([
                    'operator' => 'required',
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
            
                $data = new MobileRecharge() ;
                $data->operator = $request->operator ;
                $data->type = $request->type ;
                $data->amount = $request->amount ;
                $data->mobile = $request->mobile ;
                $data->user_id = auth()->user()->id;
                $data->status = 0 ;

                if ($data->save()) {
                    $user = auth()->user();
                    $user->balance = $user->balance - $request->amount ;
                    $user->save();
                        return redirect(route('success',[$data->id,'recharge']));
                 }
    
            }
    
            return view('admin.mobile_recharge') ;

        }


}
