<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tags')->delete();
        \DB::table('tags')->insert(
            array(
                'id' => 1,
                'name' => 'Slow player',
            ));

        \DB::table('tags')->insert(
            array(
                'id' => 2,
                'name' => 'Angry',
            ));

        \DB::table('tags')->insert(
            array(
                'id' => 3,
                'name' => 'Weak',
            ));

        \DB::table('tags')->insert(
            array(
                'id' => 4,
                'name' => 'Game Master',
            ));

        \DB::table('tags')->insert(
            array(
                'id' => 5,
                'name' => 'Know everything',
            )
        );

        \DB::table('tag_user')->insert(
            [
                'id' => 1,
                'user_id' => 2,
                'tag_id' => 2,
                'from_user_id' => 3
            ]);

        \DB::table('tag_user')->insert(
            [
                'id' => 2,
                'user_id' => 2,
                'tag_id' => 1,
                'from_user_id' => 4
            ]);

        \DB::table('tag_user')->insert(
            [
                'id' => 3,
                'user_id' => 2,
                'tag_id' => 3,
                'from_user_id' => 4
            ]);

        \DB::table('tag_user')->insert(
            [
                'id' => 4,
                'user_id' => 2,
                'tag_id' => 3,
                'from_user_id' => 3
            ]);

        \DB::table('tag_user')->insert(
            [
                'id' => 5,
                'user_id' => 2,
                'tag_id' => 2,
                'from_user_id' => 4
            ]
        );
    }
}