@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col l8 m10 s12 offset-l2 offset-m1 offset-s1 ">
            <div class="card-panel">
                <div class="section center">
                    <div class="section">
                        <h5>
                            Réinitialiser le mot de passe

                        </h5>
                    </div>
                </div>

                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <div class="section">
                    <form role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                        <div class="infoProfile col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Adresse E-Mail</label>
                            <input id="email" type="email" placeholder="E-mail" class="form-control" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                            <span class="col s12 error">
                                {{
                                    Html::image('public/img/notification/warning.svg',
                                    'Icon d\'un triangle attention',
                                    array('class' => 'responsive-img iconC'))
                                }}
                                <strong>
                                    {{ $errors->first('email') }}
                                </strong>
                            </span>
                            @endif
                        </div>
                        <div class="right-align">
                            <button type="submit" class="btn btnValider waves-light white-text">
                                Réinitialiser le mot de passe
                                {{
                                    Html::image('public/img/auth/refresh.svg',
                                    'Icon d\'un refresh',
                                    array('class' => 'responsive-img iconC', 'style' => 'vertical-align:middle;'))
                                }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
