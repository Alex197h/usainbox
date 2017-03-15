@extends('layouts.app')

@section('title', 'Profil')

@section('content')

    <div class="container">

        <div class="card-panel">
            @if(!$reviews_transporter->isEmpty())
                <table class="responsive-table highlight">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Expéditeur du colis</th>
                        <th>Etape de départ</th>
                        <th>Etape d'arrivée</th>
                        <th>Avis</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($reviews_transporter as $reservation)
                        <tr>
                            <td>{{ $reservation->passage_date }}</td>
                            <td>{{ $reservation->fullname }}</td>
                            <td>{{ $reservation->city_start_label }}</td>
                            <td>{{ $reservation->city_end_label }}</td>
                            <td>
                                <form method="post" action="" class="row">
                                    {{ csrf_field() }}
                                    <div class="input-field col s12 l4 inline">
                                        <label for="review" class="active">Note sur 5</label>
                                        <input name="review" id="review" type="number" max="5" min="0" placeholder="5">
                                    </div>
                                    <input type="hidden" name="booking_id" value="{{ $reservation->id }}">
                                    <div class="input-field col s12 l8 inline">
                                        <button type="submit" class="btn btnValider">Noter</button>
                                    </div>
                                </form>
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
                        Vous n'avez aucun avis a mettre.
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