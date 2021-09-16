<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

use  App\Models\Category;

class HomeController extends Controller
{



  public function __construct(){
    $this->middleware(['auth'])->only('likethepost', 'postcomments',
     'deletecomment', 'likethecomment');
  }

  public function index(){

    // dd(auth()->user);
    // $getAll = DB::table('posts')->paginate(10);
    // $getAll = Post::latest()->paginate(1);

    // $getAll = Post::latest()->limit(9)->get();



    // $getAll = Post::with(['user', 'postlikes'])->latest()->limit(9)->get();

    $getAll = Cache::remember("posts9", 300, function(){
      return Post::with(['user', 'postlikes'])->latest()->limit(9)->get();
    });

    // $categories = Category::all();

    
    $categories = Cache::remember("categories9", 300, function(){
      return Category::where('parent_category', NULL)->get();
    });

    // $categories = Category::where('parent_category', NULL)->get();

  //  dd($categories);
//dd($getAll);


      return view("home",[
        'posts' => $getAll,
        'categories' => $categories,
      ]);

  }


  public function showsinglepost(Post $post){

    //make array back pic_alt_tags tablw with unserialize function $pic, $alt, $tags belong to this array
    $picAltTags = unserialize($post->pic_alt_tags);
    
      //make array back ex_des tablw with unserialize function $ex, $body, belong to this array
    $exDes = unserialize($post->ex_des);
    
    //extract $picAltTags, $exDs
    extract($picAltTags);
    extract($exDes);

    //after extracting $exDs we get a body array extract that $content, belongs to this array
    extract($body);

    $pub_date = $post->created_at->toFormattedDateString();
    $author_pic = $this->postAuthorimage($post);


    $likeCheck = null;
    $totallikes = $post->postlikes->count();

if (Auth::check()) {
  if ($post->likedornot(auth()->user())){
    $likeCheck = 'heart-given';
  }
}

$id = $post->id;
$title = $post->title;
$slug = $post->slug;

$author_name = $post->user->fname.' '.$post->user->lname;




//dd($categoriesCollection);


// $lcoms = Post::find(1)->comments;
// dd($post->comments);
    return view('post',[
      'id' => $id,
      'title' => $title,
      'slug' => $slug,
      'pic' => $pic,
      'alt' => $alt,
      'tags' => $tags,
      'author_name' => $author_name,
      'ex' => $ex,
      'content' => $content,
      'pub_date' => $pub_date,
      'author_pic' => $author_pic,
      'heartgiven' => $likeCheck,
      'totallikes' => $totallikes,
      'comments' => $post->comments->take(20),
      'count' => $post->comments->count(),

    ]);
  }

  //get post categories

  public function postcategories(Post $post){
    $categoriesCollection = $post->postcollection;

    $category = [];

    foreach ($categoriesCollection as $key => $value) {
      array_push($category, $value->category);
    }
    return response()->json($category, 200);
  }


  //modify images
  private function postAuthorimage($instanc){
    if ($instanc->user->provider == 'awsblog') {
        $author_pic = asset('storage/img/profile/'.$instanc->user->user_pic);
        return $author_pic;
    }else{
      $author_pic = $instanc->user->user_pic;
      return $author_pic;
    }
  }


  public function likethepost(Post $post){
    if (!$post->likedornot(auth()->user())) {

      $post->postlikes()->create([
        'user_id' => auth()->user()->id,
      ]);

    }else {
      $post->postlikes()->where('user_id', auth()->user()->id)->delete();
    }

    // return back();
  }

//post a comment
  public function postcomments(Post $post, Request $request){

    $request->validate([
      'comment' => 'required',
    ]);

    // dd($post->comments());



    $post->comments()->create([
      'user_id' => auth()->user()->id,
      'commentbody' => $request->comment,
    ]);


    return back();

  }



  public function editcomment(Comment $comment, Request $request){
    $this->authorize('commentauthorization', $comment);

    // $request->validate([
    //   'editcomment' => 'required',
    // ]);

    $vali = Validator::make($request->all(), [
      'editcomment' => 'required',
    ]);

    $commentstuffonerr = [
      'cominstace' => $comment,
      'warmessage' => 'This field is required for editing a comment',
    ];

    if ($vali->fails()) {
      //return redirect()->route('single.post', $comment->post_id)->with('lastcomment', $commentstuffonerr);
      return back()->with('lastcomment', $commentstuffonerr);
    }

    $comment->commentbody = $request->editcomment;
    $comment->save();
    return back();
  }



  public function deletecomment(Comment $comment){
  $this->authorize('commentauthorization', $comment);
  
  $comment->delete();
  return back();
  }



public function quickread(Post $post){
$getexds = unserialize($post->ex_des);

return  response()->json([
  'quickread' => $getexds['ex'],
]);

}


public function likethecomment(Comment $comment){

  if (!$comment->commentlikedornot(auth()->user())) {
    $comment->commentlikes()->create([
      'user_id' => auth()->user()->id,
    ]);

    return back();
  }

  $comment->commentlikes()->where('user_id', auth()->user()->id)->delete();
  return back();
}


public function loadcomment(Post $post, $limit){
  $comments = $post->comments->skip($limit)->take(20);

  return  response()->json([
   $comments
  ]);
}



public function collection(Category $category){

  $child_category = Category::where('parent_category', $category->slug)->get();

  return view('collectionpost', [
    'collection' => $category->postcollection->take(20),
    'childcollection' => $child_category,
  ]);

}

}
