@extends('layouts.app')

@section('title', 'Liste des Offres')

@section('content')


<div class="row">

    @foreach($offers as $offer)
        <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 card-panel">
            <div class="section center">
                <h5>{!! ucfirst(utf8_encode(strftime('%A %d %B', strtotime($offer->date_start)))) !!}</h5>
                @if(isset($steps[$offer->id]))
                    @foreach($steps[$offer->id] as $step)

                        <span>{{ $step }}  @if(!$loop->last) -> @endif </span>

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
</div>

@endsection
