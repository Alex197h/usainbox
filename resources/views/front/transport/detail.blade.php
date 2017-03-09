@extends('layouts.app')

@section('title', 'Liste des Offres')

@section('content')

    <div class="row">

        <div class="col s8 offset-s2 card">
            <div class="section center">
                <h4>{!! ucfirst(utf8_encode(strftime('%A %d %B', strtotime($offer->date_start)))) !!}</h4>
                @if(isset($steps[$offer->id]))
                    @foreach($steps[$offer->id] as $step)

                        <span>{{ $step }}  @if(!$loop->last) → @endif </span>

                    @endforeach
                @endif
            </div>

            <div class="card-content">
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

                <b>Marque du véhicule:</b> {{ $vehicle->car_brand }}
                <br>

                <b>Modèle du véhicule:</b> {{ $vehicle->car_model }}
                <br>

                <b>Conducteur:</b> <a href="{{ route('profile', $user->id) }}">{{ $user->fullname }}</a>
                <br>

                <b>Note du conducteur:</b> /5
                <br>

                <b>Heure de départ:</b> {{ date('H:i', strtotime($offer->date_start)) }}
                <br>

                <b>Volume disponible:</b> {{ $offer->volume }}
                <br>

                <b>Poids maximum du colis:</b> {{ $offer->max_weight }}
                <br>

                <b>Longueur maximum du colis:</b> {{ $offer->max_length }}
                <br>

                <b>Largeur maximum du colis:</b> {{ $offer->max_width }}
                <br>

                <b>Hauteur maximum du colis:</b> {{ $offer->max_height }}
                <br>

                <?php echo ($offer->full) ? 'Véhicule plein' : '';  ?>

                <b>Description:</b>
                {{ $offer->description }}
                <br>

                <b>Détour:</b>
                {{ $offer->start_detour ? 'Aller' : '' }}
                {{ $offer->end_detour ? 'Retour' : '' }}
                <br>
            </div>
            <div class="card-action right-align">
                <a href="#" class="brown-text">Réserver l'annonce</a>
            </div>
        </div>
    </div>


@endsection
