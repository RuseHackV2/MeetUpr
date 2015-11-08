<?php

use Illuminate\Database\Seeder;
use App\Boardgame;

class BoardgamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('boardgames')->delete();
        $xml = file_get_contents("http://www.boardgamegeek.com/xmlapi/collection/Kondov");
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $collection = json_decode($json,TRUE);
        $i = 1;
        foreach($collection['item'] as $game) {
            $boardgame = new Boardgame();
            $boardgame->id = $i;
            $boardgame->name = $game['name'];
            $boardgame->description = 'description';
            $boardgame->url = "https://boardgamegeek.com/boardgame/" . $game['@attributes']['objectid'];
            $boardgame->image = $game['image'];
            $boardgame->save();
            $i++;
        }

    }
}
