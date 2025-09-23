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
    <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" >
    <style>
        video {
            transform: scaleX(1);
        }
    </style>
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
                <a href="{{  route('register')  }}" class="back-btn"> <i class="icon-left"></i> </a>
                <h3>ভেরিফিকেশন তথ্য</h3>
            </div>
        </div>
    </div>
    <div class="mt-3 register-section">
        <h4 class="text-center mb-2">আপনার মূখমন্ডলের একটি ছবি তুলুন</h4>
        <div class="tf-container">
            <form method="POST" action="{{ route('register.image') }}" enctype="multipart/form-data">
                @csrf
                <canvas id="canvas"  style="height:auto;width:320px;display:none;"></canvas>
                <video id="video" autoplay  style="height:auto;width:320px;background: #243634;border-radius: 20px;object-fit:cover"></video>
                <br>
                <button type="button" id="snap" class="btn btn-small btn-success">ছবি তুলুন</button>
                <br><br>

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
                <button type="submit"  class="btn  btn-primary">পরবর্তী ধাপ</button>
            </form>

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

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d');
        const snapButton = document.getElementById('snap');
        const photoInput = document.getElementById('photoInput');

        // ক্যামেরা চালু
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                alert("ক্যামেরা চালু করা যাচ্ছে না। ত্রুটি: " + err);
            });


        // ছবি তোলা
        snapButton.addEventListener('click', () => {
            canvas.style.display = 'block';
            video.style.display = 'none';
            const aspectRatio = video.videoHeight / video.videoWidth;
            canvas.height = canvas.width * aspectRatio;
           
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/png');
            photoInput.value = imageData;
        });
    </script>



</body>


<!-- Mirrored from themesflat.co/html/alipay/alipay-app-pwa/05_register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Aug 2024 17:00:40 GMT -->

</html>
