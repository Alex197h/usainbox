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
                    <table class="responsive-table">
                        <thead class="">
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
                                <th>Laisser un avis</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($reservations as $reservation)
                                <tr class="res-line">
                                    <td>{!! date('Y/m/d', strtotime($reservation->passage_date)) !!}</td>
                                    <td class="type_offer">
                                        @if($reservation->isShipper(Auth::user()->id))
                                            <span data-type="E">Expédition</span>
                                        @else
                                            <span data-type="T">Transport</span>
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
                                        <td>{{ $reservation->price ? $reservation->price.'€' : '-' }}</td>
                                        <td>{{ $reservation->hour ? date('H:i', strtotime($reservation->hour)) : '-' }}</td>
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
                                        <td>
                                            @if( (strtotime($reservation->passage_date) < time()) && !(($reservation->isShipper(Auth::user()->id) && $reservation->shipping_review)||($reservation->isTransporter(Auth::user()->id) && $reservation->transport_review)))
                                                <a type="button" class="waves-effect btnValider waves-light btn btn-modal" data-id="{{ $reservation->id }}" href="#modalAvis">Avis</a>
                                            @else
                                                {{
                                                    Html::image('public/img/reservation/checked.svg',
                                                    'Icon validé',
                                                    array('class' => 'responsive-img iconC'))
                                                }}
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

                <div id="modalAvis" class="modal">
                    <form method="post" action="" id="sendreview">
                        <div class="modal-content">
                            <h4>Laisser un avis</h4>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="note" id="note">
                                            <option value="0" disabled selected>Choisir une note</option>
                                            @for($i=1;$i<=5;$i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <label>Note</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <textarea id="review" name="review" class="materialize-textarea" required></textarea>
                                        <label for="review">Laisser un avis</label>
                                    </div>
                                </div>
                                {{ csrf_field() }}
                                <input type="hidden" name="reservation" id="reservation" value="">
                                <input type="hidden" name="type" id="type" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class=" modal-action modal-close waves-effect btnValider white-text waves-green btn-flat">Valider</button>
                        </div>
                    </form>
                </div>

                <script src="{!! asset('public/js/tables.min.js') !!}"></script>
                <script>

                $(document).ready(function(){
                    $('.modal').modal();
                    $('.btn-modal').on('click', function(){
                        $('#sendreview')[0].reset();

                        var id = $(this).attr('data-id');
                        $('#reservation').val(id);
                        var type = $(this).parents('.res-line').find('.type_offer span').attr('data-type');
                        $('#type').val(type);
                    });
                    $('table').DataTable();
                });
                </script>

            </div>
        </div>
    </div>
@endsection
