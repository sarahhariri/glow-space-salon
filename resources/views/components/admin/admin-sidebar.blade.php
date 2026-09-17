<div
    class="col-md-3 col-lg-2 p-0 bg-white border-end shadow-sm d-md-flex flex-column position-md-sticky top-0 vh-100 sidebar">
    <div class="offcanvas-md offcanvas-start bg-white" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header border-bottom d-md-none">
            <h5 class="offcanvas-title fw-semibold" id="sidebarMenuLabel">Glow Space</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>

        <div class="offcanvas-body d-md-flex flex-column p-0 h-100">
            <nav class="flex-grow-1 overflow-y-auto px-3 py-4">
                <p class="text-uppercase  small fw-semibold mb-2 px-2">Overview</p>
                <ul class="nav nav-pills flex-column gap-1 mb-4">
                    <li class="nav-item">
                        <a class="nav-link sidebar-link {{ request()->routeIs('admin.home') ? 'active' : '' }} d-flex align-items-center gap-2 rounded-3 py-2 px-3 "
                            aria-current="page" href="{{ route('admin.home') }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard Home</span>
                        </a>
                    </li>
                </ul>

                <p class="text-uppercase text-muted small fw-semibold mb-2 px-2">Users</p>
                <ul class="nav nav-pills flex-column gap-1 mb-4">
                    <li class="nav-item">
                        <a class="nav-link sidebar-link {{ request()->routeIs('admin.users.active') ? 'active text-white' : 'text-body-secondary' }}  d-flex align-items-center gap-2 rounded-3 py-2 px-3 "
                            href="{{ route('admin.users.active') }}">
                            <i class="bi bi-person-check"></i>
                            <span>Active Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebar-link {{ request()->routeIs('admin.users.deleted') ? 'active text-white' : 'text-body-secondary' }} d-flex align-items-center gap-2 rounded-3 py-2 px-3 "
                            href="{{ route('admin.users.deleted') }}">
                            <i class="bi bi-person-x"></i>
                            <span>Deleted Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebar-link {{ request()->routeIs('admin.users.all') ? 'active text-white' : 'text-body-secondary' }} d-flex align-items-center gap-2 rounded-3 py-2 px-3 "
                            href="{{ route('admin.users.all') }}">
                            <i class="bi bi-people"></i>
                            <span>All Users</span>
                        </a>
                    </li>
                </ul>

                <p class="text-uppercase  small fw-semibold mb-2 px-2">Salon Content</p>
                <ul class="nav nav-pills flex-column gap-1">
                    <li class="nav-item">
                        <a class="nav-link sidebar-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 text-body-secondary"
                            href="{{ route('admin.slides') }}">
                            <i class="bi bi-images"></i>
                            <span>Slider Carousel</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebar-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 text-body-secondary"
                            href="{{ route('admin.aboutImages') }}">
                            <i class="bi bi-bag"></i>
                            <span>About Images</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebar-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 text-body-secondary"
                            href="{{ route('admin.giftCards') }}">
                            <i class="bi bi-gift me-2"></i>
                            <span>Gift Cards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebar-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 text-body-secondary"
                            href="{{ route('admin.services') }}">
                            <i class="bi bi-scissors me-2"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebar-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 text-body-secondary"
                            href="{{ route('admin.team') }}">
                            <i class="bi bi-people-fill me-2"></i>
                            <span>Team Members</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebar-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 text-body-secondary"
                            href="{{ route('admin.reviews') }}">
                            <i class="bi bi-chat-heart-fill me-2"></i>
                            <span>Reviews</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebar-link d-flex align-items-center gap-2 rounded-3 py-2 px-3 text-body-secondary"
                            href="{{ route('admin.appointments') }}">
                            <i class="bi bi-calendar-check-fill me-2"></i>
                            <span>Appointments</span>
                        </a>
                </ul>
            </nav>

            <div class="mt-auto p-3 border-top bg-body-tertiary flex-shrink-0">
                <div class="admin-profile">
                    <div class="admin-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div class="admin-info">
                        <span class="admin-name">Admin</span>
                        <small>{{ Auth::user()->email }}</small>
                    </div>
                </div>
                <form action="{{ route('auth.logout') }}" method="POST">

                    <button type="submit" class="admin-logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
