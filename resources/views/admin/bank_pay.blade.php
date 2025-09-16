 @extends('admin.layout.master')
 @section('meta')
 @endsection
 @section('style')


 <style>
     .image-radio-group {
         display: flex;
         flex-wrap: wrap;
         justify-content: space-between;
         margin-bottom: 20px;
     }

     .image-radio {
         display: flex;
         align-items: center;
         margin: 5px;
         cursor: pointer;
         width: 30%;
         text-align: center;
     }

     .image-radio input[type="radio"] {
         margin-right: 10px;
         width: 15px;
         height: 15px;
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
         width: 20px;
         height: 20px;
         border-radius: 50%;
         object-fit: cover;
     }

     .image-radio p {
         font-size: 14px;
         color: #000;
         margin: 0;
     }

     @media (max-width: 768px) {
         .image-radio {
             width: 100%;
             text-align: center;
         }

         .image-radio p {
             font-size: 12px;
         }
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
             <h3 class="white_color">ব্যাংক পে</h3>
         </div>
     </div>
 </div>
 <div class="card-secton topup-content mt-1">
     <form id="bankForm" class="tf-form" method="post">
         @csrf
         <div class="tf-container">
             <div class="tf-balance-box">
                 <div style="overflow:scroll">
                     <div class="image-radio-group">
                         @foreach ($payable_accounts as $account)
                         <label class="image-radio">
                             <input type="radio" name="operator" value="{{ $account->name }}" {{ $loop->first ? 'checked' : '' }}>
                             <span class="radio-btn"></span>
                             <img src="{{ asset($account->logo) }}" alt="{{ $account->name }}">
                             <p class=" text-center" style="margin-left: 5px; color: #000;">{{ $account->name }}</p>
                         </label>
                         @endforeach
                     </div>
                 </div>

                 <div class="tf-form">
                     <div class="group-input input-field input-money">
                         <label for="">টাকার পরিমাণ</label>
                         <input name="amount" type="number" max="{{ auth()->user()->balance }}" value=""
                             required class="search-field value_input st1" type="text">
                         <span class="icon-clear"></span>
                     </div>
                 </div>

                 <div class="tf-form">
                     <div class="group-input input-field input-money">
                         <label for="">ব্যাংক অ্যাকাউন্ট নম্বর দিন</label>
                         <input name="mobile" type="number" placeholder="Account Number" required>
                         <span class="icon-clear"></span>
                     </div>
                 </div>

                 <div class="tf-form">
                     <div class="group-input input-field input-money">
                         <label for="">ব্রাঞ্চের নাম লিখুন</label>
                         <input name="branch" type="text" placeholder="Branch Name" required>
                         <span class="icon-clear"></span>
                     </div>
                 </div>
                 <div class="tf-form">
                     <div class="group-input input-field input-money">
                         <label for="">অ্যাকাউন্ট হোল্ডারের নাম লিখুন</label>
                         <input name="achold" type="text" placeholder="Account Holder Name" required>
                         <span class="icon-clear"></span>
                     </div>
                 </div>
             </div>
             @if($country)
             @if($rate)
             <h4 class="text-center" style=""> আজকের রেট: {{ $country->name }} {{ enToBnNumber(1) }} {{ $country->currency }} = {{ enToBnNumber(number_format($rate, 2)) }} টাকা</h4>
             @else
             Rate not found
             @endif
             @endif
             <h3 class="text-center" style="margin-top: 30px;">ব্যবহারযোগ্য ব্যালেন্স: {{ currency(auth()->user()->balance) }} টাকা</h3>
         </div>

         <div class="text-center" style="margin-bottom: 30px; margin-top: 20px;">
             <span id="openConfirm"
                 class="small-button">
                 এগিয়ে যান
             </span>
         </div>

         <div class="modal fade" id="txnConfirmModal" tabindex="-1" aria-hidden="true">
             <div class="modal-dialog modal-dialog-centered">
                 <div class="modal-content bk-modal">
                     <div class="bk-header" style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                         <div class="bk-brand">
                             <span class="bank-text">ব্যাংক</span>
                         </div>
                         <div class="bk-title">| টাকা উত্তোলন</div>
                     </div>

                     <div class="bk-body">
                         <div class="bk-summary">
                             <div class="bk-col">
                                 <div class="bank-col-title">একাউন্ট নম্বর</div>
                                 <div class="bk-col-value" id="mAccount">—</div>
                             </div>
                             <div class="bk-sep"></div>
                             <div class="bk-col">
                                 <div class="bank-col-title">এমাউন্ট</div>
                                 <div class="bk-col-value" id="mAmount">—</div>
                             </div>
                         </div>

                         <div class="bk-summary">
                             <div class="bk-col">
                                 <div class="bank-col-title">গ্রহীতার নাম</div>
                                 <div class="bk-col-value" id="mAchold">—</div>
                             </div>
                             <div class="bk-sep"></div>
                             <div class="bk-col">
                                 <div class="bank-col-title">ব্রাঞ্চ</div>
                                 <div class="bk-col-value" id="mBranch">—</div>
                             </div>
                         </div>

                         <div class="bk-summary">
                             <div class="bk-col">
                                 <div class="bank-col-title">ব্যাংক</div>
                                 <div class="bk-col-value" id="mOperator">—</div>
                             </div>
                         </div>

                         <label class="bk-label" for="pinInput">পিন</label>
                         <input id="pinInput" name="pin" type="password" class="form-control bk-input" placeholder="••••••" required>

                         <button type="submit" class="btn bank-btn mt-3">কনফার্ম</button>
                     </div>
                 </div>
             </div>
         </div>
     </form>
 </div>


 @endsection


 @section('script')
 <script>
     document.getElementById('openConfirm').addEventListener('click', function() {
         const form = document.getElementById('bankForm');
         const amount = form.elements['amount'].value.trim();
         const mobile = form.elements['mobile'].value.trim();
         const branch = form.elements['branch'].value.trim();
         const achold = form.elements['achold'].value.trim();
         const operator = document.querySelector('input[name="operator"]:checked') ?
             document.querySelector('input[name="operator"]:checked').value :
             "Not selected";

         if (!amount || !mobile || !branch || !achold || operator === "Not selected") {
             form.reportValidity();
             return;
         }

         document.getElementById('mAccount').textContent = mobile;
         document.getElementById('mAmount').textContent = amount + ' টাকা';
         document.getElementById('mAchold').textContent = achold;
         document.getElementById('mBranch').textContent = branch;
         document.getElementById('mOperator').textContent = operator;
         document.getElementById('pinInput').value = '';

         const modal = new bootstrap.Modal(document.getElementById('txnConfirmModal'));
         modal.show();
     });
 </script>
 @endsection