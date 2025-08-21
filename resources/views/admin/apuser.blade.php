<style>
body{
    background:#ffffec;
}

</style>
<div class="card-secton" >
    <div class="tf-container" >
        <div class="tf-balance-box" style="background:#ffe8d6;">
            <div class="balance">
                <div class="row">
                    <div class="col-6 br-right">
                        <div class="inner-left">
                            <p style="color:#ff3631;">আপনার বর্তমান ব্যালেন্স</p>
                            <h3 id="balance" onclick="toggleBalance()" style="cursor: pointer;background: #ff3130;color:white; padding: 2px;border-radius: 5px;text-align: center;">ব্যালেন্স দেখুন    </h3>
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
                    <div class="col-6">
                        <div class="inner-right">
                            <p style="color:#ff3631;">আপনাকে স্বাগতম</p>
                            <h3 style="color:#591616;">

                                {{ auth()->user()->name }}
                                <span></span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            @if($country)
                <marquee behavior="scroll" direction="left" style="color:#ff3631;font-size: 19px;">
                    @if($rate)
                        Today's rate: {{ $country->name }} 1 {{ $country->currency }} = {{ number_format($rate, 2) }} BDT
                    @else
                        Rate not found
                    @endif
                </marquee>

                <script>
                    console.log('Currency rate:', {{ $rate ?? 'null' }});
                </script>
            @endif



            <div class="wallet-footer">
                <ul class="d-flex justify-content-between align-items-center">
                    <li class="wallet-card-item">
                        <a href="javascript:void(0);" class="fw_6 text-center" id="btn-popup-down">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/banner/add.png">
                            </ul>

                        </a>
                    </li>
                    <li class="wallet-card-item"><a class="fw_6" href="{{ route('recharge') }}">
                            <ul class="icon icon-topup">
                                <img src="/images/banner/mobilere.png">
                            </ul>

                        </a></li>
                    <li class="wallet-card-item"><a class="fw_6 btn-card-popup" href="{{ route('billpay') }}">
                            <ul class="icon icon-group-credit-card">
                                <img src="/images/banner/bill.png">
                            </ul>

                        </a></li>
                    <li class="wallet-card-item"> <a href="{{ route('bankpay') }}" class="fw_6 text-center"
                            id="btn-popup-down">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/banner/bank.png">
                            </ul>
                        </a></li>
                </ul>
            </div>

            <div class="wallet-footer">
                <ul class="d-flex justify-content-between align-items-center">
                    <li class="wallet-card-item">
                        <a class="fw_6 btn-card-popup" href="{{ route('support') }}">
                            <ul class="icon icon-group-credit-card">
                                <img src="/images/banner/support.png">
                            </ul>

                        </a>
                    </li>
                    <li class="wallet-card-item"> <a href="{{ route('chat') }}">
                            <ul class="icon icon-topup">
                                <img src="/images/banner/group.png">
                            </ul>
                        </a></li>
                    <li class="wallet-card-item"><a class="fw_6 btn-card-popup" href="{{ route('helpline') }}">
                            <ul class="icon icon-group-credit-card">
                                <img src="/images/banner/helpline.png">
                            </ul>

                        </a></li>
                    <li class="wallet-card-item"><a class="fw_6" href="{{ route('history') }}">
                            <ul class="icon icon-my-qr">
                                <img src="/images/banner/history.png">
                            </ul>
                        </a></li>
                </ul>
            </div>
                @if(App\Models\slider::count() > 0)
            <div style="text-align: center;" class="wallet-footer">
                <ul class="d-flex justify-content-between align-items-center">

                </ul>
            </div>

            <div class="mt-5 mb-9" style="margin-top: -4px !important;margin-bottom: 8px !important;">
                <div class="tf-container">

                    <div class="mt-5">
                        <div class="swiper-container banner-tes">
                            <div class="swiper-wrapper">
                                @foreach (App\Models\slider::all() as $slider)
                                    <div class="swiper-slide">
                                        <img src="{{ asset($slider->image) }}" alt="images">
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endif

            <div class="wallet-footer">
                <ul class="d-flex justify-content-between align-items-center">

                    <li class="wallet-card-item"><a class="fw_6" href="{{ route('bkash') }}">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/banner/bkash.png">
                            </ul>

                        </a>
                    </li>
                    <li class="wallet-card-item"><a class="fw_6" href="{{ route('nagad') }}">
                            <ul class="icon icon-topup">
                                <img src="/images/banner/nagad.png">
                            </ul>
                        </a></li>
                    <li class="wallet-card-item"><a class="fw_6" href="{{ route('upay') }}">
                            <ul class="icon icon-group-credit-card">
                                <img src="/images/banner/upay.png">
                            </ul>

                        </a></li>
                    <li class="wallet-card-item"><a class="fw_6" href="{{ route('rocket') }}">
                            <ul class="icon icon-my-qr">
                                <img src="/images/banner/rocket.png">
                            </ul>
                        </a></li>
                </ul>
            </div>

            <div class="wallet-footer">
                <ul class="d-flex justify-content-between align-items-center">
                    <li class="wallet-card-item">
                        <a href="{{ route('rate') }}" class="fw_6 text-center" id="btn-popup-down">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/banner/rate.png">
                            </ul>

                        </a>
                    </li>
                    <li class="wallet-card-item"><a class="fw_6" href="{{ route('news') }}">
                            <ul class="icon icon-my-qr">
                                <img src="/images/banner/news.png">
                            </ul>
                        </a></li>
                    <li class="wallet-card-item"><a class="fw_6 btn-card-popup" href="{{ route('tutorials') }}">
                            <ul class="icon icon-group-credit-card">
                                <img src="/images/banner/help.png">
                            </ul>

                        </a></li>
                    <li class="wallet-card-item"><a class="fw_6" href="{{ route('about') }}">
                            <ul class="icon icon-my-qr">
                                <img src="/images/banner/about.png">
                            </ul>
                        </a></li>
                </ul>
            </div>

             <div class="wallet-footer">
                <ul class="d-flex justify-content-between align-items-center">
                    <li class="wallet-card-item">
                        <a href="{{ route('reviews.view') }}" class="fw_6 text-center" id="btn-popup-down">
                            <ul class="icon icon-group-transfers">
                                <img src="/images/banner/review.png">
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






