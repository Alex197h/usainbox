@extends('layouts.app')

@section('title', 'A quoi ça sert ?')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 ">
            <h3>A quoi ça sert ?</h3>
            <div class="col s8 offset-s2">
                <div class="row card-panel">
                    <div class="col s12">
                        <h4 class="center">Faire des économies</h4>
                        <p class="center">
                            {{
                                Html::image('public/img/static/what/money.svg',
                                'Icon d\'une tirelire',
                                array('class' => 'responsive-img iconS'))
                            }}
                        </p>
                        <p style="text-align:justify">
                            En tant que transporteur, rien de mieux que gagner de l'argent en voyageant.
                            De toute façon le trajet vous devez le faire alors pourquoi ne pas gagner quelques euros ?
                        </p>
                        <p style="text-align:justify">
                            En tant qu'expéditeur, rechercher le transport qui vous convient et discuter du prix.
                            Toujours moins cher que de le faire expédier par un organisme privé et en plus c'est rapide.
                            En une journée votre colis peut être livré.
                        </p>
                    </div>
                </div>
                <div class="row card-panel">

                    <div class="col s12">
                        <h4 class="center">Faire de l'écologie</h4>
                        <p class="center">
                            {{
                                Html::image('public/img/static/what/nature.svg',
                                'Icon d\'une main avec une plante',
                                array('class' => 'responsive-img iconS'))
                            }}
                        </p>
                        <p style="text-align:justify">
                            Il est toujours bien de pouvoir faire attention à l'Environnement.
                            Usain Box vous permet de faire de l'écologie en réduisant les transports inutiles.
                        </p>
                        <p style="text-align:justify">
                            Dans tous les cas vous voulez transporter votre colis,
                            autant qu'un seul véhicule fasse le trajet et pas deux en même temps !
                        </p>
                    </div>
                </div>
                <div class="row card-panel">
                    <div class="col s12">
                        <h4 class="center">Faire confiance</h4>
                        <p class="center">
                            {{
                                Html::image('public/img/static/what/business.svg',
                                'Icon d\'une poingnée de main',
                                array('class' => 'responsive-img iconS'))
                            }}
                        </p>
                        <p style="text-align:justify">
                            On a du mal à faire confiance aux personnes qu'on ne connaît pas.
                            Grâce à Usain Box, rencontrer réellement les personnes qui transporteront vos colis,
                            c'est sympa mais surtout rassurant.
                        </p>
                        <p style="text-align:justify">
                            L'entraide et quelque chose qui est de plus en plus rare.
                            Ne la laissons pas disparaître, rencontrer et découvrir des personnes qui on besoin de votre aide.
                            Se sentir utile est toujours agréable.

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
