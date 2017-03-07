@extends('layouts.app')

@section('title', 'Utilisation des cookies')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 ">
            <h3>Utilisation des cookies</h3>
            <div class="col s10 offset-s1">
                <div class="card-panel">
                    <h4>Qu’est-ce c'est et à quoi ça sert ?</h4>
                    <p style="text-align:justify;">
                        Un cookie est un fichier texte enregistré, et/ou lu par votre navigateur, sur le disque dur
                        de votre terminal (PC, ordinateur portable ou smartphone, par exemple) et déposé par les sites
                        internet que vous visitez. Quasiment tous les sites utilisent des cookies pour bien fonctionner
                        et optimiser leur ergonomie et leurs fonctionnalités.
                    </p>
                    <p>
                        Les cookies rendent également les interactions
                        avec les sites plus sécurisées et rapides, dans la mesure où ceux-ci peuvent se souvenir de vos
                        préférences (telles que votre identifiant et votre langue) en renvoyant les informations qu’ils
                        contiennent au site d’origine (cookie interne) ou à un autre site auquel ils appartiennent
                        (cookie tiers), lorsque vous visitez à nouveau le site concerné à partir du même terminal.
                    </p>
                </div>
            </div>
            <div class="col s10 offset-s1">
                <div class="card-panel">
                    <h4>Désactiver l'utilisation des cookies</h4>
                    <p style="text-align:justify;">
                        Vous pouvez révoquer votre consentement à l’utilisation des cookies à tout moment : <br>
                        ► en paramétrant votre navigateur internet <br>
                        <p>
                            Si vous souhaitez supprimer les cookies enregistrés sur votre terminal
                            et paramétrer votre navigateur pour refuser les cookies, vous pouvez le
                            faire via les préférences de votre navigateur internet. Ces options de navigation
                            relatives aux cookies se trouvent habituellement dans les menus « Options »,
                            « Outils » ou « Préférences » du navigateur que vous utilisez pour accéder à ce site.
                            Cependant, selon les différents navigateurs existants, des moyens différents peuvent être
                            utilisés pour désactiver les cookies.
                        </p>
                        <p>
                            Veuillez noter que si vous refusez, depuis votre navigateur internet, l’enregistrement de cookies sur votre terminal,
                            vous serez toujours en mesure de naviguer sur ce site,
                            mais certaines parties et options pourraient ne pas fonctionner correctement.
                        </p>
                        ► en désactivant les cookies en ligne <br>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
