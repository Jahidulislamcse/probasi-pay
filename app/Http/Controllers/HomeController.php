<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //

    public function index(){

        return view('frontend.home');
    }

    public function test(){

        return view('frontend.home');
    }

    public function sendotp(){

        $username = auth()->user()->name;
        $phone = auth()->user()->phone;
        $otp = rand(10000, 99999);
        if ($phone) {
            $request_data = [
                "msg" => "Dear $username, your OTP  is $otp. Moono Express",
                "to" => '88' . $phone,
                "api_key" => "08Zm8HiG9H9cldxBsoVx62Ej4SbvdYy2JPfX25m2",
            ];
            $response = Http::get("https://api.sms.net.bd/sendsms", $request_data);
            $response = json_decode($response);
            if ($response->error == 0) {
                auth()->user()->update(['otp' => $otp]);
                return back()->with(['response' => true, 'msg' => 'OTP sent successfully']);
            }else{
                return back()->with(['response' => false, 'msg' => 'OTP sent failed']);
            }

        }

    }

    public function forget_password( Request $request){

        $request->validate([
            'phone' => 'required|exists:users,phone'
        ]);

        $user = User::where('phone',$request->phone)->first();

        $username = $user->name;
        $phone = $user->phone;
        $otp = rand(10000, 99999);
        if ($phone) {
            $request_data = [
                "msg" => "Dear $username, your OTP  is $otp. Moono Express",
                "to" => '88' . $phone,
                "api_key" => "08Zm8HiG9H9cldxBsoVx62Ej4SbvdYy2JPfX25m2",
            ];
            $response = Http::get("https://api.sms.net.bd/sendsms", $request_data);
            $response = json_decode($response);
            if ($response->error == 0) {
                $user->update(['otp' => $otp]);
                return redirect(route('forget.otp', $phone))->with(['response' => true, 'msg' => 'OTP sent successfully']);
            }else{
                return back()->with(['response' => false, 'msg' => 'OTP sent failed']);
            }

        }


    }


    public function reset_password(Request $request,$opt=null,$phone=null){

        if($request->post()){
            $request->validate([
                'phone' => 'required|exists:users,phone',
                'password' => 'required|confirmed',
            ]);

            $user = User::where('phone',$request->phone)->first();
            $user->password = bcrypt($request->password);
                if ($user->save()) {
                    return redirect(route('login'))->with(['response' => true, 'msg' => 'Password reset Successfull']);
                }else{
                    return back()->with(['response' => false, 'msg' => 'Password reset Fail']);
                }

        }

        if($phone){
            $user = User::where('phone',$phone)->first();
            if($user->otp == $opt){
                return view('auth.reset-password',compact('phone'));
            }else{
                return back()->with(['response' => false, 'msg' => 'Invalid OTP']);
            }
        }


    }
    public function otp($phone=null){

        return view('auth.otp',compact('phone'));
    }

    public function otpvarify(Request $request){

        $request->validate([
            'otp' => 'required'
        ]);
            if($request->phone){
                $user = User::where('phone',$request->phone)->first();
                if($user->otp == $request->otp){

                    return redirect()->route('reset.password',[$request->otp,$request->phone]);
                }else{
                    return back()->with(['response' => false, 'msg' => 'Invalid OTP']);
                }
            }else{
                if(auth()->user()->otp == $request->otp){
                    auth()->user()->update(['otp' => null, 'email_verified_at' => now(),'otp_varify' => 1]);
                    return redirect()->route('index');
                }else{
                    return back()->with(['response' => false, 'msg' => 'Invalid OTP']);
                }
            }


    }


    public function getData(Request $request){

        $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required','unique:users,phone'],
                'password' => ['required'],
                'location' => ['required'],
        ],['name.required'=>'আপনার নাম দিন',
            'email.required' => 'আপনার নাম্বার লিখুন',
            'email.unique' => 'এই নাম্বার একাউন্ট খোলা আছে',
            'location' => 'আপনার দেশ সিলেক্ট করুন'
        ]);
        Session::put('register-info',$request->post());
        return redirect()->route('register.image');

    }


    public function getImage(Request $request){
        if($request->post()){
              $request->validate([
                'photo' => ['required'],
        ],['photo.required'=>'আপনার ছবি তুলুন',
        ]);
            Session::put('register-info',$request->post());
            return redirect()->route('register.final');

        }

        return view('auth.photo');

    }

    public function getFinal(Request $request){

        return view('auth.final');

    }

    public function agree(Request $request){
        $data = auth()->user();
        $data->agree = 1;
        $data->save();

        return back();

    }




    public function contact(){

        return view('frontend.contact');
    }

    public function history(){

        return view('admin.history');
    }




}
