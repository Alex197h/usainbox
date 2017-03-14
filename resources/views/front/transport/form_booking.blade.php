@extends('layouts.app')

@section('title', 'Réserver')

@section('content')

    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="row card-panel">
                <div class="center">
                    <h4>Réservez une place pour votre colis
                        le {!! ucfirst(utf8_encode(strftime('%A %d %B', strtotime($transport_offer->date_start)))) !!}</h4>
                    @if(isset($city_steps))
                        @foreach($city_steps as $step)

                            <span>{{ $step }}  @if(!$loop->last) → @endif </span>

                        @endforeach
                    @endif
                </div>

                <div class="section">
                    <form class="container" method="post" action="{{ route('booking_validate') }}">
                        {{ csrf_field() }}
                        <div class="input-field col s12">
                            <select id="step_start" name="step_start">
                                <option value="" disabled selected>Choisissez votre ville de départ</option>
                                @foreach($city_steps as $key => $city_step)
                                    @if(!$loop->last)
                                        <option value="{{ $key }}">{{ $city_step }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="step_start">Ville de départ*</label>
                        </div>
                        <div class="input-field col s12">
                            <select id="step_end" name="step_end">
                                <option value="" disabled selected>Choisissez votre ville de livraison</option>
                                @foreach($city_steps as $key => $city_step)
                                    @if(!$loop->first)
                                        <option value="{{ $key }}">{{ $city_step }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="step_end">Ville d'arrivée*</label>
                        </div>
                        <div class="input-field col s12">
                            <input name="parcel_volume" type="number" id="parcel_volume" placeholder="Volume du colis en cm3" required>
                            <label for="parcel_volume">Volume du colis*</label>
                        </div>
                        <input type="hidden" value="{{ $transporter_id }}" name="transporter_id">
                        <input type="hidden" value="{{ $transport_offer->id }}" name="transport_offer_id">
                        <div class="input-field col s12">
                            <button type="submit" class="btn btnValider white-text right">
                                Réserver
                            </button>
                        </div>
                        <div class="input-field col s12 right-align">
                            <span>En cliquant sur Réserver, vous acceptez de divulguer votre numéro de téléphone au conducteur.</span>
                            <span>Après avoir réserver une place, attendez l'appel du conducteur pour fixer le prix et le lieux de rendez-vous.</span>
                        </div>
                        <div class="input-field col s12">
                            <span>* Champ obligatoire.</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection