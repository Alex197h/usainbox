@extends('layouts.app')

@section('title', 'Charte de bonne conduite')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 ">
            <h3>Charte de bonne conduite</h3>
            <div class="col s9 offset-s1 ">
                <div class="row what card-panel">
                    <div class="col s6">
                        <h4>Donner de véritables <br> informations</h4>
                        <p>
                          {{ Html::image('public/img/info.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
                        </p>
                        <p>
                            Je complèterai mon profil avec mon vrai prénom et une vraie photo.
                            Je publierai uniquement des trajets que j'ai l'intention d'effectuer.
                        </p>
                    </div>
                    <div class="col s6">
                        <h4>Être <br> fiable</h4>
                        <p>
                          {{ Html::image('public/img/clock.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
                        </p>
                        <p>
                            Je serai à l'heure pour le colis voiturage, et je respecterai les
                            autres détails du voyage.
                        </p>
                    </div>
                </div>
                <div class="row what card-panel">
                    <div class="col s6">
                        <h4>Privilégier la <br> sécurité</h4>
                        <p>
                          {{ Html::image('public/img/drive.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
                        </p>
                        <p>
                            Je respecterai le code de la route pour veiller à
                            ma sécurité.
                        </p>
                    </div>
                    <div class="col s6">
                        <h4>Être prévenant <br> et accueillant</h4>
                        <p>
                          {{ Html::image('public/img/hand.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
                        </p>
                        <p>
                            Je serai sensible aux demande des expéditeurs,
                            et j'adopterai les valeurs du covoiturage : tolérance, respect, partage et convivialité.
                        </p>
                    </div>
                </div>
                <div class="row what card-panel">
                    <div class="col s6">
                        <h4>Laisser des <br> avis honnêtes</h4>
                        <p>
                          {{ Html::image('public/img/com.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
                        </p>
                        <p>Je laisserai des avis honnêtes, justes et polis envers les autres voyageurs.</p>
                    </div>
                    <div class="col s6">
                        <h4>Profiter <br> du voyage !</h4>
                        <p>
                          {{ Html::image('public/img/cup.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
                        </p>
                        <p>
                            Je profiterai au maximum du voyage et je ferai en sorte que les autres l'apprécient aussi !
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
