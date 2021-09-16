

{{--
  
  if the $post value is null then the admin is here to post.
  And if it's a Post Model object then the admin is here to edit.
  
--}}
{{-- <form action="{{route('admin.post')}}" method="POST" enctype="multipart/form-data"> --}}


<form action="@if ($post == null) {{route('admin.post')}} @else {{route('admin.post.edit', $post)}} @endif" 

method="POST" enctype="multipart/form-data">
    @csrf

    @if ($post != null) @method('PUT') @endif

    {{-- <h1>{{$post->postcollection->count()}}</h1> --}}



    @php
        $src = '';
        $alt = '';
        $tags = '';
        $title = '';
        $excerpt = '';
        $content = '';
    @endphp

    @if ($post != null)
        @php

        //getting alt, tags, pImage
        $altObject = (object)unserialize($post->pic_alt_tags);
        $src = $altObject->pic;
        $alt = $altObject->alt;
        $tags = $altObject->tags;


        //set title
        $title = $post->title;

        //getting excerpt, content

         $excerptAndDescription = (object)unserialize($post->ex_des);

          $body = (object)$excerptAndDescription->body;

        //set excerpt
        $excerpt = $excerptAndDescription->ex;

        //set content
        $content = $body->content;
        @endphp
    @endif



    {{-- show the image on edit --}}
    @if ($post != null)
    <div class="input-group mb-3 mt-4">
       <img src='{{asset("storage/img/postimage/$src")}}' alt="{{$alt}}" class="img-fluid">
    </div>

    <input type="hidden" name="defaultPostImage" value="{{$src}}">
    @endif



   <div class="input-group mb-3">
       <div class="input-group-prepend">
         <span class="input-group-text">Upload</span>
       </div>
       <div class="custom-file">
         <input type="file" class="custom-file-input"  name="post__image">
         <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
       </div>
     </div>
     <div class="form-group">
       <div class="row">
           <div class="col-lg-6 col-md-12 col-12">
               <label for="exampleInputEmail1">Provide an alt tag</label>
               <input type="text" class="form-control" name="Alt__tag" aria-describedby="emailHelp"
               
               value="{{$alt}}"
               placeholder="Write your title">
               <small id="emailHelp" class="form-text text-muted">Alt is good for seo</small>
           </div>
           <div class="col-lg-6 col-md-12 col-12">
               <label for="exampleInputEmail1">write tags separate them with (,)</label>
               <input type="text" class="form-control" name="seo__tags" aria-describedby="emailHelp"
               
               value="{{$tags}}"
               placeholder="Write your title">
               <small id="emailHelp" class="form-text text-muted">Tags are also good for seo</small>
           </div>
       </div>
     </div>
   <div class="form-group">
       <label for="exampleInputEmail1">Title</label>
       <input type="text" class="form-control" name="post__title"
       
       value="{{$title}}"
       aria-describedby="emailHelp"
        placeholder="Write your title" required>
       <small id="emailHelp" class="form-text text-muted">A good title is so important to attact people to read you article</small>
     </div>
     <div class="form-group">
       <label for="exampleFormControlTextarea1">Excerpt</label>

       <textarea class="form-control" name="post__excerpt" rows="3" 
       placeholder="Write your except (optional)">{{$excerpt}}</textarea>
       <small id="emailHelp" class="form-text text-muted">Excerpt is optional</small>
     </div>
   @trix(\App\Post::class, 'content')

   <div class="container">
     <div class="row">

   @if ($categories->count())

   @php $getbool = true; @endphp



   @foreach ($categories as $category)

   @php
   
   if ($post != null):
   $checked = $post->categoryexistsornot($category) ? 'checked' : '';
   $categoryeditorpost = 'subcategory[]';
   
   else:
   $checked = '';
   $categoryeditorpost = 'category[]';
   
  endif;
     
   @endphp

      
   @php  $checkbox = "<input class='form-check-input' type='checkbox' $checked name='$categoryeditorpost' value='$category->id' id='flexCheckChecked'>"; @endphp

   {{-- @php  $checkbox = "<input class='form-check-input' type='checkbox' $checked  value='$category->id' id='flexCheckChecked'>"; @endphp --}}


   <x-category-item :categoryObject="$category" 
   :checkbox="$checkbox"
   :addToFormOrNot="$getbool" />


   @endforeach

 
   {{-- subcategory adding block --}}
   <div id="subCategoriesListing">
    

@if ($post != null)
    

@if ($post->postcollection->count())

@foreach ($post->postcollection as $subCategory)
 @if ($subCategory->category->parent_category != null)
  
<input type='hidden' value={{$subCategory->category_id}}  name='subcategory[]'>

@endif
@endforeach 

@endif
@endif
   </div>
   @endif


</div>
   <button type="submit" class="btn btn-info btn-lg btn-block my-5">Post</button>
</form>


<script>

//this code sets the content to editor
const getEditorTrix = document.querySelector("#post-content-new-model");
getEditorTrix.value = "{!!$content!!}";


</script>