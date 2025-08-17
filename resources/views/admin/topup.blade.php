 
 @extends('admin.layout.master')
 @section('meta')
 
 

 
 
 @endsection
 @section('style')
 
 
 <style>
     body{
              background-color: #fff;
              color: #ff3130;
     }
     h1, h2, h3, h4, h5, h6 {
            font-weight: normal;
            color: #ff3130;
    }
    p{
        font-size: 17px;
    line-height: 25px;
    text-align: justify;
    font-weight: normal;
    }
    label {
    margin-top: 5px;
    margin-bottom: 5px;
    color: #2f2e2e;
    font-size: 18px;
}
 </style>
 
 @endsection
 @section('main')
 
 
 @php
           $country = country();
        
      @endphp

 <!-- preloade -->
 <div class="preload preload-container">
    <div class="preload-logo">
      <div class="spinner"></div>
    </div>
  </div>
<!-- /preload -->
 <div class="header">
        <div class="tf-container" style="        position: fixed;        width: 100%;    ">
            <div class="tf-statusbar d-flex justify-content-center align-items-center" style="    background: #ff3130;">
                <a href="{{ back() }}" class="text-white back-btn"> <i class="icon-left"></i> </a>
            <h3 class="white_color">মোবাইল অ্যাড ফান্ড</h3>
            </div>
        </div>
</div>



<!--<div class="app-header st1">-->
<!--    <div class="tf-container">-->
<!--        <div class="tf-topbar d-flex justify-content-center align-items-center">-->
<!--           <a href="{{  route('admin.index')  }}" class="back-btn"><i class="icon-left white_color"></i></a> -->
<!--            <h3 class="white_color">মোবাইল অ্যাড ফান্ড</h3>-->
           
           
            
<!--        </div>-->
       
<!--    </div>-->
    
<!--</div>-->

<div class=" topup-content" style="
    margin-top: 60px;
    text-align: center;
">
    
    <span style="

    background: #ff3130;
    padding: 10px 25px;
    border-radius: 10px;
    font-size: 18px;
    font-weight: normal;
        display: block;
            margin: 10px;
" class="white_color text-center">আজকের রেট: {{  @$country->rate }} টাকা</span>


<div style="margin-top:10px;margin-bottom: 25px;">
                @foreach (App\Models\Account::where('type','Mobile Banking')->get() as $data )
                 <span style="
    background: #ffd3d3;
    display: block;
    margin: 15px 30px;
    padding: 20px;
    color: #ff3130;
    font-size: 25px;
    line-height: 30px;
    border-radius: 5px;
">{{ @$data->name }} <br> <span style="font-size: 30px;">{!! @$data->details !!}</span> </span>   
                @endforeach
</div>

<span style="
    background: red;
    padding: 10px 20px;
    color: white;
    font-size: 15px;
    border-radius: 5px;
">বিকাশ নগদের মাধ্যমে ডিপোজিটের নিয়ম</span>

</div>

<!--<div class="amount-money mt-5">-->
<!--    <div class="tf-container">-->
<!--        <h3>Amount Money</h3>-->
<!--        <ul class="money list-money">-->
<!--            <li><a class="tag-money" href="#">50</a> </li>-->
<!--            <li><a class="tag-money" href="#">100</a> </li>-->
<!--            <li><a class="tag-money" href="#">200</a> </li>-->
<!--            <li><a class="tag-money" href="#">500</a> </li>-->
<!--            <li><a class="tag-money" href="#">1000</a> </li>-->
<!--            <li><a class="tag-money" href="#">2000</a> </li>-->
<!--         </ul>-->
<!--    </div>-->
<!--</div>-->
@php $content = App\Models\Section::where('key','topup')->first(); @endphp

<div style="padding:20px">
    
    <p>আপনার যদি কোন কারনে {{ @$country->name }} ব্যাংক একাউন্ট না থাকে সেক্ষেত্রে আপনি শর্ত সাপেক্ষে উপরে দেওয়া কোম্পানির বিকাশের মাধ্যমে অ্যাপে ব্যালেন্স নিতে পারবেন।
