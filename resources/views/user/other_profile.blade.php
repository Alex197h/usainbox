@extends('layouts.app')

@section('title', $user->first_name.' '.$user->last_name)

@section('content')
    <div class="container">
        <div class="row card-panel">
            <div class="col s3">

                {{
                    Html::image($user->avatar_path,
                    'Avatar de l\'utilisateur',
                    array('class' => 'responsive-img'))
                }}
            </div>
            <div class="col s8">
                <h4>{{$user->fullname}} <small>({{ date('Y') - date('Y', strtotime($user->birthday)) }} ans)</small></h4>
                <p><span>Inscrit le {{ utf8_encode(strftime('%A %d %B', strtotime($user->created_at))) }}</span></p>
                <h5 class="col s9 m3">
                    {{
                        Html::image('public/img/legende/E.svg',
                        'Icon d\'un volant',
                        array('class' => 'responsive-img iconC tooltipped', 'data-tooltip' => 'Note expéditeur'))
                    }}
                    {{ $user->shipping_note }}/5
                </h5>
                <h5 class="col s9 m3">
                    {{
                        Html::image('public/img/legende/T.svg',
                        'Icon d\'un colis',
                        array('class' => 'responsive-img iconC tooltipped', 'data-tooltip' => 'Note transporteur'))
                    }}
                    {{ $user->transport_note }}/5
                </h5>
            </div>
            <div class="col s8">
                <p>{{ $user->description }}</p>
                <br><br>
                <p>Vous pouvez contacter {{ $user->fullname }} à l'adresse suivante : <strong>{{ $user->email }}</strong></p>
            </div>
        </div>


    </div>
@endsection
