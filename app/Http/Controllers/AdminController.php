<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;   

class AdminController extends Controller
{
    public function index(){

     return view('backend.index');
    }


    public function profile()
    {
        $profile = backpack_user();

        return view('backend.users.profile')->with('profile', $profile);
    }

    public function changePassword()
    {
        return view('backend.layouts.changePassword');
    }

    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|different:current_password|min:6',
            'new_confirm_password' => 'same:new_password',
        ]);
        if (Hash::check($request->current_password, backpack_auth()->user()->password)) {
            backpack_auth()->user()->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            $request->session()->flash('success', 'Password successfully changed');
        } else {
            $request->session()->flash('error', 'Password does not match');
        }

        return redirect()->route('admin');
    }
}



