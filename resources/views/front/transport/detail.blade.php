@extends('layouts.app')

@section('title', 'Offre de transport du '.ucfirst(utf8_encode(strftime('%A %d %B', strtotime($offer->date_start)))))

@section('content')

    <div class="row">
        <div class="col s8 offset-s2">
            <div class="row card">
                <div class="section center">
                    <h5>
                        {!! utf8_encode(ucfirst(strftime('%A %d %B %Y', strtotime($offer->date_start)))) !!}
                    </h5>
                    @if(isset($steps[$offer->id]))
                        @foreach($steps[$offer->id] as $step)

                            <span>{{ $step }}  @if(!$loop->last) → @endif </span>

                            @endforeach
                        @endif
                    </div>

                    <div class="card-content">
                        <div class="col s7 annoncepanel">
                            <h5>Détail du voyage</h5>

                            <br>
                            @if($offer->is_regular)
                                {{
                                    Html::image('public/img/trajet/regularYes.svg',
                                    'Calendrier',
                                    array('class' => 'responsive-img tooltipped iconT', 'data-tooltip' => 'Trajet régulier'))
                                }}
                            @else
                                {{
                                    Html::image('public/img/trajet/regularNo.svg',
                                    'Calendrier',
                                    array('class' => 'responsive-img tooltipped iconT', 'data-tooltip' => 'Trajet occasionnel'))
                                }}
                            @endif
                            @if($offer->highway)
                                {{
                                    Html::image('public/img/trajet/highwayYes.svg',
                                    'Icon de l\'autoroute',
                                    array('class' => 'responsive-img tooltipped iconT',
                                    'data-tooltip' => 'Prend l\'autoroute'))
                                }}
                            @endif

                            @if($offer->detour)
                                {{
                                    Html::image('public/img/trajet/detour.svg',
                                    'Icon de deux flèche pour le détour',
                                    array('class' => 'responsive-img tooltipped iconT',
                                    'data-tooltip' => 'Détour possible'))
                                }}
                            @endif
                            <br>
                            <?php echo ($offer->full) ? 'Véhicule plein' : '';  ?>
                            <br>
                            <b>Heure de départ:</b> {{ date('H:i', strtotime($offer->date_start)) }}
                            <br>
                            @if($offer->max_weight > 0)
                                <b>Poids maximum du colis:</b> {{ $offer->max_weight }}
                                <br>
                            @endif

                            <b>Volume disponible:</b> {{ $offer->volume }}
                            <br>

                            @if($offer->description)
                                <b>Description:</b>
                                {{ $offer->description }}
                                <br>
                            @endif
                            <br>
                        </div>

                        <div class="col s4 offset-s1 annoncepanel">
                            <h5>{{ $vehicle->typeVehicle->label }}</h5>
                            <b>Marque :</b> {{ $vehicle->car_brand }}
                            <br>
                            <b>Modèle :</b> {{ $vehicle->car_model }}
                            <br>
                            <br>
                        </div>

                        <div style="margin-bottom: 25px;" class="col s4 offset-s1 annoncepanel">
                            <h5>Conducteur</h5>
                            <a href="{{ route('profile', $user->id) }}">{{ $user->fullname }}</a>
                            <p>
                                {{
                                    Html::image('public/img/legende/T.svg',
                                    'Icon d\'un colis',
                                    array('class' => 'responsive-img iconC tooltipped', 'data-tooltip' => 'Note transporteur'))
                                }}
                                {{ $user->transport_note }}/5
                            </p>
                            <br>
                        </div>
                    </div>

                    @if(strtotime($offer->date_start) >= time())
                        @if($auth && $user->id != $auth->id || !$auth)
                            @if($auth)
                                <form method="post" action="{{ route('booking') }}" style="margin-top: 30px;" class="col s12 card-action righ-align">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $user->id }}" name="transporter_id">
                                    <input type="hidden" value="{{ $offer->id }}" name="transport_offer_id">
                                    <button type="submit" class="btn btnValider white-text right">
                                        Envoyer une demande
                                    </button>
                                </form>
                            @else
                                <div style="margin-top: 30px;" class="col s12 card-action right-align">
                                    <a href="{{route('login')}}" class="btn btnValider white-text">
                                        Envoyer une demande
                                    </a>
                                </div>
                            @endif
                        @endif
                    @endif
                </div>
                @if(!$offer->reviews->isEmpty())
                    <div class="row card-panel">
                        <h5>
                            Quelque avis sur {{ $user->fullname }}

                            {{
                                Html::image('public/img/annonce/up.svg',
                                'Icon d\'un pouce vers le haut',
                                array('class' => 'responsive-img icon'))
                            }}

                        </h5>
                        @foreach($offer->reviews as $r)

                            <br>
                            <div class="avis col s8 offset-s2">
                                <p>{{ $r->review }} ({{ $r->note }}/5)</p>
                            </div>

                        @endforeach
                    </div>
                @endif

                @if(!$questions->isEmpty())
                    <div class="row card-panel">
                        <h5>
                            Questions sur l'annonce

                            {{
                                Html::image('public/img/annonce/help.svg',
                                'Icon d\'une question',
                                array('class' => 'responsive-img icon', 'style' => 'vertical-align:middle;'))
                            }}
                        </h5>
                        <br>
                        <div class="col s8 offset-s2">
                            @foreach($questions as $question)
                                <div class="{{ $auth && $auth->id == $question->user->id ? 'right-align reponse' : 'question' }}">
                                    <a href="{{ route('profile', $question->user->id) }}" title="{{ $question->user->full_name }}">{{ $question->user->full_name }}</a>
                                    <br>
                                    <small>Ecrit le : {{ $question->created_at->format('d/m/Y à H:i') }}</small>
                                    <hr>
                                    {{ $question->question }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                @endif
                @if(strtotime($offer->date_start) >= time())
                    @if($auth)
                        <div class="row card-panel">
                            <div class="row">
                                <h5>
                                    Une question ?
                                    {{
                                        Html::image('public/img/annonce/comments.svg',
                                        'Icon d\'une conversation',
                                        array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                                    }}
                                </h5>
                                <form class="col s12" action="" method="post">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <textarea name="question" class="materialize-textarea" required></textarea>
                                            <label for="question">Pose ta question</label>
                                        </div>
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btnValider white-text right">
                                            Poster le message
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="row card-panel center accent-1">
                            <div class="row">
                                {{
                                    Html::image('public/img/annonce/comments.svg',
                                    'Icon d\'une conversation',
                                    array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                                }}
                                Vous devez être <a href="{{route('login')}}">connecté </a> pour poster un commentaire.
                                {{
                                    Html::image('public/img/annonce/comments.svg',
                                    'Icon d\'une conversation',
                                    array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                                }}
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>


    @endsection
