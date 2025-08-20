<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankPayController;
use App\Http\Controllers\BillPayController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MobileBankingController;
use App\Http\Controllers\MobileRechargeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TopupController;
use App\Http\Middleware\Otp;
use App\Models\BankPay;
use App\Models\BillPay;
use App\Models\MobileBanking;
use App\Models\MobileRecharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::match(['get', 'post'], 'upload-image', function (Request $request) {
    if ($request->hasFile('upload')) {

        $fileName = imageUpload($request->file('upload'));


        $url = asset($fileName);

        return response()->json(['fileNmae' => $fileName, 'uploaded' => 1, 'url' => $url]);
    }

    return response()->json(['error' => 'File upload failed'], 400);
})->name('upload.image');


Route::get('otp', [HomeController::class, 'otp'])->name('otp');
Route::get('otp/{phone}/', [HomeController::class, 'otp'])->name('forget.otp');
Route::get('send/otp', [HomeController::class, 'sendotp'])->name('send.otp');
Route::post('otp/varify', [HomeController::class, 'otpvarify'])->name('otp.varify');
Route::post('password/forget', [HomeController::class, 'forget_password'])->name('password.phone');
Route::get('password/reset/{otp}/{phone}', [HomeController::class, 'reset_password'])->name('reset.password');
Route::post('password/reset', [HomeController::class, 'reset_password'])->name('reset.password.update');
Route::middleware('auth')->get('/get-notification', [NotificationController::class, 'getNotification']);
Route::middleware('auth')->get('/get-random-notification', [NotificationController::class, 'getRandomNotification']);
Route::middleware('auth')->get('/alert', [NotificationController::class, 'alert'])->name('alert');
Route::match(['get', 'post'],'get-data', [HomeController::class, 'getData'])->name('register.data');
Route::match(['get', 'post'],'get-image', [HomeController::class, 'getImage'])->name('register.image');
Route::match(['get', 'post'],'get-final', [HomeController::class, 'getFinal'])->name('register.final');
Route::match(['get', 'post'],'user-agree', [HomeController::class, 'agree'])->name('register.agree');

Route::get('review/upload', [ReviewController::class, 'create'])->name('review.upload');
Route::get('reviews/view', [ReviewController::class, 'index'])->name('reviews.view');
Route::post('review/store', [ReviewController::class, 'store'])->name('reviews.store');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');



