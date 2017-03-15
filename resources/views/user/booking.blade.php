@extends('layouts.app')

@section('title', 'Mes réservations')

@section('content')
    <div class="container">
        <div class="card-panel">
            @if(!$reservations_transporter->isEmpty())
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
                        <th>Valider la réservation</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($reservations_transporter as $reservation)
                        <tr>
                            <td>{!! ucfirst(utf8_encode(strftime('%A %d %B', strtotime($reservation->passage_date)))) !!}</td>
                            <td>
                                <a href="{{ route('detail_transport_offer', $reservation->transport_offer_id) }}"
                                   target="_blank">Voir
                                    l'offre</a>
                            </td>
                            <td>
                                <a href="{{ route('profile', $users_transporter[$reservation->id][0]->id) }}" target="_blank">
                                    {{ $users_transporter[$reservation->id][0]->fullname }}
                                </a>,
                                <a href="tel:{{ $users_transporter[$reservation->id][0]->phone }}">{{ $users_transporter[$reservation->id][0]->phone }}</a>
                            </td>
                            <td>{{ $reservation->city_start_label }}</td>
                            <td>{{ $reservation->city_end_label }}</td>
                            <td>{{ $reservation->parcel_volume }} cm3</td>
                            <td>{{ $reservation->price }}€</td>
                            <td>{{ date('h:i', strtotime($reservation->hour)) }}</td>
                            <td>
                                @if($reservation->validated)
                                    <a class="btn green disabled">Validée</a>
                                @else
                                    <form method="post" action="{{ route('post_booking') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $reservation->id }}" name="booking_id">
                                        <button type="submit" class="waves-effect waves-light btn">Valider</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="section center">
                    <p>
                        {{ Html::image('public/img/vehicles/warning.svg',
                            'Icon d\'un panneau de signalisation',
                            array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                        }}
                        Vous n'avez pas encore de réservation.
                        {{ Html::image('public/img/vehicles/warning.svg',
                            'Icon d\'un panneau de signalisation',
                            array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                        }}
                    </p>
                </div>
            @endif
        </div>



        <div class="card-panel">
            @if(!$reservations_shipper->isEmpty())
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
                        <th>Valider la réservation</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($reservations_shipper as $reservation)

                        <tr>
                            <td>{!! ucfirst(utf8_encode(strftime('%A %d %B', strtotime($reservation->passage_date)))) !!}</td>
                            <td>
                                <a href="{{ route('detail_transport_offer', $reservation->transport_offer_id) }}"
                                   target="_blank">Voir
                                    l'offre</a>
                            </td>
                            <td>
                                <a href="{{ route('profile', $users_shipper[$reservation->id][0]->id) }}" target="_blank">
                                    {{ $users_shipper[$reservation->id][0]->fullname }}
                                </a>,
                                <a href="tel:{{ $users_shipper[$reservation->id][0]->phone }}">{{ $users_shipper[$reservation->id][0]->phone }}</a>
                            </td>
                            <td>{{ $reservation->city_start_label }}</td>
                            <td>{{ $reservation->city_end_label }}</td>
                            <td>{{ $reservation->parcel_volume }} cm3</td>
                            <td>{{ $reservation->price }}€</td>
                            <td>{{ date('h:i', strtotime($reservation->hour)) }}</td>
                            <td>
                                @if($reservation->validated)
                                    <a class="btn green disabled">Validée</a>
                                @else
                                    <a class="btn green disabled">Attente</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="section center">
                    <p>
                        {{ Html::image('public/img/vehicles/warning.svg',
                            'Icon d\'un panneau de signalisation',
                            array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                        }}
                        Vous n'avez pas encore de réservation.
                        {{ Html::image('public/img/vehicles/warning.svg',
                            'Icon d\'un panneau de signalisation',
                            array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                        }}
                    </p>
                </div>
            @endif

        </div>

    </div>
@endsection