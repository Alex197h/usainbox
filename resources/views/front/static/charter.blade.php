@extends('layouts.app')

@section('title', 'Charte de bonne conduite')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 ">
            <h3>Charte de bonne conduite</h3>
            <div class="col s9 offset-s1 ">
                <div class="row card-panel">
                    <div class="col s12">
                        <h4 class="center">Donner de véritables informations</h4>
                        <p class="center">
                            {{
                                Html::image('public/img/static/charter/info.svg',
                                'Icon d\'un profile',
                                array('class' => 'responsive-img iconS'))
                            }}
                        </p>
                        <p style="text-align:justify;">
                            ► Je compléterai mon profil avec de véritables informations. <br>
                            ► Je donnerai mon vrai nom et mon vrai prénom. <br>
                            ► Je donnerai mon véritable numéro de téléphone sur lequel on peut me joindre à tout moment. <br>
                            ► Je ne donnerai que de véritables informations me concernant. <br>
                            ► Je publierai uniquement des trajets que j'ai l'intention d'effectuer. <br>
                            ► Je contacterai uniquement des transporteurs pour de véritables expéditions. <br>
                        </p>
                    </div>
                </div>
                <div class="row card-panel">
                    <div class="col s12">
                        <h4 class="center">Être fiable</h4>
                        <p class="center">
                            {{
                                Html::image('public/img/static/charter/clock.svg',
                                'Icon d\'une horloge',
                                array('class' => 'responsive-img iconS'))
                            }}
                        </p>
                        <p style="text-align=justify;">
                            ► Je ne donnerai pas de faux horaire. <br>
                            ► Je serai à l'heure pour le colis voiturage. <br>
                            ► Je serai respectueux envers le transporteur. <br>
                            ► Je serai à l'endroit convenu pour attendre le transporteur. <br>
                            ► Je serai respectueux des autres détails du voyage. <br>
                        </p>
                    </div>
                </div>
                <div class="row card-panel">
                    <div class="col s12">
                        <h4 class="center">Privilégier la sécurité</h4>
                        <p class="center">
                            {{
                                Html::image('public/img/static/charter/drive.svg',
                                'Icon d\'un volant de voiture',
                                array('class' => 'responsive-img iconS'))
                            }}
                        </p>
                        <p style="text-align=justify;">
                            ► Je respecterai le Code de la route. <br>
                            ► Je possède un permis de conduire valide pour transporter des colis. <br>
                            ► Je possède une assurance valide pour transporter des colis. <br>
                            ► Je serai prudent avec les objets qu'on me confit. <br>
                            ► Je ne proposerai pas plus de place que disponible. <br>
                        </p>
                    </div>
                </div>
                <div class="row card-panel">
                    <div class="col s12">
                        <h4 class="center">Être prévenant et accueillant</h4>
                        <p class="center">
                            {{
                                Html::image('public/img/static/charter/hand.svg',
                                'Icon d\'une poignée de main',
                                array('class' => 'responsive-img iconS'))
                            }}
                        </p>
                        <p style="text-align=justify;">
                            ► Je serai respectueux avec les personnes que je rencontre. <br>
                            ► Je serai sensible aux demandes des expéditeurs. <br>
                            ► Je serai sensible aux demandes des transporteurs. <br>
                            ► Je serai tolérant. <br>
                            ► Je serai conviviale. <br>
                            ► Je serai respecté avec les colis qu'on me confit. <br>
                        </p>
                    </div>
                </div>
                <div class="row card-panel">
                    <div class="col s12">
                        <h4 class="center">Laisser des avis honnêtes</h4>
                        <p class="center">
                            {{
                                Html::image('public/img/static/charter/com.svg',
                                'Icon d\'une bulle de conversation',
                                array('class' => 'responsive-img iconS'))
                            }}
                        </p>
                        <p style="text-align=justify;">
                            ► Je laisserai des avis honnêtes. <br>
                            ► Je resterai poli lors de la publication d'un avis. <br>
                            ► Je laisserai des avis justes. <br>
                            ► Je ne dois pas critiquer les autres utilisateurs. <br>
                            ► Je dois rester respectueux des autres personnes.<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
