<nav class="navbar navbar-expand-lg sticky-top bg-white py-3 main-navbar " id="mainNabar">
  <div class="container">
    <div class="nav-title">
    <a class="navbar-brand "  href="#">Glow Space</a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Added ms-auto to move items to the right -->
      <ul class="navbar-nav mx-auto">
        <li class="nav-item fw-semibold"><a class="nav-link " href="{{route('home')}}">Home</a></li>
        <li class="nav-item fw-semibold"><a class="nav-link" href="{{route('home')}}#about-us" >About</a></li>
        <li class="nav-item fw-semibold"><a class="nav-link" href="{{route('home')}}#services" >Services</a></li>
         <li class="nav-item fw-semibold"><a class="nav-link" href="{{route('home')}}#team">Team</a></li>
         <li class="nav-item fw-semibold"><a class="nav-link" href="{{route('home')}}#review">Review</a></li>
         
            
          
         
         
           @guest
           <li class="nav-item"><a class="nav-link fw-semibold" href="{{route('auth.register.page')}}"> Register</a></li>
            <li class="nav-item"><a class="nav-link fw-semibold" href="{{route('login')}}"> Login</a></li>
           @endguest
           @auth
          
           @if (Auth::user()->role == 'admin')
            <li class="nav-item"><a class="nav-link fw-semibold" href="{{route('admin.home')}}">Admin Panel </a>
           @endif
          
            <li class="nav-item">
               <form action="{{ route('auth.logout') }}" method="POST">
              <button type="submit" class="nav-link fw-semibold"> Logout</button>
           </form>
            
            @endauth
        </li>
       
      </ul>
     <div class=" d-flex align-items-center gap-4">
      <a href="{{ route('appointments.create') }}" class="btn nav-btn appointment-btn" type="submit">Book appointment</a>
      <a href="{{ route('giftCards') }}" class="btn nav-btn gift-btn" type="submit"><i class="bi bi-suit-heart"></i> Gift Card</a>
        
          </div>
          
    </div>
  </div>
</nav>
