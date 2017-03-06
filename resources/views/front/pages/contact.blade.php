@extends('layouts.app')

@section('title', 'Nous contacter')

    @section('content')
        <div class="container">
            <div class="row">

                @if (session('status'))
                    <script type="text/javascript">
                    function toast() {
                        Materialize.toast('{{ session('status') }}', 4000)
                    }
                    window.onload = toast;
                    </script>
                @endif

                <div class="col l6 m8 s12 offset-l3 offset-m2 card-panel contact">

                    <h3>Qu'est-ce qui vous amène ?</h3>
                    <p style='text-align: center;'>
                        {{
                            Html::image('public/img/contact/what.svg',
                            'Icon d\'un personnage qui s\'interroge',
                            array('class' => 'responsive-img iconS'))
                        }}
                    </p>

                    <div class="section">
                        <form role="form" method="POST" action="{{ route('contact_post') }}">
                            {{ csrf_field() }}

                            <div class="col s12{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Nom Prénom</label>
                                <input id="name" type="text" class="white col s12" placeholder="Nom Prénom" name="name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="col s12">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Adresse E-Mail</label>
                                <input id="email" type="email" class="white col s12" name="email" placeholder="E-mail"
                                value="{{ old('email') }}" required >
                                @if ($errors->has('email'))
                                    <span class="col s12">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col s12{{ $errors->has('message') ? ' has-error' : '' }}">
                                <label for="message">Message</label>
                                <textarea id="message" type="text" class="materialize-textarea white col s12" name="message" placeholder="Message"
                                autofocus required>{{ old('message') }}</textarea>
                                @if ($errors->has('message'))
                                    <span class="col s12">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="right-align">
                                <button type="submit" class="btn waves-effect waves-light white black-text">
                                    Envoyer
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    @endsection
