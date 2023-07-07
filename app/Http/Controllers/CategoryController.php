<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //list
    public function list(){
        return view('Admin.Category.list');
    }
}
