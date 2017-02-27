@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col l10 m12 s12 offset-l1 card-panel">
                {{-- $errors->getBag('default')->toArray()) --}}
                <div class="section center">
                    <div class="section">
                        <h5>Inscrivez vous gratuitement</h5>
                    </div>
                    <div class="section">
                        <h6>En 2 secondes avec Facebook</h6>
                        {{--<button class="fbbtn btn blue">Connexion Facebook</button>--}}
                        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                        </fb:login-button>

                        <div id="status">
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="section">
                    <h6 class="center">En 30 secondes avec une adresse e-mail</h6>
                    <form role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="col s12 m6{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" >Nom</label>

                            <input id="last_name" type="text" class="form-control" placeholder="Nom" name="last_name" value="{{ old('last_name') }}" required autofocus>

                            @if ($errors->has('last_name'))
                                <span class="col s12">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col s12 m6{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name">Prénom</label>

                            <input id="first_name" type="text" class="form-control" placeholder="Prénom" name="first_name" value="{{ old('first_name') }}" required autofocus>

                            @if ($errors->has('first_name'))
                                <span class="col s12">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col s12 m6{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <input id="email" type="email" class="form-control" placeholder="E-Mail" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="col s12">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col s12 m6{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Téléphone</label>

                            <input id="phone" type="tel" class="form-control" placeholder="Téléphone" name="phone" value="{{ old('phone') }}" required>

                            @if ($errors->has('phone'))
                                <span class="col s12">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col s12{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mot de passe</label>

                            <input id="password" placeholder="Mot de passe" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="col s12">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col s12">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmer le mot de passe</label>
                            <input id="password-confirm" placeholder="Confirmer le mot de passe" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <p class="col s12 m6{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <input class="with-gap" name="gender" value="1" type="radio" id="male" checked>
                            <label class="col s6" for="male">Homme</label>
                            <input class="with-gap" name="gender" value="0" type="radio" id="female">
                            <label class="col s6" for="female">Femme</label>
                            @if ($errors->has('gender'))
                                <span class="col s12">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </p>

                        <div class="col s12 m6{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="birthday">Date de naissance</label>
                            <input type="date" placeholder="Date de naissance" class="datepicker" id="birthday" name="birthday" value="{{ old('birthday') }}">
                            @if ($errors->has('birthday'))
                                <span class="col s12">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="right-align">
                            <button type="submit" class=" btn waves-effect waves-light white black-text">
                                S'enregistrer
                            </button>
                        </div>
                        <p>En cliquant sur S'enregistrer, vous certifiez avoir 18 ans et plus et vous acceptez les <a href="#">Conditions Générales d'Utilisation</a> de Usain Box.</p>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
