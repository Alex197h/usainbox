@extends('layouts.app')

@section('title', 'Ajouter une offre')

@section('content')
    <div class="row">
        <div class="col s12 section center">
            <h5>Proposez vos services en tant que Transporteur</h5>
        </div>

        <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 card-panel">
            <div class="section">

                <div class="col s12">
                    <div id="resss"></div>
                    <div class="col s12 right" id="map"></div>
                    <div id="transport_offers"></div>
                </div>

                <div id="offercopy">
                    <div class="offer card horizontal$selected" offer-id="$offerid">
                        <div class="card-image valign-wrapper">
                            <img class="circle valign" src="http://lorempixel.com/100/190/nature/6">
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <div class="section center">
                                    <h4>Ajouter vos villes étapes</h4>
                                </div>
                                <div class="section detail-steps"  id="stepsArea">
                                    <div col s12 m6{{ $errors->has('start_city') ? ' has-error' : '' }}>
                                        <label for="start_city">Ville de départ</label>
                                        <input id="start_city" type="text" class="form-control step"
                                               name="start_city" value="{{ old('start_city') }}" draggable="true">

                                        @if ($errors->has('start_city'))
                                            <span class="col s12">
                                                <strong>{{ $errors->first('start_city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <button id="addstep" onclick="addStep()">+</button>
                                    <div col s12 m6{{ $errors->has('end_city') ? ' has-error' : '' }} id='endstep'>
                                        <label for="end_city">Ville d'arrivé</label>
                                        <input id="end_city" type="text" class="form-control step"
                                               name="end_city" value="{{ old('end_city') }}" draggable="true">

                                        @if ($errors->has('end_city'))
                                            <span class="col s12">
                                                <strong>{{ $errors->first('end_city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <div class="col s3 {{ $errors->has('is_regular') ? ' has-error' : '' }}">
                        <input  type="checkbox" name="is_regular" id="is_regular" value="1"/>
                        <label for="is_regular"> Trajet régulier </label>

                        @if ($errors->has('is_regular'))
                            <span class="col s12">
                                <strong>{{ $errors->first('is_regular') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col s3 {{ $errors->has('highway') ? ' has-error' : '' }}">
                        <input type="checkbox" name="highway" id="highway" value="1"/>
                        <label for="highway">Passer par l'autoroute </label>

                        @if ($errors->has('highway'))
                            <span class="col s12">
                                <strong>{{ $errors->first('highway') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col s3 {{ $errors->has('start_detour') ? ' has-error' : '' }}">
                        <input type="checkbox" name="start_detour" id="start_detour" value="1"/>
                        <label for="start_detour">Détour possible</label>

                        @if ($errors->has('start_detour'))
                            <span class="col s12">
                                <strong>{{ $errors->first('start_detour') }}</strong>
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

                var nbSteps = 1;
                function addStep(){
                    if (nbSteps < 6){
                        var div = $('<div class="col s12">');
                        var label = $('<label class="col s12" for="step'+nbSteps+'">'+'Etape n°'+nbSteps+'</label>');
                        div.append(label);
                        var input = $('<input id="step'+nbSteps+'" class="form-control col s11 step" name="step'+nbSteps+'" draggable="true">');
                        div.append(input);
                        var del = $('<button id="'+nbSteps+'" onclick="removeStep()">X</button>');
                        div.append(del);
                        $('#endstep').before(div);
                        nbSteps +=1;
                    }
                }

                function removeStep(){
                    console.log(this.id);
                }
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
                        this.setVisible(true);
                }

                var dropedElementSortingOrder;
                var draggedElementSortingOrder;
                var cols;

                $(document)
                    .on('dragstart', '.step', handleDragStart)
                    .on('dragenter', '.step', handleDragEnter)
                    .on('dragover', '.step', handleDragOver)
                    .on('dragleave', '.step', handleDragLeave)
                    .on('drop', '.step', handleDrop)
                    .on('dragend', '.step', handleDragEnd)
                 /*$(function () {
                     cols = document.querySelectorAll('.step');
                     [].forEach.call(cols, function (col) {
                         col.addEventListener('dragstart', handleDragStart, true);
                         col.addEventListener('dragenter', handleDragEnter, true);
                         col.addEventListener('dragover', handleDragOver, true);
                         col.addEventListener('dragleave', handleDragLeave, true);
                         col.addEventListener('drop', handleDrop, true);
                         col.addEventListener('dragend', handleDragEnd, true);
                     });
                 });*/

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
