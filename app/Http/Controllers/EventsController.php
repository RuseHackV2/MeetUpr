<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use App\User;
use App\Tag;
use App\Notification;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostedEvents = \Auth::user()->events()
                                    ->where('event_date', '>', date('Y-m-d H:i'))
                                    ->orderBy('event_date', 'desc')
                                    ->get();

        foreach($hostedEvents as $event) {
            $event->playersCount = \DB::table('event_user')
                                        ->where('event_id', $event->id)
                                        ->where('status', 'approved')
                                        ->count();
        }

        $appliedEvents = \DB::table('events')
                                ->join('event_user', 'events.id', '=', 'event_user.event_id')
                                ->select('events.*', 'event_user.status')
                                ->where('event_user.user_id', \Auth::id())
                                ->whereIn('event_user.status', ['pending', 'approved'])
                                ->orderBy('event_date', 'desc')
                                ->where('event_date', '>', date('Y-m-d H:i'))
                                ->get();

        foreach($appliedEvents as $event) {
            $event->playersCount = \DB::table('event_user')
                ->where('event_id', $event->id)
                ->where('status', 'approved')
                ->count();
        }

        $pastEvents = \DB::table('events')
        ->join('event_user', 'event_user.event_id', '=', 'events.id')
        ->where('event_date', '<', date('Y-m-d H:i'))
        ->where('event_user.user_id', '=', \Auth::id())
        ->orderBy('events.event_date', 'desc')
        ->get(['events.*']);

        //$pastEvents = \Auth::user()->events()->where('event_date', '<', date('Y-m-d H:i'));

        return view('events.index')->with('hostedEvents', $hostedEvents)
                                    ->with('appliedEvents', $appliedEvents)
                                    ->with('pastEvents', $pastEvents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();
        $event->name = \Input::get('name');
        $event->description = \Input::get('description');
        $event->max_player_slots = \Input::get('max_players_number');
        $event->longitude = \Input::get('longitude');
        $event->latitude = \Input::get('latitude');
        $event->user_id = \Auth::id();
        $event->event_date = date('Y-m-d H:i:s', strtotime(\Input::get('event_date')));

        if(!empty(\Input::get('boardgame_select'))) {
            $event->boardgame_id = \Input::get('boardgame_select');
        }

        $event->save();

        return redirect('events/' . $event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $event->host = User::find($event->user_id);
        $event->host->userTags = self::getTagsForUser($event->host->id);

        $peopleCount = \DB::table('event_user')->where('event_id', $id)->where('status', 'approved')->count();

        $event->players = \DB::table('event_user')->select('user_id')->where('event_id', $event->id)->where('status', 'approved')->get();

        foreach($event->players as $player) {
            $player->object = User::find($player->user_id);
            $player->object->userTags = self::getTagsForUser($player->object->id);
        }

        $is_host = false;

        $listTags = [];
        $tags = Tag::orderBy('name')->get();
        foreach($tags as $tag) {
            $listTags[$tag->id] = $tag->name;
        }

        if(\Auth::user()->id == $event->host->id) {
            $is_host = true;
            $requests = \DB::table('event_user')->where('event_id', $event->id)->where('status', 'pending')->get();
            foreach($requests as $request) {
                $request->user = User::find($request->user_id);
            }

            return view('events.show')->with('event', $event)
                ->with('peopleCount', $peopleCount)
                ->with('requests', $requests)
                ->with('tags', $listTags)
                ->with('is_host', $is_host);
        }
        else {
            $applied = \DB::table('event_user')->where('event_id', $event->id)->where('user_id', \Auth::id())->get();

            if(empty($applied)) {
                $appliedStatus = 'not applied';
            } else {
                $appliedStatus = $applied[0]->status;
            }

            return view('events.show')->with('event', $event)
                ->with('peopleCount', $peopleCount)
                ->with('is_host', $is_host)
                ->with('applied', $applied)
                ->with('tags', $listTags)
                ->with('appliedStatus', $appliedStatus);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        $event = new Event();

        if(!empty($id)) {
            $event = Event::find($id);
        }

        return view('events.edit')->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function applyForEvent($id) {

        $checkIfAdded = \DB::table('event_user')->select('*')->where('user_id', \Auth::id())->where('event_id', $id)->get();
        if(empty($checkIfAdded)) {
            \DB::table('event_user')->insert(array(
                'user_id' => \Auth::id(),
                'event_id' => $id,
                'status' => 'pending'
            ));

            //Send a notification to the host that someone wants to join
            $event = Event::find($id);
            $host = User::find($event->user_id);

            $notification = new Notification();
            $notification->user_id = $host->id;
            $notification->text = 'Someone asked to join';
            $notification->object_id = $event->id;
            $notification->save();
        }

        return redirect('/events/' . $id);
    }

    public function getTagsForUser($userId) {
        $userTags = \DB::table('tag_user')
            ->join('tags', 'tag_user.tag_id', '=', 'tags.id')
            ->groupBy('tags.id')
            ->select(array('tags.name', \DB::raw('count(tags.id) AS count_tags')))
            ->where('user_id', '=', $userId)
            ->get();

        $result = [];
        if(!empty($userTags))
        {
            foreach($userTags as $userTag) {
                $result[] = [
                    'name' => $userTag->name,
                    'count_tags' => $userTag->count_tags,
                ];
            }
        }

        return $result;
    }
}
