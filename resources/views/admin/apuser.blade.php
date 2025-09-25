<div class="app-header">
    <div class="tf-container">
        <div class="tf-topbar d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <div class="left-column">
                    @php
                    if (preg_match('/^data:image\/(\w+);base64,/', auth()->user()->image)) {
                    $user_image = auth()->user()->image;
                    } else {
                    $user_image = asset(auth()->user()->image);
                    }
                    @endphp
                    <img src="{{ $user_image ? $user_image : asset('images/avatar.png') }}" alt="image" class="user-image">
                </div>
                <div class="right-column">
                    <span class="white_color fw_4 user-name">{{ auth()->user()->name }}</span>
                    <button id="balance" onclick="toggleBalance()" class="balance-btn">
                        ব্যালেন্স দেখুন
                    </button>
                </div>
            </div>

            <div class="logo-container">
                @if($generalSettings && $generalSettings->logo)
                <img src="{{ asset($generalSettings->logo) }}" alt="Company Logo" class="logo">
                @else
                <span>No Logo Available</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card-secton">
    <div class="tf-container">
        <div class="tf-balance-box main-card" >
            @if($country)
            <div class="rate-container">
                <div class="rate-button">
                    <button type="button" class="rate-btn">
                        রেট:
                    </button>
                </div>
                <div class="rate-text">
                    @if($rate)
                        <span>{{ $country->name }} {{ enToBnNumber(1) }} {{ $country->currency }} = {{ enToBnNumber(number_format($rate, 2)) }} টাকা</span>
                    @else
                        <span>Rate not found</span>
                    @endif
                </div>
            </div>



            <script>
                console.log('Currency rate:', {
                    {
                        $rate ?? 'null'
                    }
                });
            </script>
            @endif

            <div class="wallet-footer mt-4">
                <ul class="d-flex justify-content-between align-items-center">
                    <li class="wallet-card-item">
                    <a href="javascript:void(0);" class="fw_6 text-center" data-bs-toggle="modal" data-bs-target="#fundModal">
                        <ul class="icon icon-group-transfers">
                            <img src="/images/front-icons/add.png">
                        </ul>
                        <div class="label">টাকা জমা</div>
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
                            <div class="label">ব্যাংক উত্তোলন</div>
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
                            <div class="label">কাস্টমার কেয়ার</div>
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

            <div class="wallet-footer">
                <ul class="d-flex justify-content-between align-items-center">
                    <li class="wallet-card-item target-footer">
                        <a class="fw_6" href="{{ route('bkash') }}">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/front-icons/bkash3.png">
                            </ul>
                            <div class="label">বিকাশ</div>
                        </a>
                    </li>
                    <li class="wallet-card-item target-footer">
                        <a class="fw_6" href="{{ route('nagad') }}">
                            <ul class="icon icon-topup">
                                <img src="/images/front-icons/nagad3.png">
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

                <!-- <div class="text-center toggle-buttons">
                    <button id="showMoreBtn" class="toggle-btn">আরো দেখুন</button>
                </div> -->
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

            <div class="wallet-footer more-items">
                <ul class="d-flex justify-content-between align-items-center">
                    
                    <li class="wallet-card-item">
                        <a href="{{ route('remittance') }}" class="fw_6 text-center" id="btn-popup-down">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/front-icons/remittance.png">
                            </ul>
                            <div class="label">রেমিটেন্স</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a class="fw_6 btn-card-popup" href="{{ route('tutorials') }}">
                            <ul class="icon icon-group-credit-card">
                                <img src="/images/front-icons/live_offer.png">
                            </ul>
                            <div class="label">টিউটোরিয়াল</div>
                        </a>
                    </li>
                    <li class="wallet-card-item">
                        <a href="{{ route('reviews.view') }}" class="fw_6 text-center" id="btn-popup-down">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/front-icons/review.png">
                            </ul>
                            <div class="label">কাস্টমার রিভিউ</div>
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
                    
                </ul>
            </div>

            <div class="text-center ">
                <button id="hideMoreBtn" class="toggle-btn" style="display:none;">বন্ধ করুন</button>
            </div>

        </div>
    </div>
</div>
<div class="notify" style=" margin: 0 10px;   border-radius: 15px; color: white; padding: 10px;font-size: 15px;line-height: 1.3;">

</div>

