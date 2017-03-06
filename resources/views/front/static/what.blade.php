@extends('layouts.app')

@section('title', 'A quoi ça sert ?')

    @section('content')
        <div class="container">
            <div class="row">
                <div class="col s12 ">
                    <h3>A quoi ça sert ?</h3>
                    <div class="col s9 offset-s1 ">
                        <div class="row what card-panel">
                            <div class="col s4">
                                <h4>Faire <br> des économies</h4>
                                <p>
                                    {{
                                        Html::image('public/img/static/what/money.svg',
                                        'Icon d\'une tirelire',
                                        array('class' => 'responsive-img iconS'))
                                    }}
                                </p>
                                <p>
                                    Inscrivez-vous et indiquez le départ et la destination du colis, ainsi que ses dimensions et poids.
                                </p>
                            </div>
                            <div class="col s4">
                                <h4>Faire <br> de l'écologie</h4>
                                <p>
                                    {{
                                        Html::image('public/img/static/what/nature.svg',
                                        'Icon d\'une main avec une plante',
                                        array('class' => 'responsive-img iconS'))
                                    }}
                                </p>
                                <p>
                                    D'une façon ou d'une autre, le colis sera transporté :
                                    autant qu'un seul véhicule fasse le trajet et pas 2 en même temps !</p>
                                </div>
                                <div class="col s4">
                                    <h4>Faire <br> confiance</h4>
                                    <p>
                                        {{
                                            Html::image('public/img/static/what/business.svg',
                                            'Icon d\'une poingnée de main',
                                            array('class' => 'responsive-img iconS'))
                                        }}
                                    </p>
                                    <p>Rencontrer réellement les personnes qui transporteront vos colis,
                                        c'est sympa mais surtout rassurant.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
