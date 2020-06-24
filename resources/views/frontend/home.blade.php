@extends('frontend/layouts/master')

@section('content')

<!-- Map -->
<div class="mapwrapper">

  <div id="map"></div>

  {{--<div class="mapoverlay" onClick="style.pointerEvents='none'"></div>
  <iframe class="mainmap" src="https://www.google.com/maps/embed/v1/place?q=Melbourne&key=AIzaSyC8d5S59tZStgrN0G9z6Zf1hbr5U7kGA_k" allowfullscreen></iframe>--}}
</div>

<!-- Main -->
<div class="container">

  @include('frontend/partials/searchbar')

  <!-- Content -->

  <div class="row">

    <div class="col-md-12" style="">

      <div class="row">

        @foreach($main_categories as $cat)

        <div class="col-md-4">
          <div class="category-box">
            <div class="category-icon-holder">
                <span class="fa {{ (!empty($cat->icon))?$cat->icon:'fa-building'}}" style="background-color:{{ (!empty($cat->icon_bgcolor))?$cat->icon_bgcolor:'#000'}};color:{{ (!empty($cat->icon_color))?$cat->icon_color:'#fff'}};"></span>
            </div>
            <div class="category-content">
                <h2>{{$cat->name}}</h2>
                <ul>
                  @foreach($cat->children as $child)
                  <li><a href="{{ URL::to('category/'.$child->id.'/'.$child->slug) }}">{{$child->name}}</a></li>
                  @endforeach
                </ul>
            </div>
          </div>
        </div>

        @endforeach


      </div>


    </div>

  </div>





</div>

@stop


@section('scripts')

{!! HTML::script('js/jquery.sticky.js') !!}

<script type="text/javascript">

$(".sticky").sticky({topSpacing:15});


function initHomeMap() {

  var map;
  var markers = {!! json_encode($markers) !!};
  var infoWindowContent = {!! json_encode($infoWindowContent) !!};

  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 22.1506876, lng: -100.9782947},
    zoom: 11,
    scrollwheel: false,
  });


  var infoWindow = new google.maps.InfoWindow(), marker, i;

  // set markers
  for( i = 0; i < markers.length; i++ ) {
      var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

      marker = new google.maps.Marker({
          position: position,
          map: map,
          title: markers[i][0],
          icon: "{{URL::to('img/marker-blue-small.png')}}",

      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
              infoWindow.setContent(infoWindowContent[i][0]);
              infoWindow.open(map, marker);
          }
      })(marker, i));
  }


  // set user location
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      infoWindow.setPosition(pos);
      infoWindow.setContent('Location found.');
      map.setCenter(pos);
    }, function() {
      //handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation

  }


}



</script>


@stop

