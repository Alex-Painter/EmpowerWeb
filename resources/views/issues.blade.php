@extends('layouts.master')

@section('extraHeaders')

@endsection

@section('foot')
<script>
  var map;
  var sydney = {lat: -34.397, lng: 150.644};
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: sydney,
      zoom: 12
    });
    // Adds a marker to the map.
    function addMarker(lat, lon, map) {
      var ll = new google.maps.LatLng(lat, lon);
      var marker = new google.maps.Marker({
        position: ll,
        map: map
      });
    };

    var count = 0.0;
    var lattot = 0.0;
    var lontot = 0.0;

    $('[id^="latlon"]').each(function() {
        var id = $(this).attr('id').replace("latlon", "");
        var lat = document.getElementById("lat" + id).innerHTML;
        var lon = document.getElementById("lon" + id).innerHTML;
        addMarker(lat, lon, map);
        lattot = lattot + parseFloat(lat);
        lontot = lontot + parseFloat(lon);
        count = count + 1.0
    });

    var avglat = lattot / count;
    var avglon = lontot / count;

    map.setCenter({
    		lat : avglat,
    		lng : avglon
    	});
  }

  function panTo(id){
    var lat = document.getElementById("lat" + id).innerHTML;
    var lon = document.getElementById("lon" + id).innerHTML;
    var newPos = new google.maps.LatLng(lat, lon);
    map.panTo(newPos);
    map.setZoom(14);
  }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUthy-BH1YHjVjEvltuDc7QF0GT_AjmWI&callback=initMap"
async defer></script>
@endsection

@section('maps')
<div id="map"></div>
@endsection

@section('content')

<table class="table">
  <tr>
    <th>Issue #</th>
    <th>Title</th>
    <th>Location</th>
    <th>Date Submitted</th>
    <th>Picture</th>
    <th>State</th>
  </tr>
    @foreach ($issues as $issue)
    <tr>
      <td>{{ $issue->id }}</td>
      <td>{{ $issue->title }}</td>
      <td id='latlon{{ $issue-> id}}'>
        <span id='lat{{ $issue-> id}}' style="display: none;">{{ $issue-> lat}}</span>
        <span id='lon{{ $issue-> id}}' style="display: none;">{{ $issue-> long}}</span>
        <button id='{{ $issue->id}}' type="button" class="btn btn-default" onclick="panTo({{ $issue->id }})">Show on Map</button>
      </td>
      <td>{{ $issue->created_at }}</td>
      <td><img src="pictures/app/{{ $issue->id }}.jpg" style="width:75px;"></td>
      <td>
        <div class="btn-group">
          <button type="button" class="btn btn-default">{{ $issue->state }}</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="{{ route('review', ['id' =>$issue->id]) }}">Under Review</a></li>
            <li><a href="{{ route('forward', ['id' =>$issue->id]) }}">Forward to Department</a></li>
            <li><a href="{{ route('close', ['id' =>$issue->id]) }}">Close Issue</a></li>
          </ul>
        </div>
      </td>
    </tr>
    @endforeach
</table>
<div style="text-align: center;">
{!! $issues->render() !!}
</div>
@endsection
