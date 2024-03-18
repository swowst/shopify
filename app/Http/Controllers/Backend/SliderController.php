<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.pages.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       if ($request->hasFile('image')){
           $image = $request->file('image');
           $path = time().'-'.Str::slug($image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
           $image->move(public_path('backend/images/slider'),$path);
       }

       Slider::create([
           'name' => $request->name,
           'content' => $request->text,
           'link' => $request->link,
           'status' => $request->status,
           'image' => 'backend/images/slider/' . $path
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
        $slider = Slider::where('id', $id)->first();
        return view('backend.pages.slider.create', compact('slider'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::findOrFail($id); // Güncellenecek slider nesnesini bulun

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = time() . '-' . Str::slug($image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('backend/images/slider'), $path);

            // Eski resmi sil
            if (file_exists(public_path('backend/images/slider/' . $slider->image))) {
                unlink(public_path('backend/images/slider/' . $slider->image));
            }
        } else {
            $path = $slider->image; // Resim güncellenmediyse, mevcut resmin yolunu kullan
        }

        Slider::where('id', $id)->update([
            'name' => $request->name,
            'content' => $request->text,
            'link' => $request->link,
            'status' => $request->status,
            'image' => 'backend/images/slider/' . $path // Resim yolu güncellenmiş haliyle buraya atanır
        ]);

        return back()->with('success', 'Slider başarıyla güncellendi.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $slider = Slider::where('id', $request->id)->firstOrFail();

        if (!empty($slider->image)){
            unlink($slider->image);
        }

        $slider->delete();

        return response(['error' => false, 'message' => 'Deleted successfully']);
    }


    public function status(Request $request)
    {
        $itemId = $request->input('itemId');
        $status = $request->input('status');

        // Update status in the database
        $slider = Slider::findOrFail($itemId);
        $slider->status = $status;
        $slider->save();

        return response()->json(['success' => true]);

    }
}
