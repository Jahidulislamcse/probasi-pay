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
            color: #1a3637;
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
     <div class="preload preload-container">
         <div class="preload-logo">
             <div class="spinner"></div>
         </div>
     </div>
     <!-- /preload -->
 @php
           $country = country();
        
      @endphp
 <div class="header">
        <div class="tf-container" style="        position: fixed;        width: 100%;    ">
            <div class="tf-statusbar d-flex justify-content-center align-items-center" style="    background: #ff3130">
                <a href="{{ back() }}" class="text-white back-btn"> <i class="icon-left"></i> </a>
            <h3 class="white_color">মোবাইল অ্যাড ফান্ড</h3>
            </div>
        </div>
</div>




<div class=" topup-content" style="
    margin-top: 60px;
    text-align: center;
        margin-bottom: 50px;
">
   
    <span style=" background: #ff3130;padding: 10px 25px; border-radius: 10px; font-size: 18px; font-weight: normal;  display: block;  margin: 10px;" class="white_color text-center">আজকের রেট: {{  @$country->rate }} টাকা</span>
 <div style="padding:20px">
    <p>{{ @$country->name  }} তে আমাদের কোম্পানীর ব্যাংক একাউন্টে রিঙ্গিত ট্রান্সফার করে আপনি অ্যাপে ব্যালেন্স নিতে পারবেন। এক্ষেত্রে আপনি আপনার ব্যাংক একাউন্ট থেকে {{ @$country->name  }}  কোম্পানির ব্যাংক একাউন্টে {{ @$country->currency }} ট্রান্সফার করে অ্যাপে রিসিট সাবমিট করলে বা হেল্প সেন্টারের হোয়াটসএপ নাম্বারে রিসিট জমা দিলে আপনাকে প্রতি {{ @$country->currency }} কোম্পানির রেট অনুযায়ী অ্যাপে বাংলাদেশি টাকায় ব্যালেন্স এড করে দেওয়া হবে।
আজকে {{ @$country->name  }} কোম্পানীর রেট চলতেছে {{ @$country->rate }} টাকা।
সেক্ষেত্রে আজকে আপনি যদি {{ @$country->name  }} থেকে কোম্পানির ব্যাংকে ৫০০ {{ @$country->currency }} ডিপোজিট করেন সেক্ষেত্রে আপনি
অ্যাপে ব্যালেন্স পাবেন <span style="color:red;font-size:26px">{{ @ $country->rate*500 }}/= টাকা। </span></p>


</div>


<p style="text-align: center;
    margin: 20px 5px;
    font-size: 14px;">ব্যাংক একাউন্টের তথ্য জানতে নিচের হেল্পলাইন বাটনে ক্লিক করে হেল্প সেন্টারে যোগাযোগ করুন

<br>
    <a href="https://wa.me/8801942823152" style="
    background: #1a3637;
    padding: 10px 20px;
    margin-top:20px;
    margin-bottom:20px;
    color: white;
    font-size: 15px;
    line-height: 5;
    border-radius: 5px;">হেল্পলাইন</a> <br>
রিসিট সাবমিট করতে নিচের বাটনে ক্লিক করুন
</p>



    <span  style="    background: red;    padding: 10px 20px;    margin-top:20px; margin-bottom:20px;color: white; font-size: 15px;border-radius: 5px;" data-bs-toggle="modal" data-bs-target="#exampleModal">সাবমিট রিসিট</span>
</div>




</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body">
        
          <div class="mt-1  style1">

         <div style=" position:relative; display:block; width: 100%;height:100;">
             <form method="post" enctype="multipart/form-data">
                 @csrf
                 <div style="padding:15px;"></div>
                 <label> আপনার ব্যাংক ট্রান্সফার স্লিপের ছবি আপলোড করুন:
                 </label>
                 <input style="display:none;" value="Bank Add pay" type="text" name="type">
                 <input type="file" name="file">
                             @php $content = App\Models\Section::where('key','topup bank')->first(); @endphp
            <div style="padding:20px">
                {!! @$content->value !!}
            </div>
                             <div style="padding:15px;"></div>
                             <input class="tf-btn accent large" type="submit" name="submit" value="কনফার্ম করুন">
                         </form>
                     </div>
                 </div>

      </div>
      
    </div>
  </div>
</div>




    
  
     



 @endsection


 @section('script')
 @endsection
