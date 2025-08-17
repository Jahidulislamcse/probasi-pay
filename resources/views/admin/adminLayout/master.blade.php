<!doctype html>
<html lang="en">

<head>

    @yield('meta')
    @include('admin.adminLayout.header')

    @yield('style')
</head>
    <style>
        table {
            overflow: scroll;
        }
    </style>
<body>
    <!-- Preloader -->
    <!--<div id="preloader">-->
    <!--    <div class="preloader-book">-->
    <!--        <div class="inner">-->
    <!--            <div class="left"></div>-->
    <!--            <div class="middle"></div>-->
    <!--            <div class="right"></div>-->
    <!--        </div>-->
    <!--        <ul>-->
    <!--            <li></li>-->
    <!--            <li></li>-->
    <!--            <li></li>-->
    <!--            <li></li>-->
    <!--            <li></li>-->
    <!--            <li></li>-->
    <!--            <li></li>-->
    <!--            <li></li>-->
    <!--            <li></li>-->
    <!--            <li></li>-->
    <!--        </ul>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- ======================================
    ******* Page Wrapper Area Start **********
    ======================================= -->
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