<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Shop;

class WebController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $shops = Shop::paginate(5); // 
        
        return redirect()->route('shops.index');
    }
}
