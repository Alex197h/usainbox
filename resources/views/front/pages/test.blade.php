@extends('layouts.app')

@section('title', 'Accueil')

@section('content')


    <div id="map"></div>
    <div id="show">
        <h4 class="title"></h4>
        <b class="description"></b>
        <div class="offer">
            
        </div>
    </div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUTW7_sKsarvYpb8HJdG1cWptczyG3Jf0&callback=initMap&libraries=places"></script>
    <script type="text/javascript">
        var MapElement = document.getElementById('map');
        var ShowElement = document.getElementById('show');
        var Cities = <?= json_encode($transport_offers) ?>;
        
        var map;
        
        
        function initMap() {
            map = new google.maps.Map(MapElement, {
                center: {lng: 2.70263671875, lat: 46.255846818480315},
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
            
            var Markers = [];
            var MarkersHidden = false;
            var MarkerClicked = false;
            
            var Directions = new google.maps.DirectionsRenderer({
                map: map,
                preserveViewport: true,
            });
            
            
            for(i in Cities){
                if(Cities[i][0]){
                    var marker = new google.maps.Marker({
                        position: {lng: Cities[i][0].lng, lat: Cities[i][0].lat},
                        map: map,
                        icon: icon,
                        title: Cities[i][0].label,
                        cities: Cities[i],
                        transport: i,
                        path: null,
                    });
                    
                    marker.addListener('mouseover', function() {
                        for(m in Markers){
                            Markers[m].setVisible(false);
                        }
                        this.setVisible(true);
                        this.path = setPath(this.cities);
                        
                        MarkersHidden = true;
                    });
                    
                    marker.addListener('click', function() {
                        var clone = this;
                        
                        $.ajax({
                            url: 'ptest',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'transport': clone.transport,
                            },
                            success: (function(result){
                                MarkerClicked = true;
                                $(ShowElement).find('.title').text(result.date_start);
                                $(ShowElement).find('.description').text(result.description);
                                $(ShowElement).find('.offer').html(
                                    'Autoroute: '+(result.highway ? 'Oui' : 'Non')
                                    +'<br>Trajet: '+(result.is_regular ? 'Régulier' : 'Occasionnel')
                                );
                            }),
                        });
                    });
                    Markers.push(marker);
                }
            }
            
            map.addListener('mousemove', function() {
                if(!MarkerClicked && MarkersHidden){
                    for(m in Markers){
                        Markers[m].setVisible(true);
                    }
                    Directions.setDirections();
                    MarkersHidden = false;
                }
            });
            
            map.addListener('click', function() {
                if(MarkerClicked){
                    /** Effacer contenu, effacer route actuelle */
                    Directions.setDirections();
                    MarkerClicked = false;
                }
            });
            
            
            
            /** Route */
            
            function setPath(cities) {
                var origin = {lng: cities[0].lng, lat: cities[0].lat};
                var destination = {lng: cities[cities.length-1].lng, lat: cities[cities.length-1].lat};
                var waypoints = [];
                
                if(cities.length > 2){
                    for(var i = 1; i < cities.length-1; i++){
                        waypoints.push({location: {
                            lng: cities[i].lng,
                            lat: cities[i].lat,
                        }, stopover: true});
                    }
                }
                
                var request = {
                    travelMode: google.maps.DirectionsTravelMode.DRIVING,
                    avoidTolls: false,
                    origin: origin,
                    destination: destination,
                    waypoints: waypoints
                }
                var directionsService = new google.maps.DirectionsService();
                directionsService.route(request, function (response, status) {
                    if(status == google.maps.DirectionsStatus.OK) {
                        Directions.setDirections(response);
                    }
                });
            }
            
            
        }
        
    </script>



@endsection
