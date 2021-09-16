@extends('layouts.app')


@section('content')
{{-- <h1>Hey Naim let's build a blog with laravel</h1> --}}

{{-- slider section --}}
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner container">
      <div class="carousel-item active">
          <img src="{{asset('storage/img/slider/img1.jpg')}}" class="d-block w-100 slide__header_custom" alt="slide1">
      </div>
      <div class="carousel-item">
        <img src="{{asset('storage/img/slider/img2.jpg')}}" class="d-block w-100 slide__header_custom" alt="slide2">
      </div>
      <div class="carousel-item">
        <img src="{{asset('storage/img/slider/img3.jpg')}}" class="d-block w-100 slide__header_custom" alt="slide3">
      </div>
      <div class="carousel-item">
        <img src="{{asset('storage/img/slider/img4.jpg')}}" class="d-block w-100 slide__header_custom" alt="slide4">
      </div>
    </div>
  </div>

  {{-- recent post section --}}
<section class="aws__section py-4">
  {{-- @if ($posts->count()) --}}
<h3 class="text-center heading__divider text-uppercase">Recently published Post</h3>
<div class="container recentpostcontainer">
    <div class="row">

     @if ($posts->count())
      
      @foreach ($posts as $post)

      @php extract(unserialize($post->pic_alt_tags));  @endphp



      {{-- prepare it's dependency --}}
        @php
    
        $provider = $post->user->provider;
        $user_pic = $post->user->user_pic;
        $fname = $post->user->fname;
        $lname = $post->user->lname;
        $post = $post;
        $id = $post->id;
        $created_at = $post->created_at->toFormattedDateString();
        $pic = $pic;
        $alt = $alt;
        $title = $post->title;
       @endphp

      {{-- render post card component --}}
    
         <x-post-card 
        :provider="$provider"
        :userpic="$user_pic"
        :fname="$fname" 
        :lname="$lname" 
        :post="$post" 
        :id="$id" 
        :createdat="$created_at" 
        :pic="$pic" 
        :alt="$alt" 
        :title="$title"
        />

        @endforeach
    </div>
</div>

@else
<h1 class="text-center font-weight-bold">No posts to show</h1>
@endif




<div class="container">
@if ($categories->count())
    

    <h3 class="text-center heading__divider mt-4 mb-3 text-uppercase">Explore our categories</h3>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">

            <ul class="list-group">
             
                  @foreach ($categories as $category)
                      
                 
                <li class="list-group-item d-flex justify-content-between align-items-center">
              <a href="{{route('post.collection', $category)}}">{{$category->category__name}}</a>
              
                <span class="badge badge-primary badge-pill">{{$category->postcollection->count()}}</span>
                </li>
                @endforeach
              </ul>
        </div>
    </div>
        
    @endif
</div>


<div class="short_description" id="shortDescription"></div>
</section>


@endsection