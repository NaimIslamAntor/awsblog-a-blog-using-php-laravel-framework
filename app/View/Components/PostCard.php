<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Post;
class PostCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $provider;
    public $userpic;
    public $fname;
    public $lname;
    public $post;
    public $id;
    public $createdat;
    public $pic;
    public $alt;
    public $title;
    

    public function __construct($provider, $userpic, $fname, $lname, Post $post, $id, $createdat, $pic, $alt, $title)
    {
    $this->provider = $provider;
    $this->userpic = $userpic;
    $this->fname = $fname;
    $this->lname = $lname;
    $this->post = $post;
    $this->id = $id;
    $this->createdat = $createdat;
    $this->pic = $pic;
    $this->alt = $alt;
    $this->title = $title;
    }



    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.post-card');
    }
}
