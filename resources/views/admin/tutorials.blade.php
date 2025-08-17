@extends('admin.layout.master')
@section('meta')


<link rel="canonical" href="{{ route('admin.index') }}" />



@endsection
@section('style')




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
      <div class="tf-container">
          <div class="tf-statusbar d-flex justify-content-center align-items-center">
              <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="back-btn"> <i class="icon-left"></i> </a>
              <h3>টিউটোরিয়াল</h3>
          </div>
      </div>
  </div>
  <div class="mt-3 register-section">
      <div class="tf-container">
       
              <div class="group-cb mt-5">
                   <button type="button" class="tf-btn accent small mt-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">কিভাবে ব্যাল্যান্স অ্যাড করবেন <i class="fa fa-youtube-play" style="font-size:25px;color:white"></i></button>
              </div>
         <div class="group-cb mt-5">
                   <button type="button" class="tf-btn accent small mt-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter1">কিভাবে ব্যাংক ট্রান্সফার করবেন 
                   <i class="fa fa-youtube-play" style="font-size:25px;color:white"></i>
                   </button>
              </div>
                         <div class="group-cb mt-5">
                   <button type="button" class="tf-btn accent small mt-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter2">কিভাবে বিকাশ নগদে টাকা পাঠাবো
                   <i class="fa fa-youtube-play" style="font-size:25px;color:white"></i>
                   </button>
              </div>
     

      </div>
  </div>
  
  

    <div class="modal fade" id="exampleModalCenter">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">কিভাবে ব্যাল্যান্স অ্যাড করব</h5>
            <button class="btn-close" data-bs-dismiss="modal">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>
          <div class="modal-body">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex, ipsa id quasi ab facere laudantium magnam excepturi possimus ducimus fuga quibusdam quis blanditiis dolores sequi eligendi. Libero possimus non impedit?</p>
          </div>
         
        </div>
      </div>
  </div>
  
        <div class="modal fade" id="exampleModalCenter1">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">কিভাবে ব্যাংক ট্রান্সফার করবেন</h5>
            <button class="btn-close" data-bs-dismiss="modal">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>
          <div class="modal-body">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex, ipsa id quasi ab facere laudantium magnam excepturi possimus ducimus fuga quibusdam quis blanditiis dolores sequi eligendi. Libero possimus non impedit?</p>
          </div>
         
        </div>
      </div>
  </div>

        <div class="modal fade" id="exampleModalCenter2">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">কিভাবে বিকাশ নগদে টাকা পাঠাবো</h5>
            <button class="btn-close" data-bs-dismiss="modal">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>
          <div class="modal-body">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex, ipsa id quasi ab facere laudantium magnam excepturi possimus ducimus fuga quibusdam quis blanditiis dolores sequi eligendi. Libero possimus non impedit?</p>
          </div>
         
        </div>
      </div>
  </div>
       
@endsection


@section('script')






@endsection