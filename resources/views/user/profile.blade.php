@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="container">
        <div class="row card-panel">
            <div class="col s3">
                {{
                    Html::image('public/img/avatar/default.jpg',
                    'Avatar par default de l\'utilisateur',
                    array('class' => 'responsive-img'))
                }}
            </div>
            <div class="col s9">
                <h4>{{$user->last_name}} {{$user->first_name}}</h4>
                <p>
                    <span>Inscrit le {{ utf8_encode(strftime('%A %d %B', strtotime($user->created_at))) }}</span>
                </p>

            </div>
            <div class="col s9">
                <a href="{{route('user_vehicles')}}" class="white-text">
                    <button type="button" class="btn btnProfile">
                        Ajouter un vehicule
                    </button>
                </a>

                <a href="#vehicles" class="white-text">
                    <button type="button" class="btn btnProfile">
                        Vos vehicule
                    </button>
                </a>

                <a href="#" class="white-text">
                    <button type="button" class="btn btnProfile">
                        Vos annonces
                    </button>
                </a>

                <a href="#" class="white-text">
                    <button type="button" class="btn btnProfile">
                        Vos reservations
                    </button>
                </a>

            </div>
        </div>

        <div class="row card-panel">
            <h4>Mes informations</h4>
            <form method="post" action="{{ route('update_user_profile') }}">
                {{ csrf_field() }}
                <div class="input-field infoProfile col s12 m6{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <input class="with-gap" name="gender" value="1" type="radio"
                           id="male" {{ ($user->gender) ? 'checked' : '' }}>
                    <label class="col s6" for="male">
                        {{
                            Html::image('public/img/user/man.svg',
                            'Icon du sexe masculin',
                            array('class' => 'responsive-img iconP'))
                        }}
                        Homme
                    </label>

                    <input class="with-gap" name="gender" value="0" type="radio"
                           id="female" {{ ($user->gender) ? '' : 'checked' }}>
                    <label class="col s6" for="female">
                        {{
                            Html::image('public/img/user/girl.svg',
                            'Icon du sexe feminin',
                            array('class' => 'responsive-img iconP'))
                        }}
                        Femme
                    </label>
                    @if ($errors->has('gender'))
                        <span class="col s12">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="input-field infoProfile col s12 m6{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input placeholder="Adresse e-mail" name="email" id="email" type="email" value="{{ $user->email }}">
                    <label for="email">
                        {{
                            Html::image('public/img/user/email.svg',
                            'Icon du @ pour l\'adresse email',
                            array('class' => 'responsive-img iconP'))
                        }}
                        Adresse e-mail
                    </label>

                    @if ($errors->has('email'))
                        <span class="col s12">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="input-field infoProfile col s12 m6{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <input placeholder="Numéro de téléphone" name="phone" id="phone" type="tel"
                           value="{{$user->phone}}">
                    <label for="phone">
                        {{
                            Html::image('public/img/user/phone.svg',
                            'Icon d\'un téléphone',
                            array('class' => 'responsive-img iconP'))
                        }}
                        Téléphone
                    </label>

                    @if ($errors->has('phone'))
                        <span class="col s12">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="input-field infoProfile col s12 m6{{ $errors->has('birthday') ? ' has-error' : '' }}">
                    <input placeholder="" class="datepicker" name="birthday" id="birthday" type="date"
                           value="{{$user->birthday}}">
                    <label for="birthday">
                        {{
                            Html::image('public/img/user/anniv.svg',
                            'Icon d\'un cadeau d\'anniversaire',
                            array('class' => 'responsive-img iconP'))
                        }}
                        Date de naissance
                    </label>
                    @if ($errors->has('birthday'))
                        <span class="col s12">
                                <strong>{{ $errors->first('birthday') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="input-field infoProfile col s12 m6{{ $errors->has('description') ? ' has-error' : '' }}">
                    <textarea id="description" placeholder="Description" class="materialize-textarea"
                              name="description">{{ $user->description }}</textarea>
                    <label for="description">
                        {{
                            Html::image('public/img/user/pen.svg',
                            'Icon d\'un stylo et d\'une feuille',
                            array('class' => 'responsive-img iconP'))
                        }}
                        Description
                    </label>

                    @if ($errors->has('description'))
                        <span class="col s12">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="col s12">
                    <button type="submit" class="btn btnValider white-text right">
                        Enregistrer
                    </button>
                </div>

            </form>
        </div>

        <div id="vehicles" class="row card-panel scrollspy">
            <div class="section center">
                <h4>Mes véhicules</h4>
            </div>
            @foreach($vehicles as $vehicle)
                <div class="col l4 m6 s12">
                    <div class="">
                        <div class="section center">
                            <h5>
                                @if($vehicle->default == 1)
                                    {{ Html::image('public/img/vehicles/checked.svg',
                                        'Icon validation',
                                        array('class' => 'responsive-img iconC tooltipped', 'data-tooltip' => 'Vehicule par défaut'))
                                    }}
                                @endif
                                {{ ucfirst($vehicle->car_brand) }}
                                {{ ucfirst($vehicle->car_model) }}



                            </h5>
                        </div>
                        <div class="section center">
                            @if($vehicle->typeVehicle->id == 1)
                                <p class="tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">
                                    {{ Html::image('public/img/vehicles/car.svg',
                                        'Icon d\'une voiture',
                                        array('class' => 'responsive-img iconV'))
                                    }}
                                </p>
                            @elseif($vehicle->typeVehicle->id == 2)
                                <p class="tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">
                                    {{ Html::image('public/img/vehicles/truck.svg',
                                        'Icon d\'un camion',
                                        array('class' => 'responsive-img iconV'))
                                    }}
                                </p>
                            @elseif($vehicle->typeVehicle->id == 3)
                                <p class="tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">
                                    {{ Html::image('public/img/vehicles/motorcycle.svg',
                                        'Icon d\'une moto',
                                        array('class' => 'responsive-img iconV'))
                                    }}
                                </p>
                            @elseif($vehicle->typeVehicle->id == 4)
                                <p class="tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">
                                    {{ Html::image('public/img/vehicles/bike.svg',
                                        'Icon d\'un vélo',
                                        array('class' => 'responsive-img iconV'))
                                    }}
                                </p>
                            @elseif($vehicle->typeVehicle->id == 5)
                            <p class="tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">
                                {{ Html::image('public/img/vehicles/plane.svg',
                                    'Icon d\'un avion',
                                    array('class' => 'responsive-img iconV'))
                                }}
                            </p>
                        @elseif($vehicle->typeVehicle->id == 6)
                            <p class="tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">
                                {{ Html::image('public/img/vehicles/boat.svg',
                                    'Icon d\'un bateau',
                                    array('class' => 'responsive-img iconV'))
                                }}
                            </p>
                            @else
                            <p class="tooltipped" data-tooltip="{{ $vehicle->typeVehicle->label }}">
                                {{ Html::image('public/img/vehicles/what.svg',
                                    'Icon d\'un bateau',
                                    array('class' => 'responsive-img iconV'))
                                }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

        <div class="row card-panel scrollspy">
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
                                <i class="small material-icons tooltipped"
                                   data-tooltip="Trajet occasionnel">schedule</i>
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
