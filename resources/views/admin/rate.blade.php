@extends('admin.layout.master')
@section('meta')
<link rel="canonical" href="{{ route('admin.index') }}" />
@endsection
@section('style')
@endsection
@section('main')

<div class="app-header st1">
    <div class="tf-container">
        <div class="tf-topbar d-flex justify-content-center align-items-center">
            <a href="{{ route('admin.index') }}" class="back-btn"><i class="icon-left white_color"></i></a>
            <h3 class="white_color">রেট ক্যালকুলেটর</h3>
        </div>
    </div>
</div>

<div class="container mt-6">
    <div class="main">
        <div class="form-group">
            <h2>
                কত টাকা এক্সচেঞ্জ করতে চাচ্ছেন :
            </h2>
        </div>
        <div style="padding:10px;"></div>
        <div class="row">
            <form>
                @php $country = country(); @endphp
                <input style="display:none;" type="text" value="{{   @$country->rate  }}" id="firstNumber" readonly><br>
                <div style="padding:10px;"></div>
                <label>বৈদেশিক টাকার পরিমাণ লিখুন</label>
                <input type="text" id="secondNumber"><br>
                <div style="padding:10px;"></div>
                <input type="button" class="tf-btn btn-square accent" onClick="multiplyBy()" Value="কনভার্ট" />
            </form>
            <div style="padding:10px;"></div>
            <h2>
                আজকের এক্সচেঞ্জ রেট :
            </h2>
            <h1>
                <span id="result"></span>
            </h1>
        </div>


    </div>

</div>


<script>
    // Define a function to multiply two numbers and display the result
    function multiplyBy() {
        // Get the values of the input fields with the ids "firstNumber" and "secondNumber"
        num1 = document.getElementById("firstNumber").value;
        num2 = document.getElementById("secondNumber").value;

        // Set the inner HTML of the element with the id "result" to the product of the two numbers
        document.getElementById("result").innerHTML = num1 * num2;
    }

    // Define a function to divide two numbers and display the result
    function divideBy() {
        // Get the values of the input fields with the ids "firstNumber" and "secondNumber"
        num1 = document.getElementById("firstNumber").value;
        num2 = document.getElementById("secondNumber").value;

        // Set the inner HTML of the element with the id "result" to the quotient of the two numbers
        document.getElementById("result").innerHTML = num1 / num2;
    }
</script>
@endsection


@section('script')
@endsection