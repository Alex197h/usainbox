@extends('layouts.app')

@section('page_title', 'Listes des expéditions')

@section('content')

<div class="container">
  <div class="starter-template">

    @foreach($shippings as $shipping)
    <p>Posté par {{$shipping->$user->first_name}} {{$shipping->$user->last_name}},
      {{$shipping->max_price}}€ max, dépard le {{$shipping->fixed_date}} à {{$shipping->fixed_hour}}.</p>
  </div>

@endsection
