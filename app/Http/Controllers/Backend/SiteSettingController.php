<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = SiteSetting::all();
        return view('backend.pages.settings.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $models = SiteSetting::all();
        return view('backend.pages.settings.create',compact('models'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')){
            $image = $request->file('image');
            $path = time().'-'.Str::slug($image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend/images/settings'),$path);
        }

        SiteSetting::create([
            'name' => $request->name,
            'data' => $request->data ?? 'backend/images/settings' .$path,
            'image' => 'backend/images/settings/' . $path,
            'set_type' => $request->set_type,
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

        $models = SiteSetting::where('id', $id)->first();
        return view('backend.pages.settings.create', compact('models'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $settings = SiteSetting::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = time() . '-' . Str::slug($image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('backend/images/settings'), $path);

            // Eski resmi sil
            if (file_exists(public_path('backend/images/settings/' . $settings->image))) {
                unlink(public_path('backend/images/settings/' . $settings->image));
            }
        } else {
            $path = $settings->image;
        }

        SiteSetting::where('id', $id)->update([
            'name' => $request->name,
            'data' => $request->data ,
            'image' => 'backend/images/settings/' . $path,
            'set_type' => $request->set_type,
        ]);

        return back()->with('success', 'SiteSetting başarıyla güncellendi.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $settings = SiteSetting::where('id', $request->id)->firstOrFail();


        $settings->delete();

        return response(['error' => false, 'message' => 'Deleted successfully']);
    }

}
