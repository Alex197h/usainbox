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
    #map { height: 60vh; }
    </style>
    <script type="text/javascript">
    function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            console.log(response.authResponse.userID);
            testAPI(response.authResponse.userID);
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            document.getElementById('status').innerHTML = 'Please log ' +
            'into this app.';
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            document.getElementById('status').innerHTML = 'Please log ' +
            'into Facebook.';
        }
    }

    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }

    window.fbAsyncInit = function() {
        FB.init({
            appId: '1925930890968265',
            cookie: true,  // enable cookies to allow the server to access
            // the session
            xfbml: true,  // parse social plugins on this page
            version: 'v2.8' // use graph api version 2.8
        });

        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });

    };

    // Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    function testAPI(user_id) {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/' + user_id, function(response) {
            console.log(response);
            console.log('Successful login for: ' + response.name);
            document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
            FB.api("/" + response.id, function (response) {
                if (response && !response.error) {
                    console.log(response);
                }
            }
        );
    });

}
</script>
</head>
<body>

    <header class="row" style="margin:0;">
        <nav>
            <div class="white nav-wrapper">
                <a href="{{route('home')}}" class="brand-logo">{{ Html::image('public/img/logo.png', 'UBox') }}</a>
                <a href="#" data-activates="mobile-demo" class="button-collapse black-text"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    @if (Auth::check())
                        <li><a href="{{route('login')}}" class="black-text">Déposer une annonce</a></li>
                        <li><a href="{{route('logout')}}" class="black-text">Déconnexion</a></li>
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li><a href="{{route('login')}}" class="black-text">Déposer une annonce</a></li>
                        <li><a href="{{route('logout')}}" class="black-text">Déconnexion</a></li>
                    </ul>
                @else
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
                    <li><a class="grey-text text-lighten-3" href="#" class="black-text">A quoi ça sert ?</a></li>
                    <li><a class="grey-text text-lighten-3" href="#">Charte de bonne conduite</a></li>

                </ul>
            </div>
            <div class="col l3">
                <h5 class="white-text">À propos</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#">Qui sommes nous ?</a></li>
                    <li><a class="grey-text text-lighten-3" href="{{route('page', 'contact')}}">Nous contacter</a></li>

                </ul>
            </div>
            <div class="col l3">
                <h5 class="white-text">Mention légales</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#">Conditions générales</a></li>
                    <li><a class="grey-text text-lighten-3" href="#">Politique de Confidentialité</a></li>
                    <li><a class="grey-text text-lighten-3" href="#">Utilisation des cookies</a></li>

                </ul>
            </div>
            <div class="col l3 ">
                <h5 class="white-text">Suivez-nous</h5>

                <ul>
                    <li style="display:inline;">
                        <a class="grey-text text-lighten-3 " href="https://twitter.com/UBox12" target="_blank">
                            {{ Html::image('public/img/twitter.png', 'Lorem Ipsum', array('class' => 'responsive-img valign', 'style' => 'margin-right: 8px;')) }}
                        </a>
                    </li>

                    <li style="display:inline;">
                        <a class="grey-text text-lighten-3 " href="https://www.facebook.com/UBox-1837407246530068/" target="_blank">
                            {{ Html::image('public/img/facebook.png', 'Lorem Ipsum', array('class' => 'responsive-img valign', 'style' => 'margin-right: 8px;')) }}
                        </a>
                    </li>

                    <li style="display:inline;">
                        <a class="grey-text text-lighten-3 " href="https://plus.google.com/u/3/109901738787479044420" target="_blank">
                            {{ Html::image('public/img/google.png', 'Lorem Ipsum', array('class' => 'responsive-img valign', 'style' => 'margin-right: 8px;')) }}
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
