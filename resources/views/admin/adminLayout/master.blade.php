<!doctype html>
<html lang="en">

<head>
    

    @yield('meta')
    @include('admin.adminLayout.header')

    @yield('style')
    <!-- Must needed plugins to the run this Template -->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }} "></script>

    <script src="{{ asset('admin/js/todo-list.js') }} "></script>
    <script src="{{ asset('admin/js/default-assets/top-menu.js') }} "></script>

    <!-- These plugins only need for the run this page -->
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <script src="{{ asset('admin/js/jszip.min.js') }}"></script>
    <script src="{{asset('admin/js/sweetalert2.all.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
        integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Active JS -->
    <script src="{{ asset('admin/js/default-assets/active.js') }} "></script>
    @livewireScripts
</head>
    <style>
        table {
            overflow: scroll;
        }
    </style>
<body>

    <div class="flapt-page-wrapper">

        @include('admin.adminLayout.nav')

        <div class="flapt-top-menu-page-content">
            <!-- Main Content Area -->
            <div class="main-content introduction-farm">
                <div class="content-wraper-area">
                    <div class="dashboard-area">
                        <div class="container" >
                            @yield('main')
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.adminLayout.footer')

        @yield('script')

</body>
