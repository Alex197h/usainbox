@extends('layouts.app')

@section('page_title', 'Listes des expéditions')

@section('content')

    <div class="row">
        <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 card-panel">
            <form method="post" action="{{ route('save_alert') }}" class="section">
                {{ csrf_field() }}

                <div class="row">

                    <div class="input-field col s12{{ $errors->has('city_start') ? ' has-error' : '' }}">
                        <input id="city_start" class="white" placeholder="Ville départ" type="text" value="{{ $city_start ? $city_start : old('city_start') }}" name="city_start">
                        <label for="city_start">Ville de départ<span class="obligatoire">*</span></label>
                        @if($errors->has('city_start'))
                            <span class="col s12">
                                <strong>{{ $errors->first('city_start') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field col s12{{ $errors->has('city_end') ? ' has-error' : '' }}">
                        <input id="city_end" class="white" placeholder="Ville arrivée" value="{{ $city_end ? $city_end : old('city_end') }}" type="text" name="city_end">
                        <label for="city_end">Ville d'arrivée<span class="obligatoire">*</span></label>
                        @if($errors->has('city_end'))
                            <span class="col s12">
                                <strong>{{ $errors->first('city_end') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field col s12{{ $errors->has('date') ? ' has-error' : '' }}">
                        <label for="date">Date de l'expédition<span class="obligatoire">*</span></label>
                        <input type="date" name="date" class="datepicker white" placeholder="Date" value="{{ old('date') }}">
                        @if($errors->has('date'))
                            <span class="col s12">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col s12">
                        <button type="submit" class="btn btnValider white-text right">
                            M'alerter
                        </button>
                    </div>
                    <div class="input-field col s12">
                        <span><span class="obligatoire">*</span> Champs obligatoires</span>
                    </div>
                </div>

            </form>
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
