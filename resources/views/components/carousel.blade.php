<div
    id="carouselExampleCaptions"
    class="carousel slide carousel-height"
    data-bs-ride="carousel"
>
    <div class="carousel-indicators">

        @for ($i = 0; $i < count($slides); $i++)
            <button
                type="button"
                data-bs-target="#carouselExampleCaptions"
                data-bs-slide-to="{{ $i }}"
                class="{{ $i === 0 ? 'active' : '' }}"
                @if ($i === 0) aria-current="true" @endif
                aria-label="Slide {{ $i + 1 }}"
            ></button>
        @endfor

    </div>

    <div class="carousel-inner">

        @foreach ($slides as $slide)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">

                <img
                    src="{{ asset('assets/images/slides/' . $slide->image) }}"
                    class="d-block w-100 hero-slide-image
                        {{ $loop->even ? 'focus-left' : 'focus-right' }}"
                    alt="{{ $slide->title }}"
                >

                <div
                    class="carousel-caption text-start hero-content
                        {{ $loop->even ? 'hero-right' : 'hero-left' }}"
                >
                    <h5>{{ $slide->title }}</h5>

                    <p>{{ $slide->description }}</p>

                    <a
                        href="{{ route('appointments.create') }}"
                        class="btn main-btn"
                    >
                        Book Appointment
                    </a>
                </div>

            </div>
        @endforeach

    </div>

    <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev"
    >
        <span
            class="carousel-control-prev-icon"
            aria-hidden="true"
        ></span>

        <span class="visually-hidden">Previous</span>
    </button>

    <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next"
    >
        <span
            class="carousel-control-next-icon"
            aria-hidden="true"
        ></span>

        <span class="visually-hidden">Next</span>
    </button>
</div>