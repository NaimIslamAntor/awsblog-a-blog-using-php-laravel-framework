@extends('layouts.app')

@section('captchaScript')
{!! NoCaptcha::renderJs() !!}
@endsection

@section('content')
<div class="container my-4 signup__container">
    <h3 class="text-center heading__divider mt-4 mb-3 text-uppercase">Login</h3>

    @if (session('wep'))
          <h1 class="text-center bg-red">{{@session('wep')}}</h1>
      @endif

    <div class="row">
        <form class="col-lg-8 col-md-8 mx-auto col-sm-12 col-12 login__form" action="{{route('login.action')}}" method="POST">
            @csrf
            <div class="row my-2">
                <div class="col">
                  <input type="email" class="form-control" name="email" autocomplete="off" required placeholder="Email">
                </div>
              </div>
            
            <div class="row my-4">
                <div class="col">
                  <input type="password" class="form-control" name="password" autocomplete="off" required placeholder="Password">
                </div>
              </div>
          
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="rememberme" id="inlineRadio3">
                <label class="form-check-label" for="inlineRadio3">Remenber me</label>
              </div>

              <div class="row my-4">
                <div class="col">
                  <h5 class="auth__bmsg">Don't have an account <a href="{{route('signup')}}">sign up</a></h5>
                </div>
              </div>
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
              <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">Log In</button>
              <a href="{{route('google.login_request')}}" class="btn btn-danger btn-lg btn-block mt-3">Login with Google</a>
          </form>
    </div>
</div>

@endsection