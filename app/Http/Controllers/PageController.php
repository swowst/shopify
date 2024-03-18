<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function cart()
    {
        return view('frontend.pages.cart');
    }

    public function about()
    {
        $about = About::where('id', 1)->first();
        $categories = Category::where('status', '1')->get();

        return view('frontend.pages.about' , compact('about', 'categories'));
    }

    public function contact()
    {
        $categories = Category::where('status', '1')->get();

        return view('frontend.pages.contact', compact('categories'));
    }

    public function shop(Request $request, $slug=null)
    {
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $size = $request->size;
        $color = $request->color;

        $products = Product::where('status', '1')
            ->where(function ($q) use ($minPrice, $maxPrice, $color, $size){
                if (!empty($size)){
                    $q->where('size', $size);
                }

                if (!empty($color)){
                    $q->where('color', $color);
                }

                if (!empty($minPrice) && $maxPrice ){
                    $q->whereBetween('price', [$minPrice, $maxPrice]);
                }
                return $q;
            })
            ->get();


        $sizeList = $products->groupBy('size')->all();
        $colors = $products->groupBy('color')->all();

        $categories = Category::where('status', '1')->get();
        $cat = Category::where('status', '1')->where('category_up', null)->withCount('items')->get();


        return view('frontend.pages.shop', compact('categories', 'products', 'cat', 'sizeList', 'colors'));
    }



    public function saleProducts()
    {
        $categories = Category::where('status', '1')->get();

        return view('frontend.pages.shop', compact('categories'));
    }



    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $categories = Category::where('status', '1')->get();

        return view('frontend.pages.detail', compact('categories', 'product'));
    }

    public function checkout()
    {
        $categories = Category::where('status', '1')->get();

        return view('frontend.pages.checkout' , compact('categories'));
    }


    public function account()
    {
        $categories = Category::where('status', '1')->get();


        return view('frontend.pages.account' , compact('categories'));
    }



    public function registerView()
    {
        $categories = Category::where('status', '1')->get();

        return view('frontend.pages.register' , compact('categories'));
    }





}
