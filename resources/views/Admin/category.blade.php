@extends('layouts.admin')


@section('content')
    <div class="admin__dashboard">
        <h2 class="dashboard__title">Welcome back <br>{{auth()->user()->fname}} Manage your categories</h2>
       <div class="col-8 mx-auto">
        <form action="{{route('admin.category')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Name of the category</label>
                <input type="text" name="categoryname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category name" required>
              </div>
              <button type="submit" class="btn btn-secondary">Create</button>
        </form>
       <div class="container">
           <div class="row">
        
             @if ($categories->count())

             @php $getbool = false; 
             $checkbox = "";
             @endphp

             @foreach ($categories as $category)
             
             <x-category-item :categoryObject="$category" 
             :checkbox="$checkbox"
             :addToFormOrNot="$getbool" />

             {{-- @if ($category->parent_category == NULL) --}}
                 
            
            
               {{-- <div class="col-lg-3 col-md-6 col-12">
                <div class="form-group my-4">
                    <div class="form-check">
                     
                        <label class="form-check-label">
                           <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               {{$category->category__name}}
                            </button>
                           
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                                
                              {{-- add sub category --}}
                                    {{-- <div class="dropdown-item">
                                        <form class="form-inline" action="{{route('admin.addsub', $category)}}" method="POST">
                                          @csrf
                                       
                                            <div class="form-group  mb-2">
                                              <input type="text" name="subcategory" class="form-control" id="inputPassword2" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary mb-2">Add sub</button>
                                              </div>
                                           
                                          </form>
                                    </div> --}}
                                   
                                    {{-- edit category --}}
                                    {{-- <div class="dropdown-item">
                                      <form class="form-inline" action="{{route('admin.addsub', $category)}}" method="POST">
                                        @csrf

                                          <div class="form-group">
                                              <button  type="submit" class="btn btn-info mb-2">Edit</button>
                                            </div>
                                         
                                        </form>
                                  </div> --}}

                                  {{-- delete category --}}
                                  {{-- <div class="dropdown-item">
                                    <form class="form-inline" action="{{route('admin.addsub', $category)}}" method="POST">
                                      @csrf

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger mb-2">Delete</button>
                                          </div>
                                       
                                      </form>
                                </div> --}}

                                {{-- show subcategory --}}
                                {{-- <div class="dropdown-item">
                                  <button class="btn btn-success" data-subcategory-route="{{route('admin.get.subcategory', $category)}}" 
                                  data-add-or-not="{{false}}" 
                                  data-toggle="modal" data-target="#exampleModal"
                                    onclick="showSubCategory(event)">Show sub</button>
                                </div> --}}
                              

                          {{-- </div>
                        </label>
        
                      </div>
                    
                     
                    </div>
               </div>
          
           
              </div>  --}}

               @endforeach
             
               @endif
            

       </div>
 <center>{{$categories->links()}}</center> 
    </div>
  </div>

<x-subcategory-modal/>

  <script src="{{asset('js/category-manager.js')}}"></script>
@endsection

