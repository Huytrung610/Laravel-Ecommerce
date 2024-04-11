<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageSetting;

class PageSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageSettings = PageSetting::first();
        return view('backend.pages.page-setting')->with('pageSettings', $pageSettings);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $pageSettings = PageSetting::first();
        if(!$pageSettings) {
            $status= PageSetting::create($data);
        }else {
            $status = $pageSettings->fill($data)->save();
        }
       
        if ($status) {
            request()->session()->flash('success', 'Successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again');
        }

        return redirect()->route('page-setting');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
