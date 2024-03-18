<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function contactForm(ContactFormRequest $request)
    {
        $data = $request->all();
        $data['ip'] = request()->ip();
        Contact::create($data);

        return redirect()->back()->withSuccess('Saved successfully!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function filterItems(Request $request)
    {
       $minPrice = $request->minPrice;
       $maxPrice = $request->maxPrice;
       $size = $request->size;
       $color = $request->color;

        $filteredProducts = Product::where('status', '1')
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

        return view('frontend.pages.shop', compact('filteredProducts'));

    }
}
