@extends('layouts.app')

@section('meta')
{{-- meta tags for sharing post to social medias --}}
   <meta property="og:title" content="{{$title}}">
   <meta property="og:url" content="{{route('single.post', $slug)}}">
   <meta property="og:image" content="{{asset('storage/img/postimage/'.$pic)}}">
   <meta property="og:description" content="{{$ex}}">
   <meta property="og:type" content="article">

   {{-- meta tags for sharing post to twitter --}}
   <meta property="twitter:site" content="@awsblog">
   <meta property="twitter:title" content="{{$title}}">
   <meta property="twitter:description" content="{{$ex}}">
   <meta property="twitter:image" content="{{asset('storage/img/postimage/'.$pic)}}">
   <meta property="twitter:image:alt" content="{{$alt}}">
   <meta property="twitter:card" content="summary_large_image">
@endsection


@section('captchaScript')
    <link rel="stylesheet" href="{{asset('css/post.css')}}">
@endsection

@section('content')
   <section class="post-section">

       <div class="container-fluid">
      
           <div class="row">

            {{-- public-stuff area --}}
               <div class="col-lg-2 col-md-12 public-stuff">
                   <div class="heart-and-share">
                       <form class="heart-from" action="{{route('post.like', $id)}}" 
                        method="POST"
                        onsubmit="@guest login(event) @endguest @auth like(event) @endauth">
                        @csrf
                       <button class="public-mic-glo heart {{$heartgiven}}"><i class="far fa-heart"></i></button>
                       <div id="heart-count">{{$totallikes}}</div>
                    </form>
                    <div class="share-from dropdown">
                       <button class="public-mic-glo share" 
                       id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" 
                       aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
                       {{-- <div>0</div> --}}
                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item">
                            <div class="copy-link">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="copy-post-url" value="{{route('single.post', $slug)}}">
                                    <button class="btn btn-secondary mt-1" onclick="copyForShare()">Copy</button>
                                  </div>
                            </div>
                        </a>
                        <a class="dropdown-item"
                        href="https://facebook.com/share.php?u={{route('single.post', $slug)}}" target="__blank">Facebook</a>

                        <a class="dropdown-item" 
                        href="https://twitter.com/intent/tweet?text={{route('single.post', $slug)}}" target="__blank">Twitter</a>

                        <a class="dropdown-item" 
                        href="https://www.reddit.com/submit?url={{route('single.post', $slug)}}&title={{$title}}" target="__blank">Reddit</a>
                      </div>
                    </div>
                   </div>
               </div>


               {{-- read-post area --}}
               <div class="col-lg-8 col-md-12 mx-auto read-post">
               
                   <div class="post">
                    <div class="post-image">
                        @if ($pic != null)
                        <img src="{{asset('storage/img/postimage/'.$pic)}}" loading="lazy" decoding="async" alt="post-image" class="img-fluid post-img">
                        @else
                        <div class="text-center">
                            <h1 class="bg-red">This post doesn't contain a post image</h1>
                        </div>
                        @endif
                    </div>
                    <div class="start-reading">
                        <h1 class="font-weight-bold post-title-single">{{$title}}</h1>


                        <div class="author-manager my-3">
                            
                            <img src="{{$author_pic}}" alt="{{$author_name}}" loading="lazy" decoding="async" class="author-picture">
                            <a class="profile__link profile-link" href="#">{{$author_name}}</a>
                            <a class="date-of-published">{{$pub_date}}</a>
                        </div>
                        <div class="content">
                           {!!$content!!}
                        </div>

                        <div class="tags-manager my-2">
                            {{$tags}}
                        </div>

     <div class="categories-manager my-2" 
     id="categoryManager" 
     data-category-route="{{route('post.get.categories', $id)}}">

                 </div>


                    </div>
                 {{-- comment area --}}
                 <div class="container make-comment">
                     <div class="row">
                        <form class="col-lg-8 col-md-12 col-12 mx-auto" action="{{route('post.comment', $id)}}" method="POST">
                            @csrf
                            <h4><strong>Comment section</strong></h4>
                         
          <div class="form-group">
             <textarea class="form-control comment-textarea" name="comment" rows="3" @guest onclick="login(event)" @endguest
                               placeholder="Post a comment..."></textarea>
               @error('comment')
                   <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> {{$message}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button></div>
                                @enderror </div>
                  <button type="submit" class="btn btn-secondary" @guest onclick="login(event)" @endguest>Post Comment</button>
                          </form>
                     </div>

  {{-- comment show area --}}
  {{-- data-authenticated="@auth{{true}}@endauth{{''}}@guest{{false}}@endguest" --}}



                     <div class="row" id="commentsBoss" data-comment-count="{{$count}}"

                      data-post-id="{{$id}}"  

                      @auth
                      data-authenticated="{{true}}"
                      @endauth

                      @guest
                      data-authenticated="{{false}}"
                      @endguest

                   
                      @auth  data-user-id="{{auth()->id()}}" @endauth  data-csrf="{{csrf_token()}}">
                      
                         @if ($comments->count())       
                         @foreach ($comments as $comment)
                             
                        
                        <div class="col-lg-8 col-md-12 col-12 mx-auto py-4 show-comment">     
                         <div class="comment-author-fancy-divider d-flex">
                            <img src="
                            @if ($comment->user->provider == 'awsblog') {{asset('storage/img/profile/'.$comment->user->user_pic)}}
                            @else {{$comment->user->user_pic}} @endif"

                             alt="{{$comment->user->fname}} {{$comment->user->lname}}" loading="lazy"
                              decoding="async" class="author-picture mt-2">

                            <div class="comment-fancy-box">
                                <div class="comment-author">
                                    <h6 class="comment-author-name">{{$comment->user->fname}} {{$comment->user->lname}}
                                        <i class="fas fa-chevron-right right-arrow-fontawesome"></i>  <span>{{$comment->created_at->toFormattedDateString()}}</span>
                                    </h6>

                               @can('commentauthorization', $comment)

                                    <div class="comment-author-options dropdown">
                                        <i class="fas fa-ellipsis-h" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i> 
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item">
                                                <div>
                                                    <button class="btn"  data-edit-route="{{route('edit.comment', $comment)}}"
                                                        data-comment="{{$comment->commentbody}}" onclick="edit(event)">Edit</button>
                                                </div>
                                            </a>
                                            <a class="dropdown-item">
                                                <form action="{{route('delete.comment', $comment)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn" 
                                                    onclick="deleteConfirmation(event)">Delete</button>
                                                </form>
                                            </a>
                                          </div> 
                                    </div>
                                    @endcan
                                </div>
                                <div class="comment">
                                   {{$comment->commentbody}}
                                </div>
                              
                            </div>
                         </div>
                         
                          <div class="comment-public d-flex mt-2">
                              <form @auth method="POST" action="{{route('post.comment.like', $comment)}}" onsubmit="commentlike(event)" @endauth>
                                  @csrf
                                  <button type="submit" class="public-cons-btn" @guest onclick="login(event)" @endguest>
                                    <i class="far fa-heart mr-2 @auth 
                                    @if ($comment->commentlikedornot(auth()->user()))
                                        liked
                                    @endif
                                    @endauth"></i> <span>
                                        <span>{{$comment->commentlikes->count()}}</span>
                                        <span class="public-rere"> {{Str::plural('like', $comment->commentlikes->count())}}</span>
                                    </span>
                                </button>
                              </form>
                              <form class="ml-2">
                                  @csrf
                                <button class="public-cons-btn"><i class="far fa-comment-dots mr-2"></i> <span>5 <span class="public-rere">replies</span></span></button>
                                
                            </form>

                            </div>
                        </div>
                        @endforeach
                   
                        @endif

                      
                    </div>
                  
                   @if ($count > 20)
                   <img src="http://127.0.0.1:8000/storage/img/fancy/preloader.svg" alt="Loading..." width="70"
                    height="70" id="preLoaderOfComment" class="d-none mx-auto">
                   @endif
                  
                 </div>
                   </div>
               </div>


               {{-- author-of-post area --}}
               <div class="col-lg-2 col-md-12 author-of-post">
                   {{-- author info --}}
                    <div class="author-info side-author">
                        <div class="author-manager my-3 pb-2">
                           <center>
                            <img src="{{$author_pic}}" alt="" class="author-picture"><br>
                            <a class="profile__link profile-link" href="#"><strong>{{$author_name}}</strong></a>
                            <p class="about-author mx-1">Tech Lead, Physics Grad, Video/Photographer, Tech Fan, All Round Tweeter! </p>
                        </center>
                           
                        </div>
                    </div>


                        {{-- author latest posts --}}

                        {{-- <div class="author-info side-author author-l-post  mt-2 p-2">
                            <div class="author-manager my-3 pb-2">
                                <ul class="author-l-r-unorder">
                                    <li class="author-lr-list"> <a class="author-l-r-post" href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores quasi tempore eligendi repellendus voluptatibus.</a></li>
                                    <li class="author-lr-list"> <a class="author-l-r-post" href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores quasi tempore eligendi repellendus voluptatibus.</a></li>
                                    <li class="author-lr-list"> <a class="author-l-r-post" href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores quasi tempore eligendi repellendus voluptatibus.</a></li>
                                </ul>
                            </div>
         
                        </div> --}}

                      

               </div>


           </div>
       </div>
          @auth
          <form id="commentEditModal" class="comment-edit-modal p-2 
           @if (session('lastcomment')) start-edit  @endif"

         @if (session('lastcomment')) action="{{route('edit.comment', @session('lastcomment')['cominstace'])}}" @endif   method="POST">

              @csrf
              @method('PUT')
              <div class="form-group">
                <textarea class="form-control comment-textarea edit-comment-textarea"
                 name="editcomment" id="editComment" rows="3"></textarea>

               @if(session('lastcomment'))
               <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> {{@session('lastcomment')['warmessage']}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button></div>
               @endif

                <button type="submit" class="btn btn-secondary mt-2">Edit</button>
                <button type="submit" class="btn btn-secondary mt-2" onclick="dontEdit(event)">cancel</button>
              </div>
          </form>
          @endauth
   </section>
   
  
   {{-- <script type="text/javascript">



</script> --}}

@endsection

