@if(Auth::check())
    Bonjour {{Auth::user()->login}}
@endif

@if($error)
    Error: {{$error}}
@endif
@if(session()->has('connexion'))
    Vous etes maintenant connecté
@endif
@if(session()->has('deconnexion'))
    Vous etes maintenant déconnecté
@endif
<form method="post" action="">
    <input name="login">
    <input name="password" type="password">
    <input name="send" value="Connexion" type="submit">
    {!! csrf_field() !!}
</form>
<form method="post" action="{{url('user/deconnexion')}}">
    <input name="send" value="Déconnexion" type="submit">
    {!! csrf_field() !!}
</form>