এক্ষেত্রে আপনি উপরে দেওয়া কোম্পানির বিকাশে {{ @$country->name }}  থেকে বর্তমানে প্রতি {{ @$country->currency }}  যে হুন্ডি রেট পান সেই রেটে টাকা পাঠাবেন।
টাকা পাঠানোর পর কোম্পানির হেল্পলাইনে পিন এবং এমাউন্ট জানায়ে দিলে আপনাকে কোম্পানীর রেট অনুযায়ী ব্যালেন্স দিয়ে দেওয়া হবে।
বিষয়টা আরো সহজভাবে বুঝার জন্য ধরে নিন {{  @$country->name }} ট থেকে হুন্ডি মাধ্যমে আপনি যদি কোম্পানির বিকাশে ১০০ {{  @$country->currency }}  ২৮ টাকা রেট হিসেবে ২৮০০ টাকা পাঠান তাহলে আপনি অ্যাপে ব্যালেন্স পাবেন প্রতি {{  @$country->currency }}  কোম্পানীর রেট {{  @$country->rate }}  টাকা হিসেবে মোট {{ @(int)$country->rate*100 }} ট টাকা৷</p>
    <p class="text-center " style="color:red;margin-top:20px">বিকাশের মাধ্যমে ডিপোজিটের শর্তসমূহ:</p>
    <p style="color:black; font-size: 17px;  text-align: justify;">
    বিকাশের মাধ্যমে ডিপোজিটের শর্তসমূহ:
<br>👉 ডিপোজিটের ক্ষেত্রে শুধুমাত্র হুন্ডি এজেন্টদের মাধ্যমে কোম্পানীর বিকাশে টাকা পাঠাতে হবে| 
<br>👉 অ্যাপ থেকে কোম্পানির বিকাশে ডিপোজিট গ্রহনযোগ্য নয়| 
<br>👉 যতক্ষন হেল্পলাইনে পিন এবং এমাউন্ট জানাবেন না ততক্ষন ব্যালেন্স এড হবেনা|
<br>👉 অটো এড ব্যালেন্সের ক্ষেত্রে সর্বনিম্ন ৩০,০০০/= টাকা ডিপোজিট করতে হবে|
<br>👉 বিকাশের মাধ্যমে একমাসে সর্বোচ্চ ২.৫ লক্ষ টাকার ব্যালেন্স নিতে 
      পারবেন| এর উপর হলে ব্যাংকের মাধ্যমে নিতে হবে</p>
    {!! @$content->value !!}
</div>

<div class="text-center" style="
    margin: 30px;
">
    <span  style="
    background: red;
    padding: 10px 20px;
    margin-top:20px;
    margin-bottom:20px;
    color: white;
    font-size: 15px;
    border-radius: 5px;
" data-bs-toggle="modal" data-bs-target="#exampleModal">
 অটো এড ব্যালেন্স
</span>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body">
        
           <form class="tf-form" method="post">
                    @csrf
                
                        <p style=" text-align: center;  font-size: 28px;">অটো এড ব্যালেন্স</p>
                        <p style=" margin-top: 10px;">আমাদের অটো এড ব্যালেন্স সিস্টেম এ রিসেলার ব্যবসা এখন আরও সহজ ও নিরাপদ। অটো এড ব্যালেন্স ফিচার ব্যবহার করে আপনার নিজের ব্যালেন্স নিজেই ডিপোজিট করুন, যখন ইচ্ছা। এক্ষেত্রে কোন এজেন্ট কে মেসেজ করার ঝামেলা নেই।
বিকাশ বা নগদে লিমিটজনিত সমস্যার কারনে অটো এড ব্যালে এর ক্ষেত্রে বাংলাদেশি টাকায় সর্বনিম্ন ২৫০০০/= টাকা ডিপোজিট করতে হবে।</p>
                      
                        <input type="hidden" name="type" value="Mobile pay">
                        
                           <div class="tf-form">
                                <div class="form-group input-field input-money">
                                    <label for="">পিন</label>
                                    <input name="pin"  type="text" placeholder="123456"   required>
                                    <span class="icon-clear"></span>
                                <small>যে নাম্বার থেকে টাকা পাঠিয়েছেন তার শেষের 4 টা ডিজিট লিখুন</small>
                                </div>
                            </div>
                         
                        <div class="tf-form">
                            <div class="group-input input-field input-money">
                                <label for="">টাকার পরিমাণ</label>
                                <input name="amount"  type="number" value=""  required class="search-field value_input st1">
                                <span class="icon-clear"></span>
                                <small>বাংলাদেশি টাকায় যত টাকা কোম্পানীর নাম্বারে পাঠিয়েছেন সেটি লিখুন</small>
                            </div>
                        </div>
                       
                    
                   
                   <button type="submit" name="submit" class="tf-btn accent large">কনফার্ম পেমেন্ট</button>
             
                
              
                </form>
        
        
      </div>
      
    </div>
  </div>
</div>

       
@endsection


@section('script')






@endsection