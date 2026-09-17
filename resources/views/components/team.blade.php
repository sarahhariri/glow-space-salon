<section id="team" class="team-section py-5">
    <div class="container">

        <div class="main-heading text-center mb-4">
            <h3>Meet Our Experts</h3>
            <p class="main-subtitle">
                Meet the passionate beauty professionals dedicated to creating
                exceptional results with every appointment.
            </p>
        </div>

        <div class="row g-4 justify-content-center">

            @forelse ($team as $member)
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="team-card w-100">

                        <div class="team-image-wrapper">
                            @if ($member->image)
                                <img src="{{ asset('assets/images/team/' . $member->image) }}" alt="{{ $member->name }}"
                                    class="team-image">
                            @else
                                <div class="team-placeholder">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            @endif


                        </div>

                        <div class="team-content text-center">
                            <h3>{{ $member->name }}</h3>

                            <span class="team-specialization">
                                {{ $member->specialization }}
                            </span>

                            @if ($member->bio)
                                <p class="team-bio">{{ $member->bio }}</p>
                            @endif
                            <div class="team-actions">
                                @if ($member->instagram)
                                    <a href="https://instagram.com/{{ ltrim($member->instagram, '@') }}" target="_blank" class="team-social">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                @endif
                                <a href="{{ route('appointments.create', ['team_member' => $member->id])}}" class="btn team-book-btn"><i class="bi bi-calendar-check"></i>
                                    Book an Appointment
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            @empty

                <div class="col-12">
                    <p class="text-center text-muted">
                        No team members are currently available.
                    </p>
                </div>
            @endforelse

        </div>
    </div>
</section>
