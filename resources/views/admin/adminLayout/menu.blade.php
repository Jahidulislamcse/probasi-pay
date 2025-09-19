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
                    <li><a href="{{ route('topup.list') }}">Diposits</a> </li>
                    <li><a href="{{ route('recharge.list') }}">Mobile Recharge</a> </li>
                    <li><a href="">Withdraw Requests</a>
                        <ul class="dropdown">
                            <li><a href="{{ route('bankpay.list') }}">Bank </a> </li>
                            <li><a href="">Mobile Banking </a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('bkash.list') }}">Bkash</a></li>
                                    <li><a href="{{ route('nagad.list') }}">Nagad</a></li>
                                    <li><a href="{{ route('rocket.list') }}">Rocket</a></li>
                                    <li><a href="{{ route('upay.list') }}">Upay</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li><a href="{{ route('billpay.list') }}">Bill Pay</a> </li>
                    <li><a href="{{ route('remittance.list') }}">Remittance</a> </li>
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

                            <li class="{{ Request::routeIs('mobilebanking') ? 'active' : '' }}">
                                <a href="{{ route('mobilebanking') }}">Mobile Banking</a>
                            </li>
                            <li class="{{ Request::routeIs('bank') ? 'active' : '' }}">
                                <a href="{{ route('bank') }}">Bank Account</a>
                            </li>
                            <li class="{{ Request::routeIs('admin.payable_accounts.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.payable_accounts.index') }}">Payable Accounts</a>
                            </li>
                            <li class="{{ Request::routeIs('admin.commission.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.commission.index') }}">Commissions</a>
                            </li>
                            <li class="{{ Request::routeIs('country') ? 'active' : '' }}">
                                <a href="{{ route('country') }}">Country</a>
                            </li>
                            <li class="{{ Request::routeIs('slider') ? 'active' : '' }}">
                                <a href="{{ route('slider') }}">Slider</a>
                            </li>
                            <li class="{{ Request::routeIs('page') ? 'active' : '' }}">
                                <a href="{{ route('page') }}">Content</a>
                            </li>
                            <li class="{{ Request::routeIs('setting.general') ? 'active' : '' }}">
                                <a href="{{ route('setting.general') }}">Genral Setting</a>
                            </li>
                            <li class="{{ Request::routeIs('review.upload') ? 'active' : '' }}">
                                <a href="{{ route('review.upload') }}">Reviews</a>
                            </li>
                            <li class="{{ Request::routeIs('admin.banners.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.banners.index') }}">Banners</a>
                            </li>
                            <li class="{{ Request::routeIs('admin.colors.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.colors.index') }}">Color Setting</a>
                            </li>
                             <li class="{{ Request::routeIs('guides.index') ? 'active' : '' }}">
                                <a href="{{ route('guides.index') }}">App Guide</a>
                            </li>
                        </ul>
                    </li>

                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>