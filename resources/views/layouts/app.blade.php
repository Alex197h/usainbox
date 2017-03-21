<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Usain Box - @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{ Html::style('public/css/style.css') }}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    <style type="text/css">
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    </style>
</head>
<body>
    <?php
    $User = Auth::user();
    ?>
    <header class="row navbar-fixed" style="margin:0;">

        <ul id="dropdown1" class="dropdown-content">
            <li>
                <a href="{{route('user_profile')}}">Profil</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="{{route('user_vehicles')}}">Ajouter un vehicule</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="{{ route('my_ads') }}">Vos annonces</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="{{ route('my_bookings') }}">Vos réservations</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="{{route('logout')}}">Se déconnecter</a>
            </li>
        </ul>

        <nav>
            <div class="white nav-wrapper">
                <a href="{{route('home')}}" class="brand-logo">
                    {{
                        Html::image('public/img/logo.png', 'Logo de UBox')
                    }}
                </a>
                <a href="#" data-activates="mobile-demo" class="button-collapse black-text"><i
                    class="material-icons">menu</i></a>
                    @if (Auth::check())
                        <ul class="right hide-on-med-and-down">
                            @if(Auth::user()->is_admin)
                                <li>
                                    <a href="{{ route('admin') }}" class="black-text">
                                        {{
                                            Html::image('public/img/admin/boss.svg',
                                            'Icon d\'un boss',
                                            array('class' => 'responsive-img tooltipped icon',
                                            'data-tooltip' => 'Administration', 'style' => 'vertical-align:middle;'))
                                        }}
                                    </a>
                                </li>
                            @endif


                            <li>
                                <a href="{{ route('auth_notifications') }}" class="black-text">
                                    {{
                                        Html::image('public/img/accueil/bell.svg',
                                        'Icon d\'une cloche',
                                        array('class' => 'responsive-img icon tooltipped', 'data-tooltip' => 'Notifications', 'style' => 'vertical-align:middle;'))
                                    }}
                                    @if(count($User->unreadNotifications)>0)
                                        <span class="badge">{{ count($User->unreadNotifications) }}</span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{route('home')}}" class="black-text"> Rechercher</a>
                            </li>
                            <li>
                                <a href="{{route('create_transport_offer')}}" class="black-text">Déposer une annonce</a>
                            </li>
                            <li>
                                <a class="dropdown-button black-text" href="#!"
                                data-activates="dropdown1">{{$User->full_name }}<i
                                class="material-icons right">arrow_drop_down</i></a>
                            </li>
                        </ul>
                        <ul class="side-nav" id="mobile-demo">
                            @if(Auth::user()->is_admin)
                                <li>
                                    <a href="{{ route('admin') }}" class="black-text"> <i class="material-icons">dashboard</i></a>
                                </li>
                            @endif
                            <li>
                                <a href="#" class="black-text"> Rechercher</a>
                            </li>
                            <li>
                                <a href="{{route('login')}}" class="black-text">Déposer une annonce</a>
                            </li>
                            <li>
                                <a href="{{route('user_profile')}}">Profil</a>
                            </li>
                            <li>
                                <a href="{{route('user_vehicles')}}">Ajouter un vehicule</a>
                            </li>
                            <li>
                                <a href="{{ route('my_ads') }}">Vos annonces</a>
                            </li>
                            <li>
                                <a href="{{ route('my_bookings') }}">Vos réservations</a>
                            </li>
                            <li>
                                <a href="{{route('logout')}}">Se déconnecter</a>
                            </li>
                        </ul>
                    @else
                        <ul class="right hide-on-med-and-down">
                            <li>
                                <a href="{{route('login')}}" class="black-text">Déposer une annonce</a>
                            </li>
                            <li>
                                <a href="{{route('register')}}" class="black-text">Inscription</a>
                            </li>
                            <li>
                                <a href="{{route('login')}}" class="black-text">Connexion</a>
                            </li>
                        </ul>
                        <ul class="side-nav" id="mobile-demo">
                            <li>
                                <a href="{{route('login')}}" class="black-text">Déposer une annonce</a>
                            </li>
                            <li>
                                <a href="{{route('register')}}" class="black-text">Inscription</a>
                            </li>
                            <li>
                                <a href="{{route('login')}}" class="black-text">Connexion</a>
                            </li>
                        </ul>
                    @endif
                </div>
            </nav>
        </header>

        <main>
            @yield('content')

        </main>

        <footer class="page-footer">
            <div class="container">
                <div class="row">
                    <div class="col l3">
                        <h5 class="white-text">Informations</h5>
                        <ul>
                            <li>
                                <a class="grey-text text-lighten-3" href="{{route('page', 'what')}}" class="black-text">A quoi
                                    ça sert ?</a>
                                </li>
                                <li>
                                    <a class="grey-text text-lighten-3" href="{{route('page', 'charter')}}">Charte de bonne
                                        conduite</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col l3">
                                <h5 class="white-text">À propos</h5>
                                <ul>
                                    <li>
                                        <a class="grey-text text-lighten-3" href="{{route('page', 'who')}}">Qui sommes nous ?</a>
                                    </li>
                                    <li>
                                        <a class="grey-text text-lighten-3" href="{{route('contact')}}">Nous contacter</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col l3">
                                <h5 class="white-text">Mentions légales</h5>
                                <ul>
                                    <li>
                                        <a class="grey-text text-lighten-3" href="{{route('page', 'conditions')}}">Conditions
                                            générales</a>
                                        </li>
                                        <li>
                                            <a class="grey-text text-lighten-3" href="{{route('page', 'privacy')}}">Politique de
                                                confidentialité</a>
                                            </li>
                                            <li>
                                                <a class="grey-text text-lighten-3" href="{{route('page', 'cookies')}}">Utilisation des
                                                    cookies</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="col l3 ">
                                            <h5 class="white-text">Suivez-nous</h5>

                                            <ul>
                                                <li style="display:inline;">
                                                    <a class="grey-text text-lighten-3 " href="https://twitter.com/UBox12" target="_blank">
                                                        {{
                                                            Html::image('public/img/social/twitter.svg',
                                                            'Icon de twitter',
                                                            array('class' => 'responsive-img valign iconR'))
                                                        }}
                                                    </a>
                                                </li>

                                                <li style="display:inline;">
                                                    <a class="grey-text text-lighten-3 " href="https://www.facebook.com/UBox-1837407246530068/"
                                                    target="_blank">
                                                    {{
                                                        Html::image('public/img/social/facebook.svg',
                                                        'Icon de facebook',
                                                        array('class' => 'responsive-img valign iconR'))
                                                    }}
                                                </a>
                                            </li>

                                            <li style="display:inline;">
                                                <a class="grey-text text-lighten-3 " href="https://plus.google.com/u/3/109901738787479044420"
                                                target="_blank">
                                                {{
                                                    Html::image('public/img/social/google.svg',
                                                    'Icon de google plus',
                                                    array('class' => 'responsive-img valign iconR'))
                                                }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-copyright">
                            <div class="container">
                                Usain Box © 2017 Copyright
                            </div>
                        </div>
                    </footer>

                    <script>
                    var d = new Date();
                    d.setFullYear(d.getFullYear() - 100);
                    var dd = new Date();
                    dd.setFullYear(dd.getFullYear() - 18);
                    $(".datepicker").pickadate({
                        selectMonths: true,
                        selectYears: 100,
                        min: new Date(),
                        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                        monthsShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                        weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                        weekdaysLetter: ["D", "L", "M", "M", "J", "V", "S"],
                        today: "Aujourd'hui",
                        clear: false,
                        close: "Valider",
                        labelMonthNext:"Mois suivant",
                        labelMonthPrev:"Mois précedent",
                        labelMonthSelect:"Sélectionner un mois",
                        labelYearSelect:"Sélectionner une année",
                        format: 'yyyy-mm-dd'

                    });

                    $(".datepicker2").pickadate({
                        selectMonths: true,
                        selectYears: 100,
                        min: d,
                        max: dd,
                        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                        monthsShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                        weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                        weekdaysLetter: ["D", "L", "M", "M", "J", "V", "S"],
                        today: "Aujourd'hui",
                        clear: false,
                        close: "Valider",
                        labelMonthNext:"Mois suivant",
                        labelMonthPrev:"Mois précedent",
                        labelMonthSelect:"Sélectionner un mois",
                        labelYearSelect:"Sélectionner une année",
                        format: 'yyyy-mm-dd'

                    });

                    $(".button-collapse").sideNav();

                    $(document).ready(function () {
                        $('select').material_select();
                    });

                    $(document).ready(function () {
                        $('.scrollspy').scrollSpy();
                    });

                    </script>


                </body>
                </html>
