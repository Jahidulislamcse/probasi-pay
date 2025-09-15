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
<link rel="stylesheet" type="text/css" href="{{ asset('styles/styles.css') }}" />
<link rel="stylesheet" href="{{ asset('styles/swiper-bundle.min.css') }} ">
<link rel="apple-touch-icon" sizes="192x192" href="{{ asset('app/icons/icon-192x192.png') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali&display=swap" rel="stylesheet">


@php
$country = App\Models\Country::find(auth()->user()->location)
@endphp
@livewireStyles