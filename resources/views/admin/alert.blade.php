 @extends('admin.layout.master')
 @section('meta')
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
                 <a href="{{ route('admin.index') }}" class="back-btn"> <i class="icon-left"></i> </a>
               
             </div>
         </div>
     </div>
     <div class="mt-1 box-settings-profile style1">
         <div>



             <div class="panel-heading">
                 <div class="panel-body">


                     <div class="box-body">


                         <div class="table-responsive">
                          
                             <table id="editable_table" class="table table-bordered table-striped">
                               
                                 <tbody>
                                        @foreach(App\Models\Notification::latest()->get() as $list)
                                        <tr style="
                                        background: #b6d9ff;
                                        padding: 10px;
                                        margin: 10px;
                                        border-radius: 18px;
                                    ">
                                            <td>{{ @$list->message }}</td>
                                         
                                        </tr>
                                        @endforeach
                                  
                                 </tbody>
                             </table>
                         </div>

                    


                     </div>
                 </div>
             </div>


         </div>
     </div>
 @endsection


 @section('script')
 @endsection
