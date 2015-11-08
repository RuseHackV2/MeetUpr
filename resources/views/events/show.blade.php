@extends('master')
<div class="page-banner">
    <div class="page-header-overlay"></div>
    <div class="container">
        <div class="row">
            <h1 class="page-header ">{{$event->name}}</h1>
        </div>

    </div>
</div>
@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            @if($is_host)
                @foreach($requests as $request)
                    <div class="alert alert-warning">
                        <img src="{{$request->user->avatar}}" alt=""/>

                        <div class="user-info">
                            <p><a href="">{{ $request->user->name }}</a> wants to join your event</p>
                            <span class="">
                                <a href="/request/{{$request->user->id}}/{{$event->id}}/0" class="btn btn-danger">Decline</a>
                                <a href="/request/{{$request->user->id}}/{{$event->id}}/1" class="btn btn-success">Approve</a>
                            </span>
                        </div>
                    </div>
                @endforeach
            @else
                @if($appliedStatus == 'approved')
                    <div class="alert alert-success">You have been approved for this event!</div>
                @elseif($appliedStatus == 'pending')
                    <div class="alert alert-info">Your application is waiting approval!</div>
                @elseif($appliedStatus == 'not applied')
                    @if($event->max_player_slots == $peopleCount)
                        <div class="alert alert-warning">Sorry, event is full, try again later!</div>
                    @else
                        <a href="/events/{{$event->id}}/apply" class="btn btn-primary">JOIN NOW!</a>
                    @endif
                @elseif($appliedStatus == 'declined')
                    <div class="alert alert-danger">Your application has been declined :(</div>
                @endif
            @endif

            {{--<h3>--}}
            {{--{{$event->name}}--}}
            {{--@for($i = 1; $i <= $event->max_player_slots; $i++)--}}
            {{--<i class="fa fa-male {{$i <= $peopleCount ? 'taken' : 'empty'}}"></i>--}}
            {{--@endfor--}}
            {{--</h3>--}}

            {{--<div>--}}
            {{--Event Date: {{date('d M', strtotime($event->event_date))}}--}}
            {{--at {{date('H:i', strtotime($event->event_date))}}--}}
            {{--</div>--}}
            <div class="event-meta">
                <div class="row">
                    <div class="col-md-6">
                        {{--<b>Event Date:</b><br>--}}
                        <span class="fa fa-calendar fa-fw fa-lg"></span>
                        {{date('d M', strtotime($event->event_date))}}
                        at {{date('H:i', strtotime($event->event_date))}}
                    </div>
                    <div class="col-md-6 text-right">
                        <p class="players-count">
                            @for($i = 1; $i <= $event->max_player_slots; $i++)
                                <i class="fa fa-male {{$i <= $peopleCount ? 'taken' : 'empty'}}"></i>
                            @endfor
                        </p>
                        <p>
                            {{$event->status}}
                        </p>
                    </div>
                </div>
            </div>

            <hr>
                <div class="row">

                    <div class="col-md-5">
                        @if($event->host)
                            <div class="event-host">
                                <h3>Hosted by</h3>
                                <div class="host">
                                    {{--{{print_r($event->host->userTags)}}--}}
                                    <img src="{{$event->host->avatar}}" alt="">
                                    <div class="user-info">
                                        <p>{{ $event->host->name }}</p>
                                        @include('user-tags', array('tags' => $tags, 'userId' => $event->host->id))
                                        {{--@if(count($event->host->userTags) > 0)--}}
                                        {{--<div class="tags">--}}
                                        {{--@foreach($event->host->userTags as $tag)--}}
                                        {{--<span class="tag label label-info">{{$tag['name']}} - {{$tag['count_tags']}}</span>--}}
                                        {{--@endforeach--}}
                                        {{--</div>--}}

                                        {{--@endif--}}
                                    </div>
                                </div>
                            </div>
                        @endif
                            <br>
                            <p class="description lead">
                                {{$event->description}}
                            </p>
                    </div>
                    <div class="col-md-7">
                        <div id="singleEventMap" style="height: 450px;"></div>
                    </div>
                </div>

                <br><br>
            <div class="row">
                <div class="col-md-7">

                    @if($event->boardgame)
                        <div class="boardgame">
                            <h3>What we're playing</h3>
                            <div class="boardgame-name">
                                {{--<a href="{{$event->boardgame->url}}">{{$event->boardgame->name}}</a>--}}
                                <a target="_blank" href="{{$event->boardgame->url}}"><img src="{{$event->boardgame->image}}" alt=""></a>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="col-md-5">
                    <h3>Players</h3>
                    <table class="table event-players-table">
                        @foreach($event->players as $player)
                            <tr class="player">
                                <td>
                                    <img src="{{$player->object->avatar}}" alt="">
                                </td>
                                <td><span class="player-name">{{$player->object->name}}</span></td>
                                {{--@if(count($player->object->tags) > 0)--}}
                                {{--@foreach($player->object->tags as $tag)--}}
                                {{--<span class="tag tag-{{$tag->id}}">{{$tag->name}}</span>--}}
                                {{--@endforeach--}}
                                {{--@endif--}}
                                <td>
                                    {{--@if(count($player->object->userTags) > 0)--}}
                                        {{--@foreach($player->object->userTags as $tag)--}}
                                            {{--<span class="tag label label-default">{{$tag['name']}} - {{$tag['count_tags']}}</span>--}}
                                        {{--@endforeach--}}
                                    {{--@endif--}}


                                    @include('user-tags', array('tags' => $tags, 'userId' => $player->object->id))
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            {{--@if($event->host)--}}
            {{--<div class="event-host">--}}
            {{--<h4>Hosted by</h4>--}}
            {{--<div class="host">--}}
            {{--{{print_r($event->host->userTags)}}--}}
            {{--<img src="{{$event->host->avatar}}" alt=""> {{ $event->host->name }}--}}
            {{--@if(count($event->host->userTags) > 0)--}}
            {{--@foreach($event->host->userTags as $tag)--}}
            {{--<span class="tag">{{$tag['name']}} - {{$tag['count_tags']}}</span>--}}
            {{--@endforeach--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--@endif--}}

            {{--@if($event->boardgame)--}}
            {{--<div class="boardgame">--}}
            {{--<h4>What we're playing</h4>--}}

            {{--<div class="boardgame-name">--}}
            {{--<a href="{{$event->boardgame->url}}">{{$event->boardgame->name}}</a>--}}
            {{--<a target="_blank" href="{{$event->boardgame->url}}"><img src="{{$event->boardgame->image}}"--}}
            {{--alt=""></a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--@endif--}}

            {{--<p class="people-count">People count:--}}
            {{--{{ $peopleCount }} / {{$event->max_player_slots}}--}}
            {{--@for($i = 1; $i <= $event->max_player_slots; $i++)--}}
            {{--<i class="fa fa-male {{$i <= $peopleCount ? 'taken' : 'empty'}}"></i>--}}
            {{--@endfor--}}
            {{--</p>--}}


        </div>

    </div>
    {{--<div id="singleEventMap" style="height: 450px;"></div>--}}

@endsection

@section('javascript')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

    <script>

        function initialize(lat, lng, name) {

            var markers = [];
            var lat  = '<?= $event->latitude ?>';
            var lng = '<?= $event->longitude ?>';
            var name = name;
            var zoom = 15;
            //alert('lat: ' + lat + " lng: " + lng + " name: " +name);

            if(lat == null || lat == 0 || lng == null || lng == 0) {
                lat = 42.7249925;
                lng = 25.4833039;
                zoom = 8;
            }

            var mapProp = {
                center: new google.maps.LatLng(lat, lng),
                zoom: zoom,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            var map=new google.maps.Map(document.getElementById("singleEventMap"),mapProp);

            if(lat != null && lng != null) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(lat, lng),
                    map: map,
                    draggable:true,
                    title: name
                });
                registerMarkerDragListener(marker);
                markers.push(marker);

            }

            var ma = markers[0];

//    var defaultBounds = new google.maps.LatLngBounds(
//        new google.maps.LatLng(-33.8902, 151.1759),
//        new google.maps.LatLng(-33.8474, 151.2631));
//    map.fitBounds(defaultBounds)

            var input = /** @type {HTMLInputElement} */(
                    document.getElementById('searchTextField'));
//      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            var searchBox = new google.maps.places.SearchBox(input, {  });

            google.maps.event.addListener(searchBox, 'places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                for (var i = 0, marker; marker = markers[i]; i++) {
                    marker.setMap(null);
                }
                // For each place, get the icon, place name, and location.
                markers = [];

                //                for (var i = 0, place; place = places[i]; i++) {
                place = places[0];
                var bounds = new google.maps.LatLngBounds();

                // Create a marker for each place.
                var marker = new google.maps.Marker({
                    map: map,
                    title: place.name,
                    draggable: true,
                    position: place.geometry.location
                });

                markers.push(marker);

                bounds.extend(place.geometry.location);


                registerMarkerDragListener(marker);

                fillLatLng(place.geometry.location.lat(), place.geometry.location.lng());

                map.fitBounds(bounds);
            });

        }

        initialize();

    </script>

@endsection