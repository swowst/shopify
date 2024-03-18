<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Category::with('category')->get();
        return view('backend.pages.category.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = Category::where('category_up', null)->get();
        return view('backend.pages.category.create', compact( 'cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')){
            $image = $request->file('image');
            $path = time().'-'.Str::slug($image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend/images/category'),$path);
        }

        Category::create([
            'name' => $request->name,
            'image' => 'backend/images/category/' . $path,
            'content' => $request->text,
            'category_up' => $request->category_up,
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
        $cats = Category::where('category_up', null)->get();

        $models = Category::where('id', $id)->first();
        return view('backend.pages.category.create', compact('models', 'cats'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = time() . '-' . Str::slug($image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('backend/images/category'), $path);

            // Eski resmi sil
            if (file_exists(public_path('backend/images/category/' . $category->image))) {
                unlink(public_path('backend/images/category/' . $category->image));
            }
        } else {
            $path = $category->image;
        }

        Category::where('id', $id)->update([
            'name' => $request->name,
            'image' => 'backend/images/category/' . $path,
            'content' => $request->text,
            'category_up' => $request->category_up,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Category başarıyla güncellendi.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::where('id', $request->id)->firstOrFail();

        if (!empty($category->image)){
            unlink($category->image);
        }

        $category->delete();

        return response(['error' => false, 'message' => 'Deleted successfully']);
    }


    public function status(Request $request)
    {
        $itemId = $request->input('itemId');
        $status = $request->input('status');

        // Update status in the database
        $category = Category::findOrFail($itemId);
        $category->status = $status;
        $category->save();

        return response()->json(['success' => true]);

    }
}
