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


</head>
<body>

  <header class="row" style="margin:0;">
    <nav>
      <div class="white nav-wrapper">
        <a href="{{route('home')}}" class="brand-logo">{{ Html::image('public/img/logo.png', 'UBox') }}</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse black-text"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="sass.html" class="black-text">Déposer une annonce</a></li>
          <li><a href="{{route('register')}}" class="black-text">Inscription</a></li>
          <li><a href="{{route('login')}}" class="black-text">Connexion</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li><a href="sass.html" class="black-text">Déposer une annonce</a></li>
          <li><a href="{{route('register')}}" class="black-text">Inscription</a></li>
          <li><a href="{{route('login')}}" class="black-text">Connexion</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <main class="row">
@yield('content')

  </main>


  <footer class="page-footer">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Vous pouvez nous faire confiance</h5>
          <p class="grey-text text-lighten-4">Blah blah blah blah blah blah blah blah blah</p>
        </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="white-text">Nous retrouver</h5>
          <ul>
            <li><a class="grey-text text-lighten-3" href="#!">Twitter</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Google +</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        Usain Box © 2017 Copyright
        <a class="grey-text text-lighten-4 right" href="#!">Mentions légales</a>
      </div>
    </div>
  </footer>
    <script type="text/javascript">
        $(".button-collapse").sideNav();
    </script>
</body>
</html>
