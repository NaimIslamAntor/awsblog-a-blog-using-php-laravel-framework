<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use App\Models\User;
use App\Models\Postlike;
use App\Models\Comment;
use Cviebrock\EloquentSluggable\Sluggable;

use App\Models\Category;

use App\Models\PostCollection;


class Post extends Model
{
    use HasFactory, HasTrixRichText, Sluggable;


    protected $fillable = [
        'title',
        'pic_alt_tags',
        'ex_des',
    ];


    //protected $with = ['postcollection'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function postlikes(){
        return $this->hasMany(Postlike::class);
    }


    public function likedornot(User $user){
        return $this->postlikes->contains('user_id', $user->id);
    }

    public function comments(){
        return $this->hasMany(Comment::class)->latest();
    }



    public function postcollection(){
        return $this->hasMany(PostCollection::class);
    }



    public function categoryexistsornot(Category $category){
        return $this->postcollection->contains('category_id', $category->id);
    }




    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
