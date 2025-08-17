<!doctype html>
<html lang="en">

<head>
    <title>
        @if (@$title)
            {{ @$title }} - {{ @siteInfo()->company_name }}
        @else
            Welcome to {{ @siteInfo()->company_name }}
        @endif
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    @yield('meta')

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/superfish.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/slicknav.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/spacing.css">

    <link rel="stylesheet" href="{{ asset('frontend') }}/css/chosen.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/datatable.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/okayNav/2.0.4/css/common.min.css"
        integrity="sha512-xqNHxuE9T0Fgs+UPGON3GcVItfCExhkagkcZ9AiHmPM9bJDaaaeJTs4s4VblU7ec03STJXxgVQPxMIxyY4iC2Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/okayNav/2.0.4/css/okayNav.min.css"
        integrity="sha512-q/kNX4lBq/ekeNABHLxeJTlVVs4XR2sW1UZScx87rwrLK0wYnB717Bj8i+4RPs0M2N6sBexl2a5bdMgvPOl6ew=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .radio-hidden:checked~.radio-image {
            opacity: 1;
            transform: scale(1.5);
            background-color: rgb(239, 255, 170);
        }

        .radio-hidden {
            position: absolute;
            visibility: hidden;
        }

        .radio-image {
            width: 100px;
            opacity: .2;
        }



        .radio-container {
            background-color: white;
            margin: 9px;
            padding: 8px 10px;
            -webkit-box-shadow: 0px 15px 30px 0px rgba(16, 146, 147, 0.12);
            -moz-box-shadow: 0px 15px 30px 0px rgba(16, 146, 147, 0.12);
            box-shadow: 0px 15px 30px 0px rgb(0 0 0 / 12%);
            border-radius: 5px;
            -webkit-transition-duration: .2s;
            -moz-transition-duration: .2s;
            -o-transition-duration: .2s;
            transition-duration: .2s;
            cursor: pointer;
        }

        .input-group-text {
            display: flex;
            align-items: center;
            padding: .78rem .75rem;
            font-size: 1.5rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 0px;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.775rem .75rem;
            font-size: 1.5rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0px;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .loginbtn{
            border: 3px solid;
            border-radius: 50px;
        }

        .loginbtn:hover{
            border: 3px solid;
            border-radius: 50px;
            background: #000
        }
        
        .loginbtn > a {
            color: #fff ;
        }

        .signupbtn{
           
            border: 3px solid;
            border-radius: 50px;
            margin-left: 5px;
            background: #000;

        }

        .signupbtn:hover{
            border: 3px solid;
            border-radius: 50px;
            background: #ffffff
        }
        
        .signupbtn > a {
            color: #ffffff !important ;
        }

        .submenu{
            position: absolute;
            display: none !important;
            border: 3px solid;
            width: 143px;
        }

        .submenu > li{
            padding: 10px;
            border-bottom: 1px solid;
        }  
   
        .signupbtn:hover > .submenu{
            display: block !important;
        }

    </style>
    @livewireStyles
</head>

<body>

    @include('frontend.layout.header')


    @yield('main')


    @include('frontend.layout.footer')



    <!-- All JS Files -->
    <script src="{{ asset('frontend') }}/js/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/js/chosen.jquery.js"></script>
    <script src="{{ asset('frontend') }}/js/init.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/js/easing.min.js"></script>
    <script src="{{ asset('frontend') }}/js/wow.min.js"></script>
    <script src="{{ asset('frontend') }}/js/superfish.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.slicknav.min.js"></script>
    <script src="{{ asset('frontend') }}/js/viewportchecker.js"></script>
    <script src="{{ asset('frontend') }}/js/toastr.min.js"></script>
    <script src="{{ asset('frontend') }}/js/checkout.js"></script>
    <script src="{{ asset('frontend') }}/js/api.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/okayNav/2.0.4/js/jquery.okayNav-min.js"
        integrity="sha512-jUfjw0FclnvQxIqS9mYI3pw5Z0gVK3rr4Vs/HLT4Y0y+t/Go77td4zqJ2/N610AjkDzm0J3yukcMT9rKsC/Qig=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('frontend') }}/js/ltr.js"></script>

    @livewireScripts


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



        document.addEventListener('livewire:init', () => {

        });
        Livewire.on('cartAdded', (event) => {
            toastr.success('Item Added To cart')
        });

        // Toggle menu for mobile view
        const menuToggle = document.getElementById('menuToggle');
        const menu = document.querySelector('.menu');

        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('active');
        });
    </script>


</body>

</html>
