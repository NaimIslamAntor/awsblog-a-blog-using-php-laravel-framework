@extends('layouts.admin')


@section('content')
    <div class="admin__dashboard">
        <h2 class="dashboard__title">Welcome back <br>{{auth()->user()->fname}} to all posts</h2>

        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto">
                    @if ($posts->count())
                        <form action="{{route('admin.posts.delete')}}" method="POST" onsubmit="warnBeforeDelete(event)">
                          @csrf
                          @method('DELETE')
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col"><a class="btn btn-secondary" onclick="checkPosts()">Chcek All</a></th>
                            <th scope="col"><a class="btn btn-success">ID</a></th>
                            <th scope="col"><a class="btn btn-warning">Title</a></th>
                            <th scope="col"></th>
                            <th scope="col"><button type="submit" class="btn btn-danger">Delete</button></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                
                          <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input post-check" type="checkbox" name="post[]"
                                    value="{{$post->id}}" id="flexCheckChecked">
                                  </div>
                            </th>
                            <th>{{$post->id}}</th>
                            <td><a href="{{route('single.post', $post)}}" target="_blank" class="text-dark">{{$post->title}}</a></td>
                            <td><a href="{{route('single.post.edit', $post)}}"  target="_blank"  class="btn btn-info">Edit</a></td>
                            <td></td>
                          </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </form>
                      @else
                      <h1>No Posts avaiable right now</h1>
                      @endif

                      {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection