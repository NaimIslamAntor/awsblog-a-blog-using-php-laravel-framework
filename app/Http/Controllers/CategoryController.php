<?php

namespace App\Http\Controllers;
use App\Models\Category as C;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware(['auth'])->only('category', 'storecategory', 'storesubcategory'); 
    }



    public function category(){
        $this->authorize('AdminCheck', auth()->user());

 
        //inside where static method we can get paginate also.

        $categories =  C::where('parent_category', NUll)->paginate(20);
      
        

        return view('Admin.category', [
            'categories' => $categories,
        ]);
    }

    public function storecategory(Request $request){
        $this->authorize('AdminCheck', auth()->user());

        $request->validate([
            'categoryname' => 'required|min:3|max:255',
        ]);


        C::create([
            'category__name' => $request->categoryname,
           
        ]);

        return back();
    }


public function storesubcategory(Request $request, C $maincategory){

    $this->authorize('AdminCheck', auth()->user());

    $request->validate([
        'subcategory' => 'required|min:3|max:255',
    ]);

    C::create([
        'category__name' => $request->subcategory,
        'parent_category' => $maincategory->slug,
    ]);


    // $maincategory->subcategory()->create([
    //     'category_name' => $request->subcategory,
    // ]);


    return back();
}

public function getsubcategory(C $category){

    $getcollection = C::where('parent_category', $category->slug)->get();

    return response()->json($getcollection);
}

}
