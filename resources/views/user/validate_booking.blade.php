@extends('layouts.app')

@section('title', 'Valider la réservation')

@section('content')
    <div class="container">
        <div class="card-panel">
            <h5>Colis à livrer de {{ $booking->city_start_label }} vers {{ $booking->city_end_label }}</h5>
            <form method="post" action="">
                {{ csrf_field() }}
                <div class="input-field infoProfile col s12 m6{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <input placeholder="Prix pour la livraison du colis" name="price" id="price" type="number"
                           value="{{$user->phone}}">€
                    <label for="phone">Prix</label>

                    @if ($errors->has('phone'))
                        <span class="col s12">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                    @endif
                </div>

            </form>
        </div>
    </div>

@endsection