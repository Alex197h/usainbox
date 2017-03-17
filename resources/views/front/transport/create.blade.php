@extends('layouts.app')

@section('title', 'Ajouter une offre')

@section('content')
    <div class="row">
        <div class="col s12 center">
            <h4>Publier une annonce</h4>
        </div>
        <div class="col s12 l4 offset-l1">
            <div id="resss"></div>
            <div class="row" id="map"></div>
        </div>
        <div class="card col s12 l6">
            <form method="post" class="row card-content" action="{{route('post_create_transport_offer')}}">
                {{ csrf_field() }}
                <div id="offercopy">
                    <div class="offer horizontal$selected" offer-id="$offerid">
                        <div class="card-stacked col s12">
                            <div class="section detail-steps " id="stepsArea">
                                <div class="infoDepAnnonce" {{ $errors->has('start_city') ? ' has-error' : '' }}>
                                    <label class="col s12" for="start_city">Ville de départ <span class="obligatoire">*</span></label>
                                    <input id="start_city" type="text" class="col s12 form-control step"
                                    name="start_city" value="{{ old('start_city') }}" draggable="true">
                                    @if ($errors->has('start_city'))
                                        <span>
                                            <strong>{{ $errors->first('start_city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div>
                                    <p>Villes étapes</p>
                                    <button type="button" class="btn btnAdd white-text" id="addstep"
                                    onclick="addStep()">
                                    {{
                                        Html::image('public/img/annonce/add.svg',
                                        'Icon d\'un plus',
                                        array('class' => 'responsive-img iconC','style' => 'vertical-align: middle;'))
                                    }}
                                </button>
                                <br><br>
                            </div>
                            <div class="col s12 infoDepAnnonce"
                            id="endstep" {{ $errors->has('end_city') ? ' has-error' : '' }} >
                            <label class="col s12" for="end_city">Ville d'arrivée <span class="obligatoire">*</span></label>
                            <input id="end_city" type="text" class="col s12 form-control step" name="end_city"
                            value="{{ old('end_city') }}" draggable="true">

                            @if ($errors->has('end_city'))
                                <span>
                                    <strong>{{ $errors->first('end_city') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="infoProfile infoDepAnnonce col s12" {{ $errors->has('vehicle') ? ' has-error' : '' }}>
            <label for="vehicle">Véhicule utilisé <span class="obligatoire">*</span></label>
            <select id="vehicle" type="text" class="col s12 form-control" name="vehicle" required>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}"{{ $vehicle->default ? ' selected':'' }}>{{ $vehicle->car_brand }} {{ $vehicle->car_model }}</option>
                @endforeach
            </select>
            @if ($errors->has('vehicle'))
                <span>
                    <strong>{{ $errors->first('vehicle') }}</strong>
                </span>
            @endif
        </div>

        <div class="col s12 m4 infoProfile"{{ $errors->has('date_start') ? ' has-error' : '' }}>
            <label for="date_start">Date de départ <span class="obligatoire">*</span></label>

            <input id="date_start" type="date" class="datepicker form-control" placeholder="jj/mm/aaaa"
            name="date_start" value="{{ old('date_start') }}">

            @if ($errors->has('date_start'))
                <span>
                    <strong>{{ $errors->first('date_start') }}</strong>
                </span>
            @endif
        </div>


        <div class="col s12 m4 infoProfile "{{ $errors->has('max_volume') ? ' has-error' : '' }}>
            <label for="max_volume">Volume des colis en Litres<span
                class="obligatoire">*</span></label>

                <input id="max_volume" type="number" class="form-control" placeholder="Volume en Litres"
                name="max_volume" value="{{ old('max_volume') }}">

                @if ($errors->has('max_volume'))
                    <span>
                        <strong>{{ $errors->first('max_volume') }}</strong>
                    </span>
                @endif
            </div>


            <div class="col s12 m4 infoProfile"{{ $errors->has('hour_start') ? ' has-error' : '' }}>
                <label for="hour_start">Heure de départ <span
                    class="obligatoire">*</span></label>

                    <input id="hour_start" type="time" class="form-control" placeholder="hh:mm"
                    name="hour_start" value="{{ old('hour_start') }}">

                    @if ($errors->has('hour_start'))
                        <span>
                            <strong>{{ $errors->first('hour_start') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="col s12 m6 infoProfile"{{ $errors->has('max_weight') ? ' has-error' : '' }}>
                    <label for="max_weight">Poids maximum des colis en g</label>

                    <input id="max_weight" type="number" class="form-control" placeholder="Poids max en g"
                    name="max_weight" value="{{ old('max_weight') }}">

                    @if ($errors->has('max_weight'))
                        <span>
                            <strong>{{ $errors->first('max_weight') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 m6 infoProfile" {{ $errors->has('is_regular') ? ' has-error' : '' }}>
                    <input type="checkbox" name="is_regular" id="is_regular" value="1"/>
                    <label for="is_regular"> Trajet régulier </label>

                    @if ($errors->has('is_regular'))
                        <span>
                            <strong>{{ $errors->first('is_regular') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 m6 infoProfile " {{ $errors->has('highway') ? ' has-error' : '' }}>
                    <input type="checkbox" name="highway" id="highway" value="1"/>
                    <label for="highway">Passer par l'autoroute </label>

                    @if ($errors->has('highway'))
                        <span>
                            <strong>{{ $errors->first('highway') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 m6 infoProfile "{{ $errors->has('start_detour') ? ' has-error' : '' }}>
                    <input type="checkbox" name="start_detour" id="start_detour" value="1"/>
                    <label for="start_detour">Détour possible</label>

                    @if ($errors->has('start_detour'))
                        <span>
                            <strong>{{ $errors->first('start_detour') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col s12 m12 infoProfile" {{ $errors->has('description') ? ' has-error' : '' }}>
                    <label for="description">Description</label>
                    <textarea id="description" placeholder="Description" class="materialize-textarea"
                    name="description">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span>
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col s12 ">
                    <button type="submit" class="btn btnValider white-text right">
                        Poster l'annonce
                    </button>
                </div>
                <div class="col s12">
                    <p><span class="obligatoire">*</span> champ obligatoire</p>
                </div>
            </form>


            <script>
            <?php
            $res = [];
            foreach ($vehicles as $vehicle) $res[$vehicle->id] = $vehicle->toArray();
            ?>
            var Vehicles = <?= json_encode($res) ?>;

            $('#vehicle').on('change', function () {
                var vehicle = Vehicles[this.value];
                $('#max_volume').val(vehicle.max_volume != 0 ? vehicle.max_volume : '');
                $('#max_volume').attr('max', vehicle.max_volume);
            });
            $(document).ready(function () {
                $('#vehicle').change();
            });



            var nbSteps = 1;
            function addStep() {
                if (nbSteps < 6) {
                    var div = $('<div class="col s12 infoProfile etape" id="etape' + nbSteps + '">');
                    var label = $('<label class="col s12" for="step' + nbSteps + '">' + 'Etape n°' + nbSteps + '</label>');
                    div.append(label);
                    var input = $('<input id="step' + nbSteps + '" class="form-control col s8 step inpetape" name="steps[]" draggable="true">');
                    div.append(input);
                    var del = $('<button type="button" class="btn btnAdd btnRm white-text right" data-btn="' + nbSteps + '">X</button>');
                    div.append(del);
                    $('#endstep').before(div);
                    var options = {types: ['(cities)']};
                    addAutocomplete(document.getElementById('step' + nbSteps));
                    nbSteps += 1;
                }
            }

            $(document).on('click', '.btnRm', function () {
                var step = $(this).attr('data-btn') - 1;
                var divs = $('.etape');
                var buttons = $('.etape input');
                for (var i = step; i < buttons.length - 1; i++) {
                    buttons[i].value = buttons[i + 1].value
                }
                $('#' + divs[divs.length - 1].id).remove();
                nbSteps -= 1;
                updateMap();
            });
            </script>
            <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUTW7_sKsarvYpb8HJdG1cWptczyG3Jf0&callback=initMap&libraries=places"></script>
            <script type="text/javascript">
            var MapElement = document.getElementById('map');
            //var ShowElement = document.getElementById('show');
            var map;

            var options = {types: ['(cities)']};
            function addAutocomplete(e) {
                var a1 = new google.maps.places.Autocomplete(e, options);

                a1.input = e;
                a1.addListener('place_changed', saveLocation);
                a1.addListener('place_changed', updateMap);
                return a1;
            }

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

                addAutocomplete(document.getElementById('start_city'));
                addAutocomplete(document.getElementById('end_city'));
            }

            var markers = [];
            var paths = [];
            var locations = {};
            function clearAll() {
                for (var i in markers) {
                    if (markers[i]) {
                        markers[i].setMap(null);
                    }
                }
                markers = [];
                for (var i in paths) {
                    if (paths[i]) {
                        paths[i].setMap(null);
                    }
                }
                paths = [];
            }
            function addMarker(name) {
                var marker = new google.maps.Marker({
                    position: locations[name],
                    map: map,
                });

                markers.push(marker);
                return marker;
            }
            function saveLocation() {
                var place = this.getPlace();
                var name = this.input.value;

                // if(/[0-9]{5,6} /.test(name)){
                // name = name.replace(/[0-9]{5,6} /, '');
                // }
                locations[name] = place.geometry.location;
            }

            function updateMap() {
                var Cities = {
                    start: null,
                    end: null,
                    steps: [],
                }
                var cities = [];

                clearAll();

                $('.step').each(function () {
                    if (this.value) cities.push(this.value)
                });

                if (cities.length > 0) {
                    Cities.start = cities[0];
                    var ms = addMarker(Cities.start);
                    if (cities.length > 1) {
                        Cities.end = cities[cities.length - 1];
                        // addMarker(Cities.end);
                    }
                    if (cities.length > 2) {
                        for (var i = 1; i <= cities.length - 2; i++) {
                            Cities.steps.push(cities[i]);
                            // addMarker(cities[i]);
                        }
                    }

                    if (!Cities.end) {

                    } else {
                        ms.setMap(null);
                        var Directions = new google.maps.DirectionsRenderer({
                            map: map,
                            preserveViewport: true,
                        });
                        var origin = {
                            lng: locations[Cities.start].lng(),
                            lat: locations[Cities.start].lat(),
                        };
                        var destination = {
                            lng: locations[Cities.end].lng(),
                            lat: locations[Cities.end].lat(),
                        }
                        console.log(origin)
                        var waypoints = [];

                        if (Cities.steps.length > 0) {
                            for (var i in Cities.steps) {
                                var city = locations[Cities.steps[i]];
                                waypoints.push({
                                    location: {
                                        lng: city.lng(),
                                        lat: city.lat(),
                                    }, stopover: true
                                });
                            }
                        }
                        // console.log(waypoints)
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
                                paths.push(Directions);
                            }
                        });
                    }
                }
            }

            var dropedElementSortingOrder;
            var draggedElementSortingOrder;
            var cols;

            $(document)
            .on('dragstart', '.step', handleDragStart)
            .on('dragstart', '.step', updateMap)
            .on('dragenter', '.step', handleDragEnter)
            .on('dragover', '.step', handleDragOver)
            .on('dragleave', '.step', handleDragLeave)
            .on('drop', '.step', handleDrop)
            .on('dragend', '.step', handleDragEnd)
            .on('dragend', '.step', updateMap)

            function handleDragStart() {
                this.style.opacity = '0.5';
                dragSrcEl = this;
                event.dataTransfer.effectAllowed = 'move';
                dropedElementSortingOrder = $(this);
                event.dataTransfer.setData('text/html', this.innerHTML);
            }

            function handleDragOver() {
                if (event.preventDefault) {
                    event.preventDefault();
                }
                return false;
            }

            function handleDragEnter() {
                $(this).addClass('over');
            }

            function handleDragLeave() {
                $(this).removeClass('over');
            }

            function handleDrop() {
                if (event.stopPropagation) {
                    event.stopPropagation();
                }
                if (dragSrcEl != this) {
                    draggedElementSortingOrder = $(this);
                    var a = dropedElementSortingOrder.val();
                    var b = draggedElementSortingOrder.val();
                    dropedElementSortingOrder.val(b);
                    draggedElementSortingOrder.val(a);
                    var c = dropedElementSortingOrder.val();
                    var d = draggedElementSortingOrder.val();
                    dragSrcEl.innerHTML = this.innerHTML;
                    this.innerHTML = event.dataTransfer.getData('text/html');
                }
                return false;
            }

            function handleDragEnd() {
                $('.step').removeClass('over');
                this.style.opacity = '1.0';
            }

            </script>
        </div>
    </div>
</div>



@endsection
