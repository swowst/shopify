<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('backend.pages.admin-login.login');
    }

    public function loginAdmin()
    {

        if (auth()->guard('admin')->attempt(['email' => request()->email, 'password' => request()->password])){
            return redirect()->route('panel.panel.index');
        }

        return redirect()->back();
    }

    public function logoutAdmin()
    {
        if (auth()->guard('admin')->check()){
            auth()->guard('admin')->logout();
        }

        return view('backend.pages.admin-login.login');
    }
}
