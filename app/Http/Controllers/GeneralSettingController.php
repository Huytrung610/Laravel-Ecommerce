<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSetting;
class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = GeneralSetting::first();

        return view('backend.general-settings.settings')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    
    public function settings()
    {
       
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'url_instagram' => 'string',
            'url_facebook' => 'string',
            'logo_path' => 'required',
            'address' => 'string',
            'email' => 'email',
            'contact_phone' => 'string',
        ]);
        $data = $request->all();
        $settings = GeneralSetting::first();
        if(!$settings) {
            $status= GeneralSetting::create($data);
        }else {
            $status = $settings->fill($data)->save();
        }
       
        if ($status) {
            request()->session()->flash('success', 'Setting successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again');
        }

        // $currentTab = $request->get('current-tab');
        return redirect()->route('settings');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
