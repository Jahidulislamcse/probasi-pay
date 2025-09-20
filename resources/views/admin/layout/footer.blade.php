<script type="text/javascript" src="{{ asset('javascript/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('javascript/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('javascript/swiper-bundle.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('javascript/swiper.js')}}"></script>
<script type="text/javascript" src="{{ asset('javascript/main.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
    integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@livewireScripts

<div class="bottom-navigation-bar" style="margin-top: 80px;">

    <div class="footer-clr tf-container px-5">
        <ul class="tf-navigation-bar">
            <li class="active"><a class="fw_6 d-flex text-white justify-content-center align-items-center flex-column"
                    href="{{ route('admin.index') }}"><i class="icon-home2 text-white"></i> হোম</a> </li>

            <li><a class="fw_4 d-flex text-white justify-content-center align-items-center flex-column"
                    href="{{ route('history') }}">

                    <img style="height: 22px; width:22px;" src="/images/front-icons/history_.png">
                    হিস্টোরি
                </a> 
            </li>
            <li><a class="fw_4 d-flex text-white justify-content-center align-items-center flex-column"
                    href="{{ route('profile') }}">

                    <svg width="22" height="21" xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 506.3">
                        <path fill="#fff" fill-rule="nonzero" d="M119.42 6.87h125.91l-60.09 62.8h-65.82c-15.62 0-29.77 6.34-39.97 16.53l-.12.13a56.351 56.351 0 00-16.54 39.97v317.24h317.25c15.63 0 29.77-6.34 39.97-16.54l.12-.12c10.2-10.2 16.54-24.35 16.54-39.97V322.1l62.79-65.59v130.4c0 32.73-13.42 62.55-35.05 84.24l-.2.2c-21.68 21.58-51.48 34.98-84.17 34.98H47.92c-13.08 0-25.02-5.38-33.75-14.05l-.18-.19C5.36 483.38 0 471.46 0 458.42V126.3c0-32.74 13.43-62.56 35.06-84.25l.19-.19C56.94 20.27 86.72 6.87 119.42 6.87zm184.8 311.78l-122.6 24.97 17.73-130.45 104.87 105.48zm-66.17-144.94L401.27 3.81c4.47-3.72 8.95-5.16 14.11-2.2l93.64 90.68c3.72 4.48 4.48 9.64-.76 14.87l-165.41 172.1-104.8-105.55z" />
                    </svg>
                    প্রোফাইল
                </a> 
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="fw_4 d-flex justify-content-center align-items-center flex-column"
                        style="background: none;border: none;color: #fff;cursor: pointer;padding: 0px;margin: 0px;font-size: 12px;">
                        <i class="icon-user-outline text-white"></i> লগ আউট
                    </button>
                </form>
            </li>
        </ul> <!-- <span class="line"></span> -->
    </div>
</div>

<script>
    Livewire.on('msg', (event) => {
        toastr.success(event)
    });



    loadeditor();




    $('.delete-btn').on('click', function() {
        var link = $(this).attr('data');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                window.location.href = link;

            }
        })
    })


    function loadeditor() {
        var allEditors = document.querySelectorAll('.ckeditor');
        for (var i = 0; i < allEditors.length; ++i) {
            var isload = $('.ckeditor').eq(i).attr('data');
            if (isload != 1) {


                ClassicEditor.create(allEditors[i], {
                        toolbar: {
                            items: [
                                'heading', '|',
                                'bold', 'italic', 'underline', 'strikethrough', '|',
                                'alignment', '|',
                                'bulletedList', 'numberedList', '|',
                                'indent', 'outdent', '|',
                                'link', 'imageUpload', '|',
                                'blockQuote', '|',
                                'undo', 'redo'
                            ]
                        },
                        ckfinder: {
                            uploadUrl: '/upload-image?_token={{ csrf_token() }}',
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });

                $('.ckeditor').eq(i).attr('data', 1);
            }

        }
    }
</script>

<style>
    @php
        $colors = \App\Models\ColorSetting::first();
    @endphp

    body {
        background-color: {{ $colors->body_color ?? '#067fab' }};
    }
    .footer-clr{
        background-color: {{ $colors->footer_color ?? '#067fab' }};
    }
</style>