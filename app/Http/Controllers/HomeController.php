<?php

namespace App\Http\Controllers;

use App\Models\BankPay;
use App\Models\MobileBanking;
use App\Models\MobileRecharge;
use App\Models\Topup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //

    public function index()
    {

        return view('frontend.home');
    }

    public function test()
    {

        return view('frontend.home');
    }

    public function sendotp()
    {

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
            } else {
                return back()->with(['response' => false, 'msg' => 'OTP sent failed']);
            }
        }
    }

    public function forget_password(Request $request)
    {

        $request->validate([
            'phone' => 'required|exists:users,phone'
        ]);

        $user = User::where('phone', $request->phone)->first();

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
            } else {
                return back()->with(['response' => false, 'msg' => 'OTP sent failed']);
            }
        }
    }


    public function reset_password(Request $request, $opt = null, $phone = null)
    {

        if ($request->post()) {
            $request->validate([
                'phone' => 'required|exists:users,phone',
                'password' => 'required|confirmed',
            ]);

            $user = User::where('phone', $request->phone)->first();
            $user->password = bcrypt($request->password);
            if ($user->save()) {
                return redirect(route('login'))->with(['response' => true, 'msg' => 'Password reset Successfull']);
            } else {
                return back()->with(['response' => false, 'msg' => 'Password reset Fail']);
            }
        }

        if ($phone) {
            $user = User::where('phone', $phone)->first();
            if ($user->otp == $opt) {
                return view('auth.reset-password', compact('phone'));
            } else {
                return back()->with(['response' => false, 'msg' => 'Invalid OTP']);
            }
        }
    }
    public function otp($phone = null)
    {

        return view('auth.otp', compact('phone'));
    }

    public function blocked($phone = null)
    {

        return view('blocked');
    }

    public function otpvarify(Request $request)
    {

        $request->validate([
            'otp' => 'required'
        ]);
        if ($request->phone) {
            $user = User::where('phone', $request->phone)->first();
            if ($user->otp == $request->otp) {

                return redirect()->route('reset.password', [$request->otp, $request->phone]);
            } else {
                return back()->with(['response' => false, 'msg' => 'Invalid OTP']);
            }
        } else {
            if (auth()->user()->otp == $request->otp) {
                auth()->user()->update(['otp' => null, 'email_verified_at' => now(), 'otp_varify' => 1]);
                return redirect()->route('index');
            } else {
                return back()->with(['response' => false, 'msg' => 'Invalid OTP']);
            }
        }
    }


    public function getData(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'unique:users,phone'],
            'password' => ['required'],
            'location' => ['required'],
        ], [
            'name.required' => 'আপনার নাম দিন',
            'email.required' => 'আপনার নাম্বার লিখুন',
            'email.unique' => 'এই নাম্বার একাউন্ট খোলা আছে',
            'location' => 'আপনার দেশ সিলেক্ট করুন'
        ]);
        Session::put('register-info', $request->post());
        return redirect()->route('register.image');
    }


    public function getImage(Request $request)
    {
        if ($request->post()) {
            $request->validate([
                'photo' => ['required'],
            ], [
                'photo.required' => 'আপনার ছবি তুলুন',
            ]);
            Session::put('register-info', $request->post());
            return redirect()->route('register.final');
        }

        return view('auth.photo');
    }

    public function getFinal(Request $request)
    {

        return view('auth.final');
    }

    public function agree(Request $request)
    {
        $data = auth()->user();
        $data->agree = 1;
        $data->save();

        return back();
    }




    public function contact()
    {

        return view('frontend.contact');
    }

    public function history(Request $request)
    {
        $user = auth()->user(); // Get the authenticated user

        // Define the active tab (default is 'profile')
        $tab = $request->get('tab', 'profile');

        // Transactions
        $qTopup = trim($request->get('topup_q', ''));
        $topupQuery = Topup::with('gateway')->where('user_id', $user->id);
        if ($qTopup !== '') {
            $topupQuery->where(function ($s) use ($qTopup) {
                $s->where('transaction_id', 'like', "%{$qTopup}%")
                    ->orWhere('amount', 'like', "%{$qTopup}%")
                    ->orWhere('type', 'like', "%{$qTopup}%")
                    ->orWhere('mobile', 'like', "%{$qTopup}%")
                    ->orWhere('account', 'like', "%{$qTopup}%")
                    ->orWhereHas('gateway', fn($g) => $g->where('name', 'like', "%{$qTopup}%"));
            });
        }
        $topups = $topupQuery->latest()->paginate(10, ['*'], 'deposit_page');

        $qMb = trim($request->get('mb_q', ''));
        $mbQuery = MobileBanking::where('user_id', $user->id);
        if ($qMb !== '') {
            $mbQuery->where(function ($s) use ($qMb) {
                $s->where('transaction_id', 'like', "%{$qMb}%")
                    ->orWhere('amount', 'like', "%{$qMb}%")
                    ->orWhere('type', 'like', "%{$qMb}%")
                    ->orWhere('operator', 'like', "%{$qMb}%")
                    ->orWhere('mobile', 'like', "%{$qMb}%");
            });
        }
        $mobileWithdraws = $mbQuery->latest()->paginate(10, ['*'], 'mobile_withdraw_page');

        $qBank = trim($request->get('bank_q', ''));
        $bankQuery = BankPay::where('user_id', $user->id);
        if ($qBank !== '') {
            $bankQuery->where(function ($s) use ($qBank) {
                $s->where('transaction_id', 'like', "%{$qBank}%")
                    ->orWhere('amount', 'like', "%{$qBank}%")
                    ->orWhere('type', 'like', "%{$qBank}%")
                    ->orWhere('operator', 'like', "%{$qBank}%")
                    ->orWhere('mobile', 'like', "%{$qBank}%")
                    ->orWhere('number', 'like', "%{$qBank}%")
                    ->orWhere('branch', 'like', "%{$qBank}%")
                    ->orWhere('achold', 'like', "%{$qBank}%");
            });
        }
        $bankPays = $bankQuery->latest()->paginate(10, ['*'], 'bank_withdraw_page');

        $qRc = trim($request->get('rc_q', ''));
        $mrQuery = MobileRecharge::where('user_id', $user->id);
        if ($qRc !== '') {
            $mrQuery->where(function ($s) use ($qRc) {
                $s->where('operator', 'like', "%{$qRc}%")
                    ->orWhere('type', 'like', "%{$qRc}%")
                    ->orWhere('mobile', 'like', "%{$qRc}%")
                    ->orWhere('amount', 'like', "%{$qRc}%");
            });
        }
        $mobileRecharges = $mrQuery->latest()->paginate(10, ['*'], 'recharge_page');

        $qRemit = trim($request->get('remit_q', ''));
        $remitQuery = \App\Models\Remittance::where('user_id', $user->id);
        if ($qRemit !== '') {
            $remitQuery->where(function ($s) use ($qRemit) {
                $s->where('transaction_id', 'like', "%{$qRemit}%")
                    ->orWhere('operator', 'like', "%{$qRemit}%")
                    ->orWhere('account', 'like', "%{$qRemit}%")
                    ->orWhere('branch', 'like', "%{$qRemit}%")
                    ->orWhere('achold', 'like', "%{$qRemit}%")
                    ->orWhere('amount', 'like', "%{$qRemit}%");
            });
        }
        $remittances = $remitQuery->latest()->paginate(10, ['*'], 'remittance_page');

        return view('admin.history', compact(
            'user',
            'tab', // Make sure to pass the $tab variable here
            'topups',
            'qTopup',
            'mobileWithdraws',
            'qMb',
            'bankPays',
            'qBank',
            'mobileRecharges',
            'qRc',
            'remittances',
            'qRemit'
        ));
    }
}
