<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category as C;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    
    public function index(){
        $this->authorize('AdminCheck', auth()->user());
        return view('Admin.index');
    }

 

 
}
