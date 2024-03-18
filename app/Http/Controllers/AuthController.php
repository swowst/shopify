<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->only('email', 'password');
       if ( Auth::attempt($data)){
           return redirect()->route('anasayfa')->withSuccess('Success');
       }
       else{
           return redirect()->back()->with('Error');
       }
    }

    public function logout(Request $request)
    {
        if (auth()->guard('web')->check()){
            auth()->guard('web')->logout();
        }

        return redirect()->route('anasayfa')->withSuccess('Log out');
    }


    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password', 'phone');
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('account')->withSuccess('Success');

    }
}
