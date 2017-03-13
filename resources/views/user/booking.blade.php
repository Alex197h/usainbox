@extends('layouts.app')

@section('title', 'Mes réservations')

@section('content')
    <div class="container">
        <table>
            <thead>
            <tr>
                <th>Date</th>
                <th>Offre de transport</th>
                <th>Demandeur</th>
                <th>Etape de départ</th>
                <th>Etape d'arrivée</th>
                <th>Prix</th>
                <th>Heure de passage</th>
                <th>Valider</th>
            </tr>
            </thead>

            <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <th>{{ $reservation->passage_date }}</th>
                    <th><a href="{{ route('detail_transport_offer', $reservation->transport_offer_id) }}">Voir l'offre</a></th>
                    <th><a href="{{ route('profile', $users[$reservation->shipper_id]->id) }}">{{ $users[$reservation->shipper_id]->fullname }}</a></th>
                    <th>{{ $reservation->city_start_label }}</th>
                    <th>{{ $reservation->city_end_label }}</th>
                    <th>{{ $reservation->price }}</th>
                    <th>{{ $reservation->hour }}</th>
                    <th><a class="btn-large green disabled">Réservation validée</a></th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection