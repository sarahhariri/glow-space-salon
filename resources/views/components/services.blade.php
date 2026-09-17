<section id="services" class="services-section ">

    @forelse ($services as $service)

        <div class="service-row {{ $loop->even ? 'service-reverse' : '' }}">

            <div class="service-image">
                @if ($service->image)
                    <img
                        src="{{ asset('assets/images/services/' . $service->image) }}"
                        alt="{{ $service->name }}"
                    >
                @endif
            </div>

            <div class="service-content">

                <span class="service-label">
                 Our Services
                </span>

                <h2>{{ $service->name }}</h2>

                <p>{{ $service->description }}</p>

                <div class="service-details d-flex gap-5 mb-3 justify-content-start align-items-center">
                    <span>
                        <i class="bi bi-clock"></i>
                        {{ $service->duration }} minutes
                    </span>

                    <span>
                        <i class="bi bi-currency-dollar" style="color: #660033"></i>
                        From ${{ number_format($service->price, 2) }}
                    </span>
                </div>

                <a href="{{ route('appointments.create', ['service' => $service->id])}}" class="main-btn">
                    Book This Service
                </a>

            </div>

        </div>

    @empty

        <p class="text-center">
            No services are currently available.
        </p>

    @endforelse

</section>