@extends('layouts.app')

@section('title', '404')

  @section('content')
    <div class="container">
      <div class="row">
        <div class="col l6 m8 s12 offset-l3 offset-m2 ">
          <h3 style="text-align:center;">Oops ! Vous êtes perdu ?</h3>
          <div class="section">
            <section class="col s8 offset-s2">
              <p style="text-align : justify;">Nous sommes désolés mais la page que vous demandez n'existe pas.
                Si vous êtes arrivés ici depuis notre site, merci de le signaler en nous écrivant à <strong>uboxcovoiturage@gmail.com</strong>.
                <br>
                Merci ☺</p>
              </section>
              <section class="col s6 offset-s3">
                {{ Html::image('public/img/erreur/404.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
              </section>
            </div>
          </div>
        </div >

      @endsection
