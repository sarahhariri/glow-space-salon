
<x-layout title="Register" :hideFooter="true">
    <main class="signup-backg d-flex  align-items-center " >
     <img src="{{asset('assets/images/random/burgundy.webp')}}" class="signup-bg" fetchpriority="high">
     <form class="card  p-4 signup-form" method="POST" action="{{route('auth.register.action')}}" style="width:500px; max-width:100%;">
      <h1 class="mb-4 text-center " style="color: #660033">Register</h1>
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
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" />
          @error('name')
        <div class="alert m-1  " role="alert" style="background-color: #FF99CC;color:#fff;" >
            {{ $message}}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" />
          @error('password')
        <div class="alert m-1 " role="alert"  style="background-color: #FF99CC;color:#fff;">
            {{ $message}}
        </div>
        @enderror
      </div>
        <div class="mb-3">
        <label for="password" class="form-label">Password Confirmation</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
      </div>
      <div class="mb-3">
      <div  class="form-check">
        <input type="checkbox" class="form-check-input" id="terms" name="terms" />
        <label class="form-check-label" for="terms" >I agree to <a href="#" style="color: #660033">terms of policy</a></label>
      </div>
      @error('terms')
        <div class="alert m-1 " role="alert" style="background-color: #FF99CC;color:#fff;">
            {{ $message}}
        </div>
        @enderror 
      </div>
      <h6 style="color: gray; font-size: 0.85rem">
        Have an account? <a href="{{route('login')}}" style="color: #660033"> Sign in</a>
      </h6>
      <button type="submit" class="btn signup-btn mt-1">Submit</button>
     </form>
  </main>

</x-layout>