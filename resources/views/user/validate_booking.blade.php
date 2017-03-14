@extends('layouts.app')

@section('title', 'Valider la réservation')

@section('content')
    <div class="container">
        <div class="card-panel">
            <div class="section">
                <h5>Colis à livrer de {{ $booking->city_start_label }} vers {{ $booking->city_end_label }}</h5>
            </div>
            <form method="post" action="{{ route('validate_booking_auth') }}" class="section">
                {{ csrf_field() }}
                <div class="input-field infoProfile col s12 m6{{ $errors->has('price') ? ' has-error' : '' }}">
                    <input placeholder="Prix pour la livraison du colis" name="price" id="price" type="number"
                           value="{{ old('price') }}" class="col s12" min="0">
                    <label for="price">Prix</label>

                    @if ($errors->has('price'))
                        <span class="col s12">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-field infoProfile col s12 m6{{ $errors->has('hour') ? ' has-error' : '' }}">
                    <label for="hour" class="active">Heure de passage à {{ $booking->city_start_label }}</label>
                    <input placeholder="Heure de passage à {{ $booking->city_start_label }}" name="hour" id="hour" type="time"
                           value="{{ old('hour') }}" min="0">


                    @if ($errors->has('hour'))
                        <span class="col s12">
                            <strong>{{ $errors->first('hour') }}</strong>
                        </span>
                    @endif
                </div>

                <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                <div class="input-field col s12 right-align">
                    <button type="submit" class="btn btn-primary">
                        Confirmer le réservation
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection