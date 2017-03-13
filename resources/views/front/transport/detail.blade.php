@extends('layouts.app')

@section('title', 'Offre de transport du '.ucfirst(utf8_encode(strftime('%A %d %B', strtotime($offer->date_start)))))

@section('content')

    <div class="row">
        <div class="col s8 offset-s2">
            <div class="row card-panel">
                <div class="center">
                    <h4>{!! ucfirst(utf8_encode(strftime('%A %d %B', strtotime($offer->date_start)))) !!}</h4>
                    @if(isset($steps[$offer->id]))
                        @foreach($steps[$offer->id] as $step)

                            <span>{{ $step }}  @if(!$loop->last) → @endif </span>

                        @endforeach
                    @endif
                </div>

                <div class="card-content">
                    <div class="col s7 annoncepanel">
                        <h5>Détail du voyage</h5>

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

                        <b>Volume disponible:</b> {{ $offer->volume }}
                        <br>

                        <b>Poids maximum du colis:</b> {{ $offer->max_weight }}
                        <br>

                        <b>Longueur maximum du colis:</b> {{ $offer->max_length }}
                        <br>

                        <b>Largeur maximum du colis:</b> {{ $offer->max_width }}
                        <br>

                        <b>Hauteur maximum du colis:</b> {{ $offer->max_height }}
                        <br>

                        <b>Description:</b>
                        {{ $offer->description }}
                        <br>

                    </div>

                    <div class="col s4 offset-s1 annoncepanel">
                        <h5>Véhicule</h5>
                        <b>Marque :</b> {{ $vehicle->car_brand }}
                        <br>
                        <b>Modèle :</b> {{ $vehicle->car_model }}
                        <br>
                    </div>

                    <div class="col s4 offset-s1 annoncepanel">
                        <h5>Conducteur</h5>
                        <a href="{{ route('profile', $user->id) }}">{{ $user->fullname }}</a>
                        <br>
                        <b>Note :</b> /5
                        <br>
                    </div>
                </div>
                @if (Auth::check())
                    <form method="post" action="{{ route('booking') }}" class="col s12">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $user->id }}" name="transporter_id">
                        <input type="hidden" value="{{ $offer->id }}" name="transport_offer_id">
                        <button type="submit" class="btn btnValider white-text right">
                            Envoyer une demande
                        </button>
                    </form>
                @else
                    <div class="col s12">
                        <a href="{{route('login')}}" class="btn btnValider white-text right">
                            Envoyer une demande
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection
