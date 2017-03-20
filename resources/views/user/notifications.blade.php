@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    <div class="container">
        <div class="row card-panel">
            <h4>Notifications</h4>
            <hr>
            @foreach($offers as $offer)
                {{ $offer->steps[0]->label }} - {{ $offer->steps[count($offer->steps)-1]->label }}
                Le {{ $offer->date_start }}
                <a href="{{ route('detail_transport_offer', $offer->id) }}">Voir l'annonce</a>
                @if(!$notifs[$offer->id]->read_at)
                    <span class="new badge"></span>
                    {{ $notifs[$offer->id]->markAsRead() }}
                @endif
                <hr>

            @endforeach
        </div>
    </div>
@endsection
