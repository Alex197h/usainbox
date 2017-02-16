@extends('layouts.app')

@section('title', 'Accueil')

@section('content')


    <div id="map"></div>
    <script type="text/javascript">
        var Cities = <?= json_encode($transport_offers) ?>;
        
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

        function getPos(ville) {
            return {lat: Villes[ville].lat, lng: Villes[ville].lng};
        }


        var map;
        var coords = getPos('Gap');

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: coords,
                scrollwheel: false,
                navigationControl: false,
                mapTypeControl: false,
                scaleControl: false,
                draggable: true,
                zoom: 6
            });
            
            var icon = {
                url: "http://maps.google.com/mapfiles/kml/shapes/cabs.png",
                scaledSize: new google.maps.Size(25, 25),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(0, 0)
            };
            
            for(i in Cities){
                if(Cities[i][0]){
                    var marker = new google.maps.Marker({
                        position: {lng: Cities[i][0].lng, lat: Cities[i][0].lat},
                        map: map,
                        icon: icon,
                        title: Cities[i][0].label,
                        cities: Cities[i]
                    });
                    
                    marker.addListener('mouseover', function() {
                        console.log(this.cities)
                    });
                }
            }
            
            
            
            /** Route */
            /*
            function addRoute(origin, destination) {
                direction = new google.maps.DirectionsRenderer({
                    map: map,
                    // panel: document.getElementById('map')
                });
                var request = {
                    origin: origin,
                    destination: destination,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING,
                    avoidTolls: false,
                    waypoints: [
                        {location: getPos('Bordeaux'), stopover: true},
                        {location: getPos('Toulon'), stopover: true},
                        {location: getPos('Briancon'), stopover: true},
                        {location: getPos('Orleans'), stopover: true},
                        {location: getPos('Hyeres'), stopover: true},
                        {location: getPos('Quincy'), stopover: true},
                    ]
                }
                var directionsService = new google.maps.DirectionsService();
                directionsService.route(request, function (response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        direction.setDirections(response);
                    }
                });
            }

            addRoute(getPos('Gap'), getPos('Paris'));
            */
            
        }
        
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUTW7_sKsarvYpb8HJdG1cWptczyG3Jf0&callback=initMap&libraries=places"></script>



@endsection
