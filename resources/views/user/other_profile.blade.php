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
                <p><span>Inscrit le {{ utf8_encode(strftime('%A %d %B', strtotime($user->created_at))) }}</span></p>
                <p>Né le {{$user->birthday}}</p>
                <p>{{ $user->description }}</p>
            </div>
        </div>

        

    </div>
@endsection