<?php

namespace App\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Commentlikes;

class Comment extends Model
{
    use HasFactory, RefreshDatabase;

    protected $with = ['user', 'commentlikes'];

    protected $fillable = [
        'user_id',
        'commentbody',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function commentlikes(){
        return $this->hasMany(Commentlikes::class);
    }

    public function commentlikedornot(User $user){
        return $this->commentlikes->contains('user_id', $user->id);
    }
}
