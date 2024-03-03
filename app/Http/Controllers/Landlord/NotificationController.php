<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function allNotifications()
	{
		$all_notification = auth()->user()->notifications()->get();
		return view('landlord.super-admin.pages.notification.index', compact('all_notification'));
	}

    public function clearAll()
	{
		auth()->user()->notifications()->delete();

		return redirect()->back();
	}

    public function markAsReadNotification()
	{
		auth()->user()->unreadNotifications->markAsRead();
	}
}
