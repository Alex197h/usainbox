@extends('layouts.app')

@section('title', 'Valider la réservation')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s8 card offset-s2">
                <div class="section center">
                    <h5>
                        {{
                            Html::image('public/img/legende/E.svg',
                            'Icon d\'une annonce',
                            array('class' => 'responsive-img icon','style' => 'vertical-align: middle;'))
                        }}
                        Colis à livrer de <strong>{{ $booking->city_start_label }}</strong> vers <strong>{{ $booking->city_end_label }}</strong>
                    </h5>
                </div>

                <form method="post" action="{{ route('validate_booking_auth') }}" class="section">
                    {{ csrf_field() }}
                    <div class="input-field infoProfile col s12 {{ $errors->has('price') ? ' has-error' : '' }}">
                        <input placeholder="Prix pour la livraison du colis" name="price" id="price" type="number"
                        value="{{ old('price') }}" class="col s12" min="0">
                        <label for="price">Prix</label>

                        @if ($errors->has('price'))
                            <span class="col s12">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field infoProfile col s12 {{ $errors->has('hour') ? ' has-error' : '' }}">
                        <label for="hour" class="active">Heure de passage à <strong>{{ $booking->city_start_label }}</strong></label>
                        <input placeholder="Heure de passage à {{ $booking->city_start_label }}" name="hour" id="hour" type="time"
                        value="{{ old('hour') }}" min="0">
                        @if ($errors->has('hour'))
                            <span class="col s12">
                                <strong>{{ $errors->first('hour') }}</strong>
                            </span>
                        @endif
                    </div>

                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                    <div class="right-align">
                        <button type="submit" class="btn btnValider">
                            Confirmer la réservation
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
