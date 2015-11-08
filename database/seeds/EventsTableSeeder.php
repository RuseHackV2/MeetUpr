<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('events')->delete();
        $event = new Event();
        $event->name = 'Test Event';
        $event->description = 'test event';
        $event->longitude = 25.949954;
        $event->latitude = 43.847480;
        $event->max_player_slots = 6;
        $event->user_id = 2;
        $event->boardgame_id = 1;
        $event->event_date = date('Y-m-d H:i', strtotime("+1 week"));
        $event->save();

        $event = new Event();
        $event->id = 2;
        $event->name = 'Another Test Event';
        $event->description = 'test event';
        $event->longitude = 25.949954;
        $event->latitude = 43.847863;
        $event->max_player_slots = 6;
        $event->boardgame_id = 2;
        $event->user_id = 2;
        $event->event_date = date('Y-m-d H:i', strtotime("+1 week"));
        $event->save();

        $event = new Event();
        $event->id = 3;
        $event->name = 'Supper Test Event';
        $event->description = 'test event';
        $event->longitude = 25.952265;
        $event->latitude = 43.845936;
        $event->max_player_slots = 6;
        $event->boardgame_id = 3;
        $event->user_id = 2;
        $event->event_date = date('Y-m-d H:i', strtotime("+5 days"));
        $event->save();

        $event = new Event();
        $event->id = 4;
        $event->name = 'Supper Test Event 1';
        $event->description = 'test event';
        $event->longitude = 25.971419;
        $event->latitude = 43.845936;
        $event->max_player_slots = 6;
        $event->boardgame_id = 4;
        $event->user_id = 2;
        $event->event_date = date('Y-m-d H:i', strtotime("+4 days"));
        $event->save();

        $event = new Event();
        $event->id = 5;
        $event->name = 'Supper Test Event 2';
        $event->description = 'test event';
        $event->longitude = 25.956333;
        $event->latitude = 43.844216;
        $event->max_player_slots = 2;
        $event->boardgame_id = 5;
        $event->user_id = 2;
        $event->event_date = date('Y-m-d H:i', strtotime("+2 days"));
        $event->save();

        $event = new Event();
        $event->id = 6;
        $event->name = 'Supper Test Event 3';
        $event->description = 'test event';
        $event->longitude = 25.960547;
        $event->latitude = 43.852310;
        $event->max_player_slots = 2;
        $event->boardgame_id = 2;
        $event->user_id = 2;
        $event->event_date = date('Y-m-d H:i', strtotime("+3 days"));
        $event->save();

        $event = new Event();
        $event->id = 7;
        $event->name = 'Supper Test Event 4';
        $event->description = 'test event';
        $event->longitude = 25.954991;
        $event->latitude = 43.839321;
        $event->max_player_slots = 3;
        $event->boardgame_id = 1;
        $event->user_id = 2;
        $event->event_date = date('Y-m-d H:i', strtotime("+3 days"));
        $event->save();
    }
}
