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
 <div class="preload preload-container">
     <div class="preload-logo">
         <div class="spinner"></div>
     </div>
 </div>

 <div class="app-header st1">
     <div class="tf-container">
         <div class="tf-topbar d-flex justify-content-center align-items-center">
             <a href="{{  route('admin.index')  }}" class="back-btn"><i class="icon-left white_color"></i></a>
             <h3 class="white_color">বিল পে</h3>
         </div>
     </div>
 </div>
 <div class="card-secton topup-content mt-2">
     @php $country = country(); @endphp
     <form class="tf-form" method="post">
         @csrf
         <div class="tf-container">
             <div class="tf-balance-box">
                 <div class="d-flex justify-content-between align-items-center"></div>
                 <div class="image-radio-group">
                     <label class="image-radio">
                         <input type="radio" name="operator" checked value="বিদ্যুৎ বিল">
                         <img src="{{ asset('images/electricity.png') }}" alt="Image 1">
                         <p class="text-center" style="color: #000;">বিদ্যুৎ</p>
                     </label>
                     <label class="image-radio">
                         <input type="radio" name="operator" value="গ্যাস">
                         <img src="{{ asset('images/gas-bill.png') }}" alt="Image 2">
                         <p class="text-center" style="color: #000;">গ্যাস</p>
                     </label>
                     <label class="image-radio">
                         <input type="radio" name="operator" value="পানি">
                         <img src="{{ asset('images/73-730316_faucetnew11132015-utility-bill-icon-png.png') }}" alt="Image 3">
                         <p class="text-center" style="color: #000;">পানি</p>
                     </label>
                     <label class="image-radio">
                         <input type="radio" name="operator" value="টিভি">
                         <img src="{{ asset('images/195149.png') }}" alt="Image 4">
                         <p class="text-center" style="color: #000;">টিভি</p>
                     </label>
                     <label class="image-radio">
                         <input type="radio" name="operator" value="ইন্টারনেট">
                         <img src="{{ asset('images/net-bill.png') }}" alt="Image 5">
                         <p class="text-center" style="color: #000;">ইন্টারনেট</p>
                     </label>
                 </div>
                 <div class="tf-form">
                     <div class="form-group input-field input-money">
                         <label for="">ইউজার আইডি</label>
                         <input name="mobile" type="number" placeholder="00000000" maxlength="11" required>
                         <span class="icon-clear"></span>
                     </div>
                 </div>

                 <div class="tf-form">
                     <div class="form-group input-field input-money">
                         <label for="">এমাউন্ট</label>
                         <input name="amount" type="number" max="{{ auth()->user()->balance }}" value="200" required class="search-field value_input st1" type="text">
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
                 <h3 class="text-center" style="    margin-top: 30px;">ব্যবহারযোগ্য ব্যালেন্স: {{ currency(auth()->user()->balance) }} টাকা</h3>
             </div>

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
     <div class="panel-box panel-up wrap-content-panel"></div>
 </div>

 @endsection

 @section('script')
 @endsection
