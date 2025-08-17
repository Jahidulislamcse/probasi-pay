<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="top-header-left">


                </div>
                <div class="top-header-right" style="   display: inline-flex;color: #fff;">

                    <p><i class="fas fa-phone"></i>{{ @siteInfo()->phone }}</p>
                    <p><i class="far fa-envelope"></i>{{ @siteInfo()->email }}</p>

                </div>
            </div>

        </div>
    </div>
</div>



<div class="container">
    <nav>
        <div class="menu">
            <!-- Logo -->
            <div class="logo">
                <a href="{{  route('index')  }}"><img src="{{ asset(@siteInfo()->logo) }}"
                        alt="{{ @siteInfo()->company_name }}"></a>
            </div>
    
            <!-- Menu Items -->
            <button class="menu-toggle" id="menuToggle">&#9776;</button>
    
            <ul>
                <li><a href="{{  route('index')  }}">Home</a></li>
                <li><a href="{{  route('order.now') }}">Order Now</a></li>
                <li><a href="{{  route('order.index') }}">Order History</a></li>
                <li><a href="{{  route('contact') }}">Contact us</a></li>
            
                @if (auth()->check())
                    <li class="signupbtn">
                        <a 
                            href="{{ route('admin.index') }}" title="Login">
                            <i class="fas fa-user "></i>
                            <span >Dashboard</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('profile') }}" class="dropdown-item"><i class="bx bx-user font-15"
                                aria-hidden="true"></i>
                            My profile</a></li>
                            <li><form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" href="#" class="dropdown-item"><i class="bx bx-power-off font-15"
                                    aria-hidden="true"></i> Sign-out</button>
                             </form></li>
                        </ul>
                    </li>
                @else
                    <li class="loginbtn">
                        <a 
                            href="{{ route('login') }}" title="Login">
                            <i class="fas fa-user "></i>
                            <span >Login</span>
                        </a>
                    </li>
                    <li class="signupbtn">
                        <a 
                            href="{{ route('register') }}" title="Login">
                            <i class="fas fa-user "></i>
                            <span >Register</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>
