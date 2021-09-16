<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


use App\Models\PostCollection;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
       'category__name',
       'parent_category',
    ];

    protected $with = ['postcollection'];



    public function postcollection(){
        return $this->hasMany(PostCollection::class)->latest();
    }



    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'category__name'
            ]
        ];
    }




}
