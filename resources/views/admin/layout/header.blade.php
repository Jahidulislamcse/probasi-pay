
<meta http-equiv="refresh" content="360">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
<title>{{ siteInfo()->company_name }}জ</title>
<!-- Favicon and Touch Icons  -->
<link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />
<link rel="apple-touch-icon-precomposed" href="{{ asset('images/logo.png') }}" />
<!-- Font -->
<link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}" />
<!-- Icons -->
<link rel="stylesheet" href="{{ asset('fonts/icons-alipay.css') }}">
<link rel="stylesheet" href="{{ asset('styles/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('styles/swiper-bundle.min.css') }} ">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/styles.css') }}" />
<link rel="apple-touch-icon" sizes="192x192" href="{{ asset('app/icons/icon-192x192.png') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali&display=swap" rel="stylesheet">
<style>
        @font-face {
        font-family: 'Sabina Shorolipi';
        src: url('{{ asset('fonts/sabina-shorolipi.ttf') }}') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    body {
        font-family: 'Sabina Shorolipi', sans-serif;
    }
    input::placeholder {
      color: #818181;
      opacity: 1; /* Firefox */
    }
    input::-ms-input-placeholder { /* Edge 12 -18 */
      color: #818181;
    }
</style>


    <div class="app-header" style="margin-bottom: 30px;">
        <div class="tf-container">
            <div class="tf-topbar d-flex justify-content-between align-items-center">

                <a class="user-info d-flex justify-content-between align-items-center" href="{{ route('profile') }}">

                    @php
                        if (preg_match('/^data:image\/(\w+);base64,/', auth()->user()->image)) {
                            $user_image = auth()->user()->image;
                        } else {
                            $user_image = asset(auth()->user()->image);
                        }
                    @endphp

                    <img src="{{ $user_image ? $user_image : asset('images/avatar.png') }} " alt="image">




                    <div class="content">
                        <h4 class="white_color">{{ siteInfo()->company_name }}</h4>
                        <p class="white_color fw_4">প্রবাসীদের সেবায় নিয়োজিত।</p>

                    </div>
                </a>
                <div class="d-flex align-items-center gap-4">
                    <p class="white_color fw_4" id="location-info">লোকেশন লোড হচ্ছে...</p>
                </div>
            </div>
        </div>
    </div>

    @php
    $country = App\Models\Country::find(auth()->user()->location)
    @endphp
@livewireStyles
