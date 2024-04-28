<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Hash;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.index');
    }

    public function changePasswordStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        if ($request->current_password === $request->new_password) {
            $validator->errors()->add('new_password', 'The new password must be different from the current password.');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
            
            return redirect()->back()->with('success', 'Password successfully changed');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    

    public function updateProfile(Request $request){
        User::find(auth()->user()->id)->update(['name'=> $request->get('name')]);
        return redirect()->back()->with('success','Name successfully changed');;
    }      
}

