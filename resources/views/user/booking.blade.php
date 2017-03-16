@extends('layouts.app')

@section('title', 'Mes réservations')

@section('content')
<style media="screen">
@import "{!! asset('public/css/tables.min.css') !!}";
</style>

<div class="container">
    <div class="row">
        <div class="col s12 ">
            <h3>
                Liste de vos réservations
            </h3>

            @if(!$reservations->isEmpty())
                <div class="card-panel">
                    <table class="responsive-table ">
                        <thead class="center">
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Offre</th>
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
                            @foreach($reservations as $reservation)

                                <tr>
                                    <td>{!! date('Y/m/d', strtotime($reservation->passage_date)) !!}</td>
                                    <td>
                                        @if($reservation->shipper_id == Auth::user()->id)
                                            Expédition
                                        @else
                                            Transport
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('detail_transport_offer', $reservation->transport_offer_id) }}"
                                            target="_blank">Voir
                                            l'offre</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('profile', $users[$reservation->id][0]->id) }}" target="_blank">
                                                {{ $users[$reservation->id][0]->fullname }}
                                            </a>
                                            @if($reservation->transporter_id == Auth::user()->id)
                                                <br> <a href="tel:{{ $users[$reservation->id][0]->phone }}">{{ $users[$reservation->id][0]->phone }}</a>
                                            @endif

                                        </td>
                                        <td>{{ $reservation->city_start_label }}</td>
                                        <td>{{ $reservation->city_end_label }}</td>
                                        <td>{{ $reservation->parcel_volume }} cm3</td>
                                        <td>{{ $reservation->price }}€</td>
                                        <td>{{ date('h:i', strtotime($reservation->hour)) }}</td>
                                        <td>
                                            @if($reservation->shipper_id == Auth::user()->id && $reservation->validated)
                                                <a class="btn green disabled">Validée</a>
                                            @elseif($reservation->shipper_id == Auth::user()->id && !$reservation->validated)
                                                <a class="btn green disabled">Attente</a>
                                            @elseif($reservation->transporter_id == Auth::user()->id && $reservation->validated)
                                                <a class="btn green disabled">Validée</a>
                                            @elseif($reservation->transporter_id == Auth::user()->id && !$reservation->validated)
                                                <form method="post" action="{{ route('post_booking') }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" value="{{ $reservation->id }}" name="booking_id">
                                                    <button type="submit" class="waves-effect btnValider waves-light btn">Valider</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="col s10 offset-s1">
                        <div class="card-panel">
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
                        </div>
                    </div>
                @endif


                <script src="{!! asset('public/js/tables.min.js') !!}"></script>
                <script>
                $(document).ready(function(){
                    $('table').DataTable();
                });
                </script>

            </div>
        </div>
    </div>
@endsection
