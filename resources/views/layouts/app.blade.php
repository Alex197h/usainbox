<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Usain Box - @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{ Html::style('public/css/style.css') }}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    <style type="text/css">
    html, body { height: 100%; margin: 0; padding: 0; }
    </style>
    {{--<script type="text/javascript">--}}
    {{--function statusChangeCallback(response) {--}}
        {{--console.log('statusChangeCallback');--}}
        {{--console.log(response);--}}
        {{--// The response object is returned with a status field that lets the--}}
        {{--// app know the current login status of the person.--}}
        {{--// Full docs on the response object can be found in the documentation--}}
        {{--// for FB.getLoginStatus().--}}
        {{--if (response.status === 'connected') {--}}
            {{--// Logged into your app and Facebook.--}}
            {{--console.log(response.authResponse.userID);--}}
            {{--testAPI(response.authResponse.userID);--}}
        {{--} else if (response.status === 'not_authorized') {--}}
            {{--// The person is logged into Facebook, but not your app.--}}
            {{--document.getElementById('status').innerHTML = 'Please log ' +--}}
            {{--'into this app.';--}}
        {{--} else {--}}
            {{--// The person is not logged into Facebook, so we're not sure if--}}
            {{--// they are logged into this app or not.--}}
            {{--document.getElementById('status').innerHTML = 'Please log ' +--}}
            {{--'into Facebook.';--}}
        {{--}--}}
    {{--}--}}

    {{--function checkLoginState() {--}}
        {{--FB.getLoginStatus(function(response) {--}}
            {{--statusChangeCallback(response);--}}
        {{--});--}}
    {{--}--}}

    {{--window.fbAsyncInit = function() {--}}
        {{--FB.init({--}}
            {{--appId: '1925930890968265',--}}
            {{--cookie: true,  // enable cookies to allow the server to access--}}
            {{--// the session--}}
            {{--xfbml: true,  // parse social plugins on this page--}}
            {{--version: 'v2.8' // use graph api version 2.8--}}
        {{--});--}}

        {{--FB.getLoginStatus(function(response) {--}}
            {{--statusChangeCallback(response);--}}
        {{--});--}}

    {{--};--}}

    {{--// Load the SDK asynchronously--}}
    {{--(function(d, s, id) {--}}
        {{--var js, fjs = d.getElementsByTagName(s)[0];--}}
        {{--if (d.getElementById(id)) return;--}}
        {{--js = d.createElement(s); js.id = id;--}}
        {{--js.src = "//connect.facebook.net/en_US/sdk.js";--}}
        {{--fjs.parentNode.insertBefore(js, fjs);--}}
    {{--}(document, 'script', 'facebook-jssdk'));--}}

    {{--// Here we run a very simple test of the Graph API after login is--}}
    {{--// successful.  See statusChangeCallback() for when this call is made.--}}
    {{--function testAPI(user_id) {--}}
        {{--console.log('Welcome!  Fetching your information.... ');--}}
        {{--FB.api('/' + user_id, function(response) {--}}
            {{--console.log(response);--}}
            {{--console.log('Successful login for: ' + response.name);--}}
            {{--document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';--}}
            {{--FB.api("/" + response.id, function (response) {--}}
                {{--if (response && !response.error) {--}}
                    {{--console.log(response);--}}
                {{--}--}}
            {{--}--}}
        {{--);--}}
    {{--});--}}

{{--}--}}
{{--</script>--}}
</head>
<body>
    <?php
        $User = Auth::user();
    ?>
    <header class="row navbar-fixed" style="margin:0;">

        <ul id="dropdown1" class="dropdown-content">
            <li><a href="{{route('user_profile')}}">Profil</a></li>
            <li class="divider"></li>
            <li><a href="{{route('user_vehicles')}}">Ajouter un vehicule</a></li>
            <li class="divider"></li>
            <li><a href="#">Vos annonces</a></li>
            <li class="divider"></li>
            <li><a href="#">Vos réservations</a></li>
            <li class="divider"></li>
            <li><a href="#">Créer une alerte</a></li>
            <li class="divider"></li>
            <li><a href="{{route('logout')}}">Se déconnecter</a></li>
        </ul>

        <nav>
            <div class="white nav-wrapper">
                <a href="{{route('home')}}" class="brand-logo">{{ Html::image('public/img/logo.png', 'UBox') }}</a>
                <a href="#" data-activates="mobile-demo" class="button-collapse black-text"><i class="material-icons">menu</i></a>
                @if (Auth::check())
                    <ul class="right hide-on-med-and-down">
                        <li><a href="#" class="black-text"> Rechercher</a></li>
                        <li><a href="{{route('create_transport_offer')}}" class="black-text">Déposer une annonce</a></li>
                        <li><a class="dropdown-button black-text" href="#!" data-activates="dropdown1">{{$User->last_name}} {{$User->first_name}}<i class="material-icons right">arrow_drop_down</i></a></li>
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li><a href="#" class="black-text"> Rechercher</a></li>
                        <li><a href="{{route('login')}}" class="black-text">Déposer une annonce</a></li>
                        <li><a href="{{route('user_profile')}}">Profil</a></li>
                        <li><a href="{{route('user_vehicles')}}">Ajouter un vehicule</a></li>
                        <li><a href="#">Vos annonces</a></li>
                        <li><a href="#">Vos réservations</a></li>
                        <li><a href="{{route('logout')}}">Se déconnecter</a></li>
                    </ul>
                @else
                    <ul class="right hide-on-med-and-down">
                        <li><a href="{{route('login')}}" class="black-text">Déposer une annonce</a></li>
                        <li><a href="{{route('register')}}" class="black-text">Inscription</a></li>
                        <li><a href="{{route('login')}}" class="black-text">Connexion</a></li>
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li><a href="{{route('login')}}" class="black-text">Déposer une annonce</a></li>
                        <li><a href="{{route('register')}}" class="black-text">Inscription</a></li>
                        <li><a href="{{route('login')}}" class="black-text">Connexion</a></li>
                    </ul>
                @endif
            </div>
        </nav>
    </header>

    <main class="row">
        @yield('content')

    </main>

    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l3">
                    <h5 class="white-text">Informations</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="{{route('page', 'about')}}" class="black-text">Comment ça marche ?</a></li>
                        <li><a class="grey-text text-lighten-3" href="{{route('page', 'what')}}" class="black-text">A quoi ça sert ?</a></li>
                        <li><a class="grey-text text-lighten-3" href="{{route('page', 'charter')}}">Charte de bonne conduite</a></li>

                    </ul>
                </div>
                <div class="col l3">
                    <h5 class="white-text">À propos</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="{{route('page', 'who')}}">Qui sommes nous ?</a></li>
                        <li><a class="grey-text text-lighten-3" href="{{route('contact')}}">Nous contacter</a></li>

                    </ul>
                </div>
                <div class="col l3">
                    <h5 class="white-text">Mention légales</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="{{route('page', 'conditions')}}">Conditions générales</a></li>
                        <li><a class="grey-text text-lighten-3" href="{{route('page', 'privacy')}}">Politique de confidentialité</a></li>
                        <li><a class="grey-text text-lighten-3" href="{{route('page', 'cookies')}}">Utilisation des cookies</a></li>

                    </ul>
                </div>
                <div class="col l3 ">
                    <h5 class="white-text">Suivez-nous</h5>

                    <ul>
                        <li style="display:inline;">
                            <a class="grey-text text-lighten-3 " href="https://twitter.com/UBox12" target="_blank">
                                {{ Html::image('public/img/social/twitter.svg', 'Lorem Ipsum', array('class' => 'responsive-img valign iconR', 'style' => 'margin-right: 8px;')) }}
                            </a>
                        </li>

                        <li style="display:inline;">
                            <a class="grey-text text-lighten-3 " href="https://www.facebook.com/UBox-1837407246530068/" target="_blank">
                                {{ Html::image('public/img/social/facebook.svg', 'Lorem Ipsum', array('class' => 'responsive-img valign iconR', 'style' => 'margin-right: 8px;')) }}
                            </a>
                        </li>

                        <li style="display:inline;">
                            <a class="grey-text text-lighten-3 " href="https://plus.google.com/u/3/109901738787479044420" target="_blank">
                                {{ Html::image('public/img/social/google.svg', 'Lorem Ipsum', array('class' => 'responsive-img valign iconR', 'style' => 'margin-right: 8px;')) }}
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

    $(".button-collapse").sideNav();

    $(document).ready(function() {
        $('select').material_select();
    });

    $(document).ready(function () {
        $('.scrollspy').scrollSpy();
    });

    </script>


</body>
</html>
