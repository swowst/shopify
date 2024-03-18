<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function index()
    {
        $models = About::all();
        return view('backend.pages.about.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('backend.pages.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')){
            $image = $request->file('image');
            $path = time().'-'.Str::slug($image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend/images/about'),$path);
        }

        About::create([
            'name' => $request->name,
            'image' => 'backend/images/about/' . $path,
            'content' => $request->text,
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

        $models = About::firstOrfail();
        return view('backend.pages.about.create', compact('models'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $about = About::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = time() . '-' . Str::slug($image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('backend/images/about'), $path);

            // Eski resmi sil
            if (file_exists(public_path('backend/images/about/' . $about->image))) {
                unlink(public_path('backend/images/about/' . $about->image));
            }
        } else {
            $path = $about->image;
        }

        About::where('id', $id)->update([
            'name' => $request->name,
            'image' => 'backend/images/about/' . $path,
            'content' => $request->text,
        ]);

        return back()->with('success', 'About başarıyla güncellendi.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $about = About::where('id', $request->id)->firstOrFail();

        if (!empty($about->image)){
            unlink($about->image);
        }

        $about->delete();

        return response(['error' => false, 'message' => 'Deleted successfully']);
    }


    public function status(Request $request)
    {
        $itemId = $request->input('itemId');
        $status = $request->input('status');

        // Update status in the database
        $about = About::findOrFail($itemId);
        $about->status = $status;
        $about->save();

        return response()->json(['success' => true]);

    }
}
