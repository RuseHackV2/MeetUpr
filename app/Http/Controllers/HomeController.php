<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Boardgame;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $boardgames = Boardgame::all();

        $mostPlayedGames = (\DB::table('events')
            ->join('boardgames','boardgames.id', '=', 'events.boardgame_id')
            ->whereNotNull('events.boardgame_id')
            ->groupBy('events.boardgame_id')
            ->select(array('boardgames.*', \DB::raw('count(*) AS c')))
            ->take(10)
            ->orderBy('c', 'desc')
            ->get()
        );

        $nearEvents = \DB::table('events')
            ->join('users', 'events.user_id', '=', 'users.id')
            ->join('boardgames','boardgames.id', '=', 'events.boardgame_id')
            ->where('event_date', '>', date('Y-m-d H:i'))
            ->take(10)
            ->orderBy('event_date', 'asc')
            ->get([
                'users.name as host',
                'users.avatar as host_avatar',
                'events.name',
                'boardgames.name as game_name',
                'boardgames.image as game_image',
                'boardgames.url as game_url',
            ]);

        $var = [
            "mostPlayedGames" => $mostPlayedGames,
            "boardgames" => $boardgames,
            "nearEvents" => $nearEvents,
        ];

        return view('home.index', $var);
    }
}
