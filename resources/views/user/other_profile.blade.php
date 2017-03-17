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
            <div class="col s9">
                <h4>{{$user->fullname}} <small>({{ $user->shipping_note }}/5) ({{ $user->transport_note }}/5)</small></h4>
                <p><span>Inscrit le {{ utf8_encode(strftime('%A %d %B', strtotime($user->created_at))) }}</span></p>
                <p>Né le {{$user->birthday}}</p>
                <p>{{ $user->description }}</p>
                <a href="mailto:{{ $user->email }}" class="btn">Contacter {{ $user->fullname }}</a>
                <p>(Si vous n'avez pas d'application de messagerie : {{ $user->email }})</p>
            </div>
        </div>


    </div>
@endsection
