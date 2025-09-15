@extends('admin.layout.master')

@section('style')
<style>
    body {
        background-color: #f8f9fa;
    }

    .container-custom {
        padding-left: 10px;
        padding-right: 10px;
    }

    .card-review {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
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
        /* default: ~1 line */
        overflow: hidden;
        transition: max-height 0.4s ease;
    }

    .desc-wrapper.expanded {
        max-height: 1000px;
        /* enough to show full text */
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
</style>
@endsection

@section('main')
<div class="app-header st1">
    <div class="tf-container">
        <div class="tf-topbar d-flex justify-content-center align-items-center">
            <a href="{{ route('admin.index') }}" class="back-btn"><i class="icon-left white_color"></i></a>
            <h3 class="white_color">রিভিউসমূহ</h3>
        </div>
    </div>
</div>
<div class="container-custom mt-5">

    {{-- Existing Reviews --}}
    @if($reviews->isNotEmpty())
    <div class="mt-5 mb-6">
        <div class="mb-4">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by title...">
        </div>
        <h4 class="mb-4" style="color:#6e6e6e;">রিভিউসমূহ</h4>
        <div class="row" id="reviewsContainer">
            @foreach($reviews as $review)
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4 review-card">
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
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4 " style="margin-bottom: 80px;">
            {{ $reviews->links('pagination::bootstrap-5') }}
        </div>
    </div>


    @endif

</div>
@endsection

@section('script')
<script>
    // See more / See less toggle
    document.querySelectorAll('.see-more').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const wrapper = document.getElementById('desc-wrapper-' + id);

            wrapper.classList.toggle('expanded');
            this.innerText = wrapper.classList.contains('expanded') ? 'See less' : 'See more';
        });
    });
</script>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let reviews = document.querySelectorAll('.review-card');
        let anyMatch = false;

        reviews.forEach(function(card) {
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