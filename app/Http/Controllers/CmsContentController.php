<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CmsContent;
use Illuminate\Support\Str;

class CmsContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cmsPages = CmsContent::getAllCmsPage();
        return view('backend.cms-content.index')->with('cmsPages',$cmsPages);         
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.cms-content.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'string|required|unique:cms_content,title',
            'content'=>'string|required'
        ]);

        $data = $request->all();
        $slug = Str::slug($request->title);
        $count = CmsContent::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug'] = $slug;

        $status= CmsContent::create($data);
        if($status){
            request()->session()->flash('success','CMS Page Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('cms-content.index');
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
        $cmsPage = CmsContent::findOrFail($id);
        return view('backend.cms-content.edit')->with('cmsPage',$cmsPage);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        {
            $cmsPage = CmsContent::findOrFail($id);
            $data = $request->all();
            $this->validate($request,[
                'title'=>'string|required|unique:cms_content,title',
                'content'=>'string|required'
            ]);
            $slug = Str::slug($request->title);
            $count = CmsContent::where('slug',$slug)->count();
            if($count>0){
                $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
            }
            $data['slug'] = $slug;

           
            $status = $cmsPage->fill($data)->save();
            if($status){
                request()->session()->flash('success','CMS Page Successfully updated');
            }
            else{
                request()->session()->flash('error','Please try again!!');
            }
            return redirect()->route('cms-content.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cmsPage = CmsContent::findOrFail($id);

        $status = $cmsPage->delete();

        if($status){
            request()->session()->flash('success','Cms Page successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting Cms Page ');
        }
        return redirect()->route('cms-content.index');
    }
}
