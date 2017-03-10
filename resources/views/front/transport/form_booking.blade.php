@extends('layouts.app')

@section('title', 'Réserver')

@section('content')
    <form class="container card" method="post" action="">
        <div class="input-field col s12">
            <select>
                <option value="" disabled selected>Choose your option</option>
                @foreach($city_steps as $city_step)
                    <option value="" disabled selected>Choose your option</option>
                @endforeach
            </select>
            <label>Materialize Select</label>
        </div>
    </form>
@endsection