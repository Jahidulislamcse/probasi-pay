<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themesflat.co/html/alipay/alipay-app-pwa/04_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Aug 2024 17:00:35 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Login</title>
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
    <div class="mt-9 login-section" style="padding-left: 20px; padding-right: 20px;">
        <div class="tf-container" >
            <form class="tf-form" action="{{  route('login') }}" method="post" >
                @csrf
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/login-page-illustration-download-in-svg-png-gif-file-formats--app-developing-development-secure-mobile-webapp-and-pack-design-illustrations-3783954.png" style=" margin-left:35%; width:30%; height:30%">


                <div class="group-input">
                    <label>আপনার ফোন নম্বর দিন</label>
                    <input type="text" name="email" placeholder="01700000000" required>
                </div>
                <div class="group-input auth-pass-input last">
                    <label>আপনার পাসওয়ার্ড দিন</label>
                    <input type="password" class="password-input" name="password" placeholder="পাসওয়ার্ড দিন" required>
                    <a class="icon-eye password-addon" id="password-addon"></a>
                </div>

                <button type="submit" name="submit" class="tf-btn accent large" style="
    background-color: #ff3100;
    border: 1px solid #ff3100;
">লগইন</button>

            </form>
            <div class="auth-line">অথবা</div>

            <p class="mb-9 fw-3 text-center ">অ্যাকাউন্ট নেই? <a href="{{  route('register')  }}" class="auth-link-rg" style="
    padding: 15px;
    background: #ff3100;
    color: #fff;
    border-radius: 5px;
">অ্যাকাউন্ট খুলুন</a></p>
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
    @if(session()->get('response') === false)
        toastr.error('{{ session()->get('msg') }}');
    @endif
    @if(session()->get('response') === true)
        toastr.success('{{ session()->get('msg') }}');
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{ $error }}');
        @endforeach
    @endif
</script>






</body>


</html>
