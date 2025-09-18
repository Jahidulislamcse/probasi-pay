 @extends('admin.layout.master')
 @section('meta')
 @endsection
 @section('style')
 <style>
     .image-radio-group {
         display: flex;
         justify-content: space-between;
         align-items: center;
         flex-wrap: wrap;
         margin-bottom: 20px;
     }

     .image-radio {
         display: flex;
         align-items: center;
         margin: 5px;
         cursor: pointer;
     }

     .image-radio input[type="radio"] {
         margin-right: 10px;
         width: 20px;
         height: 20px;
     }

     .radio-btn {
         display: inline-block;
         width: 15px;
         height: 15px;
         border-radius: 50%;
         background-color: #fff;
         border: 2px solid #787878ff;
         margin-right: 10px;
     }

     .image-radio img {
         width: 15px;
         height: 15px;
         border-radius: 50%;
         object-fit: cover;
     }

     .image-radio p {
         font-size: 14px;
         margin: 0;
     }

     input[type="radio"]:checked+.radio-btn {
         background-color: #067fab;
         border-color: #6e6e6eff;
     }

     input[type="radio"]:checked+.radio-btn+img+p {
         color: #4CAF50;
     }
    @php
        $colors = \App\Models\ColorSetting::first();
    @endphp
    .app-header {
        background-color: {{ $colors->header_color ?? '#067fab' }};
    }
    body {
        background-color: {{ $colors->body_color ?? '#067fab' }};
    }
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'SolaimanLipi', 'Noto Sans Bengali', sans-serif !important;
        font-weight: 400;
        color: {{ $colors->headings_color ?? '#ffffff' }};
    }
    label {
      color: {{ $colors->label_color ?? '#ffffff' }};   
    }


 </style>

 @endsection
 @section('main')

 <div class="app-header st1">
     <div class="tf-container">
         <div class="tf-topbar d-flex justify-content-center align-items-center">
             <a href="{{ route('admin.index') }}" class="back-btn"><i class="icon-left white_color"></i></a>
             <h3 class="white_color mt-2">মোবাইল রিচার্জ</h3>
         </div>
     </div>
 </div>
 <div class="card-secton topup-content mt-1">
     @php $country = country(); @endphp
     <form class="tf-form" method="post">
         @csrf
         <div class="tf-container">
             <div class="tf-balance-box">
                 <div class="d-flex justify-content-between align-items-center"></div>
                 <div class="image-radio-group">
                     <!-- GP Radio Button -->
                     <label class="image-radio">
                         <input type="radio" name="operator" checked value="জিপি">
                         <span class="radio-btn"></span>
                         <img src="/images/gp.png" alt="Image 1">
                         <p class="text-center">জিপি</p>
                     </label>

                     <!-- Robi Radio Button -->
                     <label class="image-radio">
                         <input type="radio" name="operator" value="রবি">
                         <span class="radio-btn"></span>
                         <img src="/images/robi.png" alt="Image 3">
                         <p class="text-center">রবি</p>
                     </label>
                     <!-- Airtel Radio Button -->
                     <label class="image-radio">
                         <input type="radio" name="operator" value="এয়ারটেল">
                         <span class="radio-btn"></span>
                         <img src="/images/ar.png" alt="Image 4">
                         <p class="text-center">এয়ারটেল</p>
                     </label>
                     <!-- Teletalk Radio Button -->
                     <label class="image-radio">
                         <input type="radio" name="operator" value="টেলিটক">
                         <span class="radio-btn"></span>
                         <img src="/images/teletalk.png" alt="Image 4">
                         <p class="text-center">টেলিটক</p>
                     </label>

                     <!-- Banglalink Radio Button -->
                     <label class="image-radio">
                         <input type="radio" name="operator" value="বাংলালিংক">
                         <span class="radio-btn"></span>
                         <img src="/images/bl.svg.png" alt="Image 2">
                         <p class="text-center">বাংলালিংক</p>
                     </label>
                 </div>

                 <!-- SIM Type Selection -->
                 <div class="wrap-sl-country">
                     <select name="type" class="box-sl-profile form-select" required>
                         <option value="">আপনার সিমের ধরন</option>
                         <option value="PRE PAID">প্রি পেইড</option>
                         <option value="POST PAID">পোস্ট পেইড</option>
                     </select>
                 </div>

                 <!-- Amount Input -->
                 <div class="tf-form">
                     <div class="group-input input-field input-money">
                         <label for="">টাকার পরিমাণ</label>
                         <input name="amount" type="number" max="{{ auth()->user()->balance }}" value="200" required class="search-field value_input st1">
                         <span class="icon-clear"></span>
                     </div>
                 </div>

                 <!-- Mobile Number Input -->
                 <div class="tf-form">
                     <div class="group-input input-field input-money">
                         <label for="">মোবাইল</label>
                         <input name="mobile" minlength="11" maxlength="11" type="number" placeholder="0170000000" required>
                         <span class="icon-clear"></span>
                     </div>
                 </div>

                 <div class="tf-form">
                     <div class="form-group input-field input-money">
                         <label for="">পিন</label>
                         <input name="pin" type="text" placeholder="123456" required>
                         <span class="icon-clear"></span>
                     </div>
                 </div>
             </div>

             <h3 class="text-center" style="margin-top: 30px;">ব্যবহারযোগ্য ব্যালেন্স: {{ currency(auth()->user()->balance) }} টাকা</h3>
         </div>

         @php $content = App\Models\Section::where('key', 'mobile recharge')->first(); @endphp
         <div style="padding:20px">
             {!! @$content->value !!}
         </div>

         <button type="submit" name="submit" class="tf-btn accent large">অ্যাড করুন</button>
     </form>
 </div>



 <div class="tf-panel up">
     <div class="panel_overlay"></div>
     <div class="panel-box panel-up wrap-content-panel">
         <div class="heading">
             <div class="tf-container">
                 <div class="d-flex align-items-center position-relative justify-content-center">
                     <i class="icon-close1 clear-panel"></i>
                     <h3>Confirm Top Up</h3>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endsection


 @section('script')
 @endsection