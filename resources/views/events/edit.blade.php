@extends('master')
<div class="page-banner">
    <div class="page-header-overlay"></div>
    <div class="container">
        <div class="row">
            <h1 class="page-header ">Create event</h1>
        </div>

    </div>
</div>
@section('content')

    <div class="container">
        <form action="/event" method="POST" class="form-horizontal create-event-form">

            <div class="form-group">
                <label class="text-right form-label col-md-4">Name </label>
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="" value="{{ $event->name == null ? '' : $event->name }}">
                </div>
            </div>

            <div class="form-group">
                <label class="text-right form-label col-md-4">Description </label>
                <div class="col-md-6">
                    <input type="text" name="description" class="form-control" placeholder="" value="{{ $event->description == null ? '' : $event->description }}">
                </div>
            </div>

            <div class="form-group">
                <label class="text-right form-label col-md-4">Maximum Player Number </label>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="max_players_number" placeholder="" value="{{ $event->max_player_slots == null ? '' : $event->max_player_slots }}">
                </div>
            </div>

            <div class="form-group">
                <label class="text-right form-label col-md-4">Boardgame </label>
                <div class="col-md-6">
                    <input type="hidden" style="width: 100%" name="boardgame_select" id="boardgame_select">
                </div>
            </div>

            <div class="form-group">
                <label class="text-right form-label col-md-4">Event Date </label>
                <div class="col-md-6">
                    <input type="text" name="event_date" id="event_date" class="form-control">
                </div>
            </div>

            <input type="hidden" class="form-control" id="lng" name="longitude" placeholder="longitude" value="{{ $event->longitude == null ? '' : $event->longitude }}">
            <input type="hidden" class="form-control" id="lat" name="latitude" placeholder="latitude" value="{{ $event->latitude == null ? '' : $event->latitude }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div id="addEventMap" class="col-md-12" style="height: 450px;"></div>

            <div class="text-center">
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>

@endsection

@section('javascript')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

    <script>

        $( "#event_date" ).datepicker();

        function fillLatLng(lat, lng) {
            var stringLat = lat.toString();
            var realLat = stringLat.slice(0,stringLat.indexOf('.') + 8);

            var stringLng = lng.toString();
            var realLng = stringLng.slice(0,stringLng.indexOf('.') + 8);

            document.getElementById('lat').value = realLat;
            document.getElementById('lng').value = realLng;
        }

        function registerMarkerDragListener(marker) {
            google.maps.event.addListener(marker,'dragend', function(event){

                fillLatLng(event.latLng.lat(), event.latLng.lng());
                //alert('You just dropped me at: ' + event.latLng.lat() + ',' + event.latLng.lng());
            })
        }

        function initialize(lat, lng, name) {

            var markers = [];
            var lat  = 43.847480;
            var lng = 25.951305;
            var name = name;
            var zoom = 15;
            var pos;
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
            var map=new google.maps.Map(document.getElementById("addEventMap"),mapProp);

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                pos = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude
                };

                map.setCenter(pos);

                var marker = new google.maps.Marker({
                    // position: new google.maps.LatLng(43.847480, 25.951305),
                    position: new google.maps.LatLng(pos.lat, pos.lng),
                    map: map,
                    draggable:true,
                    title: name,
                    icon: 'img/token-flag.png'
                });
                registerMarkerDragListener(marker);
                markers.push(marker);

              }, function() {});
            }

            // if(lat != null && lng != null) {
            //     var marker = new google.maps.Marker({
            //         // position: new google.maps.LatLng(43.847480, 25.951305),
            //         position: new google.maps.LatLng(pos.lat, pos.lng),
            //         map: map,
            //         draggable:true,
            //         title: name
            //     });
            //     registerMarkerDragListener(marker);
            //     markers.push(marker);

            // }

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