<div class="deposit-modal modal fade" id="fundModal" tabindex="-1" aria-labelledby="fundModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <div class="tf-container">
                    <a href="{{ route('topup') }}" class="action-sheet-transfer">
                        <div class="icon"><i style="color: #ff006e;" class="icon-friends"></i></div>
                        <div class="content">
                            <h2 style="color: #ff006e;">মোবাইল পে ফান্ড অ্যাড</h2>
                            <p class="white_color">বিকাশ , নগদ , রকেট, উপায় অ্যাড ফান্ড করুন</p>
                        </div>
                    </a>

                    <a href="/cash_pickup" class="action-sheet-transfer">
                        <div class="icon"><i style="color: #ff006e;" class="icon-bank2"></i></div>
                        <div class="content">
                            <h2 style="color: #ff006e;">ক্যাশ পিক আপ </h2>
                            <p class="white_color">সরাসরি অ্যাড ফান্ড করুন</p>
                        </div>
                    </a>

                    <a href="{{ route('bank.topup') }}" class="action-sheet-transfer">
                        <div class="icon"><i style="color: #ff006e;" class="icon-bank2"></i></div>
                        <div class="content">
                            <h2 style="color: #ff006e;">ব্যাংক ফান্ড অ্যাড</h2>
                            <p class="white_color">লোকাল ব্যাংকের মাধ্যমে এডফান্ড করুন</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
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
<!-- 
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
</script> -->

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

<style>
    .app-header {
        background-color: {{ $colors->header_color ?? '#067fab' }};
    }

    .main-card {
        background-color: {{ $colors->body_color ?? '#ffffff' }};
    }

    body {
        background-color: {{ $colors->body_color ?? '#ffffff' }};
    }
    .notify {
        background-color: {{ $colors->heading_background_color ?? '#ffffff' }};
    }


    .swiper-container.banner-slider {
        width: 100%;
        height: 100px;
        margin-top: 10px;
        padding-left: 5px;
        padding-right: 5px;
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
        bottom: 5px;
        margin-left: 50%;
        transform: translateX(-50%);
        z-index: 10;
    }

    .swiper-pagination-bullet {
        background-color: #111111ff;
    }

    .swiper-pagination-bullet-active {
        background-color: #067fab;
    }

    .swiper-button-next,
    .swiper-button-prev {
        display: none;
    }


    @font-face {
        font-family: 'SolaimanLipi';
        src: url('{{ asset(' fonts/solaimanlipi.ttf') }}') format('truetype');
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
        color: {{ $colors->headings_color ?? '#ffffff' }};
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

    .tf-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .left-column {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .user-image {
        margin-top: 5px;
        width: 50px;
        height: 50px;
        border-radius: 25%;
    }

    .right-column {
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin-left: 10px;
    }

    .user-name {
        font-size: 16px;
        margin-bottom: 5px;
    }

    .balance-btn {
        cursor: pointer;
        background-color: #ffffffff;
        color: #067fab;
        padding: 2px 10px;
        border-radius: 25px;
        text-align: center;
        border: none;
    }

    @media (max-width: 600px) {
        .balance-btn {
            font-size: 12px;
            padding: 3px 10px;
        }
    }

    .balance-btn:hover {
        background-color: #ffffffff;
        color: #067fab;  
    }

    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .logo {
        width: 130px;
        height: auto;
    }
    .rate-container {
        display: flex; 
        align-items: center; 
        justify-content: space-between; 
        background: linear-gradient(135deg, #00b5e2, #006b8f); 
        border-radius: 25px; 
        width: 100%; 
        padding-right: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
        margin: 0 auto; 
    }

    @media (min-width: 1024px) {
        .rate-container {
            width: 50%; 
            margin: 0 auto; 
        }
    }

    .rate-button {
        margin-right: 10px; 
    }

    .rate-btn {
        background-color: #006b8f; 
        color: white; 
        border: none; 
        padding: 8px 15px; 
        border-radius: 50px; 
        font-weight: bold;
        font-size: 14px;
        cursor: pointer;
    }

    .rate-btn:hover {
        background-color: #006b8f; 
        color: white; 
    }

    .rate-text {
        color: white; 
        font-size: 16px; 
        font-weight: bold; 
        text-align: right; 
    }
    .deposit-modal{
        margin-top: 10%;
    }
    @media (max-width: 600px) {
        .deposit-modal{
            margin-top: 30%;
        }
    }
    .deposit-modal .modal-content {
        background: rgba(255, 255, 255, 0.1); 
        backdrop-filter: blur(10px); 
        border-radius: 15px; 
        border: none; 
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); 
    }

    .deposit-modal .modal-body {
        color: white; 
        padding: 20px; 
        background: rgba(0, 0, 0, 0.4); 
        border-radius: 15px; 
    }

    .deposit-modal .modal-header {
        border-bottom: none; 
        color: white; 
    }

    .deposit-modal .btn-close {
        background: rgba(255, 255, 255, 0.5); 
        border-radius: 50%; 
        padding: 8px;
    }




</style>