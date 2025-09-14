 @extends('admin.layout.master')
 @section('meta')
 @endsection
 @section('style')
 <style>
     .image-radio-group {
         display: inline-flex;
         flex-wrap: nowrap;
         gap: 4px;
         margin-bottom: 20px;
     }

     .image-radio {
         position: relative;

         width: 65px;
         height: 80px;
         background: #ffffff;
         border-radius: 5px;

     }

     .image-radio input[type="radio"] {
         display: none;
     }

     .image-radio img {
         width: 60px;
         height: 60px;
         object-fit: cover;
         border: 2px solid transparent;
         border-radius: 8px;
         cursor: pointer;
         transition: border 0.3s;
         padding: 5px;
         margin: 0 auto;
         display: block;
     }

     .image-radio input[type="radio"]:checked+img {
         border: 2px solid #ccc;
         background: #ccc;
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
                     <label class="image-radio">
                         <input type="radio" name="operator" checked value="জিপি">
                         <img src="/images/gp.png" alt="Image 1">
                         <p class="text-center" style="color: #000;">জিপি</p>
                     </label>
                     <label class="image-radio">
                         <input type="radio" name="operator" value="বাংলালিংক">
                         <img src="/images/bl.svg.png" alt="Image 2">
                         <p class="text-center" style="color: #000;">বাংলালিংক</p>
                     </label>
                     <label class="image-radio">
                         <input type="radio" name="operator" value="রবি">
                         <img src="/images/robi.png" alt="Image 3">
                         <p class="text-center" style="color: #000;">রবি</p>
                     </label>
                     <label class="image-radio">
                         <input type="radio" name="operator" value="এয়ারটেল">
                         <img src="/images/ar.png" alt="Image 4">
                         <p class="text-center" style="color: #000;">এয়ারটেল</p>
                     </label>
                     <label class="image-radio">
                         <input type="radio" name="operator" value="টেলিটক">
                         <img src="https://play-lh.googleusercontent.com/e99h2XlCDarz1Z7iKUy5f34w8iqcqHcCRguQEBWCQPC0Fpxqs4k3S9XZLurzv5C5aA" alt="Image 4">
                         <p class="text-center" style="color: #000;">টেলিটক</p>
                     </label>
                 </div>

                 <div class="wrap-sl-country">
                     <select name="type" class="box-sl-profile form-select" required>
                         <option value="">আপনার সিমের ধরন</option>
                         <option value="PRE PAID">প্রি পেইড</option>
                         <option value="POST PAID">পোস্ট পেইড</option>

                     </select>
                 </div>
                 <div class="tf-form">
                     <div class="group-input input-field input-money">
                         <label for="">টাকার পরিমাণ</label>
                         <input name="amount" type="number" max="{{ auth()->user()->balance }}" value="200"
                             required class="search-field value_input st1" type="text">
                         <span class="icon-clear"></span>
                     </div>
                 </div>

                 <div class="tf-form">
                     <div class="group-input input-field input-money">
                         <label for="">মোবাইল</label>
                         <input name="mobile" minlength="11" maxlength="11" type="number" placeholder="0170000000"
                             required type="text">
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
             <h3 class="text-center" style="    margin-top: 30px;">ব্যবহারযোগ্য ব্যালেন্স: {{ currency(auth()->user()->balance) }} টাকা</h3>
         </div>

         @php $content = App\Models\Section::where('key','mobile recharge')->first(); @endphp
         <div style="padding:20px">
             {!! @$content->value !!}
         </div>

         <div class="bottom-navigation-bar">
             <div class="tf-container">
                 <button type="submit" name="submit" class="tf-btn accent large">অ্যাড করুন</button>

             </div>
         </div>
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
