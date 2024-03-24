<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomePage(){
        $category = Category::all(); 
        $brand = Brand::all(); 
        return view('pages.home-page')->with(['category' => $category, 'brand' => $brand]);
    }
}
