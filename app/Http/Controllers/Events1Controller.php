<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use App\User;
use App\Boardgame;
use App\Notification;

class Events1Controller extends Controller
{
    public function shortDetails($id)
    {
        $event = Event::find($id);
        $hostId  = $event->user_id;
        $gameId = $event->boardgame_id;
        $boardGame = Boardgame::find($gameId);
        $user = User::find($hostId);

        $flagApproveEnable = (\DB::table('event_user')
                ->where('event_id', '=', $event->id)
                ->where('user_id', '=', \Auth::id())->count() == 0);

        $event->event_date_formated =  Date('g:ia \o\n jS F Y', strtotime($event->event_date));
        $peopleCount = \DB::table('event_user')->where('event_id', $id)->where('status', 'approved')->count();
        $event->people_count = $peopleCount;

        $flagApproveEnable = true;

        $var = [
            'event' => $event,
            'user' => $user,
            'boardGame' => $boardGame,
            'flagApproveEnable' => $flagApproveEnable
        ];

        return view('events.short-details', $var);
    }

    public function getNearLocation()
    {
        $inputs = \Input::get('current_pos');
        $data = json_decode($inputs);

        $builder  = \DB::table('events')
            ->where('event_date', '>', date('Y-m-d H:i:s'));
        if(!empty($data->search_string)) {
            $builder = $builder->where('events.name', 'like', '%' . $data->search_string . '%');
        }

        if(!empty($data->filters)) {
            $boardGameIds = [];
            foreach($data->filters as $boardGameId) {
                $boardGameIds[] = (int)$boardGameId;
            }

            $builder = $builder->whereIn('boardgame_id', $boardGameIds);
        }

        if(!empty($data->search_date)) {
            $builder = $builder->whereDate('event_date', '=', date('Y-m-d', strtotime($data->search_date)));
        }

        if(!empty($data->current_pos->lat)) {
            //todo show only near location
        }

        if(!empty($data->current_pos->lng)) {
            //todo show only near location
        }

        $events = $builder->get();

        $arr = [];
        foreach ($events as $event) {
            $arr[] = [
                'id' => $event->id,
                'lat' => floatval($event->latitude),
                'lng' => floatval($event->longitude),
            ];
        }

        return \Response::json($arr);
    }
}