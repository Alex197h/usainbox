@extends('layouts.app')

@section('title', 'Ajouter une offre')

@section('content')
    <div class="row">
        <div class="col s12 section center">
            <h5>Proposez d'envoyer un colis</h5>
        </div>

        <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 card-panel">
            <div class="section">

                <div class="col s12{{ $errors->has('vehicle') ? ' has-error' : '' }}">
                    <label for="vehicle">Véhicule utilisé</label>
                    <select id="vehicle" type="text" class="form-control" name="vehicle" required>
                        <option value="" disabled selected>Choisir votre véhicule</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->car_brand }} {{ $vehicle->car_model }}</option>
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

                    <input id="max_width" type="datetime" class="form-control" placeholder="Largeur max en cm"
                           name="max_width" value="{{ old('max_width') }}">

                    @if ($errors->has('max_width'))
                        <span class="col s12">
                            <strong>{{ $errors->first('max_width') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 m4{{ $errors->has('max_length') ? ' has-error' : '' }}">
                    <label for="max_length">Longueur maximum du colis acceptée</label>

                    <input id="max_length" type="datetime" class="form-control" placeholder="Longueur max en cm"
                           name="max_length" value="{{ old('max_length') }}">

                    @if ($errors->has('max_length'))
                        <span class="col s12">
                            <strong>{{ $errors->first('max_length') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 m4{{ $errors->has('max_height') ? ' has-error' : '' }}">
                    <label for="max_height">Hauteur maximum du colis acceptée</label>

                    <input id="max_height" type="datetime" class="form-control" placeholder="Hauteur max en cm"
                           name="max_height" value="{{ old('max_height') }}">

                    @if ($errors->has('max_height'))
                        <span class="col s12">
                            <strong>{{ $errors->first('max_height') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 m4{{ $errors->has('max_volume') ? ' has-error' : '' }}">
                    <label for="max_volume">Volume du colis accepté</label>

                    <input id="max_volume" type="datetime" class="form-control" placeholder="Volume max en cm3"
                           name="max_volume" value="{{ old('max_volume') }}">

                    @if ($errors->has('max_volume'))
                        <span class="col s12">
                            <strong>{{ $errors->first('max_volume') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 m4{{ $errors->has('max_weight') ? ' has-error' : '' }}">
                    <label for="max_weight">Poids du colis accepté</label>

                    <input id="max_weight" type="datetime" class="form-control" placeholder="Poids max en g"
                           name="max_weight" value="{{ old('max_weight') }}">

                    @if ($errors->has('max_weight'))
                        <span class="col s12">
                            <strong>{{ $errors->first('max_weight') }}</strong>
                        </span>
                    @endif
                </div>

                <p class="col s12{{ $errors->has('is_regular') ? ' has-error' : '' }}">
                    <input type="checkbox" name="is_regular" id="is_regular" value="1"/>
                    <label for="is_regular"> Trajet régulier</label>

                    @if ($errors->has('is_regular'))
                        <span class="col s12">
                            <strong>{{ $errors->first('is_regular') }}</strong>
                        </span>
                    @endif
                </p>

                <p class="col s12{{ $errors->has('highway') ? ' has-error' : '' }}">
                    <input type="checkbox" name="highway" id="highway" value="1"/>
                    <label for="highway"> Passer par l'autoroute</label>

                    @if ($errors->has('highway'))
                        <span class="col s12">
                            <strong>{{ $errors->first('highway') }}</strong>
                        </span>
                    @endif
                </p>

                <p class="col s12{{ $errors->has('start_detour') ? ' has-error' : '' }}">
                    <input type="checkbox" name="start_detour" id="start_detour" value="1"/>
                    <label for="start_detour"> Détour possible à l'aller</label>

                    @if ($errors->has('start_detour'))
                        <span class="col s12">
                            <strong>{{ $errors->first('start_detour') }}</strong>
                        </span>
                    @endif
                </p>

                <p class="col s12{{ $errors->has('end_detour') ? ' has-error' : '' }}">
                    <input type="checkbox" name="end_detour" id="end_detour" value="1"/>
                    <label for="end_detour"> Détour possible au retour</label>

                    @if ($errors->has('end_detour'))
                        <span class="col s12">
                            <strong>{{ $errors->first('end_detour') }}</strong>
                        </span>
                    @endif
                </p>

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
                <div class="right-align">
                    <button type="submit" class="btn waves-effect waves-light white black-text">
                        Poster l'annonce
                    </button>
                </div>


            </div>
        </div>
    </div>

@endsection