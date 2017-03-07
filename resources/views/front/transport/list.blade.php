@extends('layouts.app')

@section('title', 'Liste des Offres')

@section('content')
<div class="row">
    <form style="background: rgba(120, 106, 106, 0.75);" class="col s10 offset-s1" role="form" method="POST" action="{{ route('transport') }}">
        {{ csrf_field() }}
        <h4 class="col s12 white-text">Envoyez vos colis rapidement</h4>
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
                <button style="height: 44px;" type="submit" class="col s12 btn waves-effect waves-light white black-text">
                    Actualiser
                    {{
                        Html::image('public/img/recherche/repeat.svg',
                        'Icon pour actualiser',
                        array('class' => 'responsive-img icon', 'style' => 'vertical-align: middle;'))
                    }}
                </button>
            </div>
        </div>
    </form>
</div>
<div class="row">
    @if(!$offers->isEmpty())
    @foreach($offers as $offer)
    <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 card-panel">
        <div class="section center">
            <h5>{!! ucfirst(utf8_encode(strftime('%A %d %B', strtotime($offer->date_start)))) !!}</h5>
            @if(isset($steps[$offer->id]))
            @foreach($steps[$offer->id] as $step)

            <span>{{ $step }}  @if(!$loop->last) → @endif </span>

            @endforeach
            @endif
        </div>
        <div class="section">
            @if($offer->is_regular)
            <i class="small material-icons tooltipped" data-tooltip="Trajet régulier">restore</i>
            @else
            <i class="small material-icons tooltipped" data-tooltip="Trajet occasionnel">schedule</i>
            @endif
            @if($offer->highway)
            <i class="small material-icons tooltipped" data-tooltip="Autoroute">surround_sound</i>
            @endif
            <br>

            <b>Heure de départ:</b> {{ date('H:i', strtotime($offer->date_start)) }}
            <br>

            <b>Volume:</b> {{ $offer->volume }}
            <br>

            <b>Description:</b>
            {{ $offer->description }}
            <br>

            <b>Détour:</b>
            {{ $offer->start_detour ? 'Aller' : '' }}
            {{ $offer->end_detour ? 'Retour' : '' }}
            <br>
        </div>
    </div>
    @endforeach
    <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 card-panel">
        <div class="section center">
            <h4>Aucune offre ne vous convienttttt ?</h4>
            <form method="post" action="{{ route('create_alert') }}">
                <input type="hidden" value="{{ $city_start }}" name="city_start">
                <input type="hidden" value="{{ $city_end }}" name="city_end">
                <button class="btn btn-primary">Créer une alerte</button>
            </form>

        </div>
    </div>
    @else
    <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 card-panel">
        <div class="section center">
            <h4>Aucune offre disponible</h4>
            <form method="post" action="{{ route('create_alert') }}">
                {{ csrf_field() }}
                <input type="hidden" value="{{ $city_start }}" name="city_start">
                <input type="hidden" value="{{ $city_end }}" name="city_end">
                <button class="btn btn-primary">Créer une alerte</button>
            </form>
        </div>
    </div>
    @endif
</div>
<script>

$('#switch').on('click', function(){
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
