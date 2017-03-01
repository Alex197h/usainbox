@extends('layouts.app')

@section('title', 'Liste des Offres')

@section('content')
    <div class="row">
        <div class="col s12 section center">
            <h4>Ajouter un véhicule</h4>
        </div>

        <div class="col l6 m10 s12 offset-l3 offset-m1 card-panel">
            <div class="section">
                <form role="form" method="POST" action="{{ route('post_user_vehicles') }}">
                    {{ csrf_field() }}

                    <div class="col s12 m6{{ $errors->has('vehicle_type') ? ' has-error' : '' }}">
                        <label for="vehicle_type" >Type de véhicule</label>
                        <select id="vehicle_type" type="text" class="form-control" name="vehicle_type" required>
                            <option value="" disabled selected>Type de véhicule</option>
                            @foreach($type_vehicles as $type_vehicle)
                                <option value="{{ $type_vehicle->id }}">{{ $type_vehicle->label }}</option>
                            @endforeach
                        </select>


                        @if ($errors->has('vehicle_type'))
                            <span class="col s12">
                            <strong>{{ $errors->first('vehicle_type') }}</strong>
                        </span>
                        @endif

                    </div>

                    <div class="col s12 m6{{ $errors->has('vehicle_brand') ? ' has-error' : '' }}">
                        <label for="vehicle_brand">Marque</label>

                        <input id="vehicle_brand" type="text" class="form-control" placeholder="Marque du véhicule" name="vehicle_brand" value="{{ old('vehicle_brand') }}">

                        @if ($errors->has('vehicle_brand'))
                            <span class="col s12">
                            <strong>{{ $errors->first('vehicle_brand') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col s12 m6{{ $errors->has('vehicle_model') ? ' has-error' : '' }}">
                        <label for="vehicle_model" class="col-md-4 control-label">Modèle</label>

                        <input id="vehicle_model" type="text" class="form-control" placeholder="E-Modèle du véhicule" name="vehicle_model" value="{{ old('vehicle_model') }}">

                        @if ($errors->has('vehicle_model'))
                            <span class="col s12">
                            <strong>{{ $errors->first('vehicle_model') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col s12 m6{{ $errors->has('volume') ? ' has-error' : '' }}">
                        <label for="volume" class="col-md-4 control-label">Volume</label>

                        <input id="volume" type="number" class="form-control" placeholder="Volume disponible" name="volume" value="{{ old('volume') }}" required>

                        @if ($errors->has('volume'))
                            <span class="col s12">
                            <strong>{{ $errors->first('volume') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col s12{{ $errors->has('length') ? ' has-error' : '' }}">
                        <label for="length" class="col-md-4 control-label">Longueur</label>

                        <input id="length" placeholder="Longueur disponible" type="number" class="form-control" name="length">

                        @if ($errors->has('length'))
                            <span class="col s12">
                                    <strong>{{ $errors->first('length') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="col s12{{ $errors->has('width') ? ' has-error' : '' }}">
                        <label for="width" class="col-md-4 control-label">Largeur</label>

                        <input id="width" placeholder="Largeur disponible" type="number" class="form-control" name="width">

                        @if ($errors->has('width'))
                            <span class="col s12">
                                    <strong>{{ $errors->first('width') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="col s12{{ $errors->has('weight') ? ' has-error' : '' }}">
                        <label for="weight" class="col-md-4 control-label">Poids maximum</label>

                        <input id="weight" placeholder="Poids disponible" type="number" class="form-control" name="weight">

                        @if ($errors->has('weight'))
                            <span class="col s12">
                                    <strong>{{ $errors->first('weight') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="col s12{{ $errors->has('height') ? ' has-error' : '' }}">
                        <label for="height" class="col-md-4 control-label">Hauteur</label>

                        <input id="height" placeholder="Hauteur disponible" type="number" class="form-control" name="height">

                        @if ($errors->has('height'))
                            <span class="col s12">
                                <strong>{{ $errors->first('height') }}</strong>
                            </span>
                        @endif
                    </div>

                    <p class="col s12{{ $errors->has('default_vehicle') ? ' has-error' : '' }}">
                        <input type="checkbox" name="default_vehicle" id="default_vehicle" value="1"/>
                        <label for="default_vehicle"> Véhicule utilisé par défaut</label>

                        @if ($errors->has('default_vehicle'))
                            <span class="col s12">
                                <strong>{{ $errors->first('default_vehicle') }}</strong>
                            </span>
                        @endif
                    </p>

                    <div class="right-align">
                        <button type="submit" class=" btn waves-effect waves-light white black-text">
                            Enregistrer le véhicule
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
