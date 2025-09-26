<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announc;
use App\Models\BankPay;
use App\Models\Banner;
use App\Models\BlockedUser;
use App\Models\ColorSetting;
use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\MasjidAccount;
use App\Models\MobileBanking;
use App\Models\MobileRecharge;
use DataTables;
use App\Models\Order;
use App\Models\Topup;
use Illuminate\Support\Facades\Hash;
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
        $banners = Banner::all();
        $generalSettings = GeneralSetting::first();
        $colors = ColorSetting::first();

        if ($user->is_blocked == 1) {
            return redirect()->route('blocked');
        }

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

        if ($user->role == 'super admin') {
            return view('admin.adminDashboard', compact('title', 'country', 'rate', 'generalSettings', 'colors'));
        } else {
            return view('admin.dashboard', compact('title', 'country', 'rate', 'banners', 'generalSettings', 'colors'));
        }
    }

    public function addbalance(Request $request, $id)
    {

        if ($request->post()) {

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
        return view('admin.user.add_balance', compact(['title', 'user']));
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

    
    public function cash_pickup()
    {
        $title = "Cash Pickup";
        return view('admin.cash_pickup', compact(['title']));
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
        $lists = User::paginate(10); 
        return view('admin.user.index', compact('title', 'lists'));
    }


    public function userInfo(Request $request, User $user)
    {
        $title = 'User Details';
        $activeTab = $request->get('tab', 'profile');

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

        return view('admin.user.show', compact(
            'title',
            'user',
            'activeTab',
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
                'phone' => 'required|unique:users,phone,' . auth()->user()->id,
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

        $data  = User::find(auth()->id());
        $title = 'Update Profile';

        $query = Topup::with('gateway')->where('user_id', auth()->id());

        if ($q = trim($request->get('q', ''))) {
            $query->where(function ($s) use ($q) {
                $s->where('transaction_id', 'like', "%{$q}%")
                    ->orWhere('amount', 'like', "%{$q}%")
                    ->orWhere('type', 'like', "%{$q}%")
                    ->orWhere('mobile', 'like', "%{$q}%")
                    ->orWhere('account', 'like', "%{$q}%")
                    ->orWhereHas('gateway', function ($g) use ($q) {
                        $g->where('name', 'like', "%{$q}%");
                    });
            });
        }

        $topups = $query->latest()->paginate(10, ['*'], 'deposit_page');

        $queryMB = MobileBanking::where('user_id', auth()->id());
        if ($qmb = trim($request->get('q_mb', ''))) {
            $queryMB->where(function ($s) use ($qmb) {
                $s->where('transaction_id', 'like', "%{$qmb}%")
                    ->orWhere('amount', 'like', "%{$qmb}%")
                    ->orWhere('type', 'like', "%{$qmb}%")
                    ->orWhere('operator', 'like', "%{$qmb}%")
                    ->orWhere('mobile', 'like', "%{$qmb}%");
            });
        }

        $mobileWithdraws = $queryMB->latest()->paginate(10, ['*'], 'mobile_withdraw_page');

        $queryBP = BankPay::where('user_id', auth()->id());
        if ($qbp = trim($request->get('q_bank', ''))) {
            $queryBP->where(function ($s) use ($qbp) {
                $s->where('transaction_id', 'like', "%{$qbp}%")
                    ->orWhere('amount', 'like', "%{$qbp}%")
                    ->orWhere('type', 'like', "%{$qbp}%")
                    ->orWhere('operator', 'like', "%{$qbp}%")
                    ->orWhere('mobile', 'like', "%{$qbp}%")
                    ->orWhere('number', 'like', "%{$qbp}%")
                    ->orWhere('branch', 'like', "%{$qbp}%")
                    ->orWhere('achold', 'like', "%{$qbp}%");
            });
        }

        $bankPays = $queryBP->latest()->paginate(5, ['*'], 'bank_withdraw_page');

        $queryMR = MobileRecharge::where('user_id', auth()->id());
        if ($qrc = trim($request->get('q_rc', ''))) {
            $queryMR->where(function ($s) use ($qrc) {
                $s->where('operator', 'like', "%{$qrc}%")
                    ->orWhere('type', 'like', "%{$qrc}%")
                    ->orWhere('mobile', 'like', "%{$qrc}%")
                    ->orWhere('amount', 'like', "%{$qrc}%");
            });
        }

        $mobileRecharges = $queryMR->latest()->paginate(10, ['*'], 'recharge_page');

        $showDeposit        = $request->get('show') === 'deposit';
        $showMobileWithdraw = $request->get('show') === 'mobile_withdraw';
        $showBankWithdraw   = $request->get('show') === 'bank_withdraw';
        $showRecharge = $request->get('show') === 'recharge';

        return view('admin.user.profile', compact(
            'title',
            'data',
            'topups',
            'mobileWithdraws',
            'bankPays',
            'showDeposit',
            'showMobileWithdraw',
            'showBankWithdraw',
            'mobileRecharges',
            'showRecharge'
        ));
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        $user = auth()->user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with(['response' => true, 'msg' => 'Password changed successfully.']);
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

    public function blockUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with(['response' => false, 'msg' => 'User not found!']);
        }

        if ($user->is_blocked == 0) {
            $phone = isset($user->phone) ? $user->phone : null;
            $email = isset($user->email) ? $user->email : null;

            BlockedUser::create([
                'phone' => $phone,
                'email' => $email,
            ]);
        } else {
            BlockedUser::where('phone', $user->phone)
                ->orWhere('email', $user->email)
                ->delete();
        }

        $user->is_blocked = $user->is_blocked == 0 ? 1 : 0;

        if ($user->save()) {
            $message = $user->is_blocked == 1 ? 'User Blocked Successfully' : 'User Unblocked Successfully';
            return redirect()->back()->with(['response' => true, 'msg' => $message]);
        } else {
            return redirect()->back()->with(['response' => false, 'msg' => 'Failed to update user status']);
        }
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
        if ($user->delete()) {
            return redirect()->route('user.list')->with(['response' => true, 'msg' => 'User delete Successful!']);
        } else {
            return redirect()->back()->with(['response' => false, 'msg' => 'User delete Fail!']);
        }
    }
}
