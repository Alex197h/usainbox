@extends('layouts.app')

@section('title', 'Accueil')

    @section('content')
        <div class="row header-search">
            <form style="background: rgba(120, 106, 106, 0.75);" class="col s10 offset-s1" role="form"
            method="POST" action="{{ route('transport') }}">
            {{ csrf_field() }}
            <h4 class="col s12 white-text">Envoyez vos colis rapidement</h4>
            <div class="row">
                <div class="input-field col s12 l3">
                    <input id="city_start" class="white" placeholder="Ville départ" type="text" name="city_start" required>
                    <label style="display: none;" for="city_start">Ville départ</label>
                </div>
                <div style="text-align: center;"class="input-field col s12 l1">
                    <button type="button" style="height: 44px;" id="switch" class="btn white black-text">
                        {{
                            Html::image('public/img/switch.svg',
                            'Deux flèches pour switch',
                            array('class' => 'responsive-img icon', 'style' => 'vertical-align: middle;'))
                        }}
                    </button>
                </div>
                <div class="input-field col s12 l3">
                    <input id="city_end" class="white" placeholder="Ville arrivée" type="text" name="city_end" required>
                    <label style="display: none;" for="city_end">Ville arrivée</label>
                </div>
                <div class="input-field col s12 l2">
                    <input type="date" name="date" class=" white" placeholder="Date"
                    value="{{ date('Y-m-d') }}">
                </div>
                <div class="input-field col s12 l3">
                    <button style="height: 44px;" type="submit" class="col s12 btn waves-effect waves-light white black-text">
                        Expédier
                        {{
                            Html::image('public/img/transport.svg',
                            'Camion de transport',
                            array('class' => 'responsive-img icon', 'style' => 'vertical-align: middle;'))
                        }}
                    </button>
                </div>
            </div>
        </form>
        <a id="scrollDown" href="#introduction"
        class="hide-on-small-only waves-light transparent white-text"><i
        class="material-icons floating scrollspy">expand_more</i></a>
    </div>

    <script>
    $('#switch').on('click', function(){
        var first = $('#city_start').val();
        var last = $('#city_end').val();
        $('#city_start').val(last);
        $('#city_end').val(first);
    });
    </script>

    <div id="introduction" class="row scrollspy">
        <h3 class="center" style="padding: 55px;">Retrouver des transport partout en France</h3>
    </div>

    <div class="col s12" >
        <div id="resss"></div>
        <div class="col s12 right" id="map"></div>
        <div id="transport_offers" class="col s12"></div>
    </div>

    <!-- <section class="col s12 m8 offset-m2 home-img" id="video-pres">
    <video class="col s12 valign" autoplay loop muted class="responsive-video">
    <source src="public/video/pres.mp4" type="video/mp4"/>
</video>
</section> -->

