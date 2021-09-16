<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <title>AwsBlog</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    @yield('captchaScript')
</head>
<body id="awsblog">

    {{-- header --}}
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" style="background-color: #e3f2fd;">
        <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">AwsBlog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            @auth
             @can('AdminCheck', auth()->user())
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.home')}}" target="__blank">Admin Panel</a>
            </li>
            @endcan
            @endauth
            <li class="nav-item active">
              <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{route('signup')}}">Signup</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('login')}}">LogIn</a>
            </li>
            @endguest
            @auth
            <li class="nav-item">
              <form action="{{route('logout')}}" method="POST">
                @csrf
                <button class="btn nav-link" type="submit">Logout</button>
              </form>
            </li>  
            <li class="nav-item ml-2">
              <img src="
              @if(auth()->user()->provider == 'awsblog')
              {{asset('storage/img/profile/'.auth()->user()->user_pic)}}
              @else
              {{auth()->user()->user_pic}}
              @endif
              " alt="" id="userProfile">
            </li>        
            @endauth
          </ul>
        
        </div>
    </div>
      </nav>

      @guest
      <div class="login-modal text-center shadow-sm p-3 mb-5 bg-white rounded">
          <h4 class="text-center text-capitalize login-text">Please login to continue</h4>
          <a href="{{route('login')}}" class="btn btn-info text-white my-2">Login</a><br>
          <a href="{{route('signup')}}" class="btn btn-info mb-2 text-white">Create a new account</a><br>
          <button class="btn btn-danger" onclick="loginRemove()"><i class="fas fa-times"></i></button>
      </div>
    @endguest

    @yield('content')

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/post.js')}}"></script>
    <script src="{{asset('js/comments.js')}}"></script>
</body>
</html>