@extends('layouts.app')

@section('title', 'Mes réservations')

@section('content')
<style media="screen">
@import "{!! asset('public/css/tables.min.css') !!}";
</style>

<div class="container">
    <div class="row">
        <div class="col s12 card">
            <div class="section center">
                <h5>
                    Liste de vos réservations
                    {{
                        Html::image('public/img/reservation/list.svg',
                        'Icon d\'une annonce',
                        array('class' => 'responsive-img icon','style' => 'vertical-align: middle;'))
                    }}
                </h5>
            </div>


            @if(!$reservations->isEmpty())
                <table class="responsive-table">
                    <thead class="">
                        <tr>
                            <th class="center">Date</th>
                            <th class="center">Type</th>
                            <th class="center">Demandeur</th>
                            <th class="center">Tajet</th>
                            <th class="center">Volume</th>
                            <th class="center">Prix</th>
                            <th class="center">Heure</th>
                            <th class="center">Valider</th>
                            <th class="center">Avis</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr class="res-line">
                                <td class="center">
                                    <a class="tooltipped" data-tooltip="Voir le détail de l'annonce" href="{{ route('detail_transport_offer', $reservation->transport_offer_id) }}" target="_blank">
                                        {!! ucfirst(utf8_encode(strftime('%d %B %Y', strtotime($reservation->passage_date)))) !!}
                                    </a>

                                </td>
                                <td class="center type_offer">
                                    @if($reservation->isShipper(Auth::user()->id))
                                        {{
                                            Html::image('public/img/legende/E.svg',
                                            'Icon d\'un volant',
                                            array('class' => 'datatype responsive-img iconC tooltipped', 'data-type' => 'E', 'data-tooltip' => 'Expédition'))
                                        }}
                                    @else
                                        {{
                                            Html::image('public/img/legende/T.svg',
                                            'Icon d\'un colis',
                                            array('class' => 'datatype responsive-img iconC tooltipped', 'data-type' => 'T', 'data-tooltip' => 'Transport'))
                                        }}
                                    @endif
                                </td>
                                <td class="center">
                                    <a class="tooltipped" data-tooltip="Voir le profil" href="{{ route('profile', $users[$reservation->id][0]->id) }}" target="_blank">
                                        {{ $users[$reservation->id][0]->fullname }}
                                    </a>
                                    <hr>
                                    @if($reservation->transporter_id == Auth::user()->id)
                                        <a class="tooltipped" data-tooltip="Appeler" href="tel:{{ $users[$reservation->id][0]->phone }}">{{ $users[$reservation->id][0]->phone }}</a>
                                    @endif

                                </td>
                                <td class="center">
                                    {{ $reservation->city_start_label }} → {{ $reservation->city_end_label }}
                                </td>
                                <td class="center">{{ $reservation->parcel_volume }} L</td>
                                <td class="center">{{ $reservation->price ? $reservation->price.'€' : '-' }}</td>
                                <td class="center">{{ $reservation->hour ? date('H:i', strtotime($reservation->hour)) : '-' }}</td>
                                <td class="center">
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
                                <td class="center">
                                    @if( (strtotime($reservation->passage_date) < time()) && !(($reservation->isShipper(Auth::user()->id) && $reservation->shipping_review)||($reservation->isTransporter(Auth::user()->id) && $reservation->transport_review)))
                                        <a type="button" class="waves-effect btnValider waves-light btn btn-modal" data-id="{{ $reservation->id }}" href="#modalAvis">Avis</a>
                                    @elseif ((strtotime($reservation->passage_date) >= time()))
                                        {{
                                            Html::image('public/img/reservation/error.svg',
                                            'Icon croix rouge',
                                            array('class' => 'responsive-img iconC tooltipped', 'data-tooltip' => 'Vous ne pouvez pas encore laisser d\'avis'))
                                        }}
                                    @else
                                        {{
                                            Html::image('public/img/reservation/checked.svg',
                                            'Icon validé',
                                            array('class' => 'responsive-img iconC tooltipped', 'data-tooltip' => 'Avis laissé'))
                                        }}
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
                    var type = $(this).parents('.res-line').find('.datatype').attr('data-type');
                    $('#type').val(type);
                });
                $('table').DataTable();
            });
            </script>

        </div>
    </div>
</div>
@endsection
