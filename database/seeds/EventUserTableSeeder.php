<?php

use Illuminate\Database\Seeder;

class EventUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('event_user')->delete();
        \DB::table('event_user')->insert(
            array(
                'user_id' => 2,
                'event_id' => 2,
                'status' => 'pending'
            )
        );
    }
}
