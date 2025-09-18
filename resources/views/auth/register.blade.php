<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Register</title>

    <!-- Favicon and Touch Icons -->
    <link rel="shortcut icon" href="images/logo.png" />
    <link rel="apple-touch-icon-precomposed" href="images/logo.png" />
    
    <!-- Font and Icons -->
    <link rel="stylesheet" href="fonts/fonts.css" />
    <link rel="stylesheet" href="fonts/icons-alipay.css">
    <link rel="stylesheet" href="styles/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="styles/styles.css" />
    
    <!-- Manifest and PWA support -->
    <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="192x192" href="app/icons/icon-192x192.png">

    <!-- Toastr CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <style>
        .custom-country-dropdown {
            position: relative;
            width: 100%;
            cursor: pointer;
        }

        .selected-country {
            background: #f0f0f0;
            padding: 13px;
            border-radius: 6px;
        }

        .country-list {
            display: none;
            position: absolute;
            width: 100%;
            background: white;
            border: 1px solid #ccc;
            border-radius: 6px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
        }

        .country-list li {
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .country-list li:hover {
            background-color: #e6f7ff;
        }

        .country-list.show {
            display: block;
        }

        .radio-button-group {
            display: flex;
            gap: 10px;
        }

        .radio-button-group input[type="radio"] {
            display: none; /* hide the default radio */
        }

        .radio-button-group label {
            color: #067fab;
            background-color: #ffffff;
            border: 2px solid #ffc3c3;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 20px;
            padding: 10px;
        }

        .radio-button-group input[type="radio"]:checked+label {
            background-color: #067fab;
            color: white;
            border-color: #067fab;
            font-size: 20px;
            padding: 10px;
        }
    </style>

</head>

<body>
    <!-- Preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- End of Preload -->

    <!-- Header Section -->
    <div class="header">
        <div class="tf-container">
            <div class="tf-statusbar br-none d-flex justify-content-center align-items-center" style="background: #067fab;">
                <a href="{{ route('login') }}" class="back-btn"> <i class="icon-left text-white"></i> </a>
            </div>
        </div>
    </div>
    <!-- End of Header Section -->

    <!-- Register Section -->
    <div class="mt-3 register-section" style="padding: 20px 20px;">
        <div class="tf-container">
            @if(siteInfo() && siteInfo()->logo)
                <img src="{{ asset(siteInfo()->logo) }}" style="margin-left:25%; width:50%; height:50%; margin-top:20px; margin-bottom:20px;">
            @endif

            <form class="tf-form" action="{{ route('register.data') }}" method="post">
                @csrf

                <!-- Name Input -->
                <div class="group-input">
                    <label>নাম</label>
                    <input name="name" type="text" placeholder="Your Full Name" required>
                </div>

                <!-- Country and Mobile Number -->
                <div class="row">
                    <div class="col-5" style="padding-right: 0px;">
                        <div class="custom-country-dropdown">
                            <label>দেশ</label>
                            <div class="form-control selected-country" style="font-size:12px" onclick="toggleCountryDropdown()">দেশ </div>
                            <ul class="country-list" id="countryDropdown">
                                @foreach (App\Models\Country::all() as $data)
                                    <li onclick="selectCountry('{{ $data->id }}', '{{ asset($data->image) }}', '{{ @$data->name }}')">
                                        <img src="{{ asset(@$data->image) }}" alt="{{ @$data->name }}" style=" height: 25px; width: 40px;">
                                        {{ @$data->name }}
                                    </li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="location" id="countryInput" required>
                        </div>
                    </div>

                    <div class="col-7">
                        <div class="group-input">
                            <label>মোবাইল নম্বর</label>
                            <input name="email" type="number" minlength="11" maxlength="11" placeholder="01700000000" required>
                        </div>
                    </div>
                </div>

                <!-- Password and Confirmation -->
                <div class="group-input">
                    <label>পাসওয়ার্ড</label>
                    <input type="password" name="password" placeholder="6-20 characters" required>
                </div>
                <div class="group-input" style=" margin-bottom: 5px; ">
                    <label>পাসওয়ার্ড নিশ্চিত করুন</label>
                    <input type="password" name="password_confirmation" placeholder="6-20 characters" required>
                </div>

                <!-- Account Type Selection -->
                <h4 class="text-center" style="margin-top:15px; margin-bottom:15px;">একাউন্টের ধরণ সিলেক্ট করুন</h4>
                <div class="row">
                    <div class="col-6 d-flex justify-content-center">
                        <div class="radio-button-group">
                            <input type="radio" id="option1" class="radio-option" name="type" value="personal" checked>
                            <label for="option1">পার্সোনাল</label>
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-center">
                        <div class="radio-button-group">
                            <input type="radio" id="option2" class="radio-option" name="type" value="bussiness">
                            <label for="option2">বিজনেস</label>
                        </div>
                    </div>
                </div>

                <!-- Hidden Role Input -->
                <div style="display:none;" class="group-input">
                    <label>Role</label>
                    <input type="text" name="role" value="digital-marketing">
                </div>

                <!-- Submit Button -->
                <button type="submit" name="submit" class="tf-btn accent large" style="margin-top: 10px; background: #067fab; border: 1px solid #067fab;">
                    এগিয়ে যান
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-5">
                <div class="row">
                    <div class="col-7">
                        <h2 style="margin: 10px;"> ইতিমধ্যেই নিবন্ধিত? </h2>
                    </div>
                    <div class="col-5">
                        <a href="{{ route('login') }}" class="tf-btn accent small" style="padding: 5px; width: 100%; background: #067fab;">লগইন করুন</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Register Section -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">শর্তাবলী</h5>
                    <button class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Terms content here -->
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal -->

    <!-- Scripts -->
    <script type="text/javascript" src="javascript/jquery.min.js"></script>
    <script type="text/javascript" src="javascript/bootstrap.min.js"></script>
    <script type="text/javascript" src="javascript/password-addon.js"></script>
    <script type="text/javascript" src="javascript/main.js"></script>
    <script type="text/javascript" src="javascript/init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    <!-- Toastr Script -->
    <script>
        @if(session()->get('response') === false)
            toastr.error('{{ session()->get('msg') }}');
        @endif
        @if(session()->get('response') === true)
            toastr.success('{{ session()->get('msg') }}');
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        @endif
    </script>

    <!-- Country Dropdown Script -->
    <script>
        function toggleCountryDropdown() {
            document.getElementById('countryDropdown').classList.toggle('show');
        }

        function selectCountry(id, flagUrl, name) {
            const selected = document.querySelector('.selected-country');
            selected.innerHTML = `<img src="${flagUrl}" style="height: 25px;width: 40px;"> ${name}`;
            document.getElementById('countryInput').value = id;
            toggleCountryDropdown();
        }

        window.addEventListener('click', function (e) {
            if (!e.target.closest('.custom-country-dropdown')) {
                document.getElementById('countryDropdown').classList.remove('show');
            }
        });
    </script>
</body>

</html>
