@extends('layouts.admin')

@section('trixeditorfiles')
@trixassets
@endsection
@section('content')
    <div class="admin__dashboard">
      
  


        <h2 class="dashboard__title">Welcome back <br>{{auth()->user()->fname}} Make your post</h2>

        <div class="container">
        
            <div class="row">
           
                <div class="col-8 mx-auto">

                  {{-- title error --}}
                  @error('post__title')
                  <div class="alert alert-warning" role="alert">
                   {{$message}}
                  </div>
                  @enderror

                  {{-- alt error --}}
                  @error('Alt__tag')
                  <div class="alert alert-warning" role="alert">
                   {{$message}}
                  </div>
                  @enderror

                  {{-- tags error --}}
                  @error('seo__tags')
                  <div class="alert alert-warning" role="alert">
                   {{$message}}
                  </div>
                  @enderror

                @php   $null = null;  @endphp
          
                 <x-post-form
                  :post="$null"
                 :categories="$categories"
                 />
                 
                
                  {{-- <h1>Hi there</h1> --}}

                 {{-- <form action="{{route('admin.post')}}" method="POST" enctype="multipart/form-data">
                     @csrf
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
                                <input type="text" class="form-control" name="Alt__tag" aria-describedby="emailHelp" placeholder="Write your title">
                                <small id="emailHelp" class="form-text text-muted">Alt is good for seo</small>
                            </div>
                            <div class="col-lg-6 col-md-12 col-12">
                                <label for="exampleInputEmail1">write tags separate them with (,)</label>
                                <input type="text" class="form-control" name="seo__tags" aria-describedby="emailHelp" placeholder="Write your title">
                                <small id="emailHelp" class="form-text text-muted">Tags are also good for seo</small>
                            </div>
                        </div>
                      </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" name="post__title" aria-describedby="emailHelp" placeholder="Write your title">
                        <small id="emailHelp" class="form-text text-muted">A good title is so important to attact people to read you article</small>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Excerpt</label>
                        <textarea class="form-control" name="post__excerpt" rows="3" 
                        placeholder="Write your except (optional)"></textarea>
                        <small id="emailHelp" class="form-text text-muted">Excerpt is optional</small>
                      </div>
                    @trix(\App\Post::class, 'content')

                    <div class="container">
                      <div class="row">

                    @if ($categories->count())

                    @php $getbool = true; @endphp
       
                    @foreach ($categories as $category)
                    
                    @php  $checkbox = "<input class='form-check-input' type='checkbox' name='category[]' value='$category->id' id='flexCheckChecked'>"; @endphp

                    <x-category-item :categoryObject="$category" 
                    :checkbox="$checkbox"
                    :addToFormOrNot="$getbool" />

                    @endforeach
             
                    {{-- subcategory adding block --}}
                    {{-- <div id="subCategoriesListing">
                      {{-- <input type="hidden" name=""> --}}
                    {{-- </div> --}}
                    {{-- @endif --}}
                 
     
            {{-- </div>
                    <button type="submit" class="btn btn-info btn-lg btn-block my-5">Post</button>
                 </form> --}}
                </div>
            </div>
        </div>
    </div>
    <x-subcategory-modal/>
    <script src="{{asset('js/category-manager.js')}}"></script>
@endsection
