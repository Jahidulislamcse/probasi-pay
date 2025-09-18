<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Commition;
use App\Models\Country;
use App\Models\Topup;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TopupController extends Controller
{
    //


    public function topup_list(Request $request)
    {

        $lists = Topup::orderBy('id', 'desc')->get();

        return view('admin.topup_list', compact('lists'));
    }
    public function topup_approve($id)
    {


        $data = Topup::find($id);
        $data->status = 1;
        if ($data->save()) {
            $user = User::find($data->user_id);
            $user->balance = $user->balance + $data->amount + $data->commision;
            $user->commision = $user->commision + $data->commision;
            $user->save();
            return back()->with(['response' => true, 'msg' => 'Topup Approved!']);
        }

        return back()->with(['response' => false, 'msg' => 'Topup Not Approved!']);
    }
    public function topup_reject($id)
    {


        $data = Topup::find($id);
        $data->status = 2;
        if ($data->save()) {

            return back()->with(['response' => true, 'msg' => 'Topup Rejected!']);
        }

        return back()->with(['response' => false, 'msg' => 'Topup Not Rejected!']);
    }
    public function topup_delete($id)
    {


        $data = Topup::find($id);
        if ($data->delete()) {
            return redirect(back())->with(['response' => true, 'msg' => 'Topup Deleted!']);
        }

        return redirect(back())->with(['response' => false, 'msg' => 'Topup Not Deleted!']);
    }



    public function bank_topup(Request $request)
    {
        // dd(($request->all()));
        if ($request->post()) {
            $request->validate([
                'type'       => ['required', 'string'],
                'amount'     => ['required', 'numeric', 'min:0'],
                'account_id' => ['required', 'integer', 'exists:accounts,id'],
                'account'    => ['nullable', 'string'],
                'file'       => ['nullable', 'file', 'max:2048'],
            ]);

            $transaction_id =  strtoupper(Str::random(7));
            $commision = Commition::where('type', $request->type)->first();

            if ($commision) {
                $commision_amount = ($commision->percentage / 100) * $request->amount;
            } else {
                $commision_amount = 0;
            }

            $data = new Topup();
            $data->transaction_id = $transaction_id;
            $data->type = $request->type;

            if ($request->hasFile('file')) {
                $data->file = imageUpload($request->file);
            }
            $data->amount = $request->amount;
            $data->commision = $commision_amount;
            $data->gateway_id = $request->account_id;
            $data->account = $request->account;
            $data->status = 0;
            $data->user_id = auth()->user()->id;
            if ($data->save()) {
                return redirect(route('admin.index'))->with(['response' => true, 'msg' => 'Topup Request Success!Please wait for approval!']);
            }
        }

        $user = auth()->user();
        $lists = Topup::with('gateway')
            ->where('user_id', $user->id)
            ->where(function ($q) {
                $q->whereNotNull('file')
                    ->orWhereNull('mobile');
            })
            ->orderBy('id', 'desc')
            ->get();
        $rate = null;
        $country = null;
        $accounts = Account::where('type', 'Bank')->get();


        if ($user->location) {
            $country = \App\Models\Country::find($user->location);

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

        return view('admin.bank_topup', compact('accounts', 'country', 'rate', 'lists'));
    }


    public function topup(Request $request)
    {
        // dd(($request->all()));

        if ($request->post()) {

            $request->validate([
                'type'       => ['required', 'string'],
                'amount'     => ['required', 'numeric', 'min:0'],
                'account_id' => ['required', 'integer', 'exists:accounts,id'],
                'pin'        => ['required', 'string'],
                'file'       => ['nullable', 'file', 'max:2048'],
            ]);

            $transaction_id =  strtoupper(Str::random(7));
            $commision = Commition::where('type', $request->type)->first();

            if ($commision) {
                $commision_amount = ($commision->percentage / 100) * $request->amount;
            } else {
                $commision_amount = 0;
            }

            $data = new Topup();
            $data->transaction_id = $transaction_id;
            $data->type = $request->type;
            $data->amount = $request->amount;
            $data->commision = $commision_amount;
            $data->account = $request->account;
            $data->status = 0;
            $data->gateway_id = $request->account_id;
            $data->mobile = $request->pin;
            $data->user_id = auth()->user()->id;

            if ($request->hasFile('file')) {
                $data->file = imageUpload($request->file);
            }

            if ($data->save()) {
                return redirect(route('admin.index'))->with(['response' => true, 'msg' => 'Topup Request Success!']);
            }
        }

        $accounts = Account::where('type', 'Mobile Banking')->get();
        $user = auth()->user();
        $lists = Topup::with('gateway')
            ->where('user_id', $user->id)
            ->where(function ($q) {
                $q->whereNotNull('mobile');
            })
            ->orderBy('id', 'desc')
            ->get();
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

        return view('admin.topup', compact('country', 'rate', 'accounts', 'lists'));
    }
}
