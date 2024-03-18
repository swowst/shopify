<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class PageHomeController extends Controller
{
    public function index()
    {
        $cat = Category::where('status', '1')->where('category_up', null)->withCount('items')->get();

        $categories = Category::where('status', '1')->get();
        $sliders = Slider::where('status', '1')->get();
        return view('frontend.pages.index', compact('sliders', 'categories', 'cat'));
    }
}
