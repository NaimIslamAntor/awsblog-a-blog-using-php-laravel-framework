@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 80px">

@if ($childcollection->count())
    <div class="row subcategories-row">
       <div class="col-12">
        <h3 class="subcategory-heading">Subcategories</h3>
       </div>
        <div class="col-12 pt-2">
            @foreach ($childcollection as $item)
            <a href="{{route('post.collection', $item)}}" class="btn btn-success">{{$item->category__name}}</a>
            @endforeach
        </div>
    </div>
    @endif

    <div class="row">
        @if ($collection->count())
        @foreach ($collection as $item)

        @php 
        extract(unserialize($item->post->pic_alt_tags));
        @endphp

        <div class="col-lg-4 col-md-6 col-sm-12">

            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{asset("storage/img/postimage/$pic")}}" alt="{{$alt}}">
                <div class="card-body">
                  <a href="{{route('single.post', $item->post)}}" class="card-text">
                      {{$item->post->title}}
                  </a>
                </div>

              </div>

        </div>
        @endforeach
        @else
        <div class="col-12 text-center">
            <h1>This Category has no posts</h1>
        </div>
        @endif
    </div>
</div>

@endsection