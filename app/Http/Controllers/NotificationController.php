<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Notification;

class NotificationController extends Controller
{
    public function open($id) {
        $notification = Notification::find($id);
        $notification->seen = 1;
        $notification->save();

        $notifications = \Auth::user()->notifications()->where('seen', '0')->get();
        if(count($notifications) == 0) {
            return response()->json('empty');
        }

        return response()->json('success');
    }
}
