@extends('layouts.app')

@section('page_title', 'Alerte')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col l8 m10 s12 offset-l2 offset-m1 offset-s1 ">
                <div class="card-panel">
                    <div class="section center">
                        <div class="section">
                            <h5>
                                Créer une alerte
                                {{
                                    Html::image('public/img/recherche/bell.svg',
                                    'Icon d\'une cloche',
                                    array('class' => 'responsive-img icon', 'style' => 'vertical-align:middle;'))
                                }}
                            </h5>
                        </div>
                    </div>
                    <form method="post" action="{{ route('save_alert') }}" class="section">
                        {{ csrf_field() }}
                        <div class="infoProfile input-field col s12{{ $errors->has('city_start') ? ' has-error' : '' }}">
                            <input id="city_start" class="white" placeholder="Ville départ" type="text" value="{{ $city_start ? $city_start : old('city_start') }}" name="city_start" required>
                            <label for="city_start">Ville de départ <span class="obligatoire">*</span></label>
                            @if($errors->has('city_start'))
                                <span class="col s12 error">
                                    {{
                                        Html::image('public/img/notification/warning.svg',
                                        'Icon d\'un triangle attention',
                                        array('class' => 'responsive-img iconC'))
                                    }}
                                    <strong>
                                        {{ $errors->first('city_start') }}
                                    </strong>
                                </span>
                            @endif
                        </div>

                        <div class="infoProfile input-field col s12{{ $errors->has('city_end') ? ' has-error' : '' }}">
                            <input id="city_end" class="white" placeholder="Ville arrivée" value="{{ $city_end ? $city_end : old('city_end') }}" type="text" name="city_end" required>
                            <label for="city_end">Ville d'arrivée <span class="obligatoire">*</span></label>
                            @if($errors->has('city_end'))
                                <span class="col s12 error">
                                    {{
                                        Html::image('public/img/notification/warning.svg',
                                        'Icon d\'un triangle attention',
                                        array('class' => 'responsive-img iconC'))
                                    }}
                                    <strong>
                                        {{ $errors->first('city_end') }}
                                    </strong>
                                </span>
                            @endif
                        </div>

                        <div class="infoProfile input-field col s12{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date">Date de l'expédition <span class="obligatoire">*</span></label>
                            <input type="date" name="date" class="datepicker white" placeholder="Date" value="{{ old('date') }}" required>
                            @if($errors->has('date'))
                                <span class="col s12 error">
                                    {{
                                        Html::image('public/img/notification/warning.svg',
                                        'Icon d\'un triangle attention',
                                        array('class' => 'responsive-img iconC'))
                                    }}
                                    <strong>
                                        {{ $errors->first('date') }}
                                    </strong>
                                </span>
                            @endif
                        </div>
                        <div class="infoProfile input-field col s12{{ $errors->has('volume') ? ' has-error' : '' }}">
                            <label for="volume">Volume du colis en Litres <span class="obligatoire">*</span></label>
                            <input type="number" name="volume" class=" white" placeholder="Volume de votre colis en Litres" value="{{ old('volume') }}" required>
                            @if($errors->has('volume'))
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

                        <div class="infoProfile input-field col s12{{ $errors->has('libele') ? ' has-error' : '' }}">
                            <label for="libele">Libellé du colis <span class="obligatoire">*</span></label>
                            <input type="text" name="libele" class=" white" placeholder="Objet à envoyer" value="{{ old('libele') }}" required>
                            @if($errors->has('libele'))
                                <span class="col s12 error">
                                    <strong>{{ $errors->first('libele') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="infoProfile col s12">
                            <button type="submit" class="btn btnValider white-text right">
                                M'alerter
                                {{
                                    Html::image('public/img/recherche/bell.svg',
                                    'Icon d\'une cloche',
                                    array('class' => 'responsive-img iconC', 'style' => 'vertical-align:middle;'))
                                }}
                            </button>
                        </div>
                    </form>
                    <div class="section infoProfile ">
                        <span><span class="obligatoire">*</span> Champs obligatoires</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUTW7_sKsarvYpb8HJdG1cWptczyG3Jf0&callback=initMap&libraries=places"></script>
    <script>

    function initMap(){
        var options = {types: ['(cities)']};
        new google.maps.places.Autocomplete(document.getElementById('city_start'), options);
        new google.maps.places.Autocomplete(document.getElementById('city_end'), options);
    }
    </script>
@endsection
