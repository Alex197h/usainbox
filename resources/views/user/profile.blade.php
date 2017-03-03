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
                    <p>
                        <span>Inscrit le {{ utf8_encode(strftime('%A %d %B', strtotime($user->created_at))) }}</span>
                    </p>
                    <div class="col s11">
                        <nav>
                            <div class="white nav-wrapper">
                                <ul class="">
                                    <li><a href="{{route('user_vehicles')}}" class="black-text">Ajouter un vehicule</a></li>
                                    <li><a href="#" class="black-text">Liste des vehicules</a></li>
                                    <li><a href="#" class="black-text">Liste de vos annonces</a></li>
                                    <li><a href="#" class="black-text">Liste de vos reservations</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row card-panel">
                <h4>Mes informations</h4>
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
                        <button type="submit" class="btn yellow black-text right">
                            Enregistrer
                        </button>
                    </div>

                </form>
            </div>

            <div class="row">
                <div class="section center">
                    <h4>Mes véhicules</h4>
                </div>
                @foreach($vehicles as $vehicle)
                    <div class="col l4 m6 s12">
                        <div class=" card-panel">
                            <div class="section center">
                                <h5>{{ ucfirst($vehicle->car_brand) }} {{ ucfirst($vehicle->car_model) }}</h5>
                            </div>
                            <div class="section">
                                @if($vehicle->typeVehicle->id == 1)
                                    <i class="material-icons tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">directions_car</i>
                                @elseif($vehicle->typeVehicle->id == 2)
                                    <i class="material-icons tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">local_shipping</i>
                                @elseif($vehicle->typeVehicle->id == 3)
                                    <i class="material-icons tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">motorcycle</i>
                                @elseif($vehicle->typeVehicle->id == 4)
                                    <i class="material-icons tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">directions_bike</i>
                                @elseif($vehicle->typeVehicle->id == 5)
                                    <i class="material-icons tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">flight</i>
                                @elseif($vehicle->typeVehicle->id == 12)
                                    <i class="material-icons tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">directions_boat</i>
                                @else
                                    <i class="material-icons tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">directions_bus</i>
                                @endif
                                {!! ($vehicle->default) ? '<i class="material-icons tooltipped" data-tooltip="Véhicule par défaut">check_circle</i>' : '' !!}
                                <p><b>Volume:</b> {{ $vehicle->max_volume }}</p>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>


            <div class="row">
                <div class="section center">
                    <h4>Mes dernières annonces</h4>
                </div>
                @foreach($transport_offers as $offer)
                    <div class="col s12">
                        <div class=" card-panel">
                            <div class="section center">
                                <h5>{!! ucfirst(utf8_encode(strftime('%A %d %B', strtotime($offer->date_start)))) !!}</h5>
                                @if(isset($steps[$offer->id]))
                                    @foreach($steps[$offer->id] as $step)

                                        <span>{{ $step }}  @if(!$loop->last) → @endif </span>

                                    @endforeach
                                @endif
                            </div>
                            <div class="section">
                                @if($offer->is_regular)
                                    <i class="small material-icons tooltipped" data-tooltip="Trajet régulier">restore</i>
                                @else
                                    <i class="small material-icons tooltipped" data-tooltip="Trajet occasionnel">schedule</i>
                                @endif
                                @if($offer->highway)
                                    <i class="small material-icons tooltipped" data-tooltip="Autoroute">surround_sound</i>
                                @endif
                                <br>

                                <b>Heure de départ:</b> {{ date('H:i', strtotime($offer->date_start)) }}
                                <br>

                                <b>Volume:</b> {{ $offer->volume }}
                                <br>

                                <b>Description:</b>
                                {{ $offer->description }}
                                <br>

                                <b>Détour:</b>
                                {{ $offer->start_detour ? 'Aller' : '' }}
                                {{ $offer->end_detour ? 'Retour' : '' }}
                                <br>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    @endsection
