<?php
  include ('config.php');
?>
<!DOCTYPE html>
<html>
<head>
<script src="//maps.googleapis.com/maps/api/js?v=3.2&amp;sensor=false"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="routeboxer.js"></script>

<style>
    #map {
      border: 1px solid black;
    }
  </style>
</head>
<body onload="initMap();">
<div id="map" style="width: 800px; height: 600px;"></div>
<div id="lokasi"></div>
    Radius dari jalan raya <input type="text" id="distance" value="0.05" size="2">miles
    Rute dari <input type="text" id="from" value="surabaya"/>
    ke <input type="text" id="to" value="sidoarjo"/>
    <input type="submit" onclick="route()"/> <br/>

    <div id="results"></div>
    <div id="page"></div>
<script type="text/javascript">
    
  var map = null;
  var boxpolys = null;
  var directions = null;
  var routeBoxer = null;
  var distance = null; // km
  var image = "markerku.png"; //custom marker icon. Silahkan ganti sesuai keinginan
    
function success(position) {
  var markers = [];
  var coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  var geocoder = geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'latLng': coords }, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[1]) { 
          $("#lokasi").append("Lokasi: " +results[1].formatted_address+ "");
        }
      }
  });
 
  var mapOptions = {
    center: coords,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoom: 17,
    mapTypeControl: false,
    navigationControlOption: {
      style: google.maps.NavigationControlStyle.SMALL
    }
  };
      
  map = new google.maps.Map(document.getElementById("map"), mapOptions);

  //event jika map diklik
  map.addListener('click', function(event) {
    deleteMarker();
    addMarker(event.latLng);
  });

  //buat marker dan info window
  var marker = new google.maps.Marker({
      position: coords,
      map: map,
      draggable:true,
      icon: image,
      title:"You are here!"
  });

  var infowindow = new google.maps.InfoWindow({
      content: 'Kamu di sini sekarang!'
  });
  infowindow.open(map,marker);

  //fungsi menambah marker
  function addMarker(location) {
    deleteMarker();
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        icon: image,
    });
    var infowindow = new google.maps.InfoWindow({
        content: 'Kamu akan menambahkan lokasi di sini!'
    }); 
    infowindow.open(map,marker);
    markers.push(marker); 
  }

  //fungsi menyembunyikan marker
  function clearMarkers() {
    setMapOnAll(null);
  } 

  // Sets the map on all markers in the array.
  function setMapOnAll(map) {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
  }

  //menghapus marker dari array
  function deleteMarker(){
    clearMarkers();
    markers = [];
  }

  //deklarasi routeBoxer
  routeBoxer = new RouteBoxer(); 
  directionService = new google.maps.DirectionsService();
  directionsRenderer = new google.maps.DirectionsRenderer({ map: map });    
}
    
function route() {
  // Clear any previous route boxes from the map
  clearBoxes();
      
  // Convert jarak rute terhadap boxes dari satuan mile ke km
  distance = parseFloat(document.getElementById("distance").value) * 1.609344;
      
  var request = {
    origin: document.getElementById("from").value,
    destination: document.getElementById("to").value,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  }
      
  // Buat rute (direction) yang sudah direquest sebelumnya
  directionService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsRenderer.setDirections(result);
           
      var path = result.routes[0].overview_path;
      var boxes = routeBoxer.box(path, distance);
      drawBoxes(boxes);
      findPlaces(boxes);
    } else {
      alert("Directions query failed: " + status);
    }
  });
}
    
// Draw the array of boxes as polylines on the map
function drawBoxes(boxes) {
  boxpolys = new Array(boxes.length);
    for (var i = 0; i < boxes.length; i++) {
      boxpolys[i] = new google.maps.Rectangle({
        bounds: boxes[i],
        fillOpacity: 0,
        strokeOpacity: 1.0,
        strokeColor: '#000000',
        strokeWeight: 0,
        map: map
    });
  }
}
    
// Menghapus boxes yang sudah ada di map. dipanggil setiap kali request rute baru
function clearBoxes() {
  if (boxpolys != null) {
    for (var i = 0; i < boxpolys.length; i++) {
      boxpolys[i].setMap(null);
    }
  }
  boxpolys = null;
}

//fungsi untuk 'create marker'
function createMarker(map, coords, title) {
  /* map -> variabel map (lihat success();)
     coords -> koordinat dari lokasi (latitude & longitude)
     title -> set title masing-masing marker
  */ 
  var marker = new google.maps.Marker({
    position: coords,
    map: map,
    title: title,
    draggable: false,
    icon: image
  });
  return marker;
}

//Cari lokasi yang memiliki koordinat di dalam boxes
function findPlaces(boxes) {
  $.getJSON('proses.php', function(results){
    console.log(results);
    for (var i = 0; i < boxes.length; i++) {
      $.each(results, function(k, v){
          if ( v.lat < boxes[i].getNorthEast().lat() && v.lat > boxes[i].getSouthWest().lat() && v.lng > boxes[i].getSouthWest().lng() && v.lng < boxes[i].getNorthEast().lng()) {

            var coords = new google.maps.LatLng(v.lat, v.lng);
            createMarker(map, coords, v.nama);          
          } 
      }); 
    }
  });
}
 
function initMap(){
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(success);
  } else {
    error('Geo Location is not supported');
  }  
}

  </script>
</body>
</html>