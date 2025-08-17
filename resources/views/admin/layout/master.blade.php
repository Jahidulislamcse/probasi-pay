<!doctype html>
<html lang="en">

<head>

    @yield('meta')
    @include('admin.layout.header')

    @yield('style')

    <style>
        .rounded-pill {
            border-radius: 50rem !important;
        }

        .text-bg-warning {
            color: #000 !important;
            background-color: RGBA(255, 193, 7, var(--bs-bg-opacity, 1)) !important;
        }

        .text-bg-success {
            color: #fff !important;
            background-color: RGBA(25, 135, 84, var(--bs-bg-opacity, 1)) !important;
        }

        .text-bg-danger {
            color: #fff !important;
            background-color: RGBA(220, 53, 69, var(--bs-bg-opacity, 1)) !important;
        }
    </style>
</head>

<body>

    <div id="notification-bar"
        style="display:none; position:fixed; top:0; left:0; width:100%; background:#0006ffbf; padding:10px; text-align:center; z-index:9999; color:#fff">
    </div>
    @yield('main')

    @include('admin.layout.footer')

    @yield('script')


</body>
