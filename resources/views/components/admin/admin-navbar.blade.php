  {{-- <header class="navbar navbar-expand-md navbar-light bg-white border-bottom shadow sticky-top p-2 ">
      <a class="navbar-brand fs-6 text-dark fw-semibold " href="{{route('home')}}">Glow Space</a>
      <div class="ms-auto d-none d-md-flex align-items-center">
          <a class="nav-link text-dark small fw-medium px-2" href="{{route('home')}}">
              <i class="bi bi-arrow-left-circle me-1"></i>
              Back to main site
          </a>
      </div>
      <button class="navbar-toggler d-md-none border-0 shadow-none ms-auto" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
  </header> --}}



  <header class="navbar navbar-expand-md navbar-light bg-white sticky-top admin-navbar px-4">

    <a class="navbar-brand fs-6 fw-semibold admin-brand"
        href="{{ route('home') }}">
        Glow Space
    </a>

    <div class="ms-auto d-none d-md-flex align-items-center">
        <a class="nav-link small fw-medium back-main-link"
            href="{{ route('home') }}">
            <i class="bi bi-arrow-left-circle me-1"></i>
            Back to main site
        </a>
    </div>

    <button
        class="navbar-toggler d-md-none border-0 shadow-none ms-auto"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#sidebarMenu"
        aria-controls="sidebarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>
    </button>

</header>


