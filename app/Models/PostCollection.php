<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//importing user and post model
use App\Models\Category;
use App\Models\Post;



class PostCollection extends Model
{
    use HasFactory;


    protected $fillable = [
        'category_id',
    ];

    protected $with = ['post'];


    public function post(){
        return $this->belongsTo(Post::class);
    }


    public function category(){
        return $this->belongsTo(Category::class);
    }


}
