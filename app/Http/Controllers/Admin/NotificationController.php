<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifications;

class NotificationController extends Controller
{
    public function index(){
    	$notifications = Notifications::with(['user'])->where('destination', auth('admin')->user()->id)->where('destination_type', 'admin')->get();
        Notifications::where('destination',auth('admin')->user()->id)->where('destination_type', 'admin')->update(array('status' => '1', 'updated_at' => date('Y-m-d H:i:s')));
    	return view('admin.notification.index', compact('notifications'));
    }

    public function notification_destroy($id){
    	try {
        	$notification = Notifications::find($id);
            $notification->delete();
            return redirect()->back()->with('message', 'Notification delete Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
