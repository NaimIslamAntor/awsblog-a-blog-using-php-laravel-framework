<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category as C;

class CategoryItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $category;
    public $categoryCheckbox;
    public $getbool;

    public function __construct(C $categoryObject, $checkbox, $addToFormOrNot)
    {
       $this->category = $categoryObject;
       $this->categoryCheckbox = $checkbox;
       $this->getbool = $addToFormOrNot;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.category-item');
    }
}
