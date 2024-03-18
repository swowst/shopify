<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = User::all();
        return view('backend.pages.users.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        $cats = User::where('users_up', null)->get();
        return view('backend.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'status' => $request->status,
        ]);


        return back()->withSuccess('Success');
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
        $models = User::where('id', $id)->first();
        return view('backend.pages.users.create', compact('models'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::findOrFail($id);



        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'status' => $request->status,
        ]);

        return back()->withSuccess('success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $users = User::where('id', $request->id)->firstOrFail();

        $users->delete();

        return response(['error' => false, 'message' => 'Deleted successfully']);
    }


    public function status(Request $request)
    {
        $itemId = $request->input('itemId');
        $status = $request->input('status');

        // Update status in the database
        $users = User::findOrFail($itemId);
        $users->status = $status;
        $users->save();

        return response()->json(['success' => true]);

    }
}
