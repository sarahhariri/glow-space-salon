<section id="review" class="py-5">
    <div class="container">

        <div class="main-heading text-center mb-4">
            <h3>What Our Clients Say</h3>
            <p class="main-subtitle">Share your experience with us.</p>
        </div>


        <div class="row justify-content-center">

            @forelse($reviews as $review)

                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    @php
                        $words = explode(' ', trim($review->name));
                        $initials = strtoupper(
                            substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''),
                        );
                    @endphp
                    <div class="review-card">
                        <div class="review-header ">
                            <div class="review-avatar">
                                {{ $initials }}
                            </div>
                            <div class="review-info">
                                <h5>{{ ucfirst($review->name) }}</h5>

                                <div class="stars mb-2">

                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi bi-star text-warning"></i>
                                        @endif
                                    @endfor

                                </div>

                            </div>
                        </div>
                        <p class="review-comment">{{ $review->comment }}</p>


                    </div>
                </div>

            @empty

                <p class="text-center">
                    No reviews yet.
                </p>

            @endforelse


        </div>

        @auth
            @if(auth()->user()->review)
            <div class="alert alert-info text-center" style="background-color: #e60073; color:white; border:none;">
                You have already submitted a review.
            </div>
        @else
            <div class="review-form-wrapper mt-5">
                <h3 class="text-center mb-4">Leave a Review</h3>

                <form action="{{ route('reviews.store') }}" method="POST">


                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>

                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>

                        <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror">
                            <option value="">Choose a rating</option>

                            @for ($rating = 1; $rating <= 5; $rating++)
                                <option value="{{ $rating }}" @selected(old('rating') == $rating)>
                                    {{ $rating }} Star{{ $rating > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>

                        @error('rating')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Your Review</label>

                        <textarea name="comment" id="comment" rows="4" class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>

                        @error('comment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn review-btn">
                        Submit Review
                    </button>
                </form>
            </div>
            @endif
        @else
            <div class="review-login-box text-center">
                <p>Please login to share your experience. </p>
                <a href={{ route('login') }} class="btn review-btn">Login to Review</a>
            </div>
        @endauth
    </div>

</section>
