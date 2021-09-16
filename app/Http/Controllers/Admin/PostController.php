<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category as C;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;


class PostController extends Controller
{
    private $postImage = null;

    public function __construct(){
        $this->middleware(['auth']);
      
    }

    public function post(){
        $this->authorize('AdminCheck', auth()->user());
         $categories =  C::where('parent_category', NUll)->paginate(20);

        //$categories =  C::all();
        return view('Admin.post',[
            'categories' => $categories,
        ]);
    }


    public function storepost(Request $request){
       // dd($request->category);

       //dd($request->subcategory);

    //    foreach($request->subcategory as $sub){
    //     if (C $sub) {
           
    //     }
    //    }

    
    // if ($request->category->count()) {
    //         dd($request->category);
    // }else{
    //     dd("It didnot work");
    // }


   // dd($request->subcategory);
    

        $this->authorize('AdminCheck', auth()->user());
        $request->validate([
            'post__title' => 'required',
            'Alt__tag' => 'max:255',
            'seo__tags' => 'max:255',
        ]);


        if ($request->hasFile('post__image')) {

            $request->file('post__image')->store("public/img/postimage");
           // dd($request->file('post__image')->hashName());
           $this->postImage = $request->file('post__image')->hashName();

        }

        $picAltTags = serialize([
            'pic' => $this->postImage,
            'alt' => $request->Alt__tag,
            'tags' => $request->seo__tags,
        ]);


        $ExDs = serialize([
            'ex' => $request->post__excerpt,
            'body' => request('post-trixFields'),
        ]);

// dd(request('post-trixFields'));
       $post = $request->user()->posts()->create([
            'title' => $request->post__title,
            'pic_alt_tags' => $picAltTags,
            'ex_des' => $ExDs,
         
        ]);

        //dd($post->id);


        if ($request->category !== null) {

            foreach ($request->category as $key => $value) {
                $post->postcollection()->create([
                    'category_id' => $value,
                ]);
            }
          
        }


        
        if ($request->subcategory !== null) {
            
            foreach ($request->subcategory as $key => $value) {
                $post->postcollection()->create([
                    'category_id' => $value,
                ]);
            }
          
        }


        return back();

    }


    public function showposts(){
        $this->authorize('AdminCheck', auth()->user());
        $latestposts = Post::latest()->paginate(30);

        return view("Admin.allposts", [
            'posts' => $latestposts,
        ]);
    }



    public function destroyposts(Request $request){
        $this->authorize('AdminCheck', auth()->user());

        foreach ($request->post as $key => $post) {
           $findpost = Post::find($post);
           $findpost->delete();
        }

        return back();

    }



    /*
     *
     @This method used to show post to edit. 
     *
     */

    public function showSinglePostToEdit(Post $post){
        $this->authorize('AdminCheck', auth()->user());

        // dd("Lets edit posts");

       // dd($post);

        $categories =  C::where('parent_category', NULL)->get();


        return view('Admin.editpost', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }


    public function editpost(Post $post, Request $request){

        $this->authorize('AdminCheck', auth()->user());


      
        
        $request->validate([
            'post__title' => 'required',
            'Alt__tag' => 'max:255',
            'seo__tags' => 'max:255',
        ]);


        if ($request->hasFile('post__image')) {

            $request->file('post__image')->store("public/img/postimage");
           // dd($request->file('post__image')->hashName());
           $this->postImage = $request->file('post__image')->hashName();

        }else {
            $this->postImage = $request->defaultPostImage;
        }

        $picAltTags = serialize([
            'pic' => $this->postImage,
            'alt' => $request->Alt__tag,
            'tags' => $request->seo__tags,
        ]);


        $ExDs = serialize([
            'ex' => $request->post__excerpt,
            'body' => request('post-trixFields'),
        ]);


        $post->update([
            'title' => $request->post__title,
            'pic_alt_tags' => $picAltTags,
            'ex_des' => $ExDs,
        ]);


        $post->postcollection()->delete();


        $categories = $request->subcategory;

        if ($categories != null) {
            foreach ($categories as $key => $category) {
               $post->postcollection()->create([
                   'category_id' => $category,
               ]);
            }
        }


        return back();
    }


}
