@extends('layouts.app')

@section('title', 'Modifier votre véhicule')

@section('content')

<div class="row">
    <div class="col l6 m10 s12 offset-l3 offset-m1">
        <div class="row card-panel">
            <a href="{{route('user_profile')}}">
                <button type="button" class="btn btnProfile white-text  ">
                    Retour
                </button>
            </a>
            <div class="section center">
                    <h5>
                        Modifier votre véhicule
                        {{
                            Html::image('public/img/vehicles/rocket.svg',
                            'Icon d\'une fusée',
                            array('class' => 'responsive-img icon', 'style' => 'vertical-align:middle;'))
                        }}
                    </h5>
            </div>
            <div class="section">
                <form role="form" method="POST" action="{{ route('modify_vehicle', $vehicle->id) }}">
                    {{ csrf_field() }}
                    <div class="infoProfile col s12 m6{{ $errors->has('vehicle_type') ? ' has-error' : '' }}">
                        <label for="vehicle_type">Type de véhicule <span class="obligatoire">*</span></label>
                        <select id="vehicle_type" type="text" class="form-control" name="vehicle_type" required>
                            @foreach($vehicle_types as $vehicle_type)
                            <option value="{{ $vehicle_type->id }}" <?php echo ($vehicle_type->id == $vehicle->type_vehicle_id) ? 'selected' : ''  ?>>{{ $vehicle_type->label }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('vehicle_type'))
                        <span class="col s12">
                            <strong>{{ $errors->first('vehicle_type') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="infoProfile col s12 m6{{ $errors->has('vehicle_brand') ? ' has-error' : '' }}">
                        <label for="vehicle_brand">Marque <span class="obligatoire">*</span></label>
                        <input id="vehicle_brand" type="text" class="form-control" placeholder="Marque du véhicule"
                        name="vehicle_brand" value="{{ $vehicle->car_brand }}" required>
                        @if ($errors->has('vehicle_brand'))
                        <span class="col s12">
                            <strong>{{ $errors->first('vehicle_brand') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="infoProfile col s12 m6{{ $errors->has('vehicle_model') ? ' has-error' : '' }}">
                        <label for="vehicle_model" class="col-md-4 control-label">Modèle <span
                            class="obligatoire">*</span></label>
                            <input id="vehicle_model" type="text" class="form-control"
                            placeholder="E-Modèle du véhicule" name="vehicle_model"
                            value="{{ $vehicle->car_model }}" required>
                            @if ($errors->has('vehicle_model'))
                            <span class="col s12">
                                <strong>{{ $errors->first('vehicle_model') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="infoProfile col s12 m6{{ $errors->has('volume') ? ' has-error' : '' }}">
                            <label for="volume" class="col-md-4 control-label">Volume en Litres<span
                                class="obligatoire">*</span></label>
                                <input id="volume" type="number" class="form-control" placeholder="Volume disponible en Litres"
                                name="volume" value="{{ $vehicle->max_volume }}" required>
                                @if ($errors->has('volume'))
                                <span class="col s12">
                                    <strong>{{ $errors->first('volume') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="infoProfile col s12 m6{{ $errors->has('weight') ? ' has-error' : '' }}">
                                <label for="weight" class="col-md-4 control-label">Poids en g</label>
                                <input id="weight" placeholder="Poids disponible en g" type="number" class="form-control"
                                name="weight" value="{{ $vehicle->max_weight }}">
                                @if ($errors->has('weight'))
                                <span class="col s12">
                                    <strong>{{ $errors->first('weight') }}</strong>
                                </span>
                                @endif
                            </div>

                            @if (!$vehicle->default)
                            <div class="infoProfile col s12{{ $errors->has('default_vehicle') ? ' has-error' : '' }}">
                                <input type="checkbox" name="default_vehicle" id="default_vehicle" value="1">
                                <label for="default_vehicle">Véhicule utilisé par défaut</label>
                                @if ($errors->has('default_vehicle'))
                                <span class="col s12">
                                    <strong>{{ $errors->first('default_vehicle') }}</strong>
                                </span>
                                @endif
                            </div>
                            @endif

                            <div class="col s12">
                                <button type="submit" class="btn btnValider white-text right">
                                    Enregistrer
                                </button>
                            </div>

                            <div class="input-field col s12">
                                <span><span class="obligatoire">*</span> Champs obligatoires</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endsection
