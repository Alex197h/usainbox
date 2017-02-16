@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

<div class="row header-search ">
  <form class=" col s12" role="form" method="POST" action="{{ route('transport') }}">
    {{ csrf_field() }}
    <h4 class="col s12 white-text">Envoyez vos colis rapidement</h4>
    <div class="row">
      <div class="input-field col s12 m5 l3">
        <input id="city_start" class="white" placeholder="Ville départ" type="text" name="city_start">
        <label style="display: none;" for="city_start">Ville départ</label>
      </div>
      <div class="input-field col s12 m5 l3">
        <input id="city_end" class="white" placeholder="Ville arrivée" type="text" name="city_end">
        <label style="display: none;" for="city_end">Ville arrivée</label>
      </div>
      <div class="input-field col s12 m2 l2">
        <input type="date" class="datepicker white" placeholder="Date">
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

<div id="map"></div>

<section class="col s12 m8 offset-m2 home-img" id="video-pres">
  <video class="col s12 valign" autoplay loop muted class="responsive-video">
    <source src="public/video/pres.mp4" type="video/mp4"/>
  </video>
</section>

@endsection
