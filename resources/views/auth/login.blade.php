<x-layout title="Login" :hideFooter="true">
      <main class="signup-backg d-flex w-100 align-items-center " style="height: 100vh">
        <img src="{{asset('assets/images/random/burgundy.webp')}}" class="signup-bg" fetchpriority="high">
    <form class="card p-4 signup-form"  method="POST" action="{{route('auth.login.action')}}" style="width:60vh;">
      <h1 class="mb-4 text-center " style="color: #660033">Sign In</h1>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="{{old('email')}}" />
        <div id="emailHelp" class="form-text">
          We'll never share your email with anyone else.
        </div>
           @error('email')
        <div class="alert m-1" role="alert" style="background-color: #FF99CC;color:#fff;">
            {{ $message}}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" />
           @error('password')
        <div class="alert m-1  " role="alert" style="background-color: #FF99CC;color:#fff;">
            {{ $message}}
        </div>
        @enderror
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember" />
        <label class="form-check-label" for="remember">Remember me</label>
      </div>
      <h6 style="color: gray; font-size: 0.85rem">
        Don't have an account? <a href="{{route('auth.register.page')}}" style="color: #660033"> Sign up</a>
      </h6>
      <button type="submit" class="btn signup-btn mt-1">Submit</button>
      <br>
        @if (session('error'))
     <div class="alert h-25 " role="alert" style="background-color: #FF99CC;color:#fff;">
            {{ session('error')}}
        </div>
        @endif
    </form>
  
  </main>
</x-layout>
