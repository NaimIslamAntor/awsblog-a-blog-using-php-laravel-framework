<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtraController extends Controller
{
    public function termsAndConditions(){
        return view("terms");
    }
}
