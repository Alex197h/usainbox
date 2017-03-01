@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

  <div class="row header-search ">
    <form class=" col s12" role="form" method="POST" action="{{ route('transport') }}">
      {{ csrf_field() }}
      <h4 class="col s12 white-text">Envoyez vos colis rapidement</h4>
      <div class="row">
        <div class="input-field col s12 m5 l4">
          <input id="city_start" class="white" placeholder="Ville départ" type="text" name="city_start">
          <label style="display: none;" for="city_start">Ville départ</label>
        </div>
        <div class="input-field col s12 m5 l4">
          <input id="city_end" class="white" placeholder="Ville arrivée" type="text" name="city_end">
          <label style="display: none;" for="city_end">Ville arrivée</label>
        </div>
        <div class="input-field col s12 m2 l2">
          <input type="date" name="date" class="datepicker white" placeholder="Date" value="{{ date('Y-m-d') }}">
        </div>
        <div class="input-field col s12 m6 l2">
          <button type="submit" class="col s12 btn waves-effect waves-light white black-text">
            Transporter
          </button>
        </div>
      </div>
    </form>
    <a id="scrollDown" href="#introduction" class="hide-on-small-only waves-effect waves-light transparent white-text"><i class="material-icons floating">expand_more</i></a>
  </div>

  <div class="row">
    <section id="introduction" class="center col s12 m12 l6 valign section scrollspy ">
      <h3 class="col s12 m10 offset-m1">Lorem Ipsum</h3>
      <p class="col s12 m10 offset-m1">Le Lorem Ipsum est simplement du faux texte employé dans la composition et
        la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis
        les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un
        livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi
        adapté à la bureautique informatique, sans que son contenu n'en soit modifié.
      </p>
    </section>
    <section class="col s12 m12 l6 valign home-img center-align">
      {{ Html::image('public/img/img.png', 'Lorem Ipsum', array('class' => 'responsive-img center-align')) }}
    </section>
  </div>

  <div class="col s12">
    <div class="col s12 right" id="map"></div>
    <div id="transport_offers">
      <div class="offer card horizontal">
        <div class="card-image">
          <img src="http://lorempixel.com/100/190/nature/6">
        </div>
        <div class="card-stacked">
          <div class="card-content">
            <h4>Mardi 15 mars</h4>
            <span>Paris &rarr; Gap &rarr; Aix en Provence </span>
            <i class="small material-icons tooltipped" data-tooltip="Trajet régulier">restore</i>
            <i class="small material-icons tooltipped" data-tooltip="Trajet régulier">restore</i>
            <b>Heure de départ:</b> 04:20
            <br>
            <b>Description:</b>
          </div>
          <div class="card-action">
            <a href="#">This is a link</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="col s12 m8 offset-m2 home-img" id="video-pres">
    <video class="col s12 valign" autoplay loop muted class="responsive-video">
      <source src="public/video/pres.mp4" type="video/mp4"/>
    </video>
  </section>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUTW7_sKsarvYpb8HJdG1cWptczyG3Jf0&callback=initMap&libraries=places"></script>
  <script type="text/javascript">


      var MapElement = document.getElementById('map');
      var ShowElement = document.getElementById('show');
      var Cities = <?= json_encode($transport_offers) ?>;

      var map;


      function initMap() {
          map = new google.maps.Map(MapElement, {
              center: {lng: 2.70263671875, lat: 46.255846818480315},
              navigationControl: false,
              mapTypeControl: false,
              scaleControl: false,
              draggable: true,
              scrollwheel:false,
              zoom: 6
          });

          var icon = {
              url: "http://maps.google.com/mapfiles/kml/shapes/cabs.png",
              scaledSize: new google.maps.Size(25, 25),
              origin: new google.maps.Point(0,0),
              anchor: new google.maps.Point(0, 0)
          };

          var Markers = {};
          var MarkersHidden = false;
          var MarkerClicked = false;


          var preMarkers = {};
          for(i in Cities){
              if(Cities[i][0]){
                  if(!preMarkers[Cities[i][0].label]) preMarkers[Cities[i][0].label] = [];
                  Cities[i].transport = i;
                  preMarkers[Cities[i][0].label].push(Cities[i]);
              }
          }

          for(i in preMarkers){
              var cityStart = preMarkers[i][0][0];
              var cities = preMarkers[i][0];
              var transport = [];

              if(preMarkers[i].length == 1){
                  transport.push(cities.transport);
                  delete cities.transport;
              }
              /* Else if cities are stacked */
              else {
                  for(j in preMarkers[i]){
                      transport.push(preMarkers[i][j].transport);
                      delete preMarkers[i][j].transport;

                  }
              }


              var marker = new google.maps.Marker({
                  position: {lng: cityStart.lng, lat: cityStart.lat},
                  map: map,
                  icon: icon,
                  title: cityStart.label,

                  cities: cities,
                  transport: transport,
                  showPath: false,
                  path: null,
              });

              marker.addListener('mouseover', function() {
                  for(m in Markers){
                      for(n in Markers[m]){
                          Markers[m][n].setVisible(false);
                      }
                  }
                  if(!this.path) this.path = setPath(this.cities);
                  this.setVisible(true);
                  this.path.setMap(map);
                  MarkersHidden = true;
              });

              marker.addListener('mouseout', function() {
                  if(!this.showPath){
                      for(m in Markers){
                          for(n in Markers[m]){
                              Markers[m][n].setVisible(true);
                          }
                      }
                      this.path.setMap(null);
                      MarkersHidden = false;
                  }
              });

              marker.addListener('click', function() {
                  var clone = this;
                  var offers = this.transport;

                  $.ajax({
                      url: 'ptest',
                      method: 'POST',
                      dataType: 'json',
                      data: {
                          '_token': '{{ csrf_token() }}',
                          'transport': offers,
                      },
                      success: (function(result){
                          for(m in Markers){
                              for(n in Markers[m]){
                                  Markers[m][n].setVisible(false);
                              }
                          }
                          clone.setVisible(true);
                          clone.path.setMap(map);
                          clone.showPath = true;

                          MarkersHidden = true;
                          MarkerClicked = true;


                          var div = $('#transport_offers');
                          div.html('')
                          for(r in result){
                              console.log(result[r])
                              let offer = $('<div class="offer">');
                              offer.append('<h4>'+result[r].date_start+' ('+result[r].id+')</h4>');
                              offer.append('<div>'+result[r].description+'</div>');
                              div.append(offer);
                          }
                          $("#map").animate({"width" : "60%"}, 500);
                          div.show(500);

                      })
                  });
              });

              if(!Markers[marker.title]) Markers[marker.title] = [];
              Markers[marker.title].push(marker);
          }

          map.addListener('click', function() {
              for(m in Markers){
                  for(n in Markers[m]){
                      Markers[m][n].setVisible(true);
                      Markers[m][n].showPath = false;
                      if(Markers[m][n].path){
                          Markers[m][n].path.setMap(null);
                      }
                  }
              }
              MarkerClicked = false;
              $('#transport_offers').html('').hide();
              $("#map").animate({"width" : "100%"}, 500);

          });



          /** Route */
          function setPath(cities) {
              var Directions = new google.maps.DirectionsRenderer({
                  map: null,
                  preserveViewport: true,
              });
              var origin = {lng: cities[0].lng, lat: cities[0].lat};
              var destination = {lng: cities[cities.length-1].lng, lat: cities[cities.length-1].lat};
              var waypoints = [];

              if(cities.length > 2){
                  for(var i = 1; i < cities.length-1; i++){
                      waypoints.push({location: {
                          lng: cities[i].lng,
                          lat: cities[i].lat,
                      }, stopover: true});
                  }
              }

              var request = {
                  travelMode: google.maps.DirectionsTravelMode.DRIVING,
                  avoidTolls: false,
                  origin: origin,
                  destination: destination,
                  waypoints: waypoints
              }
              var directionsService = new google.maps.DirectionsService();
              directionsService.route(request, function (response, status) {
                  if(status == google.maps.DirectionsStatus.OK) {
                      Directions.setDirections(response);
                  }
              });
              return Directions;
          }

          var options = {types: ['(cities)']};
          new google.maps.places.Autocomplete(document.getElementById('city_start'), options);
          new google.maps.places.Autocomplete(document.getElementById('city_end'), options);

      }
  </script>


@endsection
