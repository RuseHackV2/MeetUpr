var map, pos, nearEvents, markers = [];

$(function() {

  $('[data-toggle="tooltip"]').tooltip();

	$('.slider-mpg').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
  });

  $('#boardgame_select').select2({
      ajax: {
          url: "/boardgames/get",
          dataType: 'json',
          delay: 250,
          data: function (params) {
              return {
                  q: params.term, // search term
                  page: params.page
              };
          },
          processResults: function (data, page) {
              // parse the results into the format expected by Select2.
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data
              return {
                  results: data
              };
          },
          cache: true
      },
  });

});

function updateMap() {

  deleteMarkers();

  var usr_data = {
    search_string: $('#search_string').val(),
    search_date: $('#search_date').val(),
    current_pos: pos,
    filters: getFilters()
  };

  function getFilters() {
    var res = [];
      var p = ($('#boardgame_select').val());
      if(p != '' ) {
          res.push(p);
      }



    //$('#advanced-search input').each(function() {
    //  if($(this).is(':checked')) {
    //    res.push($(this).val());
    //  }
    //});
    return res;
  }

  $.get('/events/get-near-location?current_pos='+JSON.stringify(usr_data), function(data) {
      console.log(usr_data);
    for (var i = 0; i < data.length; i++) {
      addMarker(data[i].id, {
        lat: parseFloat(data[i].lat, 10),
        lng: parseFloat(data[i].lng, 10)
      });
    }
  });
}

function addMarker(evId, location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map,
    icon: 'img/token-crown.png'
  });

  marker.eventId = evId;

  marker.addListener('click', function() {
    var theId = this.eventId;
    $('.modal-container').html('');
    $.get("/events/short-details/" + theId, function(data) {
        $('.modal-container').append(data);
        $('#myModal').modal('show');
    });
  });

  markers.push(marker);
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function deleteMarkers() {
  setMapOnAll(null);
  markers = [];
}

function initMap() {
  map = new google.maps.Map(document.getElementById('map-near-events'), {
    center: {lat: 43.847480, lng: 25.951305},
    zoom: 14,
    scrollwheel: false
  });
  // var infoWindow = new google.maps.InfoWindow({map: map});

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      map.setCenter(pos);

      updateMap();

    }, function() {});
  }
}
