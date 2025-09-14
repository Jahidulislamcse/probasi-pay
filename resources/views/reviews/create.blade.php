@extends('admin.adminLayout.master')

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
        margin-bottom: 30px;
        display: flex;
        flex-direction: column;
    }

    .card-header-review {
        background: linear-gradient(135deg, #d32f2f, #b71c1c);
        color: #fff;
        padding: 18px 25px;
        font-weight: 600;
        font-size: 1.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-body {
        padding: 12px;
        font-size: 0.9rem;
        color: #444;
        display: flex;
        flex-direction: column;
    }

    .video-container {
        height: 160px;
        overflow: hidden;
        margin-bottom: 8px;
    }

    .video-container video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .truncate-text {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .desc-wrapper {
        max-height: 1.5em;
        overflow: hidden;
        transition: max-height 0.4s ease;
    }

    .desc-wrapper.expanded {
        max-height: 1000px;
    }

    .see-more {
        color: #5162fcff;
        cursor: pointer;
        font-size: 0.85rem;
        display: inline-block;
        margin-top: 5px;
    }
    .see-more:hover {
        text-decoration: underline;
    }

    .btn-review {
        background-color: #6e6e6e;
        border: none;
        font-weight: 500;
        width: 100%;
        padding: 10px;
    }

    .btn-review:hover {
        background-color: #555;
    }

    .toggle-review-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        margin-bottom: 20px;
        cursor: pointer;
    }

    .toggle-review-btn:hover {
        background-color: #065ebbff;
    }
</style>
@endsection

@section('main')
<div class="container-custom mt-5">

    {{-- Toggle button for review form --}}
    <button class="toggle-review-btn" id="toggleReviewForm">
        রিভিউ আপলোড করুন
    </button>

    {{-- Create Review Form --}}
    <div id="reviewForm" style="display:none;">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card-review" style="height:auto;"> <!-- allow height auto for form -->
                    <div class="card-header-review">রিভিউ আপলোড করুন</div>
                    <div class="card-body">
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

                            <div class="d-grid mt-3">
                                <button type="submit" class="btn-review">রিভিউ জমা দিন</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Existing Reviews --}}
    @if($reviews->isNotEmpty())
        <div class="mt-5">
            <div class="mb-4">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by title...">
            </div>
            <h4 class="mb-4" style="color:#6e6e6e;">বর্তমান রিভিউসমূহ</h4>
            <div class="row" id="reviewsContainer">
                @foreach($reviews as $review)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 review-card">
                        <div class="card-review">
                            <div class="card-header-review">{{ $review->title }}</div>
                            <div class="card-body">
                                @if($review->video_path)
                                    <div class="video-container">
                                        <video controls>
                                            <source src="{{ asset($review->video_path) }}" type="video/mp4">
                                            আপনার ব্রাউজার ভিডিওটি সমর্থন করছে না।
                                        </video>
                                    </div>
                                @endif

                                <div class="desc-wrapper" id="desc-wrapper-{{ $review->id }}">
                                    <p id="desc-{{ $review->id }}">
                                        {{ $review->description }}
                                    </p>
                                </div>

                                @if(strlen($review->description) > 50)
                                    <span class="see-more" data-id="{{ $review->id }}">See more</span>
                                @endif

                                <div class="mt-2 d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-primary edit-review"
                                        data-id="{{ $review->id }}"
                                        data-title="{{ $review->title }}"
                                        data-description="{{ $review->description }}"
                                        data-video="{{ $review->video_path ?? '' }}">Edit</button>

                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('আপনি কি সত্যিই এই রিভিউ মুছে ফেলতে চান?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4" style="margin-bottom: 80px;">
                {{ $reviews->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Update Review Modal -->
        <div class="modal fade" id="updateReviewModal" tabindex="-1" aria-labelledby="updateReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="updateReviewModalLabel">রিভিউ আপডেট করুন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateReviewFormElement" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="update_review_id" name="review_id">

                    <div class="mb-3">
                        <label for="update_title" class="form-label">রিভিউ শিরোনাম</label>
                        <input type="text" class="form-control" id="update_title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="update_video_path" class="form-label">রিভিউ ভিডিও আপলোড করুন</label>
                        <input class="form-control" type="file" id="update_video_path" name="video_path" accept="video/*">
                        <div class="form-text">সমর্থিত ফরম্যাট: mp4, mov, avi, webm | সর্বোচ্চ: 50MB</div>
                    </div>

                    <div class="mb-3">
                        <label for="update_description" class="form-label">রিভিউ বিবরণ</label>
                        <textarea class="form-control" id="update_description" name="description" rows="4" required></textarea>
                    </div>

                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-primary">রিভিউ আপডেট করুন</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>


    @endif

</div>
@endsection

@section('script')
<script>
   // Toggle the review form
    document.getElementById('toggleReviewForm')?.addEventListener('click', function() {
        const form = document.getElementById('reviewForm');
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    });

    // See more / See less toggle
    document.querySelectorAll('.see-more').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const wrapper = document.getElementById('desc-wrapper-' + id);

            wrapper.classList.toggle('expanded');
            this.innerText = wrapper.classList.contains('expanded') ? 'See less' : 'See more';
        });
    });

    // Edit review open modal
    document.querySelectorAll('.edit-review').forEach(btn => {
        btn.addEventListener('click', function() {
            const reviewId = this.dataset.id;
            const title = this.dataset.title;
            const description = this.dataset.description;
            const video = this.dataset.video;

            // Prefill modal fields
            document.getElementById('update_review_id').value = reviewId;
            document.getElementById('update_title').value = title;
            document.getElementById('update_description').value = description;


            // Set form action dynamically
            const formElement = document.getElementById('updateReviewFormElement');
            formElement.action = `/reviews/${reviewId}`;

            // Show modal (Bootstrap 5)
            const updateModal = new bootstrap.Modal(document.getElementById('updateReviewModal'));
            updateModal.show();
        });
    });

</script>
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let searchValue = this.value.toLowerCase();
    let reviews = document.querySelectorAll('.review-card');
    let anyMatch = false;

    reviews.forEach(function (card) {
        let title = card.querySelector('.card-header-review').textContent.toLowerCase();
        if (searchValue === '' || title.includes(searchValue)) {
            card.classList.remove('d-none');
            anyMatch = true;
        } else {
            card.classList.add('d-none');
        }
    });

    // Show "no results" message if needed
    let noResultMsg = document.getElementById('noResultsMsg');
    if (!anyMatch) {
        if (!noResultMsg) {
            noResultMsg = document.createElement('p');
            noResultMsg.id = 'noResultsMsg';
            noResultMsg.className = 'text-muted mt-3';
            noResultMsg.textContent = 'No reviews found.';
            document.getElementById('reviewsContainer').appendChild(noResultMsg);
        }
    } else {
        if (noResultMsg) noResultMsg.remove();
    }
});
</script>


@endsection
