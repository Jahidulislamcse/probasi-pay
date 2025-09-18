<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Metas -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Register</title>
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="images/logo.png" />
    <link rel="apple-touch-icon-precomposed" href="images/logo.png" />
    <!-- Font -->
    <link rel="stylesheet" href="fonts/fonts.css" />
    <!-- Icons -->
    <link rel="stylesheet" href="fonts/icons-alipay.css">
    <link rel="stylesheet" href="styles/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="styles/styles.css" />
    <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="192x192" href="app/icons/icon-192x192.png">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <!-- preloade -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div class="header">
        <div class="tf-container">
            <div class="tf-statusbar br-none d-flex justify-content-center align-items-center">
                <a href="="{{  route('register.image')  }}" class="back-btn"> <i class="icon-left"></i> </a>
            </div>
        </div>
    </div>
    <div class="mt-3 register-section" style="padding-left: 20px; padding-right: 20px;">
        <div class="tf-container">
            <form class="tf-form" action="{{ route('register') }}" method="post">
                @csrf
                <h2 class="m-2 text-center">পোপন পিন সেট করুন</h2>
                         
                <div class="group-input">
                    <label>পিন লিখুন</label>
                    <input type="password" name="pin" >
                </div>
                <div class="group-input">
                    <label>পিন পুনরায় লিখুন</label>
                    <input type="password" name="pin" class="pin"> 
                </div>

                @php
                $data = Illuminate\Support\Facades\Session::get('register-info');
                $country = App\Models\Country::find($data['location']);
            @endphp

                <input type="hidden" name="photo" id="photoInput"  value="{{ @$data['photo'] }}">
                <input name="name" type="hidden" placeholder="Your Full Name" value="{{ @$data['name'] }}">
                <input name="email" type="hidden" placeholder="Your Full Name"  value="{{ @$data['email'] }}">
                <input name="location" type="hidden" placeholder="Your Full Name" value="{{ @$data['location'] }}">
                <input name="password" type="hidden" placeholder="Your Full Name" value="{{ @$data['password'] }}">
                <input name="password_confirmation" type="hidden" placeholder="Your Full Name" value="{{ @$data['password_confirmation'] }}">
                <input name="role" type="hidden" placeholder="Your Full Name" value="{{ @$data['role'] }}">
                <input name="type" type="hidden" placeholder="Your Full Name" value="{{ @$data['type'] }}">
              

             
                <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal" class="tf-btn accent large">নিবন্ধন করুন</button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                   
                        <div class="modal-body">
                           
                        <div class="modal-body">
                            <h3 class="text-center">তথ্যগুলো পুনরায় যাচাই করুন</h3>
                            <p style="
                            font-size: 18px;
                            background: #bde0e5;
                            padding: 12px;
                            margin: 5px;
                            border-radius: 10px;
                            color: #000;
                        ">নাম: {{ @$data['name'] }}</p>
                        <p style="
                            font-size: 18px;
                            background: #bde0e5;
                            padding: 12px;
                            margin: 5px;
                            border-radius: 10px;
                            color: #000;
                        ">দেশ: {{ @$country->name }}</p>
                        <p style="
                        font-size: 18px;
                        background: #bde0e5;
                        padding: 12px;
                        margin: 5px;
                        border-radius: 10px;
                        color: #000;
                    ">একাউন্ট টাইপ: {{ @$data['type'] }}</p>
                            <p style="
                            font-size: 18px;
                            background: #bde0e5;
                            padding: 12px;
                            margin: 5px;
                            border-radius: 10px;
                            color: #000;
                        ">পাসওয়ার্ড: {{ $data['password'] }}</p>
                        <p style="
                        font-size: 18px;
                        background: #bde0e5;
                        padding: 12px;
                        margin: 5px;
                        border-radius: 10px;
                        color: #000;
                    ">মোবাইল: {{ $data['email'] }}</p>
                        <p style="
                        font-size: 18px;
                        background: #bde0e5;
                        padding: 12px;
                        margin: 5px;
                        border-radius: 10px;
                        color: #000;
                    ">পিন: <span id="displayPin"></span></p>
                    <script>
                        document.querySelector('.pin').addEventListener('keyup', function() {
                            var pin = this.value;
                            document.getElementById('displayPin').innerText = pin;
                        });
                        
                    </script>
                            <h5 class="text-center mt-3 mb-3">আমি নিশ্চয়তা দিচ্ছি যে আমার দেওয়া উপরের সকল তথ্য সঠিক</h5>
                            <button class="btn btn-danger">সাবমিট</button>
                        </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>

            </form>

        </div>
    </div>



    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex, ipsa id quasi ab facere laudantium
                        magnam excepturi possimus ducimus fuga quibusdam quis blanditiis dolores sequi eligendi. Libero
                        possimus non impedit?</p>
                </div>

            </div>
        </div>
    </div>



    <script type="text/javascript" src="javascript/jquery.min.js"></script>
    <script type="text/javascript" src="javascript/bootstrap.min.js"></script>
    <script type="text/javascript" src="javascript/password-addon.js"></script>
    <script type="text/javascript" src="javascript/main.js"></script>
    <script type="text/javascript" src="javascript/init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
        integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        @if (session()->get('response') === false)
            toastr.error('{{ session()->get('msg') }}')
        @endif
        @if (session()->get('response') === true)
            toastr.success('{{ session()->get('msg') }}')
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}')
            @endforeach
        @endif
    </script>





</body>


<!-- Mirrored from themesflat.co/html/alipay/alipay-app-pwa/05_register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Aug 2024 17:00:40 GMT -->

</html>