Route::group(['middleware' => ['auth']], function () {

        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('history', [HomeController::class, 'history'])->name('history');

        Route::get('notification', [NotificationController::class, 'index'])->name('notifications.index')->middleware('admin');
        Route::get('notification/create', [NotificationController::class, 'create'])->name('notifications.create')->middleware('admin');
        Route::post('notification/store', [NotificationController::class, 'store'])->name('notifications.store')->middleware('admin');
        Route::get('notification/{notification}/edit', [NotificationController::class, 'edit'])->name('notifications.edit')->middleware('admin');
        Route::post('notification/{notification}/update', [NotificationController::class, 'update'])->name('notifications.update')->middleware('admin');
        Route::get('notification/{id}/delete', [NotificationController::class, 'delete'])->name('notifications.delete')->middleware('admin');

        Route::group(['controller' => AdminController::class], function () {

            Route::match(['get', 'post'], 'announce', 'announce')->name('announce');
            Route::match(['get', 'post'], 'users', 'users')->name('user.list');
            Route::match(['get', 'post'], 'user-profile', 'profile')->name('profile');
            Route::match(['get', 'post'], 'chat', 'chat')->name('chat');
            Route::match(['get', 'post'], 'chat-admin', 'chatAdmin')->name('chat.admin');
            Route::match(['get', 'post'], 'pending-chat', 'pendingChat')->name('pending-chat');
            Route::match(['get', 'post'], 'support', 'support')->name('support');
            Route::match(['get', 'post'], 'helpline', 'helpline')->name('helpline');
            Route::match(['get', 'post'], 'rate', 'rate')->name('rate');
            Route::match(['get', 'post'], 'news', 'news')->name('news');
            Route::match(['get', 'post'], 'tutorials', 'tutorials')->name('tutorials');
            Route::match(['get', 'post'], 'about', 'about')->name('about');
            Route::match(['get', 'post'], 'user-create', 'create')->name('user.new');
            Route::match(['get', 'post'], 'user-edit/{id}', 'create')->name('user.edit');
            Route::match(['get', 'post'], 'user-masjid', 'masjid')->name('user.masjid');
            Route::match(['get', 'post'], 'user-masjid/{id}', 'masjid')->name('user.masjid.edit');
            Route::match(['get'], 'user-status/{id}', 'userstatus')->name('user.status');
            Route::match(['get'], 'user-delete/{id}', 'userdelete')->name('user.delete');
            Route::match(['get', 'post'],'user-add-balance/{id}', 'addbalance')->name('user.addbalance')->middleware('admin');
        });

        Route::group(['controller' => TopupController::class], function () {

            Route::match(['get', 'post'], 'topup-list', 'topup_list')->name('topup.list')->middleware('admin');
            Route::match(['get', 'post'], 'topup-approve/{id}', 'topup_approve')->name('topup.approve')->middleware('admin');
            Route::match(['get', 'post'], 'topup-reject/{id}', 'topup_reject')->name('topup.reject')->middleware('admin');
            Route::match(['get', 'post'], 'topup-delete/{id}', 'topup_delete')->name('topup.delete')->middleware('admin');
            Route::match(['get', 'post'], 'user/topup', 'topup')->name('topup');
            Route::match(['get', 'post'], 'bank/topup', 'bank_topup')->name('bank.topup');

        });

        Route::group(['controller' => MobileRechargeController::class], function () {

            Route::match(['get', 'post'], 'recharge-list', 'list')->name('recharge.list')->middleware('admin');
            Route::match(['get', 'post'], 'recharge-approve/{id}', 'approve')->name('recharge.approve')->middleware('admin');
            Route::match(['get', 'post'], 'recharge-reject/{id}', 'reject')->name('recharge.reject')->middleware('admin');
            Route::match(['get', 'post'], 'recharge-delete/{id}', 'delete')->name('recharge.delete')->middleware('admin');
            Route::match(['get', 'post'], 'user/recharge', 'recharge')->name('recharge');

        });

        Route::group(['controller' => BillPayController::class], function () {

            Route::match(['get', 'post'], 'billpay-list', 'list')->name('billpay.list')->middleware('admin');
            Route::match(['get', 'post'], 'billpay-approve/{id}', 'approve')->name('billpay.approve')->middleware('admin');
            Route::match(['get', 'post'], 'billpay-reject/{id}', 'reject')->name('billpay.reject')->middleware('admin');
            Route::match(['get', 'post'], 'billpay-delete/{id}', 'delete')->name('billpay.delete')->middleware('admin');
            Route::match(['get', 'post'], 'user/billpay', 'billpay')->name('billpay');

        });

        Route::group(['controller' => BankPayController::class], function () {

            Route::match(['get', 'post'], 'bankpay-list', 'list')->name('bankpay.list')->middleware('admin');
            Route::match(['get', 'post'], 'bankpay-approve/{id}', 'approve')->name('bankpay.approve')->middleware('admin');
            Route::match(['get', 'post'], 'bankpay-reject/{id}', 'reject')->name('bankpay.reject')->middleware('admin');
            Route::match(['get', 'post'], 'bankpay-delete/{id}', 'delete')->name('bankpay.delete')->middleware('admin');
            Route::match(['get', 'post'], 'user/bankpay', 'bankpay')->name('bankpay');

        });

        Route::group(['controller' => MobileBankingController::class], function () {

            Route::match(['get', 'post'], 'user/bkash', 'bkash')->name('bkash');
            Route::match(['get', 'post'], 'user/nagad', 'nagad')->name('nagad');
            Route::match(['get', 'post'], 'user/upay', 'upay')->name('upay');
            Route::match(['get', 'post'], 'user/rocket', 'rocket')->name('rocket');

            Route::match(['get', 'post'], 'bkash-list', 'bkash_list')->name('bkash.list')->middleware('admin');
            Route::match(['get', 'post'], 'nagad-list', 'nagad_list')->name('nagad.list')->middleware('admin');
            Route::match(['get', 'post'], 'upay-list', 'upay_list')->name('upay.list')->middleware('admin');
            Route::match(['get', 'post'], 'rocket-list', 'rocket_list')->name('rocket.list')->middleware('admin');
            Route::match(['get', 'post'], 'mobilebanking-approve/{id}', 'approve')->name('mobilebankinglist.approve')->middleware('admin');
            Route::match(['get', 'post'], 'mobilebanking-reject/{id}', 'reject')->name('mobilebankinglist.reject')->middleware('admin');
            Route::match(['get', 'post'], 'mobilebanking-delete/{id}', 'delete')->name('mobilebankinglist.delete')->middleware('admin');

        });

        Route::group(['controller' => CommonController::class], function () {

            Route::match(['get', 'post'], 'success/{id}/{page}', 'success')->name('success');
            Route::match(['get', 'post'], 'page', 'page')->name('page');
            Route::match(['get', 'post'], 'page/{id}/edit', 'page')->name('page.edit');
            Route::match(['get', 'post'], 'page/{id}/delete', 'pagedelete')->name('page.delete');

        });

        Route::group(['controller' => SettingController::class], function () {
            Route::match(['get', 'post'], 'setting/general', 'general')->name('setting.general')->middleware('admin');

            Route::match(['get', 'post'], 'mobilebanking', 'mobilebanking')->name('mobilebanking')->middleware('admin');
            Route::match(['get', 'post'], 'mobilebanking/{id}/edit', 'mobilebanking')->name('mobilebanking.edit')->middleware('admin');
            Route::match(['get', 'post'], 'mobilebanking/{id}/delete', 'mobilebankingdelete')->name('mobilebanking.delete')->middleware('admin');

            Route::match(['get', 'post'], 'bank', 'bank')->name('bank')->middleware('admin');
            Route::match(['get', 'post'], 'bank/{id}/edit', 'bank')->name('bank.edit')->middleware('admin');
            Route::match(['get', 'post'], 'bank/{id}/delete', 'bankedelete')->name('bank.delete')->middleware('admin');

            Route::match(['get', 'post'], 'country', 'country')->name('country')->middleware('admin');
            Route::match(['get', 'post'], 'country/{id}/edit', 'country')->name('country.edit')->middleware('admin');
            Route::match(['get', 'post'], 'country/{id}/delete', 'countrydelete')->name('country.delete')->middleware('admin');

            Route::match(['get', 'post'], 'slider', 'slider')->name('slider')->middleware('admin');
            Route::match(['get', 'post'], 'slider/{id}/edit', 'slider')->name('slider.edit')->middleware('admin');
            Route::match(['get', 'post'], 'slider/{id}/delete', 'sliderdelete')->name('slider.delete')->middleware('admin');

        });

});
