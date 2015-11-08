@extends('master')

@section('content')
    <h1>HOME</h1>
    <pre>

    {{ \Auth::user() }}
        <?php


        $xml = file_get_contents("http://www.boardgamegeek.com/xmlapi/collection/Kondov");
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $collection = json_decode($json,TRUE);

        foreach($collection['item'] as $item) {
        print_r($item); ?>
        <img src="<?= $item['thumbnail'] ?>" alt="">
        <?php
        }
        ?>
</pre>
@endsection