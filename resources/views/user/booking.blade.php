@extends('layouts.app')

@section('title', 'Mes réservations')

@section('content')
    <div class="container">
        <div class="card-panel">
            <table class="responsive-table highlight centered">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Offre de transport</th>
                    <th>Demandeur</th>
                    <th>Etape de départ</th>
                    <th>Etape d'arrivée</th>
                    <th>Volume du colis</th>
                    <th>Prix</th>
                    <th>Heure de passage</th>
                    <th>Valider</th>
                </tr>
                </thead>

                <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{!! ucfirst(utf8_encode(strftime('%A %d %B', strtotime($reservation->passage_date)))) !!}</td>
                        <td>
                            <a href="{{ route('detail_transport_offer', $reservation->transport_offer_id) }}">Voir
                                l'offre</a>
                        </td>
                        <td>
                            <a href="{{ route('profile', $users[$reservation->id][0]->id) }}">
                                {{ $users[$reservation->id][0]->fullname }}
                            </a>,
                            <a href="tel:{{ $users[$reservation->id][0]->phone }}">{{ $users[$reservation->id][0]->phone }}</a>
                        </td>
                        <td>{{ $reservation->city_start_label }}</td>
                        <td>{{ $reservation->city_end_label }}</td>
                        <td>{{ $reservation->parcel_volume }}</td>
                        <td>{{ $reservation->price }}</td>
                        <td>{{ $reservation->hour }}</td>
                        <td>
                            @if($reservation->validated)
                                <a class="btn green disabled">Validée</a>
                            @else
                                <form method="post" action="{{ route('') }}">
                                    <input type="hidden" value="{{ $reservation->id }}" name="booking_id">
                                    <button type="submit" class="waves-effect waves-light btn">A valider</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection