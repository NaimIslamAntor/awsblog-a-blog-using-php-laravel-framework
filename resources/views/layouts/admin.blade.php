<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminsidebar.css')}}">
    @yield('trixeditorfiles')
</head>
<body>
    <div class="sidebar__toggler">
        <i class="fas fa-bars" id="toggleSidebar"></i>
    </div>
<div class="sidebar__container">
    <div class="sidebar__body">
       <div class="link__head mt-3"><a href="{{route('admin.home')}}" class="sidebarlink">Dashboard</a></div>

       <div class="link__head">
        <a href="{{route('admin.post')}}" class="sidebarlink">Add Post</a>
       </div>

       <div class="link__head">
        <a href="{{route('admin.allposts')}}" class="sidebarlink">All Posts</a>
       </div>

       <div class="link__head">
        <a href="#" class="sidebarlink">Users</a>
       </div>
       <div class="link__head">
        <a href="{{route('admin.category')}}" class="sidebarlink">Categories</a>
       </div>
       <div class="link__head">
        <a href="#" class="sidebarlink">link 5</a>
       </div>
    </div>
</div>
@yield('content')
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/adminsidebar.js')}}"></script>
</body>
</html>