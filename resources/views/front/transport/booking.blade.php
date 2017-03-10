@extends('layouts.app')

@section('title', 'Réserver')

@section('content')
    <div class="valign-wrapper">
        <h5 class="valign">Contactez le conducteur pour fixer un prix</h5>
        <span><i class="large material-icons">phone</i> <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></span>
    </div>
@endsection