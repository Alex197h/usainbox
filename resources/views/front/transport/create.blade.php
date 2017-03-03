@extends('layouts.app')

@section('title', 'Ajouter une offre')

@section('content')
    <div class="row">
        <div class="col s12 section center">
            <h5>Proposez d'envoyer un colis</h5>
        </div>

        <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 card-panel">
            <div class="section">

                <div class="col s12">
                    <div id="resss"></div>
                    <div class="col s12 right" id="map"></div>
                    <div id="transport_offers"></div>
                </div>

                <div class="col s12{{ $errors->has('vehicle') ? ' has-error' : '' }}">
                    <label for="vehicle">Véhicule utilisé</label>
                    <select id="vehicle" type="text" class="form-control" name="vehicle" required>
                        <option value="" disabled selected>Choisir votre véhicule</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}"{{ $vehicle->default ? ' selected':'' }}>{{ $vehicle->car_brand }} {{ $vehicle->car_model }}</option>
                        @endforeach
                    </select>


                    @if ($errors->has('vehicle'))
                        <span class="col s12">
                            <strong>{{ $errors->first('vehicle') }}</strong>
                        </span>
                    @endif

                </div>

                <div class="col s12 m4{{ $errors->has('date_start') ? ' has-error' : '' }}">
                    <label for="date_start">Date et heure de départ</label>

                    <input id="date_start" type="datetime" class="form-control" placeholder="jj/mm/aaaa hh:mm"
                           name="date_start" value="{{ old('date_start') }}">

                    @if ($errors->has('date_start'))
                        <span class="col s12">
                            <strong>{{ $errors->first('date_start') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 m4{{ $errors->has('max_width') ? ' has-error' : '' }}">
                    <label for="max_width">Largeur maximale du colis acceptée</label>

                    <input id="max_width" type="number" class="form-control" placeholder="Largeur max en cm"
                           name="max_width" value="{{ old('max_width') }}">

                    @if ($errors->has('max_width'))
                        <span class="col s12">
                            <strong>{{ $errors->first('max_width') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 m4{{ $errors->has('max_length') ? ' has-error' : '' }}">
                    <label for="max_length">Longueur maximum du colis acceptée</label>

                    <input id="max_length" type="number" class="form-control" placeholder="Longueur max en cm"
                           name="max_length" value="{{ old('max_length') }}">

                    @if ($errors->has('max_length'))
                        <span class="col s12">
                            <strong>{{ $errors->first('max_length') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 m4{{ $errors->has('max_height') ? ' has-error' : '' }}">
                    <label for="max_height">Hauteur maximum du colis acceptée</label>

                    <input id="max_height" type="number" class="form-control" placeholder="Hauteur max en cm"
                           name="max_height" value="{{ old('max_height') }}">

                    @if ($errors->has('max_height'))
                        <span class="col s12">
                            <strong>{{ $errors->first('max_height') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 m4{{ $errors->has('max_volume') ? ' has-error' : '' }}">
                    <label for="max_volume">Volume du colis accepté</label>

                    <input id="max_volume" type="number" class="form-control" placeholder="Volume max en cm3"
                           name="max_volume" value="{{ old('max_volume') }}">

                    @if ($errors->has('max_volume'))
                        <span class="col s12">
                            <strong>{{ $errors->first('max_volume') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 m4{{ $errors->has('max_weight') ? ' has-error' : '' }}">
                    <label for="max_weight">Poids du colis accepté</label>

                    <input id="max_weight" type="number" class="form-control" placeholder="Poids max en g"
                           name="max_weight" value="{{ old('max_weight') }}">

                    @if ($errors->has('max_weight'))
                        <span class="col s12">
                            <strong>{{ $errors->first('max_weight') }}</strong>
                        </span>
                    @endif
                </div>

                <p class="col s12">
                    <div class="col s2 {{ $errors->has('is_regular') ? ' has-error' : '' }}">
                        <input  type="checkbox" name="is_regular" id="is_regular" value="1"/>
                        <label for="is_regular"> Trajet régulier </label>

                        @if ($errors->has('is_regular'))
                            <span class="col s12">
                                <strong>{{ $errors->first('is_regular') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col s2 {{ $errors->has('highway') ? ' has-error' : '' }}">
                        <input type="checkbox" name="highway" id="highway" value="1"/>
                        <label for="highway">Passer par l'autoroute </label>

                        @if ($errors->has('highway'))
                            <span class="col s12">
                                <strong>{{ $errors->first('highway') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col s2 {{ $errors->has('start_detour') ? ' has-error' : '' }}">
                        <input type="checkbox" name="start_detour" id="start_detour" value="1"/>
                        <label for="start_detour">Détour possible au départ </label>

                        @if ($errors->has('start_detour'))
                            <span class="col s12">
                                <strong>{{ $errors->first('start_detour') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col s2 {{ $errors->has('end_detour') ? ' has-error' : '' }}">
                        <input type="checkbox" name="end_detour" id="end_detour" value="1"/>
                        <label for="end_detour">Détour possible à l'arrivé </label>

                        @if ($errors->has('end_detour'))
                            <span class="col s12">
                                <strong>{{ $errors->first('end_detour') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col s3 {{ $errors->has('help_charge') ? ' has-error' : '' }}">
                        <input type="checkbox" name="help_charge" id="help_charge" value="1"/>
                        <label for="help_charge">Je peux aider à charger ou décharger </label>

                        @if ($errors->has('help_charge'))
                            <span class="col s12">
                                <strong>{{ $errors->first('help_charge') }}</strong>
                            </span>
                        @endif
                    </div>
                <div class="col s12 m12{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Description</label>
                    <textarea id="description" placeholder="Description" class="materialize-textarea"
                              name="description">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="col s12">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col s12 right-align">
                    <button type="submit" class="btn waves-effect waves-light white black-text">
                        Poster l'annonce
                    </button>
                </div>

            <script>
                <?php
                    $res = [];
                    foreach($vehicles as $vehicle) $res[$vehicle->id] = $vehicle->toArray();
                ?>
                var Vehicles = <?= json_encode($res) ?>;

                $('#vehicle').on('change', function(){
                    var vehicle = Vehicles[this.value];

                    $('#max_width').val(vehicle.max_width != 0 ? vehicle.max_width : '');
                    $('#max_height').val(vehicle.max_height != 0 ? vehicle.max_height : '');
                    $('#max_length').val(vehicle.max_length != 0 ? vehicle.max_length : '');
                    $('#max_volume').val(vehicle.max_volume != 0 ? vehicle.max_volume : '');
                    $('#max_weight').val(vehicle.max_weight);
                });
                $(document).ready(function(){
                    $('#vehicle').change();
                });

                $('#max_width, #max_height, #max_length').on('input', function(id){
                    var vehicle = Vehicles[$('#vehicle').val()];

                    var width = $('#max_width').val();
                    var height = $('#max_height').val();
                    var length = $('#max_length').val();

                    if(
                        width == '' || height == '' || length == '' ||
                    width == 0 || height == 0 || length == 0)
                    $('#max_volume').val(vehicle.max_volume);
                    else
                        $('#max_volume').val(width * height * length);

                });


            </script>
            <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUTW7_sKsarvYpb8HJdG1cWptczyG3Jf0&callback=initMap&libraries=places"></script>
            <script type="text/javascript">
            var MapElement = document.getElementById('map');
            //var ShowElement = document.getElementById('show');
            

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


                // var preMarkers = {};
                // for (i in Cities) {
                //     if (Cities[i][0]) {
                //         if (!preMarkers[Cities[i][0].label]) preMarkers[Cities[i][0].label] = [];
                //         Cities[i].transport = i;
                //         preMarkers[Cities[i][0].label].push(Cities[i]);
                //     }
                // }

                // for (i in preMarkers) {
                //     var cityStart = preMarkers[i][0][0];
                //     var cities = [];
                //     var transport = [];

                    // if(preMarkers[i].length == 1) {
                    //     cities.push(preMarkers[i][0]);
                    //     transport.push(preMarkers[i][0].transport);
                    // }
                    /* Else if cities are stacked */
                    // else {
                    //     for(var j in preMarkers[i]) {
                    //         cities.push(preMarkers[i][j]);
                    //         transport.push(preMarkers[i][j].transport);
                    //     }
                    // }

                    // var marker = new google.maps.Marker({
                    //     position: {lng: cityStart.lng, lat: cityStart.lat},
                    //     map: map,
                    //     icon: icon,
                    //     title: cityStart.label,
                    //     cities: cities,
                    //     transport: transport,
                    //     clicked: false,
                    //     showPath: false,
                    //     path: null,
                    //     paths: [],
                    //     infowindow: null,
                    // });

                    // marker.addListener('mouseover', function() {
                    //     var count = this.cities.length;
                    //
                    //     if(count == 1){
                    //         for(m in Markers) {
                    //             for (n in Markers[m]) {
                    //                 Markers[m][n].setVisible(false);
                    //             }
                    //         }
                    //         this.setVisible(true);
                    //
                    //         if(!this.path) this.path = setPath(this.cities[0]);
                    //         this.path.setMap(map);
                    //         this.showPath = true;
                    //
                    //         MarkersHidden = true;
                    //     } else {
                    //         this.infowindow = new google.maps.InfoWindow({
                    //             content: count+' offres'
                    //         });
                    //         this.infowindow.open(map, this);
                    //     }
                    // });

                    // marker.addListener('mouseout', function () {
                    //     if(this.infowindow){
                    //         this.infowindow.close();
                    //         this.infowindow = null;
                    //     }
                    //     if(this.showPath && !MarkerClicked) {
                    //         for (m in Markers) {
                    //             for (n in Markers[m]) {
                    //                 Markers[m][n].setVisible(true);
                    //             }
                    //         }
                    //         this.path.setMap(null);
                    //         this.path = null;
                    //         MarkersHidden = false;
                    //     }
                    // });
                    //
                    // marker.addListener('click', function () {
                    //     var clone = this;
                    //     var offers = this.transport;
                    //     MarkerClicked = true;
                    //     for(m in Markers) {
                    //         for (n in Markers[m]) {
                    //             Markers[m][n].setVisible(false);
                    //         }
                    //     }
                        this.setVisible(true);

                    //     if(clone.cities.length == 1 || (!clone.showPath && clone.cities.length > 1)){
                    //         $.ajax({
                    //             url: 'gettransportmap',
                    //             method: 'POST',
                    //             dataType: 'json',
                    //             data: {
                    //                 '_token': '{{ csrf_token() }}',
                    //                 'transport': offers,
                    //             },
                    //             success: (function(result) {
                    //                 if(clone.cities.length > 1){
                    //                     clone.path = setPath(clone.cities[0]);
                    //                 }
                    //
                    //                 clone.path.setMap(map);
                    //                 clone.showPath = true;
                    //
                    //                 MarkersHidden = true;
                    //
                    //                 var div = $('#transport_offers');
                    //                 div.html('');
                    //
                    //                 var count = 1;
                    //                 for(r in result) {
                    //                     var divo = $('#offercopy').html();
                    //                     var d = result[r].date_start;
                    //                     var arr = {
                    //                         selected: count==1 ? ' selected' : '',
                    //                         date: (new Date(d.split(' ')[0])).toLocaleDateString(),
                    //                         offerid: count,
                    //                         user: result[r].user.id,
                    //                         hour: d.split(' ')[1],
                    //                         name: result[r].user.first_name+' '+result[r].user.last_name,
                    //                         gender: result[r].user.gender == 0 ? 'FFBCD8' : '39D5FF',
                    //                         age: (new Date().getFullYear())-(new Date(result[r].user.birthday).getFullYear()),
                    //                         description: result[r].description,
                    //                         regular: {
                    //                             text: result[r].is_regular ? 'Trajet régulier' : 'Trajet occasionnel',
                    //                             icon: result[r].is_regular ? 'restore' : 'schedule',
                    //                         },
                    //                         highway: {
                    //                             color: result[r].highway == 1 ? '333' : 'CCC',
                    //                             message: result[r].highway == 1 ? 'Prend l\'autoroute' : 'Ne prend pas l\'autoroute',
                    //                         },
                    //                     };
                    //                     divo = divo.replace(/[$]([a-z]+)([.]([a-z]+))?/g, function(matches, a, b, c){
                    //                         var res = '';
                    //                         if(c){
                    //                             if(arr[a] && arr[a][c]) res = arr[a][c];
                    //                         }
                    //                         else if(arr[a]) res = arr[a];
                    //
                    //                         return res;
                    //                     });
                    //
                    //                     var Newdiv = $(divo);
                    //
                    //                     Newdiv.on('click', function(){
                    //                         if(!$(this).hasClass('selected')){
                    //                             clone.path.setMap(null);
                    //                             clone.path = setPath(clone.cities[$(this).attr('offer-id')-1]);
                    //                             clone.path.setMap(map);
                    //                         }
                    //                     });
                    //
                    //                     div.append(Newdiv);
                    //                     count++;
                    //                 }
                    //                 // $("#map").animate({"width": "60%"}, 500);
                    //                 div.show(500);
                    //                 $('.tooltipped').tooltip({delay: 50});
                    //             })
                    //         });
                    //     }
                    // });

                    // if (!Markers[marker.title]) Markers[marker.title] = [];
                    // Markers[marker.title].push(marker);
                }

                // map.addListener('click', function () {
                //     for (m in Markers) {
                //         for (n in Markers[m]) {
                //             Markers[m][n].setVisible(true);
                //             Markers[m][n].showPath = false;
                //             if (Markers[m][n].path) {
                //                 Markers[m][n].path.setMap(null);
                //             }
                //         }
                //     }
                //     MarkerClicked = false;
                //     $('#transport_offers').html('').hide(500);
                //     // $("#map").animate({"width": "100%"}, 500);
                //
                // });


                /** Route */
                // function setPath(cities) {
                //     var Directions = new google.maps.DirectionsRenderer({
                //         map: null,
                //         preserveViewport: true,
                //     });
                //     var origin = {lng: cities[0].lng, lat: cities[0].lat};
                //     var destination = {lng: cities[cities.length - 1].lng, lat: cities[cities.length - 1].lat};
                //     var waypoints = [];
                //
                //     if (cities.length > 2) {
                //         for (var i = 1; i < cities.length - 1; i++) {
                //             waypoints.push({
                //                 location: {
                //                     lng: cities[i].lng,
                //                     lat: cities[i].lat,
                //                 }, stopover: true
                //             });
                //         }
                //     }

                    // var request = {
                    //     travelMode: google.maps.DirectionsTravelMode.DRIVING,
                    //     avoidTolls: false,
                    //     origin: origin,
                    //     destination: destination,
                    //     waypoints: waypoints
                    // }
                //     var directionsService = new google.maps.DirectionsService();
                //     directionsService.route(request, function (response, status) {
                //         if (status == google.maps.DirectionsStatus.OK) {
                //             Directions.setDirections(response);
                //         }
                //     });
                //     return Directions;
                // }

            //     var options = {types: ['(cities)']};
            //     new google.maps.places.Autocomplete(document.getElementById('city_start'), options);
            //     new google.maps.places.Autocomplete(document.getElementById('city_end'), options);
            // }
            //
            // $(document).on('click', '#transport_offers .offer', function(){
            //     if(!$(this).hasClass('selected')){
            //         $('#transport_offers .offer.selected').removeClass('selected');
            //         $(this).addClass('selected');
            //     }
            // });

            </script>
            </div>
        </div>
    </div>

@endsection
