<head>
    <style type="text/css">
      html, body { height: 100%; margin: 0; padding: 0; }
      #map { height: 100%; }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script type="text/javascript">
        var Villes = {
            Gap: {
                lat: 44.559638,
                lng: 6.079758
            },
            Vars: {
                lat: 44.57207367490651,
                lng: 6.680030822753906
            },
            Tallard: {
                lat: 44.46153683560693,
                lng: 6.055011749267578
            },
            Sisteron: {
                lat: 44.19500528245342,
                lng: 5.943045616149902
            },
            Briancon: {
                lat: 44.89926459675508,
                lng: 6.6432952880859375
            },
            Hyeres: {
                lat: 43.118841028558776,
                lng: 6.128911972045898
            },
            Toulon: {
                lat: 43.124228780989085,
                lng: 5.92987060546875
            },
            Quincy: {
                lat: 47.13377541734805,
                lng: 2.1560239791870117
            },
            Orleans: {
                lat: 47.90667693563599,
                lng: 1.9095611572265625
            },
            Paris: {
                lat: 48.8511618571692,
                lng: 2.3565673828125
            },
            Bordeaux: {
                lat: 44.83834308566653,
                lng: -0.569915771484375
            },
            NewYork: {
                lat: 40.69521661351715,
                lng: -73.9984130859375
            },
            Bogota: {
                lat: 4.688666902768214,
                lng: -74.06707763671875
            },
        }
        
        function getPos(ville){
            return {lat: Villes[ville].lat, lng: Villes[ville].lng};
        }
        
        
        var map;
        var coords = getPos('Gap');
        
        function initMap(){
            map = new google.maps.Map(document.getElementById('map'), {
                center: coords,
                zoom: 8
            });
            
            var marker = new google.maps.Marker({
                position: coords,
                map: map,
                title: 'Hello World!'
            });
            
            var infoWindow = new google.maps.InfoWindow({map: map});
            
            
            
            /** Géolocaliser l'utilisateur */
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                };
                infoWindow.setPosition(pos);
                map.setCenter(pos);
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                handleLocationError(false, infoWindow, map.getCenter());
            }
            /***************/
            
            
            /** Log positions on click */
            var ClickPos = false;
            if(ClickPos){
                google.maps.event.addListener(map, "click", function (event) {
                    var latitude = event.latLng.lat();
                    var longitude = event.latLng.lng();
                    console.log( latitude + ', ' + longitude );

                    radius = new google.maps.Circle({map: map,
                        radius: 100,
                        center: event.latLng,
                        fillColor: '#777',
                        fillOpacity: 0.1,
                        strokeColor: '#AA0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        draggable: true,    // Dragable
                        editable: true      // Resizable
                    });
                    map.panTo(new google.maps.LatLng(latitude,longitude));
                });
            }
            /** Eng log positions */
            
            
            /** Route */
            
            function addRoute(origin, destination){
                direction = new google.maps.DirectionsRenderer({
                    map   : map, 
                    panel : document.getElementById('map') 
                });
                var request = {
                    origin      : origin,
                    destination : destination,
                    travelMode  : google.maps.DirectionsTravelMode.DRIVING,
                    avoidTolls: false,
                    waypoints: [
                        {location: getPos('Bordeaux'),stopover:true},
                        {location: getPos('Toulon'),stopover:true},
                        {location: getPos('Briancon'),stopover:true},
                        {location: getPos('Orleans'),stopover:true},
                        {location: getPos('Hyeres'),stopover:true},
                        {location: getPos('Quincy'),stopover:true},
                    ]
                }
                var directionsService = new google.maps.DirectionsService();
                directionsService.route(request, function(response, status){
                    if(status == google.maps.DirectionsStatus.OK){
                        direction.setDirections(response);
                    }
                });
            }
            
            addRoute(getPos('Gap'), getPos('Paris'));
        }
        
        /** Récupérer les positions actuelles */
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
          }
        
        
        
    </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUTW7_sKsarvYpb8HJdG1cWptczyG3Jf0&callback=initMap"></script>
</body>
<script>
    var Clé = 'AIzaSyBUTW7_sKsarvYpb8HJdG1cWptczyG3Jf0';
</script>

