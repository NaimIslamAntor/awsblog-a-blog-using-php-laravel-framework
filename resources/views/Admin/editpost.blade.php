@extends('layouts.admin')

@section('trixeditorfiles')
@trixassets
@endsection


@section('content')

<div class="admin__dashboard">

    
    <h2 class="dashboard__title">Welcome back <br>{{auth()->user()->fname}} Make edit in your post</h2>
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">

        
             <x-post-form
             :post="$post"
             :categories="$categories"
             />


            </div>
        </div>
    </div>
</div>
<x-subcategory-modal/>
<script src="{{asset('js/category-manager.js')}}"></script>
    
@endsection