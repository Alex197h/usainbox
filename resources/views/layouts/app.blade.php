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
      <div class="col l4">
        <h5 class="white-text">Informations</h5>
        <ul>
          <li><a class="grey-text text-lighten-3" href="{{route('register')}}">Devenir membre</a></li>
          <li><a class="grey-text text-lighten-3" href="{{route('about')}}" class="black-text">Comment ça marche ?</a></li>
          <li><a class="grey-text text-lighten-3" href="#" class="black-text">A quoi ça sert ?</a></li>
          <li><a class="grey-text text-lighten-3" href="#" class="black-text">Plan du site</a></li>
        </ul>
      </div>
      <div class="col l4">
        <h5 class="white-text">Accès rapide</h5>
        <ul>
          <li><a class="grey-text text-lighten-3" href="{{route('contact')}}">Nous contacter</a></li>
          <li><a class="grey-text text-lighten-3" href="#">Mentions légales</a></li>
          <li><a class="grey-text text-lighten-3" href="#">Conditions générales</a></li>
          <li><a class="grey-text text-lighten-3" href="#">Charte</a></li>
        </ul>
      </div>
      <div class="col l4 ">
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

<script>
var Villes = {
  Gap: {
    lat: 44.559638,
    lng: 6.079758
  },
  Vars: {
    lat: 44.57207367490651,
    lng: 6.680030822753906
  },
  Tallard: {
    lat: 44.46153683560693,
    lng: 6.055011749267578
  },
  Sisteron: {
    lat: 44.19500528245342,
    lng: 5.943045616149902
  },
  Briancon: {
    lat: 44.89926459675508,
    lng: 6.6432952880859375
  },
  Hyeres: {
    lat: 43.118841028558776,
    lng: 6.128911972045898
  },
  Toulon: {
    lat: 43.124228780989085,
    lng: 5.92987060546875
  },
  Quincy: {
    lat: 47.13377541734805,
    lng: 2.1560239791870117
  },
  Orleans: {
    lat: 47.90667693563599,
    lng: 1.9095611572265625
  },
  Paris: {
    lat: 48.8511618571692,
    lng: 2.3565673828125
  },
  Bordeaux: {
    lat: 44.83834308566653,
    lng: -0.569915771484375
  },
  NewYork: {
    lat: 40.69521661351715,
    lng: -73.9984130859375
  },
  Bogota: {
    lat: 4.688666902768214,
    lng: -74.06707763671875
  },
}

function getPos(ville) {
  return {lat: Villes[ville].lat, lng: Villes[ville].lng};
}

var map;
var coords = getPos('Gap');

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: coords,
    scrollwheel: false,
    navigationControl: false,
    mapTypeControl: false,
    scaleControl: false,
    draggable: true,
    zoom: 10
  });
  var marker = new google.maps.Marker({
    position: coords,
    map: map,
    title: 'Hello World!'
  });
  var infoWindow = new google.maps.InfoWindow({map: map});
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      infoWindow.setPosition(pos);
      map.setCenter(pos);
    }, function () {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    handleLocationError(false, infoWindow, map.getCenter());
  }

  var ClickPos = false;
  if (ClickPos) {
    google.maps.event.addListener(map, "click", function (event) {
      var latitude = event.latLng.lat();
      var longitude = event.latLng.lng();
      console.log(latitude + ', ' + longitude);
      radius = new google.maps.Circle({
        map: map,
        radius: 100,
        center: event.latLng,
        fillColor: '#777',
        fillOpacity: 0.1,
        strokeColor: '#AA0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        scrollwheel: false,
        navigationControl: false,
        draggable: true,    // Dragable
        editable: true      // Resizable
      });
      map.panTo(new google.maps.LatLng(latitude, longitude));
    });
  }

  function addRoute(origin, destination) {
    direction = new google.maps.DirectionsRenderer({
      map: map,
      panel: document.getElementById('map')
    });
    var request = {
      origin: origin,
      destination: destination,
      travelMode: google.maps.DirectionsTravelMode.DRIVING,
      avoidTolls: false,
      waypoints: [
        {location: getPos('Bordeaux'), stopover: true},
        {location: getPos('Toulon'), stopover: true},
        {location: getPos('Briancon'), stopover: true},
        {location: getPos('Orleans'), stopover: true},
        {location: getPos('Hyeres'), stopover: true},
        {location: getPos('Quincy'), stopover: true},
      ]
    }
    var directionsService = new google.maps.DirectionsService();
    directionsService.route(request, function (response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        direction.setDirections(response);
      }
    });
  }
  addRoute(getPos('Gap'), getPos('Paris'));
  var options = {types: ['(cities)']};
  new google.maps.places.Autocomplete(document.getElementById('city_start'), options);
  new google.maps.places.Autocomplete(document.getElementById('city_end'), options);
}

/** Récupérer les positions actuelles */
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesn\'t support geolocation.');
}
</script>

</body>
</html>
