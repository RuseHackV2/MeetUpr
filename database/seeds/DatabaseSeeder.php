<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(BoardgamesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(EventUserTableSeeder::class);
        $this->call(TagsTableSeeder::class);

        Model::reguard();
    }
}
