<style>
    body {
        background: #ffffec;
    }
</style>
<style>
    @font-face {
        font-family: 'SolaimanLipi';
        src: url('{{ asset('fonts/solaimanlipi.ttf') }}') format('truetype');
        font-weight: 300;
        font-style: normal;
    }

    body,
    input,
    button,
    select,
    textarea {
        font-family: 'SolaimanLipi', 'Noto Sans Bengali', sans-serif !important;
        font-weight: 300;
        line-height: 1.6;
        letter-spacing: 0.2px;
        color: #222;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'SolaimanLipi', 'Noto Sans Bengali', sans-serif !important;
        font-weight: 400;
    }

    label,
    button,
    .btn,
    .fw_4,
    .fw_6,
    .nav-link {
        font-weight: 400 !important;
    }

    input::placeholder {
        color: #818181;
        opacity: 1;
    }

    input::-ms-input-placeholder {
        color: #818181;
    }

    .up-content-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        padding: 0 20px;
    }

    .up-content {
        margin-bottom: 5px;
    }

    .left-content {
        flex: 1;
        padding-left: 45px;
    }

    .right-content {
        flex: 1;
        text-align: right;
    }

    .white_color {
        color: white;
    }
</style>


<div class="app-header" style="margin-bottom: 30px;">
    <div class="tf-container">
        <div class="up-content-container">
            <div class="left-content">
                <h4 class="white_color">{{ siteInfo()->company_name }}</h4>
            </div>

            <div class="right-content">
                <p class="white_color">প্রবাসীদের সেবায় নিয়োজিত</p>
            </div>
        </div>

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
                <span class="white_color fw_4">{{ auth()->user()->name }}</span>
            </a>
            <div class="d-flex align-items-center gap-4">
                <p class="white_color fw_4" id="location-info">
                    {{ auth()->user()->country ? auth()->user()->country->name : 'লোকেশন পাওয়া যায়নি' }}
                </p>
            </div>
        </div>
    </div>
