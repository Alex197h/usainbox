@extends('layouts.app')

@section('title', 'Accueil')

@section('content')


    <div class="row header-search ">
        <form class=" col s12">
            <h4 class="col s12 white-text">Envoyez vos colis rapidement</h4>
            <div class="row">
                <div class="input-field col s12 m5 l3">
                    <input id="icon_prefix" class="white" placeholder="Ville départ" type="text">
                    <label style="display: none;" for="icon_prefix">Ville départ</label>
                </div>
                <div class="input-field col s12 m5 l3">
                    <input id="icon_telephone" class="white" placeholder="Ville arrivée" type="tel">
                    <label style="display: none;" for="icon_prefix">Ville arrivée</label>
                </div>
                <div class="input-field col s12 m2 l2">
                    <input type="date" class="datepicker white" placeholder="Date">
                </div>
                <div class="input-field col s12 m6 l2">
                    <button class="col s12 btn waves-effect waves-light white black-text" type="button" name="action">
                        Expédier
                    </button>
                </div>
                <div class="input-field col s12 m6 l2">
                    <button class="col s12 btn waves-effect waves-light white black-text" type="button" name="action">
                        Transporter
                    </button>
                </div>
            </div>
        </form>
        <a id="scrollDown" href="#introduction" class="hide-on-small-only waves-effect waves-light transparent white-text"><i
                    class="material-icons">expand_more</i></a>
    </div>

    <div class="row">
        <section id="introduction" class="center col s12 m12 l6 valign section scrollspy ">
            <h3 class="col s12 m10 offset-m1">Lorem Ipsum</h3>
            <p class="col s12 m10 offset-m1">Le Lorem Ipsum est simplement du faux texte employé dans la composition et
                la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis
                les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un
                livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi
                adapté à la bureautique informatique, sans que son contenu n'en soit modifié.</p>
        </section>
        <section class="col s12 m12 l6 valign home-img center-align">
            {{ Html::image('public/img/img.png', 'Lorem Ipsum', array('class' => 'responsive-img center-align')) }}
        </section>
    </div>



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
                zoom: 10
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
                navigator.geolocation.getCurrentPosition(function (position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    infoWindow.setPosition(pos);
                    map.setCenter(pos);
                }, function () {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                handleLocationError(false, infoWindow, map.getCenter());
            }
            /***************/


            /** Log positions on click */
            var ClickPos = false;
            if (ClickPos) {
                google.maps.event.addListener(map, "click", function (event) {
                    var latitude = event.latLng.lat();
                    var longitude = event.latLng.lng();
                    console.log(latitude + ', ' + longitude);

                    radius = new google.maps.Circle({
                        map: map,
                        radius: 100,
                        center: event.latLng,
                        fillColor: '#777',
                        fillOpacity: 0.1,
                        strokeColor: '#AA0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        scrollwheel: false,
                        navigationControl: false,
                        draggable: true,    // Dragable
                        editable: true      // Resizable
                    });
                    map.panTo(new google.maps.LatLng(latitude, longitude));
                });
            }
            /** Eng log positions */


            /** Route */

            function addRoute(origin, destination) {
                direction = new google.maps.DirectionsRenderer({
                    map: map,
                    panel: document.getElementById('map')
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
        }

        /** Récupérer les positions actuelles */
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
        }


    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUTW7_sKsarvYpb8HJdG1cWptczyG3Jf0&callback=initMap"></script>



    <section class="col s12 m8 offset-m2 home-img" id="video-pres">
        <video class="col s12 valign" autoplay loop muted class="responsive-video">
            <source src="public/video/pres.mp4" type="video/mp4">
        </video>
    </section>
    <script type="text/javascript">

        $(document).ready(function () {
            $('.scrollspy').scrollSpy();
        });

        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
        });
    </script>
@endsection
