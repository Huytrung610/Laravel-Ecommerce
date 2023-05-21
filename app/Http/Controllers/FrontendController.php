<?php

namespace App\Http\Controllers;


use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    

    public function index(Request $request){
        return redirect('/');
    }

    public function home()
    {
        return view('frontend.index');
          
    }
 

    // Login
    public function login(){
        // $cmsContentPage = CmsContent::where('status', \App\Models\CmsContent::STATUS_ENABLE)
            // ->where(function ($query) {
            //     $query->where('slug', \App\Models\CmsContent::TERMS_SLUG)
            //         ->orWhere('slug', \App\Models\CmsContent::PRIVACY_SLUG);
            // })
            // ->get();

        return view('frontend.pages.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginSubmit(Request $request){
        $data = $request->all();

        try {
            if (backpack_user()) {
                throw new \Exception(__('You are logged in as admin role, please logout and login again!'));
            }

            if (Auth::attempt(
                [
                    'email' => $data['email'],
                    'password' => $data['password'],
                    'status' => 'active',
                    'role' => User::ROLE_TYPE_USER
                ]
            )) {
                Session::put('user', $data['email']);
                request()->session()->flash('success', __('Successfully login'));
            } else {
                throw new \Exception(__('Invalid email and password please try again!'));
            }
        }catch (\Exception $exception) {
            request()->session()->flash('error', $exception->getMessage());

            return redirect()->back();
        }

        return redirect()->route('home');
    }

    public function logout(){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logout successfully');
        return back();
    }

   
    public function registerSubmit(Request $request){
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'string|required|min:2',
            'email' => 'string|required|unique:users,email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Logic xử lý khi validation thành công
        $check = $this->create($data);
        Session::put('user', $data['email']);
        if ($check) {
            request()->session()->flash('success', 'Successfully registered');
            return redirect()->route('home');
        } else {
            request()->session()->flash('error', 'Please try again!');
            return back();
        }
    }
    public function create(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>'active'
            ]);
    }

    
}
