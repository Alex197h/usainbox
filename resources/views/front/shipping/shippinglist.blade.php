@extends('layouts.app')

@section('page_title', 'Listes des expéditions')

@section('content')

  <div class="row">
      <div class="col l6 m10 s10 offset-l3 offset-m1 offset-s1 z-depth-1 login-form">
              <div class="section">
        @foreach($shippings as $shipping)
            <div class="card-panel cyan lighten-5">
                <br>

                <b>Posté par:</b>
                {{$shipping->user->first_name}} {{$shipping->user->last_name}}
                <br>

                <b>Date:</b> Le {{ date('d/m/Y', strtotime($shipping->fixed_date)) }} à {{ date('H:i:s', strtotime($shipping->fixed_hour)) }}
                <br>

                <b>Description:</b>
                {{ $shipping->description }}
                <br>

                <b>Volume:</b>
                {{ $shipping->getVolumeAttribute() }} L
                <br>

                <b>Poid:</b>
                {{ $shipping->max_weight }} kg
                <br>

                <b>Prix maximum</b>
                {{$shipping->max_price}}€
                <br>

            </div>

        @endforeach
      </div>
    </div>
  </div>

@endsection
