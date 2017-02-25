@extends('layouts.app')

@section('title', 'A quoi ça sert ?')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 ">
            <h3>A quoi ça sert ?</h3>
            <div class="col s9 offset-s1 card-panel">
                <div class="row what">
                    <div class="col s4">
                        <h4>Faire <br> des économies</h4>
                        <p><i class="material-icons">euro_symbol</i></p>
                        <p>Inscrivez-vous et indiquez le départ et la destination du colis, ainsi que ses dimensions et poids</p>
                    </div>
                    <div class="col s4">
                        <h4>Faire <br> de l'écologie</h4>
                        <p><i class="material-icons">local_florist</i></p>
                        <p>
                            D'une façon ou d'une autre, le colis sera transporté :
                            autant qu'un seul véhicule fasse le trajet et pas 2 en même temps !</p>
                    </div>
                    <div class="col s4">
                        <h4>Faire <br> confiance</h4>
                        <p><i class="material-icons">group</i></p>
                        <p>Rencontrer réellement les personnes qui transporteront vos colis,
                            c'est sympa mais surtout rassurant.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
