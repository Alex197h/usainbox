@extends('layouts.app')

@section('title', 'Ajouter un véhicule')

@section('content')

<div class="row">
    <div class="col l6 m10 s12 offset-l3 offset-m1">
        <div class="row card-panel">
            <a href="{{route('user_profile')}}">
                <button type="button" class="btn btnProfile white-text  ">
                    {{
                        Html::image('public/img/vehicles/back.svg',
                        'Icon d\'une flèche retour',
                        array('class' => 'responsive-img icon', 'style' => 'vertical-align:middle;'))
                    }}
                    Retour au profil
                </button>
            </a>

            <div class="section center">
                <div class="section">
                    <h5>
                        Ajouter un véhicule
                        {{
                            Html::image('public/img/vehicles/rocket.svg',
                            'Icon d\'une fusée',
                            array('class' => 'responsive-img icon', 'style' => 'vertical-align:middle;'))
                        }}
                    </h5>
                </div>
            </div>
            <div class="section">
                <form role="form" method="POST" action="{{ route('post_user_vehicles') }}" novalidate>
                    {{ csrf_field() }}
                    <div class="infoProfile col s12 m6 {{ $errors->has('vehicle_type') ? ' has-error' : '' }}">
                        <label for="vehicle_type">Type de véhicule <span class="obligatoire">*</span></label>
                        <select id="vehicle_type" type="text" class="form-control" name="vehicle_type" required>
                            <option value="" disabled selected>Choisir le type de véhicule</option>
                            @foreach($type_vehicles as $type_vehicle)
                            <option value="{{ $type_vehicle->id }}">{{ $type_vehicle->label }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('vehicle_type'))
                        <span class="col s12 error">
                            {{
                                Html::image('public/img/notification/warning.svg',
                                'Icon d\'un triangle attention',
                                array('class' => 'responsive-img iconC'))
                            }}
                            <strong>
                                {{ $errors->first('vehicle_type') }}
                            </strong>
                        </span>
                        @endif
                    </div>
                    <div class="infoProfile col s12 m6 {{ $errors->has('vehicle_brand') ? ' has-error' : '' }}">
                        <label for="vehicle_brand">Marque <span class="obligatoire">*</span></label>
                        <input list="brands-list" required id="vehicle_brand" type="text" class="form-control" placeholder="Marque du véhicule" name="vehicle_brand" value="{{ old('vehicle_brand') }}">
                        @if ($errors->has('vehicle_brand'))
                        <span class="col s12 error">
                            {{
                                Html::image('public/img/notification/warning.svg',
                                'Icon d\'un triangle attention',
                                array('class' => 'responsive-img iconC'))
                            }}
                            <strong>
                                {{ $errors->first('vehicle_brand') }}
                            </strong>
                        </span>
                        @endif
                    </div>
                    <div class="infoProfile col s12 m6 {{ $errors->has('vehicle_model') ? ' has-error' : '' }}">
                        <label for="vehicle_model" class="col-md-4 control-label">Modèle <span class="obligatoire">*</span></label>
                        <input list="models-list" id="vehicle_model" type="text" class="form-control" placeholder="E-Modèle du véhicule" name="vehicle_model" value="{{ old('vehicle_model') }}" required>
                        @if ($errors->has('vehicle_model'))
                        <span class="col s12 error">
                            {{
                                Html::image('public/img/notification/warning.svg',
                                'Icon d\'un triangle attention',
                                array('class' => 'responsive-img iconC'))
                            }}
                            <strong>
                                {{ $errors->first('vehicle_model') }}
                            </strong>
                        </span>
                        @endif
                    </div>
                    <div class="infoProfile col s12 m6{{ $errors->has('volume') ? ' has-error' : '' }}">
                        <label for="volume" class="col-md-4 control-label">Volume en Litres<span class="obligatoire">*</span></label>
                        <input id="volume" type="number" class="form-control" placeholder="Volume disponible en Litres" name="volume" value="{{ old('volume') }}" required>
                        @if ($errors->has('volume'))
                        <span class="col s12 error">
                            {{
                                Html::image('public/img/notification/warning.svg',
                                'Icon d\'un triangle attention',
                                array('class' => 'responsive-img iconC'))
                            }}
                            <strong>
                                {{ $errors->first('volume') }}
                            </strong>
                        </span>
                        @endif
                    </div>

                    <div class="infoProfile col s12 m6{{ $errors->has('weight') ? ' has-error' : '' }}">
                        <label for="weight" class="col-md-4 control-label">Poids maximum</label>
                        <input id="weight" placeholder="Poids disponible" type="number" class="form-control" name="weight">
                        @if ($errors->has('weight'))
                        <span class="col s12 error">
                            {{
                                Html::image('public/img/notification/warning.svg',
                                'Icon d\'un triangle attention',
                                array('class' => 'responsive-img iconC'))
                            }}
                            <strong>
                                {{ $errors->first('weight') }}
                            </strong>
                        </span>
                        @endif
                    </div>
                    @if (!$vehicles->isEmpty() )
                    <div class="col s12 {{ $errors->has('default_vehicle') ? ' has-error' : '' }}">
                        <input type="checkbox" name="default_vehicle" id="default_vehicle" value="1"/>
                        <label for="default_vehicle">Véhicule utilisé par défaut</label>
                        @if ($errors->has('default_vehicle'))
                        <span class="col s12 error">
                            {{
                                Html::image('public/img/notification/warning.svg',
                                'Icon d\'un triangle attention',
                                array('class' => 'responsive-img iconC'))
                            }}
                            <strong>
                                {{ $errors->first('default_vehicle') }}
                            </strong>
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
                    
                    <datalist id="brands-list"></datalist>
                    <datalist id="models-list"></datalist>
                </form>
                <div class="test col s12"></div>
            </div>
            <script>
                $('#width, #height, #length').on('input', function (id) {
                    var width = $('#width').val();
                    var height = $('#height').val();
                    var length = $('#length').val();

                    if (
                        width == '' || height == '' || length == '' ||
                        width == 0 || height == 0 || length == 0)
                        $('#volume').val('');
                    else $('#volume').val(width * height * length);
                });
                
                $('#vehicle_type').on('change', function(){
                    var id = this.value;
                    
                    $.ajax({
                        url: '{{ route('get_vehicles_brands') }}',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(result){
                            if(result.brands){
                                $('#brands-list').html('');
                                for(i in result.brands)
                                    $('#brands-list').append('<option value="'+result.brands[i]+'">');
                            }
                            if(result.models){
                                $('#models-list').html('');
                                for(i in result.models)
                                    $('#models-list').append('<option value="'+result.models[i]+'">');
                            }
                        }
                    });
                });
                </script>
            </div>
        </div>
    </div>

    @endsection
