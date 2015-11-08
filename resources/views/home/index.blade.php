@extends('master')

@section('javascript')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDErhUiz0EqWR9PyyxPAmCEFw9z0GpRA5M&callback=initMap" async defer></script>
@endsection

@section('content')

<style>
/*.search-event,*/
/*#advanced-search {*/
  /*margin: 1em 0;*/
/*}*/
.search-event .form-group {
  margin-right: 8px;
}
#advanced-search label {
  float: left;
  width: 25%;
}
#advanced-search input {
  margin-right: 8px;
}

.search-event .select2-choice {
  width: 250px;
}
</style>

<?php

// TODO: Alex
$xml = file_get_contents("http://www.boardgamegeek.com/xmlapi/collection/Kondov");
$xml = simplexml_load_string($xml);
$json = json_encode($xml);
$collection = json_decode($json,TRUE);
$reversed = array_reverse($collection['item']);

?>

<script>


  // var nearEvents = [
  //   {id: 1, lat: 43.847480, lng: 25.951305},
  //   {id: 2, lat: 43.847863, lng: 25.949954},
  //   {id: 3, lat: 43.845936, lng: 25.952265},
  //   {id: 4, lat: 43.855136, lng: 25.971419},
  //   {id: 5, lat: 43.852310, lng: 25.960547},
  //   {id: 6, lat: 43.854784, lng: 25.956333},
  //   {id: 7, lat: 43.844216, lng: 25.969273},
  //   {id: 8, lat: 43.839321, lng: 25.954991},
  // ];
</script>

<section>
  {{--<div class="container">--}}

    {{--<div class="text-center">--}}
      {{--<a href="#" class="btn btn-primary btn-lg">Create event</a>--}}
    {{--</div>--}}
  <div class="search-event-wrap">
    <div class="container">

    <form action="#" class="form-inline search-event">
      <div class="form-group">
        <label>Search for event</label>
      </div>

      <div class="form-group">
        <input type="text" name="" id="search_string" class="form-control">
      </div>

      <div class="form-group">
        <input type="date" name="" id="search_date" class="form-control">
      </div>

      <div class="form-group">
        <input type="hidden" name="boardgame_select" id="boardgame_select">
      </div>

      <div class="form-group">
        <button type="button" class="btn btn-default" onclick="updateMap()">Search</button>
      </div>

      <!-- <div class="form-group">
        <a role="button" data-toggle="collapse" href="#advanced-search" aria-expanded="false" aria-controls="advanced-search">Advanced search</a>
      </div>

      <div class="collapse" id="advanced-search">
        <div class="well">
          <div class="row">
            @foreach($boardgames as $item)
              <label><input type="checkbox" name="" value="{{ $item->id }}">{{ $item->name }}</label>
            @endforeach
          </div>
          <button type="button" class="btn btn-default" onclick="updateMap()">Search</button>
        </div>
      </div> -->

    </form>

</div>
  </div>
  <div id="map-near-events"></div>
</section>

{{--<hr>--}}

<section>
  <div class="container">

    <div class="row">
      <div class="col-sm-6">
        <h1>Latest Events</h1>
        <table class="table">
          @foreach($nearEvents as $event)
            <tr>
              <td><a href="{{ $event->game_url }}" target="_blank"><img src="{{ $event->game_image }}" width="40" alt="{{ $event->name }}"></a></td>
              <td>{{ $event->name }}</td>
              <td>Hosted by {{ $event->host }}</td>
            </tr>
          @endforeach
        </table>
      </div>

      <div class="col-sm-6">
        <h1>Most Played Games</h1>
        <div class="slider-mpg">
          @foreach($mostPlayedGames as $game)
            <div><a href="{{ $game->url }}" target="_blank"><img src="{{ $game->image }}" alt="{{ $game->name }}"></a></div>
          @endforeach
        </div>
      </div>
    </div>

  </div>
</section>

<hr>

<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-4 col-sm-offset-4">
        <a href="#" class="btn btn-primary btn-lg pull-right">Browse events</a>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="eventDetails" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Game name</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
