 @extends('admin.layout.master')
 @section('meta')
 @endsection
 @section('style')
  <style>
  .image-radio-group {
    display: flex;
    flex-wrap: nowrap;
    gap: 4px;
    margin-bottom: 20px;
    justify-content: center;
    
  }

  .image-radio {
    position: relative;
    
    width: 65px;
    height: 40px;
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

   .image-radio input[type="radio"]:checked + p  {
    border:  2px solid #ff0000;
    background: #ff0000;
  }
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
        @php    $country = country();  @endphp
        <h3 class="text-white text-center">আজকের রেট: {{ @$country->name }} ১ {{ @$country->currency }} = {{ @$country->rate }} টাকা</h3>
        <form class="tf-form" method="post">
            @csrf
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="d-flex justify-content-between align-items-center">
                   
                </div>
                                 
               <!--<div class="wrap-sl-country">-->
               <!--     <select name="type" class="box-sl-profile form-select" required>-->
               <!--         <option  value="">আপনার সিমের ধরন</option>-->
               <!--         <option value="Personal">পার্সোনাল</option>-->
               <!--         <option value="Payment">পেমেন্ট</option>-->
               <!--         <option value="Agent">এজেন্ট</option>-->
                  
               <!--     </select>-->
               <!-- </div>-->
                   <img src="/images/upay.png" style="width: 100px;display: block;margin: 13px auto;">
                <h2 class="text-center" style=" font-weight: normal;">ট্রানজেকশন টাইপ সিলেক্ট করুন</h2>
                  <div style="overflow:scroll">
                       <div class="image-radio-group">
                          <label class="image-radio">
                            <input type="radio" name="type" checked value="পার্সোনাল">
                            <p class="text-center" style=" color: #f79797;padding-top: 10px; padding-bottom: 7px;">পার্সোনাল</p>
                          </label>
                          <label class="image-radio">
                            <input type="radio" name="type" value=" পেমেন্ট">
                              <p class="text-center" style="color: #f79797;padding-top: 10px;padding-bottom: 7px;"> পেমেন্ট</p>
                          </label>
                          <label class="image-radio">
                            <input type="radio" name="type" value="এজেন্ট">
                              <p class="text-center" style="color: #f79797;padding-top: 10px;padding-bottom: 7px;">এজেন্ট</p>
                          </label>
                        
                    
                        </div>
                    </div>
                <div class="tf-form">
                    <div class="group-input input-field input-money">
                        <label for="">টাকার পরিমাণ</label>
                        <input name="amount"  type="number" max="{{ auth()->user()->balance }}" value="200" required class="search-field value_input st1" type="text">
                        <span class="icon-clear"></span>
                    </div>
                </div>
               
                   <div class="tf-form">
                    <div class="group-input input-field input-money">
                        <label for="">মোবাইল/অ্যাকাউন্ট নম্বর</label>
                        <input name="mobile"  type="number" placeholder="0170000000" maxlength="11"  required type="text">
                        <span class="icon-clear"></span>
                    </div>
                </div>
                <div class="form-group input-field input-money">
                        <label for="">পিন</label>
                        <input name="pin"  type="text" placeholder="123456"   required>
                        <span class="icon-clear"></span>
                    </div>
            </div>
            <h3 class="text-center" style="    margin-top: 30px;">ব্যবহারযোগ্য ব্যালেন্স: {{ currency(auth()->user()->balance) }} টাকা</h3>
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
          </div>
    </div>

 

 @endsection


 @section('script')
 @endsection
