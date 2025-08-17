@extends('admin.adminLayout.master')
@section('meta')

<title>{{ isset($title)?$title:'welcome' }} - {{ env('APP_NAME') }}</title>


@endsection
@section('style')

<style>
    .avatar-upload {
        position: relative;
        max-width: 205px;


        .avatar-edit {
            position: absolute;

            z-index: 1;
            top: 10px;

            input {
                display: none;

                +label {
                    display: inline-block;
                    width: 34px;
                    height: 34px;
                    margin-bottom: 0;
                    border-radius: 100%;
                    background: #FFFFFF;
                    border: 1px solid transparent;
                    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
                    cursor: pointer;
                    font-weight: normal;
                    transition: all .2s ease-in-out;

                    &:hover {
                        background: #f1f1f1;
                        border-color: #d6d6d6;
                    }

                    &:after {
                        content: "\f040";
                        font-family: 'FontAwesome';
                        color: #757575;
                        position: absolute;
                        top: 10px;
                        left: 0;
                        right: 0;
                        text-align: center;
                        margin: auto;
                    }
                }
            }
        }

        .avatar-preview {
            width: 100px;
            height: 100px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);

            >div {
                width: 100%;
                height: 100%;
                border-radius: 100%;
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
            }
        }
    }
</style>


@endsection
@section('main')

<!--  END CUSTOM STYLE FILE  -->

<!-- END GLOBAL MANDATORY STYLES -->

<div class="row layout-top-spacing">




    <div class="  row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-body">
                    <form action="{{ route('setting.general') }}  " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <x-form.input type="text" label="Company Name" id="company_name"
                                    :value="@$data->company_name" name="company_name" />
                                @error('company_name') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <x-form.input type="text" label="Headquarter Adress" id="hq_address"
                                    :value="@$data->hq_address" name="hq_address" />
                                @error('hq_address') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <x-form.input type="text" label="Office Address" id="factory_address"
                                    :value="@$data->factory_address" name="factory_address" />
                                @error('factory_address') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <x-form.input type="text" label="Phone" id="phone" :value="@$data->phone" name="phone"
                                    class="tagfy" />
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <x-form.input type="text" label="Email" id="email" :value="@$data->email"
                                    name="email" />
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <x-form.input type="text" label="Website" id="website" :value="@$data->website"
                                    name="website" />
                                @error('website') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                             <div class="col-md-3">
                                <x-form.input type="text" label="Exchange Rate" id="usd_rate"
                                    :value="@$data->usd_rate" name="usd_rate" />
                                @error('usd_rate') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> 
                        </div>

                        <fieldset class="row mb-3">
                            <div class="col-sm-12 col-md-4 col-lg-4 ">
                                <label> Logo </label>
                                <br>
                                <div class="container">

                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="logo"
                                                accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview"
                                                style="background-image: url(@if(@$data->logo) {{ asset(@$data->logo) }} @else  https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019 @endif);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 ">
                                <label> Icon </label>
                                <br>
                                <div class="container">

                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="iconimageUpload" name="icon"
                                                accept=".png, .jpg, .jpeg" />
                                            <label for="iconimageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="iconimagePreview"
                                                style="background-image: url(@if(@$data->icon) {{ asset(@$data->icon) }} @else  https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019 @endif);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-10 col-md-4 col-lg-4">
                                <label>Status</label>
                                <div class="form-check">

                                    <input class="form-check-input" type="radio" name="status" id="status1" value="1"
                                        @if(@$data->status == 1 || empty($data))
                                    checked
                                    @endif >
                                    <label class="form-check-label" for="status1">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status2" value="0"
                                        @if(@$data->status === 0 ))
                                    checked
                                    @endif>
                                    <label class="form-check-label" for="status2">
                                        Deactive
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>






</div>



@endsection
@section('script')

<script>
    function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function iconreadURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#iconimagePreview').css('background-image', 'url('+e.target.result +')');
                            $('#iconimagePreview').hide();
                            $('#iconimagePreview').fadeIn(650);

                            
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            $("#imageUpload").change(function() {
                readURL(this);
            });
            $("#iconimageUpload").change(function() {
                    iconreadURL(this);
                });
</script>
<!-- These plugins only need for the run this page -->
<script src="{{ asset('admin/js/apexcharts.min.js') }} "></script>
<script src="{{ asset('admin/js/dashboard-custom.js') }} "></script>


@endsection