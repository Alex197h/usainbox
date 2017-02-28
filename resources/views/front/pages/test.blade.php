@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

    <style>
        #map{height: 700px;}
    </style>
    <div id="result"></div>
    <div id="map"></div>
    <div id="transport_offers"></div>
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
                scrollwheel:true,
                zoom: 6
            });
            
            var icon = {
                url: "http://maps.google.com/mapfiles/kml/shapes/cabs.png",
                scaledSize: new google.maps.Size(25, 25),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(0, 0)
            };
            
            var Markers = {};
            var MarkersHidden = false;
            var MarkerClicked = false;
            
            
            var preMarkers = {};
            for(i in Cities){
                if(Cities[i][0]){
                    if(!preMarkers[Cities[i][0].label]) preMarkers[Cities[i][0].label] = [];
                    Cities[i].transport = i;
                    preMarkers[Cities[i][0].label].push(Cities[i]);
                }
            }
            
            for(i in preMarkers){
                var cityStart = preMarkers[i][0][0];
                var cities = preMarkers[i][0];
                var transport = [];
                
                if(preMarkers[i].length == 1){
                    transport.push(cities.transport);
                    delete cities.transport;
                }
                /* Else if cities are stacked */
                else {
                    for(j in preMarkers[i]){
                        transport.push(preMarkers[i][j].transport);
                        delete preMarkers[i][j].transport;
                        
                    }
                }
                
                
                var marker = new google.maps.Marker({
                    position: {lng: cityStart.lng, lat: cityStart.lat},
                    map: map,
                    icon: icon,
                    title: cityStart.label,
                    
                    cities: cities,
                    transport: transport,
                    showPath: false,
                    path: null,
                });
                
                marker.addListener('mouseover', function() {
                    for(m in Markers){
                        for(n in Markers[m]){
                            Markers[m][n].setVisible(false);
                        }
                    }
                    if(!this.path) this.path = setPath(this.cities);
                    this.setVisible(true);
                    this.path.setMap(map);
                    MarkersHidden = true;
                });
                
                marker.addListener('mouseout', function() {
                    if(!this.showPath){
                        for(m in Markers){
                            for(n in Markers[m]){
                                Markers[m][n].setVisible(true);
                            }
                        }
                        this.path.setMap(null);
                        MarkersHidden = false;
                    }
                });
                
                marker.addListener('click', function() {
                    var clone = this;
                    var offers = this.transport;
                    
                    $.ajax({
                        url: 'ptest',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'transport': offers,
                        },
                        success: (function(result){
                            for(m in Markers){
                                for(n in Markers[m]){
                                    Markers[m][n].setVisible(false);
                                }
                            }
                            clone.setVisible(true);
                            clone.path.setMap(map);
                            clone.showPath = true;
                            
                            MarkersHidden = true;
                            MarkerClicked = true;
                            
                            var div = $('#transport_offers');
                            div.html('')
                            for(r in result){
                                console.log(result[r])
                                let offer = $('<div>');
                                offer.append('<h4>'+result[r].date_start+' ('+result[r].id+')</h4>');
                                offer.append('<div>'+result[r].description+'</div>');
                                div.append(offer);
                            }
                            
                            // $(ShowElement).find('.title').text();
                            // $(ShowElement).find('.description').text(result.description);
                            // $(ShowElement).find('.offer').html(
                                // 'Autoroute: '+(result.highway ? 'Oui' : 'Non')
                                // +'<br>Trajet: '+(result.is_regular ? 'Régulier' : 'Occasionnel')
                            // );
                        }),
                    });
                });
                
                if(!Markers[marker.title]) Markers[marker.title] = [];
                Markers[marker.title].push(marker);
            }
            
            map.addListener('click', function() {
                for(m in Markers){
                    for(n in Markers[m]){
                        Markers[m][n].setVisible(true);
                        Markers[m][n].showPath = false;
                        if(Markers[m][n].path){
                            Markers[m][n].path.setMap(null);
                        }
                    }
                }
                MarkerClicked = false;
            });
            
            /** Route */
            function setPath(cities) {
                var Directions = new google.maps.DirectionsRenderer({
                    map: null,
                    preserveViewport: true,
                });
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
                return Directions;
            }
            
            
        }
    </script>



@endsection