</div>
<div class="card-secton">
    <div class="tf-container">
        <div class="tf-balance-box" style="background:#ffe8d6;">
            <div class="balance">
                <div class="row">
                    <div class="col-6 br-right">
                        <div class="inner-left">
                            <h3 id="balance" onclick="toggleBalance()" style="cursor: pointer;background: #ff3130;color:white; padding: 2px;border-radius: 5px;text-align: center;">ব্যালেন্স দেখুন </h3>
                        </div>
                        <script>
                            function toggleBalance() {
                                const balanceElement = document.getElementById('balance');
                                const realBalance = "{{ number_format(auth()->user()->balance, 2) }} ৳";

                                if (balanceElement.innerText === 'ব্যালেন্স দেখুন') {
                                    balanceElement.innerText = realBalance;
                                    hideTimeout = setTimeout(() => {
                                        balanceElement.innerText = 'ব্যালেন্স দেখুন';
                                    }, 5000);
                                } else {
                                    balanceElement.innerText = 'ব্যালেন্স দেখুন';
                                }
                            }
                        </script>

                    </div>
                </div>
            </div>

            @if($country)
            <marquee behavior="scroll" direction="left" style="color:#ff3631;font-size: 19px;">
                @if($rate)
                আজকের রেট: {{ $country->name }} {{ enToBnNumber(1) }} {{ $country->currency }} = {{ enToBnNumber(number_format($rate, 2)) }} টাকা
                @else
                Rate not found
                @endif
            </marquee>

            <script>
                console.log('Currency rate:', {
                    {
                        $rate ?? 'null'
                    }
                });
            </script>
            @endif

            <div class="wallet-footer">
                <ul class="d-flex justify-content-between align-items-center">
                    <li class="wallet-card-item">
                        <a href="javascript:void(0);" class="fw_6 text-center" id="btn-popup-down">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/front-icons/add.png">
                            </ul>
                            <div class="label">সেন্ডমানি</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a class="fw_6" href="{{ route('recharge') }}">
                            <ul class="icon icon-topup">
                                <img src="/images/front-icons/recharge.png">
                            </ul>
                            <div class="label">মোবাইল রিচার্জ</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a class="fw_6 btn-card-popup" href="{{ route('billpay') }}">
                            <ul class="icon icon-group-credit-card">
                                <img src="/images/front-icons/bill.png">
                            </ul>
                            <div class="label">পে-বিল</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a href="{{ route('bankpay') }}" class="fw_6 text-center" id="btn-popup-down">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/front-icons/bank.png">
                            </ul>
                            <div class="label">ব্যাংক প্যামেন্ট</div>
                        </a>
                    </li>
                </ul>
            </div>


            <div class="wallet-footer">
                <ul class="d-flex justify-content-between align-items-center">
                    <li class="wallet-card-item">
                        <a class="fw_6 btn-card-popup" href="{{ route('support') }}">
                            <ul class="icon icon-group-credit-card">
                                <img src="/images/front-icons/loan.png">
                            </ul>
                            <div class="label">লোন</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a href="{{ route('chat') }}">
                            <ul class="icon icon-topup">
                                <img src="/images/front-icons/group-chat.png">
                            </ul>
                            <div class="label">গ্রপচ্যাট</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a class="fw_6 btn-card-popup" href="{{ route('helpline') }}">
                            <ul class="icon icon-group-credit-card">
                                <img src="/images/front-icons/live-chat.png">
                            </ul>
                            <div class="label">কাস্টমার সার্ভিস</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a class="fw_6" href="{{ route('history') }}">
                            <ul class="icon icon-my-qr">
                                <img src="/images/front-icons/transaction.png">
                            </ul>
                            <div class="label">লেনদেন বিবরণ</div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="wallet-footer ">
                <ul class="d-flex justify-content-between align-items-center">
                    <li class="wallet-card-item target-footer">
                        <a class="fw_6" href="{{ route('bkash') }}">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/front-icons/bkash.png">
                            </ul>
                            <div class="label">বিকাশ</div>
                        </a>
                    </li>
                    <li class="wallet-card-item target-footer">
                        <a class="fw_6" href="{{ route('nagad') }}">
                            <ul class="icon icon-topup">
                                <img src="/images/front-icons/nagad.png">
                            </ul>
                            <div class="label">নগদ</div>
                        </a>
                    </li>
                    <li class="wallet-card-item target-footer">
                        <a class="fw_6" href="{{ route('upay') }}">
                            <ul class="icon">
                                <img src="/images/front-icons/upay.png">
                            </ul>
                            <div class="label">উপায়</div>
                        </a>
                    </li>
                    <li class="wallet-card-item target-footer">
                        <a class="fw_6" href="{{ route('rocket') }}">
                            <ul class="icon icon-my-qr">
                                <img src="/images/front-icons/rocket.png">
                            </ul>
                            <div class="label">রকেট</div>
                        </a>
                    </li>
                </ul>

                <div class="text-center toggle-buttons">
                    <button id="showMoreBtn" class="toggle-btn">আরো দেখুন</button>
                </div>
            </div>

            <div class="wallet-footer more-items">
                <ul class="d-flex justify-content-between align-items-center">
                    <li class="wallet-card-item">
                        <a href="{{ route('rate') }}" class="fw_6 text-center" id="btn-popup-down">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/front-icons/exchange-rate.png">
                            </ul>
                            <div class="label">এক্সচেঞ্জ রেট</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a href="{{ route('remittance') }}" class="fw_6 text-center" id="btn-popup-down">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/front-icons/remittance.png">
                            </ul>
                            <div class="label">রেমিটেন্স</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a class="fw_6" href="{{ route('news') }}">
                            <ul class="icon icon-my-qr">
                                <img src="/images/front-icons/news.png">
                            </ul>
                            <div class="label">প্রবাসী খবর</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a class="fw_6 btn-card-popup" href="{{ route('tutorials') }}">
                            <ul class="icon icon-group-credit-card">
                                <img src="/images/front-icons/live_offer.png">
                            </ul>
                            <div class="label">টিউটোরিয়াল ও অফার</div>
                        </a>
                    </li>
                </ul>
            </div>


            <div class="text-center ">
                <button id="hideMoreBtn" class="toggle-btn" style="display:none;">বন্ধ করুন</button>
            </div>


            @if($banners->count() > 0)
            <div style="text-align: center;" class=" mb-4">
                <div class="swiper-container banner-slider">
                    <div class="swiper-wrapper">
                        @foreach ($banners as $banner)
                        <div class="swiper-slide">
                            <img src="{{ asset($banner->image) }}" alt="Banner" class="img-fluid" style="border-radius: 10px; width: 100%; height: 100%;">
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            @endif

            <div class="wallet-footer">
                <ul class="d-flex justify-content-between align-items-center">
                    <li class="wallet-card-item">
                        <a href="{{ route('reviews.view') }}" class="fw_6 text-center" id="btn-popup-down">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/front-icons/review.png">
                            </ul>
                            <div class="label">রিভিউ</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a class="fw_6" href="{{ route('about') }}">
                            <ul class="icon icon-my-qr">
                                <img src="/images/front-icons/about.png">
                            </ul>
                            <div class="label">আরো জানুন</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a class="fw_6" href="">
                            <ul class="icon icon-my-qr">
                            </ul>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a class="fw_6" href="">
                            <ul class="icon icon-my-qr">
                            </ul>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="tf-panel down">
    <div class="panel_overlay"></div>
    <div class="panel-box panel-down">
        <div class="header bg_white_color">
            <div class="tf-container">
                <div class="tf-statusbar d-flex justify-content-center align-items-center">
                    <a href="#" class="clear-panel"> <i class="icon-close1"></i> </a>
                    <h3>অ্যাড ফান্ড</h3>
                    <a href="#" class="action-right"></a>
                </div>
            </div>
        </div>
        <div class="wrap-transfer mb-5">
            <div class="tf-container">

                <a href="{{ route('topup') }}" class="action-sheet-transfer">
                    <div class="icon"><i style="color:#ff3130;" class="icon-friends"></i></div>
                    <div class="content">
                        <h4 class=" " style="color:#ff3130;">মোবাইল পে ফান্ড অ্যাড</h4>
                        <p>বিকাশ , নগদ , রকেট, উপায় অ্যাড ফান্ড করুন</p>
                    </div>

                </a>

                <a href="/helpline" class="action-sheet-transfer">
                    <div class="icon"><i style="color:#ff3130;" class="icon-bank2"></i></div>
                    <div class="content">
                        <h4 class="" style="color:#ff3130;">ক্যাশ পিক আপ </h4>
                        <p>সরাসরি অ্যাড ফান্ড করুন</p>
                    </div>
                </a>

                <a href="{{ route('bank.topup') }}" class="action-sheet-transfer">
                    <div class="icon"><i style="color:#ff3130;" class="icon-bank2"></i></div>
                    <div class="content">
                        <h4 class="" style="color:#ff3130;">ব্যাংক ফান্ড অ্যাড</h4>
                        <p>সকল ব্যাংকের মাধ্যমে অ্যাড ফান্ড করুন</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>

