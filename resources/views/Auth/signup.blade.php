@extends('layouts.app')

@section('captchaScript')
{!! NoCaptcha::renderJs() !!}
@endsection

@section('content')
<div class="container my-4 signup__container">
    <h3 class="text-center heading__divider mt-4 mb-3 text-uppercase">signup</h3>
    <div class="row">
      @if (session('e_existance'))
          <h1 class="text-center bg-red">{{@session('e_existance')}}</h1>
      @endif
        <form class="col-lg-8 col-md-8 mx-auto col-sm-12 col-12 signup__form" action="{{route('mksignup')}}" method="POST">
            @csrf
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" name="fname" autocomplete="off" required 
                 placeholder="First name" value="{{old('fname')}}">
                @error('fname')
              <br>
              <div class="form-check form-check-inline bg-red">
               {{$message}}
              </div>
              @enderror
              </div>
              
              <div class="col">
                <input type="text" class="form-control" name="lname" autocomplete="off"
                 required placeholder="Last name" value="{{old('lname')}}">
                @error('lname')
                <br>
                <div class="form-check form-check-inline bg-red">
                 {{$message}}
                </div>
                @enderror
              </div>
            </div>
          
            <div class="row my-4">
                <div class="col">
                  <input type="email" class="form-control" name="email" autocomplete="off"
                   required placeholder="Email" value="{{old('email')}}">
                </div>
              </div>
              @error('email')
              <br>
              <div class="form-check form-check-inline bg-red">
               {{$message}}
              </div>
              @enderror

            <div class="row my-4">
                <div class="col">
                  <input type="password" class="form-control" name="password" 
                  autocomplete="off" required placeholder="Password">
                </div>
              </div>
              @error('password')
              <br>
              <div class="form-check form-check-inline bg-red">
               {{$message}}
              </div>
              @enderror

            
            <div class="row my-4">
                <div class="col">
                  <input type="password" class="form-control" name="password_confirmation" autocomplete="off"
                   required placeholder="Re type your password">
                </div>
              </div>
              <div class="row my-4">
                <div class="col">
                 <h4>Your Gender</h4>
                </div>
              </div>
              
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                 required {{ old('gender') == 'male' ? 'checked' : null}} checked value="male">

                <label class="form-check-label" for="inlineRadio1">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                 {{ old('gender') == 'female' ? 'checked' : null}}  required value="female">

                <label class="form-check-label" for="inlineRadio2">Female</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender"
                {{ old('gender') == 'other' ? 'checked' : null}}  id="inlineRadio3" required value="other">
                <label class="form-check-label" for="inlineRadio3">Other</label>
              </div>
              @error('gender')
              <br>
              <div class="form-check form-check-inline bg-red">
               {{$message}}
              </div>
              @enderror
             
           <br><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="remember" id="inlineRadio3">
                <label class="form-check-label" for="inlineRadio3">Remenber me</label>
              </div>
              <br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="terms" required checked id="inlineRadio3">
                <label class="form-check-label" for="inlineRadio3">Agree our<a href="{{route('terms')}}"> terms and conditions</a></label>
              </div>
              @error('terms')
              <br>
              <div class="form-check form-check-inline bg-red">
               {{$message}}
              </div>
              @enderror
              <div class="row my-4">
                <div class="col">
                  <h5 class="auth__bmsg">Already have an account <a href="{{route('login')}}">log in</a></h5>
                </div>
              </div>
              {{-- <br> --}}
              <div class="row my-4">
                <div class="col">
                  {!! NoCaptcha::display() !!}
                </div>
              </div>
              @error('g-recaptcha-response')
              <br>
              <div class="form-check form-check-inline bg-red">
               {{$message}}
              </div>
              @enderror
              <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">Sign up</button>
          </form>
    </div>
</div>
@endsection