<div id="offercopy" hidden>
    <div class="col s12 offer card horizontal$selected" offer-id="$offerid">
        <div class="card-image valign-wrapper">
            <img class="circle valign" src="http://lorempixel.com/100/190/nature/6">
        </div>
        <div class="card-stacked">
            <div class="card-content">
                <div class="section center">
                    <h4>$date</h4>
                    <span>$itinerary</span>
                    <i class="small material-icons" style="color:#$gender">account_circle</i><span>
                        <a href="{{ url('user') }}/$user">$name</a> ($age ans)</span><br>
                    </div>
                    <div class="section detail-offer">
                        <i class="small material-icons">star_border</i><span> $note/5</span><br><br>
                        <b>Heure de départ:</b> $hour<br>
                        <b>Description:</b> $description<br><br>
                        {{ Html::image('public/img/trajet/$regular.icon.svg',
                            'Calendrier',
                            array('class' => 'responsive-img tooltipped iconT', 'data-tooltip' => '$regular.text'))
                        }}

                        $highway $charge $detour

                    </div>
                </div>
                <div class="card-action">
                    <a href="#">Voir l'annonce</a>
                </div>
            </div>
        </div>
    </div>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUTW7_sKsarvYpb8HJdG1cWptczyG3Jf0&callback=initMap&libraries=places"></script>
    <script type="text/javascript">


    var MapElement = document.getElementById('map');
    var ShowElement = document.getElementById('show');
    var Cities = <?= json_encode($transport_offers) ?>;

    var map;


    function initMap() {
        map = new google.maps.Map(MapElement, {
            center: {lng: 2.70263671875, lat: 46.255846818480315},
            navigationControl: false,
            mapTypeControl: false,
            scaleControl: false,
            draggable: true,
            scrollwheel: false,
            zoom: 6
        });

        var icon = {
            url: "http://maps.google.com/mapfiles/kml/shapes/cabs.png",
            scaledSize: new google.maps.Size(25, 25),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(0, 0)
        };

        var Markers = {};
        var Paths = [];
        var MarkersHidden = false;
        var MarkerClicked = false;


        var preMarkers = {};
        for (i in Cities) {
            if (Cities[i][0]) {
                if (!preMarkers[Cities[i][0].label]) preMarkers[Cities[i][0].label] = [];
                Cities[i].transport = i;
                preMarkers[Cities[i][0].label].push(Cities[i]);
            }
        }

        for (i in preMarkers) {
            var cityStart = preMarkers[i][0][0];
            var cities = [];
            var transport = [];

            if(preMarkers[i].length == 1) {
                cities.push(preMarkers[i][0]);
                transport.push(preMarkers[i][0].transport);
            }
            /* Else if cities are stacked */
            else {
                for(var j in preMarkers[i]) {
                    cities.push(preMarkers[i][j]);
                    transport.push(preMarkers[i][j].transport);
                }
            }

            var marker = new google.maps.Marker({
                position: {lng: cityStart.lng, lat: cityStart.lat},
                map: map,
                icon: icon,
                title: cityStart.label,
                cities: cities,
                transport: transport,
                clicked: false,
                showPath: false,
                path: null,
                paths: [],
                infowindow: null,
            });

            marker.addListener('mouseover', function() {
                var count = this.cities.length;

                if(count == 1){
                    for(m in Markers) {
                        for (n in Markers[m]) {
                            Markers[m][n].setVisible(false);
                        }
                    }
                    this.setVisible(true);

                    if(!this.path) this.path = setPath(this.cities[0]);
                    this.path.setMap(map);
                    this.showPath = true;

                    MarkersHidden = true;
                } else {
                    this.infowindow = new google.maps.InfoWindow({
                        content: count+' offres'
                    });
                    this.infowindow.open(map, this);
                }
            });

            marker.addListener('mouseout', function () {
                if(this.infowindow){
                    this.infowindow.close();
                    this.infowindow = null;
                }
                if(this.showPath && !MarkerClicked) {
                    for (m in Markers) {
                        for (n in Markers[m]) {
                            Markers[m][n].setVisible(true);
                        }
                    }
                    this.path.setMap(null);
                    this.path = null;
                    MarkersHidden = false;
                }
            });

            marker.addListener('click', function () {
                var clone = this;
                var offers = this.transport;
                MarkerClicked = true;
                for(m in Markers) {
                    for (n in Markers[m]) {
                        Markers[m][n].setVisible(false);
                    }
                }
                this.setVisible(true);

                if(clone.cities.length == 1 || (!clone.showPath && clone.cities.length > 1)){
                    $.ajax({
                        url: 'gettransportmap',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'transport': offers,
                        },
                        success: (function(result) {
                            if(clone.cities.length > 1){
                                clone.path = setPath(clone.cities[0]);
                            }

                            clone.path.setMap(map);
                            clone.showPath = true;

                            MarkersHidden = true;

                            var div = $('#transport_offers');
                            div.html('');

                            var count = 1;
                            for(r in result) {
                                console.log(result[r]);
                                var divo = $('#offercopy').html();
                                var d = result[r].date_start;
                                var arr = {
                                    selected: count==1 ? ' selected' : '',
                                    date: (new Date(d.split(' ')[0])).toLocaleDateString(),
                                    offerid: count,
                                    user: result[r].user.id,
                                    hour: d.split(' ')[1],
                                    name: result[r].user.first_name+' '+result[r].user.last_name,
                                    gender: result[r].user.gender == 0 ? 'FFBCD8' : '39D5FF',
                                    age: (new Date().getFullYear())-(new Date(result[r].user.birthday).getFullYear()),
                                    description: result[r].description,
                                    regular: {
                                        icon: result[r].is_regular ? 'regularYes' : 'regularNo',
                                        text: result[r].is_regular ? 'Trajet régulier' : 'Trajet occasionnel',
                                    },
                                    highway : result[r].highway == 1 ?
                                    '{{ Html::image('public/img/trajet/highwayYes.svg',
                                        'Icon de l\'autoroute',
                                        array('class' => 'responsive-img tooltipped iconT',
                                        'data-tooltip' => 'Prend l\'autoroute'))
                                    }}' : '',

                                    charge: result[r].user.help_charge == 1 ?
                                    '{{ Html::image('public/img/trajet/cartYes.svg',
                                        'Icon d\'un diable pour le transport',
                                        array('class' => 'responsive-img tooltipped iconT',
                                        'data-tooltip' => 'Aide pour le chargement'))
                                    }}' : '',

                                    detour: result[r].detour == 1 ?
                                    '{{ Html::image('public/img/trajet/detour.svg',
                                        'Icon de deux flèche pour le détour',
                                        array('class' => 'responsive-img tooltipped iconT',
                                        'data-tooltip' => 'Détour possible'))
                                    }}' : '',
                                };
                                divo = divo.replace(/[$]([a-z]+)([.]([a-z]+))?/g, function(matches, a, b, c){
                                    var res = '';
                                    if(c){
                                        if(arr[a] && arr[a][c]) res = arr[a][c];
                                    }
                                    else if(arr[a]) res = arr[a];

                                    return res;
                                });

                                var Newdiv = $(divo);

                                Newdiv.on('click', function(){
                                    if(!$(this).hasClass('selected')){
                                        clone.path.setMap(null);
                                        clone.path = setPath(clone.cities[$(this).attr('offer-id')-1]);
                                        clone.path.setMap(map);
                                    }
                                });

                                div.append(Newdiv);
                                count++;
                            }
                            // $("#map").animate({"width": "60%"}, 500);
                            div.show(500);
                            $('.tooltipped').tooltip({delay: 50});
                        })
                    });
                }
            });

            if (!Markers[marker.title]) Markers[marker.title] = [];
            Markers[marker.title].push(marker);
        }

        map.addListener('click', function () {
            for (m in Markers) {
                for (n in Markers[m]) {
                    Markers[m][n].setVisible(true);
                    Markers[m][n].showPath = false;
                    if (Markers[m][n].path) {
                        Markers[m][n].path.setMap(null);
                    }
                }
            }
            MarkerClicked = false;
            $('#transport_offers').html('').hide(500);
            // $("#map").animate({"width": "100%"}, 500);

        });


        /** Route */
        function setPath(cities) {
            var Directions = new google.maps.DirectionsRenderer({
                map: null,
                preserveViewport: true,
            });
            var origin = {lng: cities[0].lng, lat: cities[0].lat};
            var destination = {lng: cities[cities.length - 1].lng, lat: cities[cities.length - 1].lat};
            var waypoints = [];

            if (cities.length > 2) {
                for (var i = 1; i < cities.length - 1; i++) {
                    waypoints.push({
                        location: {
                            lng: cities[i].lng,
                            lat: cities[i].lat,
                        }, stopover: true
                    });
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
                if (status == google.maps.DirectionsStatus.OK) {
                    Directions.setDirections(response);
                }
            });
            return Directions;
        }

        var options = {types: ['(cities)']};
        new google.maps.places.Autocomplete(document.getElementById('city_start'), options);
        new google.maps.places.Autocomplete(document.getElementById('city_end'), options);
    }

    $(document).on('click', '#transport_offers .offer', function(){
        if(!$(this).hasClass('selected')){
            $('#transport_offers .offer.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    </script>


@endsection
