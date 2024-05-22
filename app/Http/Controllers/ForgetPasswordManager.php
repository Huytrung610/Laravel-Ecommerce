<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgetPasswordManager extends Controller
{
    public function forgetPassword(){
        return view('frontend.pages.forget-password');
    }

    public function forgetPasswordPost(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('frontend.emails.forget-password',['token' => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject('Request Password');

        });

        return redirect()->to(route('forget.password'))->with('success', 'We have send an email to reset password! Please check your email');
    }

    public function resetPassword($token){
        return view('frontend.pages.new-password',compact('token'));
    }

    public function resetPasswordPost(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $updatePassword = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();
        if(!$updatePassword){
            return redirect()->to(route('reset.password'))->with('error','Invalid email.Please try again');
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->to(route('login.form'))->with('success', 'Password reset successfully!');
    }
}