<div class="notify" style=" margin: 10px;background: #cd1307;    border-radius: 15px; color: white; padding: 10px;font-size: 20px;line-height: 1.3;margin-bottom: 79px;">

</div>


<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script type="text/javascript">
    var swiper = new Swiper('.banner-slider', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: false,
    });
</script>

<script>
    document.getElementById('showMoreBtn').addEventListener('click', function() {
        document.querySelector('.more-items').classList.add('show');
        document.getElementById('showMoreBtn').style.display = 'none';
        document.getElementById('hideMoreBtn').style.display = 'inline-block';

        document.querySelectorAll('.target-footer').forEach(function(item) {
            item.style.opacity = '1';
        });
    });

    document.getElementById('hideMoreBtn').addEventListener('click', function() {
        document.querySelector('.more-items').classList.remove('show');
        document.getElementById('hideMoreBtn').style.display = 'none';
        document.getElementById('showMoreBtn').style.display = 'inline-block';

        document.querySelectorAll('.target-footer').forEach(function(item) {
            item.style.opacity = '0.3';
        });
    });
</script>

<style>
    .swiper-container.banner-slider {
        width: 100%;
        height: 120px;
        margin-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
        box-sizing: border-box;
        overflow: hidden;
        position: relative;
    }

    @media (max-width: 768px) {
        .swiper-container.banner-slider {
            height: 80px;
        }
    }

    .swiper-slide img {
        border-radius: 15px;
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .swiper-pagination {
        position: absolute;
        bottom: 10px;
        margin-left: 50%;
        transform: translateX(-50%);
        z-index: 10;
    }

    .swiper-pagination-bullet {
        background-color: #111111ff;
    }

    .swiper-pagination-bullet-active {
        background-color: #ff3130;
    }

    .swiper-button-next,
    .swiper-button-prev {
        display: none;
</style>
