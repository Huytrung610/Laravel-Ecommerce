<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubcriber;
use App\Exports\subscribersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;


class NewsletterSubcriberController extends Controller
{
    const STATUS_ACTIVE = '1';
    const STATUS_INACTIVE = '0';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcribers = NewsletterSubcriber::getAllSubcriber();
        return view('backend.subcribers.index')->with('subcribers',$subcribers);
    }

    public function addSubcriber(Request $request){

        if ($request->ajax()) {
            $data = $request->all();
            $subscriberCount = NewsletterSubcriber::where('email_subcriber', $data['email_subscriber'])->count();

            if ($subscriberCount > 0) {
                return response()->json(['status' => 'error']);
            } else {
                $subscriber = new NewsletterSubcriber();
                $subscriber->email_subcriber = $data['email_subscriber'];
                $subscriber->status = self::STATUS_ACTIVE;
                $subscriber->save();
                return response()->json('success');
            }
        }
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

    public function updateSubscriberStatus(Request $request)
    {
        $data = $request->all();
        $subscriber = NewsletterSubcriber::findOrFail($data['subscriber_id']);
        $subscriber->status = $data['status'];
        $status= $subscriber->save();

        if($status){
            request()->session()->flash('success','Status subscriber successfully updated');
        }
        else{
            request()->session()->flash('error','Error while update status ');
        }
        return redirect()->route('subcriber');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function exportSubscribers()  {
        $formattedDate = Carbon::now()->format('d-m-y');
        $filename = 'subscribers_' . $formattedDate . '.xlsx';
    
        return Excel::download(new subscribersExport, $filename);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscriber = NewsletterSubcriber::findOrFail($id);

        $status = $subscriber->delete();

        if($status){
            request()->session()->flash('success','Subcscriber successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting Subcscriber ');
        }
        return redirect()->route('subcriber');
    }
}
