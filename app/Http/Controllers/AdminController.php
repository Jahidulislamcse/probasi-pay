<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announc;
use App\Models\MasjidAccount;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;


class AdminController extends Controller
{
public function index()
{
        $title = 'Welcome to Dashboard';
        $user = auth()->user();
        $rate = null;
        $country = null;

        if ($user->location) {
            $country = \App\Models\Country::find($user->location);

            if ($country && $country->currency_code) {
                try {
                    // Use your API key
                    $apiKey = '59ba09ebee6097d71246aa9f';
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

    if ($user->role == 'super admin') {
        return view('admin.adminDashboard', compact('title', 'country', 'rate'));
    } else {
        return view('admin.dashboard', compact('title', 'country', 'rate'));
    }
}

    public function addbalance(Request $request,$id){

         if($request->post()){

                $user = User::find($id);

                $user->balance = $user->balance + $request->amount;

                if ($user->save()) {
                return redirect()->back()->with(['response' => true, 'msg' => 'User Balance Add Successful']);
            } else {
                return redirect()->back()->with(['response' => false, 'msg' => 'User Balance Add Fail!']);
            }
         }



         $title = "Add balance";
         $user = User::find($id);
        return view('admin.user.add_balance', compact(['title','user']));
    }

    public function support()
    {
        $title = "Live Support";
        return view('admin.support', compact(['title']));
    }

    public function helpline()
    {
        $title = "Helpline";
        return view('admin.helpline', compact(['title']));
    }

    public function rate()
    {
        $title = "Rate Calculation";
        return view('admin.rate', compact(['title']));
    }

    public function news()
    {
        $title = "News";
        return view('admin.news', compact(['title']));
    }

    public function tutorials()
    {
        $title = "Tutorials";
        return view('admin.tutorials', compact(['title']));
    }

    public function about()
    {
        $title = "Abouts us";
        return view('admin.about', compact(['title']));
    }


    public function users()
    {
        $title = 'User List';
        $lists = User::all();
        return view('admin.user.index', compact(['title', 'lists']));
    }

    public function announce()
    {
        $title = 'User List';
        $list = Announc::all();
        return view('admin.partner.announce', compact(['title', 'list']));
    }
   public function pendingChat()
    {
        $title = 'Pending Chat';

        return view('admin.pending-chat', compact(['title']));
    }


    public function profile(Request $request)
    {

        if ($request->isMethod('post')) {


            $data = User::find(auth()->user()->id);

            $request->validate([
                'name' => 'required',
                'email' => 'nullable|unique:users,email,' . auth()->user()->id,
                'phone' => 'required|unique:users,email,' . auth()->user()->id,
                'username' => 'nullable|unique:users,username,' . auth()->user()->id,
            ]);



            $data->employee_id = $request->employee_id;
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->location = $request->location;
            $data->email = $request->email;
            $data->username = $request->username;

            if ($request->hasFile('image')) {
                $data->image =  imageUpload($request->file('image'));
            }

            if ($request->password) {
                $data->password = bcrypt($request->password);
            }


            if ($data->save()) {
                return redirect()->back()->with(['response' => true, 'msg' => 'User Create Successful']);
            } else {
                return redirect()->back()->with(['response' => false, 'msg' => 'User Create Fail!']);
            }
        }

        $data = User::find(auth()->user()->id);
        $title = 'Update Profile';
        return view('admin.user.profile', compact(['title', 'data']));
    }

    public function chat()
    {


        $title = 'Group Chat';
        return view('admin.chat', compact(['title']));
    }
    public function chatAdmin()
    {
        $title = 'Group Chat';
        return view('admin.chat', compact(['title']));
    }

    public function userstatus($id)
    {
        $user = User::find($id);
        if ($user->status == 1) {
            $user->status = 0;
        } else {
            $user->status = 1;
        }
        $user->save();
        return redirect()->back()->with(['response' => true, 'msg' => 'User Status update Successful!']);
    }

    public function userdelete($id)
    {
        $user = User::find($id);
        if ( $user->delete()) {
            return redirect()->back()->with(['response' => true, 'msg' => 'User delete Successful!']);
        } else {
            return redirect()->back()->with(['response' => false, 'msg' => 'User delete Fail!']);
        }

    }


}
