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
                <p><span>Type de membre : {{ ($user->is_transporter) ? 'Transporteur' : 'Expéditeur' }}</span></p>
                <p><span>Inscrit le {{ $user->created_at->format('d F Y') }}</span></p>
            </div>
        </div>

        <div class="row card-panel">
            <h2>Mes informations</h2>
            <form>

                <p class="input-field col s12 m6">
                    <input class="with-gap" name="gender" value="1" type="radio" id="male" {{ ($user->gender) ? 'checked' : '' }}>
                    <label class="col s6" for="male">Homme</label>
                    <input class="with-gap" name="gender" value="0" type="radio" id="female" {{ ($user->gender) ? '' : 'checked' }}>
                    <label class="col s6" for="female">Femme</label>
                </p>
                <div class="input-field col s12 m6">
                    <input placeholder="Adresse e-mail" name="mail" id="mail" type="email" value="{{ $user->email }}">
                    <label for="mail">Adresse e-mail</label>
                </div>
                <div class="input-field col s12 m6">
                    <input placeholder="Numéro de téléphone" name="tel" id="tel" type="tel" value="{{$user->phone}}">
                    <label for="tel">Téléphone</label>
                </div>
                <div class="input-field col s12 m6">
                    <input placeholder="Date de naissance" class="datepicker" name="birth" id="birth" type="date" value="{{$user->birthday}}">
                    <label for="birth">Date de naissance</label>
                </div>
                <div class="input-field col s12 m6">
                    <textarea id="description" placeholder="Description" class="materialize-textarea" name="description">{{ $user->description }}</textarea>
                    <label for="description">Description</label>
                </div>
                <button type="submit" class="btn waves-effect waves-light white black-text col s12">
                    Enregistrer
                </button>
            </form>
        </div>

    </div>
@endsection