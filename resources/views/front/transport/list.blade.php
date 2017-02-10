@extends('layouts.app')

@section('title', 'Liste des Offres')

@section('content')


<div class="row">
    <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 z-depth-1 login-form">
            <div class="section center">
                <h5>Inscrivez vous gratuitement</h5>
            </div>
            <div class="section">
                @foreach($offers as $offer)
                    <div class="card-panel cyan lighten-5">
                        @if($offer->is_regular)
                            <i class="small material-icons tooltipped" data-tooltip="Trajet régulier">restore</i>
                        @else
                            <i class="small material-icons tooltipped" data-tooltip="Trajet occasionnel">schedule</i>
                        @endif
                        @if($offer->highway)
                            <i class="small material-icons tooltipped" data-tooltip="Autoroute">surround_sound</i>
                        @endif
                        <br>
                        
                        <b>Date:</b> Le {{ date('d/m/Y à H:i:s', strtotime($offer->date_start)) }}
                        <br>
                        
                        <b>Volume:</b> {{ $offer->volume }}
                        <br>
                        
                        <b>Description:</b>
                        {{ $offer->description }}
                        <br>
                        
                        <b>Détour:</b>
                            {{ $offer->start_detour ? 'Allé' : '' }}
                            {{ $offer->end_detour ? 'Retour' : '' }}
                        <br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
