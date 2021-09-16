<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Post;


class PostForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $post;
     public $categories;

     //Post $post
    public function __construct($categories,  $post)
    {
        
       $this->post = $post;
       $this->categories = $categories;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.post-form');
    }
}
