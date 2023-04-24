<?php

namespace App\Http\Controllers;


use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;

class FrontendController extends Controller
{
    /**
     * @var OrderHelper
     */
    private OrderHelper $orderHelper;

    public function __construct() {
        $this->orderHelper = new OrderHelper();
    }

    public function index(Request $request){
        return redirect('/');
    }

    // public function home()
    // {
    //     $currentLanguage = app()->getLocale();
    //     $posts = Post::where('status', 'active')->orderBy('id', 'DESC')->where('language_code',$currentLanguage)->limit(3)->get();
    //     $banners = Banner::where('status', 'active')->orderBy('id', 'DESC')->get();
    //     $cmsRepository = new \App\Repositories\CmsRepository();
    //     $aboutUs = $cmsRepository->getBySlug(CmsContent::ABOUT_CPF_HOME_SLUG, true);

    //     return view('frontend.index')
    //         ->with('posts', $posts)
    //         ->with('banners', $banners)
    //         ->with('aboutUs', $aboutUs);
    // }

    // public function aboutUs(){
    //     return view('frontend.pages.about-us');
    // }

    // public function contact(){
    //     return view('frontend.pages.contact');
    // }

    // public function Profile(){
    //     /** @var User $user */
    //     $user        = Auth::user();
    //     $address     = $user->getAddress();
    //     $defaultAddress = $user->getAddressDefault();

    //     return view('frontend.pages.profile', ['addressList' => $address, 'defaultAddress' => $defaultAddress]);
    // }
    // public function Chat(){
    //     return view('frontend.pages.chat');
    // }
    // public function Order(Request $request){
    //     $orderList = $this->orderHelper->prepareOrderList($request);
    //     return view('frontend.pages.order')->with('orderList', $orderList);
    // }

    // public function productFilter(Request $request){
    //         $data= $request->all();
    //         // return $data;
    //         $showURL="";
    //         if(!empty($data['show'])){
    //             $showURL .='&show='.$data['show'];
    //         }

    //         $sortByURL='';
    //         if(!empty($data['sortBy'])){
    //             $sortByURL .='&sortBy='.$data['sortBy'];
    //         }

    //         $catURL="";
    //         if(!empty($data['category'])){
    //             foreach($data['category'] as $category){
    //                 if(empty($catURL)){
    //                     $catURL .='&category='.$category;
    //                 }
    //                 else{
    //                     $catURL .=','.$category;
    //                 }
    //             }
    //         }

    //         $brandURL="";
    //         if(!empty($data['brand'])){
    //             foreach($data['brand'] as $brand){
    //                 if(empty($brandURL)){
    //                     $brandURL .='&brand='.$brand;
    //                 }
    //                 else{
    //                     $brandURL .=','.$brand;
    //                 }
    //             }
    //         }
    //         // return $brandURL;

    //         $priceRangeURL="";
    //         if(!empty($data['price_range'])){
    //             $priceRangeURL .='&price='.$data['price_range'];
    //         }
    //         if(request()->is('e-shop.loc/product-grids')){
    //             return redirect()->route('product-grids',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
    //         }
    //         else{
    //             return redirect()->route('product-lists',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
    //         }
    // }


    // public function productSearch(Request $request){
    //     $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
    //     $products=Product::orwhere('title','like','%'.$request->search.'%')
    //                 ->orwhere('slug','like','%'.$request->search.'%')
    //                 ->orwhere('description','like','%'.$request->search.'%')
    //                 ->orwhere('summary','like','%'.$request->search.'%')
    //                 ->orwhere('price','like','%'.$request->search.'%')
    //                 ->orderBy('id','DESC')
    //                 ->paginate('9');
    //     return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    // }

    // public function productBrand(Request $request){
    //     $products=Brand::getProductByBrand($request->slug);
    //     $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
    //     if(request()->is('e-shop.loc/product-grids')){
    //         return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
    //     }
    //     else{
    //         return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
    //     }

    // }

    // public function productSubCat(Request $request){
    //     $products=Category::getProductBySubCat($request->sub_slug);
    //     // return $products;
    //     $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

    //     if(request()->is('e-shop.loc/product-grids')){
    //         return view('frontend.pages.product-grids')->with('products',$products->sub_products)->with('recent_products',$recent_products);
    //     }
    //     else{
    //         return view('frontend.pages.product-lists')->with('products',$products->sub_products)->with('recent_products',$recent_products);
    //     }

    // }

    // Login
    public function login(){
        // $cmsContentPage = CmsContent::where('status', \App\Models\CmsContent::STATUS_ENABLE)
            ->where(function ($query) {
                $query->where('slug', \App\Models\CmsContent::TERMS_SLUG)
                    ->orWhere('slug', \App\Models\CmsContent::PRIVACY_SLUG);
            })
            ->get();

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
                throw new \Exception(__('Invalid email and password pleas try again!'));
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

    public function register(){
        return view('frontend.pages.register');
    }
    public function registerSubmit(Request $request){
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'string|required|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $data=$request->all();
        // dd($data);
        $check=$this->create($data);
        Session::put('user',$data['email']);
        if($check){
            request()->session()->flash('success','Successfully registered');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Please try again!');
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

    // public function subscribe(Request $request){
    //     if(! Newsletter::isSubscribed($request->email)){
    //             Newsletter::subscribePending($request->email);
    //             if(Newsletter::lastActionSucceeded()){
    //                 request()->session()->flash('success','Subscribed! Please check your email');
    //                 return redirect()->route('home');
    //             }
    //             else{
    //                 Newsletter::getLastError();
    //                 return back()->with('error','Something went wrong! please try again');
    //             }
    //         }
    //         else{
    //             request()->session()->flash('error','Already Subscribed');
    //             return back();
    //         }
    // }

}
