<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Product::where('status', '1')->orderBy('id', 'desc')->get();
        return view('backend.pages.products.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = Category::all();
        return view('backend.pages.products.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')){
            $image = $request->file('image');
            $path = time().'-'.Str::slug($image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend/images/products'),$path);
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'color' => $request->color,
            'category_id' => $request->category_id,
            'content' => $request->text,
            'size' => $request->size,
            'image' => 'backend/images/products/' . $path,
            'short_text' => $request->short_text,
            'qty' => $request->qty,
            'status' => $request->status,
        ]);


        return back()->with('success', 'Resim dosyası bulunamadı.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $models = Product::where('id', $id)->first();
        return view('backend.pages.products.create', compact('models'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $products = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = time() . '-' . Str::slug($image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('backend/images/products'), $path);
        } else {
            $path = $products->image;
        }

        Product::where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'color' => $request->color,
            'category_id' => $request->category_id,
            'content' => $request->text,
            'size' => $request->size,
            'image' => 'backend/images/products/' . $path,
            'short_text' => $request->short_text,
            'qty' => $request->qty,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Product başarıyla güncellendi.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $products = Product::where('id', $request->id)->firstOrFail();

        if (!empty($products->image)){
            unlink($products->image);
        }

        $products->delete();

        return response(['error' => false, 'message' => 'Deleted successfully']);
    }


    public function status(Request $request)
    {
        $itemId = $request->input('itemId');
        $status = $request->input('status');

        // Update status in the database
        $products = Product::findOrFail($itemId);
        $products->status = $status;
        $products->save();

        return response()->json(['success' => true]);

    }
}
