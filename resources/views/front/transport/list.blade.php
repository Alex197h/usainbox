@extends('layouts.app')

@section('title', 'Liste des Offres')

@section('content')
    <div class="row rechercheV">
        <form style="background: rgba(120, 106, 106, 0.75);" class="col s10 offset-s1" role="form" method="POST"
        action="{{ route('transport') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="input-field col s12 l3">
                <input id="city_start" class="white" placeholder="Ville départ" type="text"
                value="{{ $city_start }}" name="city_start">
                <label style="display: none;" for="city_start">Ville départ</label>
            </div>
            <div style="text-align: center;" class="input-field col s12 l1">
                <button type="button" style="height: 44px;" id="switch" class="btn white black-text">
                    {{
                        Html::image('public/img/switch.svg',
                        'Deux flèches pour switch',
                        array('class' => 'responsive-img icon', 'style' => 'vertical-align: middle;'))
                    }}
                </button>
            </div>
            <div class="input-field col s12 l3">
                <input id="city_end" class="white" placeholder="Ville arrivée" type="text" value="{{ $city_end }}"
                name="city_end">
                <label style="display: none;" for="city_end">Ville arrivée</label>
            </div>
            <div class="input-field col s12 l2">
                <input type="date" name="date" class=" white" placeholder="Date"
                value="{{ date('Y-m-d') }}">
            </div>
            <div class="input-field col s12 l3">
                <button style="height: 44px;" type="submit"
                class="col s12 btn waves-effect waves-light white black-text">
                Actualiser
                {{
                    Html::image('public/img/recherche/refresh.svg',
                    'Icon pour actualiser',
                    array('class' => 'responsive-img iconC', 'style' => 'vertical-align: middle;'))
                }}
            </button>
        </div>
    </div>
</form>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUTW7_sKsarvYpb8HJdG1cWptczyG3Jf0&callback=initMap&libraries=places"></script>
<script>
function initMap(){
    var options = {types: ['(cities)']};
    new google.maps.places.Autocomplete(document.getElementById('city_start'), options);
    new google.maps.places.Autocomplete(document.getElementById('city_end'), options);
}
</script>

@if(!$offers->isEmpty())
    @foreach($offers as $offer)
        <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 card annoncepanel">
            <div class="section center">
                <h5>{!! ucfirst(utf8_encode(strftime('%A %d %B', strtotime($offer->date_start)))) !!}</h5>
                @if(isset($steps[$offer->id]))
                    @foreach($steps[$offer->id] as $step)

                        <span>{{ $step }}  @if(!$loop->last) → @endif </span>

                        @endforeach
                    @endif
                </div>
                <div class="section">
                    <a href="{{ route('profile', $offer->user->id) }}">{{ $offer->user->full_name }}</a>
                    <br>
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
                    @if($offer->user->help_charge)
                        {{
                            Html::image('public/img/trajet/cartYes.svg',
                            'Icon d\'un diable pour le transport',
                            array('class' => 'responsive-img tooltipped iconT',
                            'data-tooltip' => 'Aide pour le chargement'))
                        }}
                    @endif
                    <br>

                    <b>Heure de départ :</b> {{ date('H:i', strtotime($offer->date_start)) }}
                    <br>

                    <b>Volume disponible :</b> {{ $offer->volume }}
                    <br>

                    @if($offer->description)
                        <b>Description :</b>
                        {{ $offer->description }}
                        <br>
                    @endif
                </div>
                <div class="card-action right-align">
                    <a href="{{ route('detail_transport_offer', $offer->id) }}" class="brown-text">Voir
                        l'annonce</a>
                    </div>
                </div>

                <div class="row">
                @endforeach
                <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 annoncepanel">
                    <div class="section center">
                        <h4>Aucune offre ne vous convient ?</h4>
                        @if(Auth::check())
                            <form method="post" action="{{ route('create_alert') }}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $city_start }}" name="city_start">
                                <input type="hidden" value="{{ $city_end }}" name="city_end">
                                <button class="btn btn-primary btnProfile">
                                    M'alerter en cas de nouvelle offre
                                    {{
                                        Html::image('public/img/recherche/bell.svg',
                                        'Icon d\'une cloche',
                                        array('class' => 'responsive-img iconC', 'style' => 'vertical-align: middle;'))
                                    }}
                                </button>
                            </form>
                        @else
                            <a class="btn btn-primary btnProfile" href="{{ route('login') }}">
                                M'alerter en cas de nouvelle offre
                                {{
                                    Html::image('public/img/recherche/bell.svg',
                                    'Icon d\'une cloche',
                                    array('class' => 'responsive-img iconC', 'style' => 'vertical-align: middle;'))
                                }}
                            </a>

                        @endif
                    </div>
                </div>
            @else
                <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 annoncepanel">
                    <div class="section center">
                        <h4>Aucune offre n'est disponible</h4>
                        @if(Auth::check())
                            <form method="post" action="{{ route('create_alert') }}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $city_start }}" name="city_start">
                                <input type="hidden" value="{{ $city_end }}" name="city_end">
                                <button class="btn btn-primary btnProfile">
                                    M'alerter en cas de nouvelle offre
                                    {{
                                        Html::image('public/img/recherche/bell.svg',
                                        'Icon d\'une cloche',
                                        array('class' => 'responsive-img iconC', 'style' => 'vertical-align: middle;'))
                                    }}
                                </button>
                            </form>
                        @else
                            <a class="btn btn-primary btnProfile" href="{{ route('login') }}">
                                M'alerter en cas de nouvelle offre
                                {{
                                    Html::image('public/img/recherche/bell.svg',
                                    'Icon d\'une cloche',
                                    array('class' => 'responsive-img iconC', 'style' => 'vertical-align: middle;'))
                                }}
                            </a>

                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script>

    $('#switch').on('click', function () {
        var first = $('#city_start').val();
        var last = $('#city_end').val();
        $('#city_start').val(last);
        $('#city_end').val(first);
    });

    function initMap() {
        var options = {types: ['(cities)']};
        new google.maps.places.Autocomplete(document.getElementById('city_start'), options);
        new google.maps.places.Autocomplete(document.getElementById('city_end'), options);
    }
    </script>
@endsection
