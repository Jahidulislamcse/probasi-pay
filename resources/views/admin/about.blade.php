@extends('admin.layout.master')
@section('meta')


<link rel="canonical" href="{{ route('admin.index') }}" />



@endsection
@section('style')




@endsection
@section('main')

<style>
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
    p {
      color: {{ $colors->paragraph_color ?? '#ffffff' }};   
    }

  .tf-statusbar {
    background-color: #067fab;
  }

  .p {
    font-size: 15px;
  }

  .h {
    font-size: 20px;
  }

  #myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
  }

  #myImg:hover {
    opacity: 0.7;
  }

  /* The Modal (background) */
  .modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.9);
    /* Black w/ opacity */
  }

  /* Modal Content (image) */
  .modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
  }

  /* Caption of Modal Image */
  #caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
  }

  /* Add Animation */
  .modal-content,
  #caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
  }

  @-webkit-keyframes zoom {
    from {
      -webkit-transform: scale(0)
    }

    to {
      -webkit-transform: scale(1)
    }
  }

  @keyframes zoom {
    from {
      transform: scale(0)
    }

    to {
      transform: scale(1)
    }
  }

  /* The Close Button */
  .close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
  }

  .close:hover,
  .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
  }

  /* 100% Image Width on Smaller Screens */
  @media only screen and (max-width: 700px) {
    .modal-content {
      width: 100%;
    }
  }
</style>


<div class="app-header st1">
  <div class="tf-container">
    <div class="tf-topbar d-flex justify-content-center align-items-center">
      <a href="{{ route('admin.index') }}" class="back-btn"><i class="icon-left white_color"></i></a>
      <h3 class="white_color">আমাদের সম্পর্কে</h3>
    </div>
  </div>
