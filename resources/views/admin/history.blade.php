 @extends('admin.layout.master')
 @section('meta')
 @endsection
 @section('style')
 
 
<style>
        .history-card{
            background: #ffd3ad;
            border-radius: 10px;
            margin: 10px;
            padding: 20px;
            position: relative;
        }
        .type{
            font-size: 20px;color: #ff3130;
        }
         .amount{
            font-size: 18px;color: #ff3130;
        }
    .receipt{
        
        background: #ff3130;
        padding: 10px 25px;
        position: absolute;
        top: 19px;
        right: 16px;
        border-radius: 5px;
        color: #fff;

    }
    
    .status{
            background: #ff3130;
    padding: 10px 30px;
    line-height: 5;
    border-radius: 5px;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #ffffff;
    background-color: #ff3432;
    border-color: #ff3432;
}
    .nav-link{
        color:#5b4a3b;
    }
    p{
            color: #5b4a3b;
    }
</style>
 
 
 @endsection
 @section('main')
     <!-- preloade -->
     <div class="preload preload-container">
         <div class="preload-logo">
             <div class="spinner"></div>
         </div>
     </div>
     <!-- /preload -->
     <div class="header">
         <div  style="background:#ff3432; color:white;" class="tf-container">
             <div class="tf-statusbar d-flex justify-content-center align-items-center">
                <a href="{{ route('admin.index') }}" class="back-btn"> <i class="icon-left"></i> </a>
                 <h3 style="color:white;">কাস্টমার লেনদেন বিবরণ</h3>
             </div>
         </div>
     </div>
     <div class="mt-1 box-settings-profile style1">
         <div>



             <div class="panel-heading">
                 <div class="panel-body">


                     <div class="box-body">
                         
                         <nav>
                      <div class="nav nav-tabs" id="nav-tab" role="tablist" style="
    background: #ffd3ad;
    padding: 10px;
        border-radius: 7px;
">
                        <button style="width:50%;" class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">লেনদেন</button>
                        <button style="width:50%; color:#591616;" class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">ডিপোজিট </button>
                      </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                          
                          
                                        @foreach(App\Models\MobileRecharge::where('user_id',auth()->user()->id)->get() as $list)
                                        <div class="history-card">
                                            <p class="type">মোবাইল রিচার্জ</p>
                                            <p class="amount">{{ currency(@$list->amount) }} টাকা</p>
                                               <p>{{ @$list->created_at }} </p>
                                               <p>{{ hiddnum(@$list->mobile) }} </p>
                                            <span style="color:white;" class="status">{{ $list->status != 0 ?  $list->status == 1 ? 'সফল'  : 'বাতিল': 'অপেক্ষমান' }}</span>
                                            <a @if($list->status == 1) href="{{ route('success',[$list->id,'recharge']) }}" @else href="#" @endif class="receipt">রিসিট</a>
                                        </div>
                                        @endforeach
                                        
                                          @foreach(App\Models\MobileBanking::where('user_id',auth()->user()->id)->get() as $list)
                                        <div class="history-card">
                                            <p class="type">মোবাইল ব্যাংকিং</p>
                                            <p class="amount">{{ currency(@$list->amount) }} টাকা</p>
                                              <p>{{ @$list->created_at }} </p>
                                              <p>{{ hiddnum(@$list->mobile) }} </p>
                                            <span class="status">{{ $list->status != 0 ?  $list->status == 1 ? 'সফল'  : 'বাতিল': 'অপেক্ষমান' }}</span>
                                            <a @if($list->status == 1) href="{{ route('success',[$list->id,'mobilebanking']) }}" @else href="#" @endif class="receipt">রিসিট</a>
                                        </div>
                                        @endforeach
                                        
                                             @foreach(App\Models\BillPay::where('user_id',auth()->user()->id)->get() as $list)
                                        <div class="history-card">
                                            <p class="type">বিল পে</p>
                                            <p class="amount">{{ currency(@$list->amount) }} টাকা</p>
                                               <p>{{ @$list->created_at }} </p>
                                               <p>{{ hiddnum(@$list->mobile) }} </p>
                                            <span class="status">{{ $list->status != 0 ?  $list->status == 1 ? 'সফল'  : 'বাতিল': 'অপেক্ষমান' }}</span>
                                            <a @if($list->status == 1) href="{{ route('success',[$list->id,'billpay']) }}" @else href="#" @endif class="receipt">রিসিট</a>
                                        </div>
                                        @endforeach
                                          @foreach(App\Models\BankPay::where('user_id',auth()->user()->id)->get() as $list)
                                        <div class="history-card">
                                            <p class="type">ব্যাংক পে</p>
                                            <p class="amount">{{ currency(@$list->amount) }} টাকা</p>
                                              <p>{{ @$list->created_at }} </p>
                                              <p>{{ hiddnum(@$list->mobile) }} </p>
                                            <span class="status">{{ $list->status != 0 ?  $list->status == 1 ? 'সফল'  : 'বাতিল': 'অপেক্ষমান' }}</span>
                                            
                                            <a @if($list->status == 1) href="{{ route('success',[$list->id,'bankpay']) }}" @else href="#" @endif class="receipt">রিসিট</a>
                                        </div>
                                        @endforeach
                          
                          
                      </div>
                      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                          
                           @foreach(App\Models\Topup::where('user_id',auth()->user()->id)->get() as $list)
                                        <div class="history-card">
                                            <p class="type">{{ @$list->type === "Mobile pay" ? 'মোবাইল ব্যাংকিং' : 'ব্যাংক জমা'  }}</p>
                                            <p class="amount">{{ currency(@$list->amount) }} টাকা</p>
                                            <p>{{ @$list->created_at }} </p>
                                            <span class="status">{{ $list->status != 0 ?  $list->status == 1 ? 'সফল'  : 'বাতিল': 'অপেক্ষমান' }}</span>
                                        </div>
                                        @endforeach
                          
                          
                      </div>
                 
                    </div>


                       </div>
                 </div>
             </div>


         </div>
     </div>
 @endsection


 @section('script')
 @endsection
