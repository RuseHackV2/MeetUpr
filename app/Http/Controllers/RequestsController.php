<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Boardgame;
use App\Notification;

class RequestsController extends Controller
{
    public function processRequest($userId, $eventId, $permit) {
        if($permit == 0) {
            $status = 'declined';

            \DB::table('event_user')
                                ->where('event_id', '=', $eventId)
                                ->where('user_id', '=', $userId)
                                ->delete();

        } elseif($permit == 1) {
            $status = 'approved';

            \DB::table('event_user')->where('event_id', $eventId)
                ->where('user_id', $userId)
                ->update(array(
                    'status' => $status
                ));

            $notification = new Notification();
            $notification->user_id = $userId;
            $notification->text = 'You have been accepted for ';
            $notification->object_id = $eventId;
            $notification->save();
        }



        return redirect('/events/' . $eventId);
    }

    public function getBoardGames() {
        $searchQuery = \Input::get('q');

        $boardgames = \DB::table('boardgames')
            ->where('name', 'like', '%' . $searchQuery . '%')
            ->get();
        $response = array();

        foreach($boardgames as $game) {
            $boardgame = array();
            $boardgame['id'] = $game->id;
            $boardgame['text'] = $game->name;
            array_push($response, $boardgame);
        }

        return response()->json($response);
    }
}
