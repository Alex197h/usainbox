@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col l6 m8 s12 offset-l3 offset-m2 card-panel">
                <div class="section center">
                    <div class="section">
                        <h5>Connectez vous rapidement</h5>
                    </div>
                    <h6>En 2 secondes avec Facebook</h6>
                    <a href="{{url('/auth/facebook')}}" class="btn btnValider btn-link">Facebook</a>
                </div>

                <div class="divider"></div>

                <div class="section">
                    <form role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Adresse E-Mail</label>
                            <input id="email" type="email" class="white col s12" name="email" placeholder="E-mail"
                                   value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="col s12">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col s12{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Mot de passe</label>
                            <input id="password" type="password" class="white col s12" placeholder="Mot de passe"
                                   name="password" required>

                            @if ($errors->has('password'))
                                <span class="col s12">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <p class="col s12">
                            <input type="checkbox" name="remember" id="remember"/>
                            <label for="remember"> Se souvenir de moi</label>
                        </p>
                        <div class="col s12">
                            <button type="submit" class="btn btnValider col s12 waves-light white-text">
                                Se connecter
                            </button>
                        </div>
                        <div class="right-align">
                            <a href="{{ url('/password/reset') }}" class="btn-flat right-align">
                                Mot de passe oublié ?
                            </a>
                        </div>
                    </form>
                </div>

                <div class="divider"></div>

                <div class="section">
                    <p><strong>Pas encore membre ?</strong></p>
                    <a href="{{url('/register')}}">Inscrivez-vous gratuitement</a>
                </div>

            </div>
        </div>
    </div>
@endsection
