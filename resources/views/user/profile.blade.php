@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="container">


        @if (session('message'))
            <script type="text/javascript">
                function toast() {
                    Materialize.toast('{{ session('message') }}', 4000)
                }
                window.onload = toast;
            </script>
        @endif


        <form method="post" action="{{ route('update_user_profile') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row card-panel">

                <div class="col s3">
                    {{
                        Html::image($user->avatar_path,
                        'Avatar par default de l\'utilisateur',
                        array('class' => 'responsive-img'))
                    }}
                    <div class=" file-field input-field">
                        <div class="btn btnProfile">
                            <span>Modifier votre photo</span>
                            <input name="avatar" type="file">
                        </div>
                        <div class="file-path-wrapper hide">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </div>

                <div class="col s9">
                    <h4>{{$user->last_name}} {{$user->first_name}} <small>({{ $user->note }}/5)</small></h4>
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

                    <a href="{{ route('my_ads') }}" class="white-text">
                        <button type="button" class="btn btnProfile">
                            Vos annonces
                        </button>
                    </a>

                    <a href="{{ route('my_bookings') }}" class="white-text btn btnProfile">
                        Vos reservations @if($reservations > 0)
                            <div class="chip"> {{ $reservations }}</div>@endif
                    </a>

                    <a href="{{ route('my_reviews') }}" class="white-text">
                        <button type="button" class="btn btnProfile">
                            Vos avis
                        </button>
                    </a>

                </div>
            </div>

            <div class="row card-panel">
                <h4>Mes informations</h4>


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
                    <input placeholder="" class="datepicker2" name="birthday" id="birthday" type="date"
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


                <div class="input-field infoProfile col s12 m6{{ $errors->has('help_charge') ? ' has-error' : '' }}">
                    <input class="with-gap" name="charge" value="1" type="radio"
                           id="help_charge" {{ ($user->help_charge) ? 'checked' : '' }}>
                    <label class="col s6" for="help_charge">

                        Aide pour porter les colis
                    </label>

                    <input class="with-gap" name="charge" value="0" type="radio"
                           id="not_help_charge" {{ ($user->help_charge) ? '' : 'checked' }}>
                    <label class="col s6" for="not_help_charge">

                        N'aide pas pour porter les colis
                    </label>
                    @if ($errors->has('help_charge'))
                        <span class="col s12">
                                <strong>{{ $errors->first('help_charge') }}</strong>
                            </span>
                    @endif
                </div>


                <div class="col s12">
                    <button type="submit" class="btn btnValider white-text right">
                        Enregistrer
                    </button>
                </div>



            </div>
        </form>
        <div id="vehicles" class="row card-panel scrollspy">
            <div class="section center">
                <h4>Mes véhicules</h4>
            </div>

            @if(!$vehicles->isEmpty())

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
                                <a class="tooltipped" data-tooltip="Éditer le véhicule"
                                   href="{{ route('modify_vehicle', $vehicle->id) }}">
                                    {{ Html::image('public/img/user/file.svg',
                                        'Icon d\'un fichier',
                                        array('class' => 'responsive-img icon'))
                                    }}
                                </a>
                                <a class="tooltipped" data-tooltip="Supprimer le véhicule">
                                    {{ Html::image('public/img/user/dustbin.svg',
                                        'Icon d\'une poubelle',
                                        array('class' => 'responsive-img icon deletevehicle', 'data-id' => $vehicle->id))
                                    }}
                                </a>
                            </div>
                        </div>
                    </div>

                @endforeach

            @else
                <div class="section center">
                    <p>
                        {{ Html::image('public/img/vehicles/warning.svg',
                            'Icon d\'un panneau de signalisation',
                            array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                        }}
                        Vous n'avez pas encore ajouté de véhicule. Vous pouvez en ajouter en
                        <a href="{{route('user_vehicles')}}">cliquant ici</a>.
                        {{ Html::image('public/img/vehicles/warning.svg',
                            'Icon d\'un panneau de signalisation',
                            array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                        }}
                    </p>
                </div>
            @endif
        </div>

        <div class="card-panel center">
            <div class="row">
                <div class="col s12">
                    <h4>Supprimer définitivement votre compte</h4>
                </div>
                <div class="col s12">
                    <button class="deleteprofile btn red">
                        Supprimer le compte
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script>
        $('.deletevehicle').on('click', function () {
            var id = $(this).attr('data-id');
            var r = confirm("Etes-vous sûr de vouloir supprimer le véhicule ?");
            if (r == true) {
                location.href = '{{ route('delete_vehicle')}}' + '/' + id;
            }
        });
        $('.deleteprofile').on('click', function () {
            var r = confirm("Etes-vous sûr de vouloir supprimer votre compte ?");
            if (r == true) {
                location.href = '{{ route('delete_auth_profile')}}'
            }
        });

    </script>

@endsection
