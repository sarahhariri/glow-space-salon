<x-admin.admin-layout>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Dashboard Overview</h2>
                <p class="text-muted mb-0">
                    Here's what's happening at
                    <span class="dashboard-accent">Glow Space.</span>
                </p>
            </div>

            <div class="dashboard-date">
                <i class="bi bi-calendar3 me-2"></i>
                {{ now()->format('M d, Y') }}
            </div>
        </div>


        {{-- Statistics --}}
        <div class="row g-4">

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card">
                    <div class="dashboard-icon icon-burgundy">
                        <i class="bi bi-calendar-check"></i>
                    </div>

                    <p class="dashboard-label">Total Appointments</p>

                    <h2 class="dashboard-number">
                        {{ $totalAppointments }}
                    </h2>

                    <small class="text-muted">All appointments</small>
                </div>
            </div>


            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card">
                    <div class="dashboard-icon icon-warning">
                        <i class="bi bi-clock"></i>
                    </div>

                    <p class="dashboard-label">Pending</p>

                    <h2 class="dashboard-number">
                        {{ $pendingAppointments }}
                    </h2>

                    <small class="text-muted">
                        Waiting for confirmation
                    </small>
                </div>
            </div>


            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card">
                    <div class="dashboard-icon icon-success">
                        <i class="bi bi-calendar2-check"></i>
                    </div>

                    <p class="dashboard-label">Confirmed</p>

                    <h2 class="dashboard-number">
                        {{ $confirmedAppointments }}
                    </h2>

                    <small class="text-muted">
                        Upcoming appointments
                    </small>
                </div>
            </div>


            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card">
                    <div class="dashboard-icon icon-purple">
                        <i class="bi bi-check-circle"></i>
                    </div>

                    <p class="dashboard-label">Completed</p>

                    <h2 class="dashboard-number">
                        {{ $completedAppointments }}
                    </h2>

                    <small class="text-muted">
                        Successfully completed
                    </small>
                </div>
            </div>


            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card">
                    <div class="dashboard-icon icon-pink">
                        <i class="bi bi-scissors"></i>
                    </div>

                    <p class="dashboard-label">Services</p>

                    <h2 class="dashboard-number">
                        {{ $totalServices }}
                    </h2>

                    <small class="text-muted">Total services</small>
                </div>
            </div>


            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card">
                    <div class="dashboard-icon icon-blue">
                        <i class="bi bi-people"></i>
                    </div>

                    <p class="dashboard-label">Team Members</p>

                    <h2 class="dashboard-number">
                        {{ $totalTeam }}
                    </h2>

                    <small class="text-muted">Salon experts</small>
                </div>
            </div>


            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card">
                    <div class="dashboard-icon icon-gold">
                        <i class="bi bi-star"></i>
                    </div>

                    <p class="dashboard-label">Reviews</p>

                    <h2 class="dashboard-number">
                        {{ $totalReviews }}
                    </h2>

                    <small class="text-muted">Client reviews</small>
                </div>
            </div>


            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card">
                    <div class="dashboard-icon icon-purple">
                        <i class="bi bi-gift"></i>
                    </div>

                    <p class="dashboard-label">Gift Cards</p>

                    <h2 class="dashboard-number">
                        {{ $totalGiftCards }}
                    </h2>

                    <small class="text-muted">Gift card requests</small>
                </div>
            </div>

        </div>


        {{-- Pending appointments banner --}}
        <div class="dashboard-banner mt-4">
            <div class="d-flex align-items-center gap-3">

                <div class="banner-icon">
                    <i class="bi bi-calendar-event"></i>
                </div>

                <div>
                    <h6 class="fw-semibold mb-1">
                        Appointments need your attention
                    </h6>

                    <p class="text-muted small mb-0">
                        You have
                        <strong>{{ $pendingAppointments }}</strong>
                        pending appointments waiting for confirmation.
                    </p>
                </div>

            </div>

            <a href="{{ route('admin.appointments') }}"
               class="btn dashboard-btn">
                View Appointments
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>

    </main>
</x-admin.admin-layout>