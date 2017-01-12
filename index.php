<?php
  include ('config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Liat Marker</title>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
<!--  <script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script -->
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<body>
<section id="wrapper">
<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
    <article>

    </article>
 <script>
  function success(position) {
  var mapcanvas = document.createElement('div');
  mapcanvas.id = 'mapcontainer';
  mapcanvas.style.height = '400px';
  mapcanvas.style.width = '600px';

  document.querySelector('article').appendChild(mapcanvas);

  var coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  
    var options = {
      zoom: 18,
      center: coords,
      mapTypeControl: false,
      navigationControlOptions: {
        style: google.maps.NavigationControlStyle.SMALL
      },
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("mapcontainer"), options);

    map.addListener('click', function(event) {
        addMarker(event.latLng);
    });

    var marker = new google.maps.Marker({
        position: coords,
        map: map,
        title:"You are here!"
    });

  function addMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
    var infowindow = new google.maps.InfoWindow({
      content: 'Latitude: ' + location.lat() +
      '<br>Longitude: ' + location.lng()
    });
    infowindow.open(map,marker);
       // markers.push(marker);
  }
}

//mengecek dan menampilkan
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(success);
} else {
  error('Geo Location is not supported');
}
    
 /*  function ambildata(){
      $.ajax({
        url : "ambildata.php",
        dataType : "JSON",
        cache : false,
        success : function(msg){
          for (var i=0; i<msg.posisi.info.length();i++) {
            //
            var LatBaru = new google.maps.LatLng(msg.posisi.info[i].lat,msg.posisi.info[i].lang);
            var marker = new google.maps.Marker({
              position: LatBaru;
              map: peta,
              title:"Judul"
            });
          };
        }
      });
    } */
  </script>
<div id="petaku"></div>
</section>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZbkZWH-_I7v8oi_S9FuZEN0vB0MAEjnw&callback=initMap" type="text/javascript"></script> 

</body>
</html>