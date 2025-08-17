<?php

namespace App\Http\Controllers;

use App\Models\BankPay;
use Illuminate\Http\Request;

class BankPayController extends Controller
{
    //

    public function list()
    {
        $lists = BankPay::orderBy('id', 'desc')->get();
        return view('admin.bank_pay_list', compact('lists'));
    }
    public function approve($id)
    {
        $recharge = BankPay::findOrFail($id);
        $recharge->status = 1;
        $recharge->save();

        return redirect()->back()->with(['response' => true, 'msg' => 'Bank Pay Approved!']);
    }
    public function reject($id)
    {
        $recharge = BankPay::findOrFail($id);
        $recharge->status = 2;
        $recharge->save();

        $user = $recharge->user;
        $user->balance += $recharge->amount;
        $user->save();

        return redirect()->back()->with(['response' => true, 'msg' => 'Bank Pay Rejected and Amount Refunded!']);
    }

    public function delete($id)
    {
        $transaction = BankPay::findOrFail($id);
        if( $transaction->delete()){
            return redirect()->back()->with(['response' => true, 'msg' => ' Bank Pay Deleted!']);
        }
    }


    public function bankpay(Request $request){

        if ($request->post()) {

            $request->validate([
                'operator' => 'required',
                'amount' => 'required|numeric|min:1',
                'mobile' => 'required|numeric|min:10',
                'branch' => 'required',
                'achold' => 'required'
            ]);
            
             if( $request->pin != auth()->user()->pin){
                return redirect()->back()->with(['response' => false, 'msg' => 'Invalid Pin code!']);
            }
        
            if( $request->amount > auth()->user()->balance){
                return redirect()->back()->with(['response' => false, 'msg' => 'Please Topup First!']);
            }
            
           
            $data = new BankPay() ;
            $data->operator = $request->operator ;
            
            $data->amount = $request->amount ;
            $data->mobile = $request->mobile ;
            $data->branch = $request->branch ;
            $data->achold = $request->achold ;
 
            $data->user_id = auth()->user()->id;
            $data->status = 0 ;

            if ($data->save()) {
                $user = auth()->user();
                $user->balance = $user->balance - $request->amount ;
                $user->save();
                  
                    return redirect(route('success',[$data->id,'bankpay']));
             }

        }

        return view('admin.bank_pay') ;

    }
}
