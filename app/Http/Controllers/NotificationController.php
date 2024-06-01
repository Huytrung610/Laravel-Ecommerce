<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('backend.notification.index');
    }

    public function show(Request $request)
    {
        $helper = new \App\Helpers\Helper();
        $notificationUrl = $helper->checkSendNotification($request);

        return redirect($notificationUrl);
    }

    public function delete($id)
    {
        try {
            $notification = Notification::find($id);
            $notification->delete();
            request()->session()->flash('success', __('Notification successfully deleted'));
        } catch (\Exception $exception) {
            request()->session()->flash('error', __('Error please try again') . $exception->getMessage());
        }
        return back();
    }
}
