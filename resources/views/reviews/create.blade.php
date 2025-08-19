@extends('admin.layout.master')

@section('style')
<style>
    body {
        background-color: #f8f9fa;
    }

    .card-review {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 80px;
    }

    .card-header-review {
        background: linear-gradient(135deg, #d32f2f, #b71c1c);
        color: #fff;
        padding: 18px 25px;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .form-label {
        font-weight: 600;
        color: #b71c1c;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .form-control:focus, .form-select:focus {
        border-color: #d32f2f;
        box-shadow: 0 0 0 0.2rem rgba(211, 47, 47, 0.25);
    }

    .btn-review {
        background-color: #d32f2f;
        border: none;
        font-weight: 500;
        width: 100%;
        padding: 12px;
    }

    .btn-review:hover {
        background-color: #b71c1c;
    }

    .image-radio-group {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .image-radio {
        position: relative;
        width: 70px;
        text-align: center;
    }

    .image-radio input[type="radio"] {
        display: none;
    }

    .image-radio img {
        width: 65px;
        height: 65px;
        border-radius: 8px;
        border: 2px solid transparent;
        cursor: pointer;
        transition: 0.3s;
    }

    .image-radio input[type="radio"]:checked + img {
        border: 2px solid #d32f2f;
    }

    .container-custom {
        max-width: 1140px;
        margin: 0 auto;
    }

    .toggle-review-btn {
        background-color: #d32f2f;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        cursor: pointer;
    }
    .toggle-review-btn:hover {
        background-color: #b71c1c;
        color: #fff;
    }
</style>
@endsection

@section('main')
<div class="container-custom mt-5">
    @if($reviews->isNotEmpty())
        <button class="toggle-review-btn" id="toggleReviewForm">রিভিউ আপলোড করুন</button>
    @endif

    <div id="reviewForm" @if($reviews->isNotEmpty()) style="display:none;" @endif>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card-review">
                    <div class="card-header-review">
                        রিভিউ আপলোড করুন
                    </div>
                    <div class="card-body p-4">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>দুঃখিত!</strong> নিচের ভুলগুলো ঠিক করুন:
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                            <div class="mb-3">
                                <label for="title" class="form-label">রিভিউ শিরোনাম</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="রিভিউর শিরোনাম লিখুন" required>
                            </div>

                            <div class="mb-3">
                                <label for="video_path" class="form-label">রিভিউ ভিডিও আপলোড করুন</label>
                                <input class="form-control" type="file" id="video_path" name="video_path" accept="video/*" required>
                                <div class="form-text">সমর্থিত ফরম্যাট: mp4, mov, avi, webm | সর্বোচ্চ: 50MB</div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">রিভিউ বিবরণ</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="আপনার রিভিউ লিখুন..."></textarea>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn-review">রিভিউ জমা দিন</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($reviews->isNotEmpty())
        <div class="mt-5">
            <h4 class="mb-4" style="color:#b71c1c;">বর্তমান রিভিউসমূহ</h4>
            <div class="row">
                @foreach($reviews as $review)
                    <div class="col-md-6">
                        <div class="card-review">
                            <div class="card-header-review">{{ $review->title }}</div>
                            <div class="card-body p-3">
                                @if($review->video_path)
                                    <video width="100%" height="250" controls>
                                        <source src="{{ asset($review->video_path) }}" type="video/mp4">
                                        আপনার ব্রাউজার ভিডিওটি সমর্থন করছে না।
                                    </video>
                                @endif
                                <p class="mt-3">{{ $review->description }}</p>
                                <small>রিভিউ প্রদান করেছেন: {{ $review->user->name ?? 'অজানা' }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@endsection

@section('script')
<script>
    document.getElementById('toggleReviewForm')?.addEventListener('click', function() {
        const form = document.getElementById('reviewForm');
        if(form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    });
</script>
@endsection
