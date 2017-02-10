@extends('layouts.app')

<!-- Main Content -->
@section('content')
    <div class="container">
        <div class="row">
            <div class="col l4 m10 s12 offset-l4 offset-m1 card-panel">
                <div class="panel-heading">Réinitialiser le mot de passe</div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="section">
                    <form role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Adresse E-Mail</label>

                            <input id="email" type="email" placeholder="E-mail" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="col s12">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <button type="submit" class="col s12 btn waves-effect waves-light white black-text">
                            Réinitialiser le mot de passe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
