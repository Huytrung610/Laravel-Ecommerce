<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubcriber;

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
        try {
            if ($request->ajax()) {
                $data = $request->all();
    
                $subscriber = NewsletterSubscriber::findOrFail($data['subscriber_id']);
    
                $subscriber->status = $data['status'];
                $subscriber->save();
    
                return response()->json(['success' => true]);
            }
    
            return response()->json(['error' => 'Invalid request']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Subscriber not found']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
