 @extends('admin.layout.master')
 @section('meta')
 @endsection
 @section('style')
 <style>

 </style>
 @endsection
 @section('main')
 <div class="preload preload-container">
     <div class="preload-logo">
         <div class="spinner"></div>
     </div>
 </div>

 <!-- /preload -->
 <div class="app-header st1">
     <div class="tf-container">
         <div class="tf-topbar d-flex justify-content-center align-items-center">
             <a href="{{ route('admin.index') }}" class="back-btn"><i class="icon-left white_color"></i></a>
             <h3 class="white_color">উপায় পে</h3>
         </div>
     </div>
 </div>
 <div class="card-secton topup-content">
     <form class="tf-form" method="post">
         @csrf
         <div class="tf-container">
             <div class="tf-balance-box">
                 <div class="d-flex justify-content-between align-items-center">
                 </div>

                 <img src="/images/upay.png" style="width: 100px;display: block;margin: 13px auto;">
                 <h2 class="text-center" style=" font-weight: normal;">ট্রানজেকশন টাইপ সিলেক্ট করুন</h2>
                 <div class="option-container">
                     <div class="option-container">
                         <div class="image-radio-group">
                             <label class="image-radio">
                                 <input type="radio" name="type" checked value="সেন্ডমানি">
                                 <p>সেন্ডমানি</p>
                             </label>

                             <label class="image-radio">
                                 <input type="radio" name="type" value="পেমেন্ট">
                                 <p>পেমেন্ট</p>
                             </label>

                             <label class="image-radio">
                                 <input type="radio" name="type" value="ক্যাশআউট">
                                 <p>ক্যাশআউট</p>
                             </label>
                         </div>
                     </div>
                 </div>
                 <div class="tf-form">
                     <div class="group-input input-field input-money">
                         <label for="">টাকার পরিমাণ</label>
                         <input name="amount" type="number" max="{{ auth()->user()->balance }}" value="200" required class="search-field value_input st1" type="text">
                         <span class="icon-clear"></span>
                     </div>
                 </div>

                 <div class="tf-form">
                     <div class="group-input input-field input-money">
                         <label for="">মোবাইল/অ্যাকাউন্ট নম্বর</label>
                         <input name="mobile" type="number" placeholder="0170000000" maxlength="11" required type="text">
                         <span class="icon-clear"></span>
                     </div>
                 </div>
             </div>
             <h3 class="text-center" style="    margin-top: 30px;">ব্যবহারযোগ্য ব্যালেন্স: {{ currency(auth()->user()->balance) }} টাকা</h3>
         </div>
     </form>
 </div>

 <div class="text-center" style="margin: 30px;">
     <span id="openConfirm" class="small-button">
         এগিয়ে যান
     </span>
 </div>

 <div class="modal fade" id="txnConfirmModal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content bk-modal">


             <div class="text-center mt-3">
                 <img src="/images/upay.png" style="width: 100px; display: block; margin: 0 auto;">
             </div>

             <div class="bk-body">
                 <div class="bk-summary">
                     <div class="bk-col">
                         <div class="up-col-title">একাউন্ট নম্বর</div>
                         <div class="bk-col-value" id="mAccount">—</div>
                     </div>
                     <div class="bk-sep"></div>
                     <div class="bk-col">
                         <div class="up-col-title">এমাউন্ট</div>
                         <div class="bk-col-value" id="mAmount">—</div>
                     </div>
                 </div>

                 <div class="bk-summary">
                     <div class="bk-col">
                         <div class="up-col-title">ট্রানজেকশন টাইপ</div>
                         <div class="bk-col-value" id="mType">—</div>
                     </div>
                 </div>

                 <label class="bk-label" for="pinInput">পিন</label>
                 <input id="pinInput" name="pin" type="password" class="form-control bk-input" placeholder="••••••" required>

                 <button type="submit" class="btn up-btn mt-3">কনফার্ম</button>
             </div>
         </div>
     </div>
 </div>
 </form>
 </div>




 <div class="tf-panel up">
     <div class="panel_overlay"></div>
     <div class="panel-box panel-up wrap-content-panel">
     </div>
 </div>



 @endsection


 @section('script')
 <script>
     document.getElementById('openConfirm').addEventListener('click', function() {
         const form = document.querySelector('.tf-form');
         const amount = form.elements['amount'].value.trim();
         const mobile = form.elements['mobile'].value.trim();
         const type = form.elements['type'] ? document.querySelector('input[name="type"]:checked').value : "Not selected";

         if (!amount || !mobile || type === "Not selected") {
             form.reportValidity();
             return;
         }

         document.getElementById('mAccount').textContent = mobile;
         document.getElementById('mAmount').textContent = amount + ' টাকা';
         document.getElementById('mType').textContent = type;


         document.getElementById('pinInput').value = '';

         const modal = new bootstrap.Modal(document.getElementById('txnConfirmModal'));
         modal.show();
     });
 </script>
 @endsection