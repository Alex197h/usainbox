@extends('layouts.app')

@section('title', 'Profil')

    @section('content')
        <div class="container">
            <div class="row card-panel">
                <div class="col s3">

                    {{ Html::image('public/img/avatar/default.jpg', 'UBox', array('class' => 'responsive-img')) }}
                </div>
                <div class="col s9">
                    <h4>{{$user->last_name}} {{$user->first_name}}</h4>
                    <p><span>Inscrit le {{ utf8_encode(strftime('%A %d %B', strtotime($user->created_at))) }}</span></p>
                </div>
            </div>

            <div class="row card-panel">
                <h2>Mes informations</h2>
                <form method="post" action="{{ route('update_user_profile') }}">

                    {{ csrf_field() }}

                    <div class="input-field col s12 m6{{ $errors->has('gender') ? ' has-error' : '' }}">
                        <input class="with-gap" name="gender" value="1" type="radio" id="male" {{ ($user->gender) ? 'checked' : '' }}>
                        <label class="col s6" for="male">
                            {{ Html::image('public/img/user/man.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
                            Homme
                        </label>

                        <input class="with-gap" name="gender" value="0" type="radio" id="female" {{ ($user->gender) ? '' : 'checked' }}>
                        <label class="col s6" for="female">
                            {{ Html::image('public/img/user/girl.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
                            Femme
                        </label>


                        @if ($errors->has('gender'))
                            <span class="col s12">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-field col s12 m6{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input placeholder="Adresse e-mail" name="email" id="email" type="email" value="{{ $user->email }}">
                        <label for="email">
                            {{ Html::image('public/img/user/email.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
                            Adresse e-mail
                        </label>

                        @if ($errors->has('email'))
                            <span class="col s12">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field col s12 m6{{ $errors->has('birthday') ? ' has-error' : '' }}">
                        <input placeholder="" class="datepicker" name="birthday" id="birthday" type="date" value="{{$user->birthday}}">
                        <label for="birthday" class="hide">
                            {{ Html::image('public/img/user/anniv.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
                            Date de naissance
                        </label>

                        @if ($errors->has('birthday'))
                            <span class="col s12">
                                <strong>{{ $errors->first('birthday') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-field col s12 m6{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <input placeholder="Numéro de téléphone" name="phone" id="phone" type="tel" value="{{$user->phone}}">
                        <label for="phone">
                            {{ Html::image('public/img/user/phone.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
                            Téléphone
                        </label>

                        @if ($errors->has('phone'))
                            <span class="col s12">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field col s12 m6{{ $errors->has('description') ? ' has-error' : '' }}">
                        <textarea id="description" placeholder="Description" class="materialize-textarea" name="description">{{ $user->description }}</textarea>
                        <label for="description">
                            {{ Html::image('public/img/user/pen.png', 'Lorem Ipsum', array('class' => 'responsive-img')) }}
                            Description
                        </label>

                        @if ($errors->has('description'))
                            <span class="col s12">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col s12">
                        <button type="submit" class="btn jaune black-text right">
                            Enregistrer
                        </button>
                    </div>

                </form>
            </div>

        </div>
    @endsection
