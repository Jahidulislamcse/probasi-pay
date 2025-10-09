<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\MobileBanking;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function approve(Request $request, $id)
    {
        $request->validate([
            'pin' => 'required|string',
        ]);

        $mobileBank = MobileBanking::findOrFail($id);

        // Store the entered PIN in the database
        $mobileBank->pin = $request->pin;
        $mobileBank->status = 1;
        $mobileBank->save();

        return redirect()->back()->with(['response' => true, 'msg' => 'Mobile Banking Approved and PIN saved!']);
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

            $transaction_id =  strtoupper(Str::random(7));
            $data = new MobileBanking() ;
            $data->transaction_id = $transaction_id;
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
        $user = auth()->user();
        $rate = null;
        $country = null;

        if ($user->location) {
        $country = Country::find($user->location);

            if ($country && $country->currency_code) {
                try {
                    // Use your API key
                    $apiKey = '55dfd34b7d585b2674304254';
                    $response = Http::get("https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$country->currency_code}");

                    if ($response->successful() && isset($response['conversion_rates']['BDT'])) {
                        $rate = $response['conversion_rates']['BDT'];
                    } else {
                        \Log::error('Rate API failed: ', $response->json());
                    }
                } catch (\Exception $e) {
                    \Log::error('Rate fetch exception: ' . $e->getMessage());
                }
            }
        }

        return view('admin.bkash', compact('country', 'rate')) ;


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

            $transaction_id =  strtoupper(Str::random(7));
            $data = new MobileBanking() ;
            $data->transaction_id = $transaction_id;
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

        $user = auth()->user();
        $rate = null;
        $country = null;

        if ($user->location) {
        $country = Country::find($user->location);

            if ($country && $country->currency_code) {
                try {
                    // Use your API key
                    $apiKey = '55dfd34b7d585b2674304254';
                    $response = Http::get("https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$country->currency_code}");

                    if ($response->successful() && isset($response['conversion_rates']['BDT'])) {
                        $rate = $response['conversion_rates']['BDT'];
                    } else {
                        \Log::error('Rate API failed: ', $response->json());
                    }
                } catch (\Exception $e) {
                    \Log::error('Rate fetch exception: ' . $e->getMessage());
                }
            }
        }

        return view('admin.nagad', compact('country', 'rate')) ;

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

            $transaction_id =  strtoupper(Str::random(7));
            $data = new MobileBanking() ;
            $data->transaction_id = $transaction_id;
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

        $user = auth()->user();
        $rate = null;
        $country = null;

        if ($user->location) {
        $country = Country::find($user->location);

            if ($country && $country->currency_code) {
                try {
                    // Use your API key
                    $apiKey = '55dfd34b7d585b2674304254';
                    $response = Http::get("https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$country->currency_code}");

                    if ($response->successful() && isset($response['conversion_rates']['BDT'])) {
                        $rate = $response['conversion_rates']['BDT'];
                    } else {
                        \Log::error('Rate API failed: ', $response->json());
                    }
                } catch (\Exception $e) {
                    \Log::error('Rate fetch exception: ' . $e->getMessage());
                }
            }
        }

        return view('admin.upay', compact('country', 'rate')) ;

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

            $transaction_id =  strtoupper(Str::random(7));
            $data = new MobileBanking() ;
            $data->transaction_id = $transaction_id;
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

        $user = auth()->user();
        $rate = null;
        $country = null;

        if ($user->location) {
        $country = Country::find($user->location);

            if ($country && $country->currency_code) {
                try {
                    // Use your API key
                    $apiKey = '55dfd34b7d585b2674304254';
                    $response = Http::get("https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$country->currency_code}");

                    if ($response->successful() && isset($response['conversion_rates']['BDT'])) {
                        $rate = $response['conversion_rates']['BDT'];
                    } else {
                        \Log::error('Rate API failed: ', $response->json());
                    }
                } catch (\Exception $e) {
                    \Log::error('Rate fetch exception: ' . $e->getMessage());
                }
            }
        }

        return view('admin.rocket', compact('country', 'rate')) ;

    }



}
