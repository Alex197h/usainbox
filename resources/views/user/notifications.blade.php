@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 card">
                <div class="section center">
                    <h5>
                        Liste de vos notifications
                        {{
                            Html::image('public/img/recherche/bell.svg',
                            'Icon d\'une cloche',
                            array('class' => 'responsive-img icon','style' => 'vertical-align: middle;'))
                        }}
                    </h5>
                </div>
                @if(!$offers->isEmpty())
                    @foreach($offers as $offer)
                        {{ $offer->steps[0]->label }} - {{ $offer->steps[count($offer->steps)-1]->label }}
                        Le {{ $offer->date_start }}
                        <a href="{{ route('detail_transport_offer', $offer->id) }}">Voir l'annonce</a>
                        @if(!$notifs[$offer->id]->read_at)
                            <span class="new badge"></span>
                            {{ $notifs[$offer->id]->markAsRead() }}
                        @endif
                        <hr>
                    @endforeach
                @else
                    <div class="section center">
                        <p>
                            {{ Html::image('public/img/vehicles/warning.svg',
                                'Icon d\'un panneau de signalisation',
                                array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                            }}
                            Vous n'avez pas encore de notifications.
                            {{ Html::image('public/img/vehicles/warning.svg',
                                'Icon d\'un panneau de signalisation',
                                array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                            }}
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
