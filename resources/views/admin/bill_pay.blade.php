@extends('admin.layout.master')

@section('meta')
@endsection

@section('style')
<style>
    .image-radio-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .image-radio {
        display: flex;
        align-items: center;
        margin: 5px;
        cursor: pointer;
    }

    .image-radio input[type="radio"] {
        margin-right: 10px;
        width: 20px;
        height: 20px;
    }

    .radio-btn {
        display: inline-block;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: #fff;
        border: 2px solid #787878ff;
        margin-right: 10px;
    }

    .image-radio img {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        object-fit: cover;
    }

    .image-radio p {
        font-size: 14px;
        color: #000;
        margin: 0;
    }

    input[type="radio"]:checked+.radio-btn {
        background-color: #e74518ff;
        border-color: #6e6e6eff;
    }

    input[type="radio"]:checked+.radio-btn+img+p {
        color: #4CAF50;
    }
</style>
@endsection

@section('main')

<div class="app-header st1">
    <div class="tf-container">
        <div class="tf-topbar d-flex justify-content-center align-items-center">
            <a href="{{ route('admin.index') }}" class="back-btn"><i class="icon-left white_color"></i></a>
            <h3 class="white_color">বিল পে</h3>
        </div>
    </div>
</div>

<div class="card-secton topup-content mt-2">
    @php $country = country(); @endphp
    <form class="tf-form" method="post">
        @csrf
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="d-flex justify-content-between align-items-center"></div>
                <div class="image-radio-group">
                    <!-- Electricity Bill Option -->
                    <label class="image-radio">
                        <input type="radio" name="operator" checked value="বিদ্যুৎ বিল">
                        <span class="radio-btn"></span>
                        <img src="{{ asset('images/electricity.png') }}" alt="Electricity">
                        <p>বিদ্যুৎ</p>
                    </label>

                    <!-- Gas Bill Option -->
                    <label class="image-radio">
                        <input type="radio" name="operator" value="গ্যাস">
                        <span class="radio-btn"></span>
                        <img src="{{ asset('images/gas-bill.png') }}" alt="Gas">
                        <p>গ্যাস</p>
                    </label>

                    <!-- Water Bill Option -->
                    <label class="image-radio">
                        <input type="radio" name="operator" value="পানি">
                        <span class="radio-btn"></span>
                        <img src="{{ asset('images/73-730316_faucetnew11132015-utility-bill-icon-png.png') }}" alt="Water">
                        <p>পানি</p>
                    </label>

                    <!-- TV Bill Option -->
                    <label class="image-radio">
                        <input type="radio" name="operator" value="টিভি">
                        <span class="radio-btn"></span>
                        <img src="{{ asset('images/195149.png') }}" alt="TV">
                        <p>টিভি</p>
                    </label>

                    <!-- Internet Bill Option -->
                    <label class="image-radio">
                        <input type="radio" name="operator" value="ইন্টারনেট">
                        <span class="radio-btn"></span>
                        <img src="{{ asset('images/net-bill.png') }}" alt="Internet">
                        <p>ইন্টারনেট</p>
                    </label>
                </div>

                <!-- User ID Input -->
                <div class="tf-form">
                    <div class="form-group input-field input-money">
                        <label for="">ইউজার আইডি</label>
                        <input name="mobile" type="number" placeholder="00000000" maxlength="11" required>
                        <span class="icon-clear"></span>
                    </div>
                </div>

                <!-- Amount Input -->
                <div class="tf-form">
                    <div class="form-group input-field input-money">
                        <label for="">এমাউন্ট</label>
                        <input name="amount" type="number" max="{{ auth()->user()->balance }}" value="200" required class="search-field value_input st1">
                        <span class="icon-clear"></span>
                    </div>
                </div>

                <!-- Pin Input -->
                <div class="tf-form">
                    <div class="form-group input-field input-money">
                        <label for="">পিন</label>
                        <input name="pin" type="text" placeholder="123456" required>
                        <span class="icon-clear"></span>
                    </div>
                </div>

                <!-- Balance Display -->
                <h3 class="text-center" style="margin-top: 30px;">ব্যবহারযোগ্য ব্যালেন্স: {{ currency(auth()->user()->balance) }} টাকা</h3>
            </div>
        </div>

        <div class="bottom-navigation-bar">
            <div class="tf-container">
                <button type="submit" name="submit" class="tf-btn accent large">অ্যাড করুন</button>
            </div>
        </div>
    </form>
</div>

<div class="tf-panel up">
    <div class="panel_overlay"></div>
    <div class="panel-box panel-up wrap-content-panel"></div>
</div>

@endsection

@section('script')
@endsection