

<div class="col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
    <div class="blog_holder">
     <div class="blog__header">

         <div class="avatar profile">
             <img src="
             @if($provider == "awsblog")
             {{asset('storage/img/profile/'.$userpic)}}
             @else
             {{$userpic}}
             @endif" alt="A" class="profile">
         </div>

         <div class="profile__info">
             <p class="a_name"><a class="profile__link" href="#">{{$fname}} {{$lname}}</a></p>
             <p class="p_date">{{$createdat}}</p>
         </div>
     </div>
     <div class="blog__image__and__short__description">
         <img src="{{asset('storage/img/postimage/'.$pic)}}" loading="lazy" decoding="async" alt="{{$alt}}" class="img-fluid postimage-custom">
         <div class="post__description">
           <a  class="post__link" href="{{route('single.post', $post)}}">{{$title}}</a>
          
        
         </div>
     </div>
     <div class="blog__footer"> 
        <button class="btn post__btn post_heart
        @auth @if ($post->likedornot(auth()->user())) liked @endif @endauth"><i class="off fas fa-heart"></i></button>

      
      <div class="dropdown share-wrapper">
        <button class="btn post__btn post_share" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" 
        aria-expanded="false"
><i class="off fas fa-share-alt"></i></button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item">
              <div class="copy-link">
                  <div class="form-group">
                      <input type="text" class="form-control" id="copy-post-url-{{$id}}" value="{{route('single.post', $post)}}">
                      <button class="btn btn-secondary mt-1" onclick="copyForShareFromHome('copy-post-url-{{$id}}')">Copy</button>
                    </div>
              </div>
          </a>
          <a class="dropdown-item"
          href="https://facebook.com/share.php?u={{route('single.post', $post)}}" target="__blank">Facebook</a>

          <a class="dropdown-item" 
          href="https://twitter.com/intent/tweet?text={{route('single.post', $post)}}" target="__blank">Twitter</a>

          <a class="dropdown-item" 
          href="https://www.reddit.com/submit?url={{route('single.post', $post)}}&title={{$title}}" target="__blank">Reddit</a>
        </div>
      </div>
        <button class="btn post__btn post__read" data-loader="{{asset('storage/img/fancy/loader.gif')}}"
        data-route="{{route('post.quick.read', $post)}}" onclick="quickRead(event)"><i class="off fas fa-chevron-down"></i></button>
     </div>
 </div>
    </div> 