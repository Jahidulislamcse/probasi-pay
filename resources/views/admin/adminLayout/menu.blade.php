<!-- Classy Nav -->
<div class="classy-nav-container breakpoint-off">
    <nav class="classy-navbar justify-content-between" id="classyNav">
        <div class="classy-navbar-toggler">
            <i class="fa fa-bars me-2" aria-hidden="true"></i>
            <span>Menu</span>
        </div>

        <div class="classy-menu">
            <div class="classycloseIcon">
                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
            </div>

            <!-- Nav Start -->
            <div class="classynav">


                <ul>
                    <li><a href="{{ route('admin.index') }}">Home</a></li>


                    @if (auth()->user()->role == 'super admin')
                        <li><a href="{{ route('topup.list') }}">Topup</a> </li>
                        <li><a href="{{ route('recharge.list') }}">Mobile Recharge</a> </li>
                        <li><a href="{{ route('bankpay.list') }}">Bank Pay</a> </li>
                        <li><a href="{{ route('billpay.list') }}">Bill Pay</a> </li>
                        <li><a href="#">Mobile Banking</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('bkash.list') }}">Bkash</a></li>
                                <li><a href="{{ route('nagad.list') }}">Nagad</a></li>
                                <li><a href="{{ route('rocket.list') }}">Rocket</a></li>
                                <li><a href="{{ route('upay.list') }}">Upay</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('user.list') }}">Customers</a> </li>
                        <li><a href="{{ route('notifications.index') }}">Notification</a> </li>

                        <li><a href="#">Chat</a>
                            <ul class="dropdown">

                                <li class="{{ Request::routeIs('chat.admin') ? 'active' : '' }}">
                                    <a href="{{ route('chat.admin') }}">Group Chat</a>
                                </li>
                                  <li class="{{ Request::routeIs('pending-chat') ? 'active' : '' }}">
                                    <a href="{{ route('pending-chat') }}">Pending Chat</a>
                                </li>
                            </ul>
                        </li>

                        <li><a href="#">Setting</a>
                            <ul class="dropdown">

                                <li class="{{ Request::routeIs('setting.general') ? 'active' : '' }}">
                                    <a href="{{ route('mobilebanking') }}">Mobile Banking</a>
                                </li>
                                <li class="{{ Request::routeIs('setting.general') ? 'active' : '' }}">
                                    <a href="{{ route('bank') }}">Bank Account</a>
                                </li>
                                <li class="{{ Request::routeIs('setting.general') ? 'active' : '' }}">
                                    <a href="{{ route('country') }}">Country</a>
                                </li>
                                <li class="{{ Request::routeIs('setting.general') ? 'active' : '' }}">
                                    <a href="{{ route('slider') }}">Slider</a>
                                </li>
                                <li class="{{ Request::routeIs('page') ? 'active' : '' }}">
                                    <a href="{{ route('page') }}">Content</a>
                                </li>
                                <li class="{{ Request::routeIs('setting.general') ? 'active' : '' }}">
                                    <a href="{{ route('setting.general') }}">Genral Setting</a>
                                </li>


                            </ul>
                        </li>
                        <li><a href="{{ route('review.upload') }}">Reviews</a></li>
                    @endif



                </ul>


            </div>
        </div>
    </nav>
</div>
