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

        :root {
            --bottom-bar-height: 90px;
        }

        html,
        body {
            min-height: 100%;
            height: auto;
            overflow-y: auto;
        }

        .app-header {
            position: static;
        }

        .bottom-navigation-bar {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 999;
        }

        body {
            padding-bottom: calc(var(--bottom-bar-height) + env(safe-area-inset-bottom));
        }

        [style*="100vh"],
        .vh-100,
        .h-screen {
            height: auto !important;
            max-height: none !important;
            overflow: visible !important;
        }

        .preload.preload-container,
        .tf-panel.up .panel_overlay {
            pointer-events: none;
        }
    </style>
</head>

<body>

    <div id="notification-bar"
        style="display:none; position:fixed; top:0; left:0; width:100%; background:#0006ffbf;
        padding:10px; text-align:center; z-index:9999; color:#fff">
    </div>

    @yield('main')

    @include('admin.layout.footer')

    @yield('script')

    <script>
        window.addEventListener('load', function () {
            document.body.classList.remove('no-scroll', 'overflow-hidden', 'modal-open');
            document.body.style.overflowY = 'auto';
            document.documentElement.style.overflowY = 'auto';

            const preloader = document.querySelector('.preload.preload-container');
            if (preloader) {
                preloader.style.display = 'none';
            }
        });
    </script>

</body>
</html>