</div>
<div class="mt-1 box-settings-profile style1">



  <table>
    <tr>
      <th><img id="myImg" src="/images/a1.jpg" style="width:180px;height:250px;"></th>
      <th><img id="myImg2" src="/images/ab.jpg" style="width:180px;height:250px;"></th>
    </tr>

  </table>


  <div style="padding-bottom:56.25%; position:relative; display:block; width: 100%;height:100;">
    <br>

    <h3 style="color:#067fab;font-size: 20px;">আমাদের সম্পর্কে:-<br></h3><br>
    <p style="color:black; font-size: 19px;  text-align: justify;">
      প্রবাসী পে সার্ভিস লি. একটি মোবাইল ভিত্তিক ইন্টারন্যাশনাল মানি ট্রান্সফার এন্ড রিচার্জ আ্যপ| আমরা ২০১৮ সাল থেকে যাত্রা শুরু করে এখন পর্যন্ত বিশ্বস্ততার সাথে সৌদি আরব, কাতার, ওমান, দুবাই, মালয়েশিয়া, সিঙ্গাপুর, মালদ্বীপ, ব্রুনাই সহ আরও প্রায় ৩৮ টি দেশে মোবাইল ব্যাংকিং ও রেমিট্যান্স সেবা দিয়ে আসছি| সময়ের সাথে সাথে গ্লোবাল প্রবাসীপে রেমিটেন্স সার্ভিস লি. এখন আরও দ্রুত ও বিশ্বস্ততার সাথে কাজ করে যাচ্ছে| দেশ বিদেশ মিলিয়ে গ্লোবাল রেমিটেন্স সার্ভিস লি. এর সাথে ইতোমধ্যেই যুক্ত হয়েছেন বিশ্বব্যাপী প্রায় 32850 জন গ্রাহক যারা 24 ঘন্টা সম্পূর্ন নিরাপদ ও বিশ্বস্ততার সাথে লেনদেন করে যাচ্ছেন| গ্লোবাল রেমিটেন্স সার্ভিস লি. তার কাস্টমার এক্সপেরিয়েন্সকে সবোর্চ্চ গুরুত্ব দেয়| বিশেষ করে প্রবাসী ভাইদের লেনদেন কে সহজ, দ্রুত ও নিরাপদ করতে আমরা বদ্ধপরিকর|
    </p>
    <h3 style="color:#067fab;font-size: 20px;"><br>আমাদের সার্ভিসসমূহ হল :-</h3>
    <p style="color:black;   font-size: 19px; text-align: justify;"><br>১| প্রবাস থেকে সর্বোচ্চ রেটে মোবাইল ব্যাংকিং| যেমন:-বিকাশ, নগদ, রকেট, এমক্যাশ, ইউক্যাশ, শিওরক্যাশ <br> ২| বাংলাদেশের যেকোন ব্যাংকে সর্বোচ্চ রেটে টাকা পাঠানো|
      <br>৩| বাংলাদেশের যেকোন সিমে ফ্লেক্সিলোড দেওয়া|<br> ৪| বাংলাদেশের যেকোন সিমে এমবি ও মিনিট প্যাক
      একটিভেট করে দেওয়া|
      <br>৫| বাংলাদেশের যেকোন ধরনের বিল পেমেন্ট করা|
      <br>৬| 24/7 কাস্টমার হেল্পলাইন|
      <br>৭| অটো এড ব্যালেন্স এর সুবিধা|<br>
    </p><br><br>
    <h3 style="color:#067fab;font-size: 20px;">এতো এতো প্রতারকের মধ্যে আপনাদেরকে কিভাবে বিশ্বাস করবো? <br></h3><br>
    <p style="color:black;  font-size: 19px; text-align: justify;">সম্মানীত প্রবাসী, <br><br>
      ভুঁইফোড় কোম্পানী আর বিশ্বস্ত কোম্পানি চেনার সবথেকে সহজ উপায় হলো তাদের স্বচ্ছতা দেখা|
      এক্ষেত্রে একমাত্র আমাদের আছে লাইভ গ্রুপ চ্যাট অপশন|
      আমাদের অ্যাপের গ্রুপচ্যাট অপশনে আপনি যুক্ত হয়ে আমাদের অন্যান্য একটিভ কাস্টমারদের সাথে সরাসরি নিজেই চ্যাটের সুযোগ পাচ্ছেন যা আমাদের স্বচ্ছ বিজনেসের নিশ্চয়তা দেয়|
      আমরা ১০০% বিশ্বস্ততার সাথে সেবা দিয়ে থাকি বলেই একমাত্র আমরা আপনাদের নিজেদের মধ্যে গ্রুপচ্যাটে যোগাযোগ এর ব্যবস্থা করে দিয়েছি যা ভুয়া কোম্পানি গুলো কখনোই করেনা|
      এছাড়া আপনি কোম্পানীর ট্রেড লাইসেন্স ও রেজিষ্ট্রেশন সার্টিফিকেট যাচাই করে নিতে পারেন|
      আমাদের অ্যাপের প্রতিটা লেনদেন হয় অটো সার্ভারের মাধ্যমে| ফলে অ্যাপে কোন পেন্ডিং ঝামেলা নেই এবং আপনার লেনদেন থাকে সম্পূর্ণ সুরক্ষিত|
      অ্যাপে রয়েছে হেল্প সেন্টার যেখানে আপনি ২৪ ঘন্টা যেকোন সমস্যার সমাধান পাবেন|
    <p><br>
    <p style="color:#067fab; font-size: 19px;  text-align: justify;">আপনারা রেট কিভাবে বেশি দিচ্ছেন? <br><br>
    <p>
    <p style="color:black; font-size:19px;  text-align: justify;">
      সম্মানীত প্রবাসী, আমরা মূলত এক্সচেঞ্জ কোম্পানী| আমাদের কোম্পানীর সাথে পার্টনারশীপে যুক্ত প্রতিষ্ঠান বা ব্যক্তিরা তাদের অর্থ সবথেকে দ্রুত ও সহজে বাংলাদেশ থেকে অন্য দেশে বিনিময় করতে তারা আমাদের মাধ্যম ব্যবহার করে থাকে|
      এক্ষেত্রে আমাদের পার্টনার প্রতিষ্ঠান বা ব্যক্তিরা তাদের অর্থের দ্রুত বিনিময় বা স্থানান্তর কে মুনাফার থেকে বেশি অগ্রাধিকার দিয়ে থাকে| এছাড়া আমাদের সকল লেনদেন ইন্টারন্যাশনাল ক্রিপ্টো কারেন্সি যেমন ইউএসডিটি, বিটকয়েন এ কনভার্টেট হয় যা ক্রিপ্টো ট্রেডিং থেকে একটি বড় ইনকাম জেনারেট করতে সহায়তা করে| তাছাড়া আমাদের লেনদেনগুলোর একটি বড় অংশ ইন্টারন্যাশনাল শেয়ার মার্কেটের সাথে যুক্ত|
      সর্বোপরি, পার্টনারশিপ এর দ্রুত ও ঝামেলাহীন টাকা স্থানান্তর এবং এজেন্টশীপের অধিক মুনাফায় টাকা স্থানান্তর এই দুই উদ্দেশ্যের মেলবন্ধন ঘটিয়ে প্রবাসী পে রেমিটেন্স সার্ভিস আপনাকে দিচ্ছে একটি সহজ ও বিশ্বস্ত লেনদেন মাধ্যম|
    </p>

    </iframe>
  </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>

<script>
  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById("myImg");
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  img.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
</script>

<script>
  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById("myImg2");
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  img.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
</script>

@endsection


@section('script')






@endsection