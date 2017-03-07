@extends('layouts.app')

@section('title', 'Conditions générales')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 ">
            <h3>
                Conditions générales
                {{
                    Html::image('public/img/static/condition/text.svg',
                    'Icon de feuille de papier',
                    array('class' => 'responsive-img iconS'))
                }}
            </h3>
            <div class="col s10 offset-s1">
                <div class="card-panel">
                    <h4>Inscription à Usain Box</h4>
                    <p style="text-align:justify;">
                        L’utilisation de Usain Box est réservée aux personnes physiques âgées de 18 ans ou plus.
                        Toute inscription sur Usain Box par une personne mineure est strictement interdite.
                        En accédant, utilisant ou vous inscrivant sur Usain Box, vous déclarez et garantissez avoir 18 ans ou plus.
                    </p>
                </div>
            </div>
            <div class="col s10 offset-s1">
                <div class="card-panel">
                    <h4>Création de compte</h4>
                    <p style="text-align:justify;">
                        Usain Box permet aux membres de publier et consulter des annonces ainsi que d’interagir
                        entre eux pour la réservation de place. Vous pouvez consulter les annonces même si vous n’êtes
                        pas inscrit sur Usain Box. Cependant, vous ne pouvez ni publier d'annonce ni réserver
                        de place sans avoir, au préalable, créé un compte et être devenu un membre de Usain Box.
                    </p>
                    <p style="text-align:justify;">
                        Pour vous créer un compte, vous pouvez :
                        <br> ► remplir l’ensemble des champs figurant sur le formulaire d’inscription
                        <br> ► vous connecter, via Usain Box, à votre compte Facebook
                        <br>
                    </p>
                    <p style="text-align:justify;">
                        Lors de la création de votre compte, vous vous engagez à fournir des informations personnelles exactes
                        et conformes à la réalité.
                        Les mettre à jour régulièrement, par l’intermédiaire de votre profil, afin d’en garantir la pertinence et l’exactitude.
                    </p>
                    <p style="text-align:justify;">
                        En cas de perte ou divulgation de votre mot de passe, vous vous engagez à en informer Usain Box.
                        Vous êtes seul responsable de l’utilisation faite de votre Compte par un tiers, tant que vous n’avez
                        pas expressément notifié Usain Box de la perte, l’utilisation frauduleuse
                        par un tiers ou la divulgation de votre mot de passe à un tiers.
                    </p>
                    <p style="text-align:justify;">
                        Vous vous engagez à ne pas créer ou utiliser, sous votre propre identité ou celle d’un tiers,
                        d’autres comptes que celui initialement créé.
                    </p>
                </div>
            </div>
            <div class="col s10 offset-s1">
                <div class="card-panel">
                    <h4>Publication des annonces</h4>
                    <p style="text-align:justify;">
                        En tant que membre, vous pouvez créer et publier des annonces sur Usain Box en indiquant
                        des informations quant au trajet que vous comptez effectuer
                        (dates/heures et lieux de départ et d’arrivée, places disponible, options proposées, etc.).
                        Lors de la publication de votre Annonce, vous pouvez indiquer des villes étapes, dans lesquelles
                        vous acceptez de vous arrêter pour prendre ou déposer des colis.
                    </p>
                    <p style="text-align:justify;">
                        Vous êtes autorisé à publier une annonce si vous remplissez l’ensemble des conditions suivantes :
                        <br> ► vous êtes titulaire d’un permis de conduire valide
                        <br> ► le véhicule bénéficie d’une assurance au tiers valide
                        <br> ► vous n’avez aucune contre-indication ou incapacité médicale à conduire
                        <br> ► vous n’offrez pas plus de places que celles disponibles dans votre véhicule
                        <br> ► vous utilisez un véhicule avec un contrôle technique à jour
                    </p>
                    <p style="text-align:justify;">
                        Vous reconnaissez être le seul responsable du contenu de l’annonce que vous publiez sur Usain Box.
                        En conséquence, vous déclarez et garantissez l’exactitude et la véracité de toute information contenue dans
                        votre annonce et vous engagez à effectuer le trajet selon les modalités décrites dans votre Annonce.
                    </p>
                </div>
            </div>
            <div class="col s10 offset-s1">
                <div class="card-panel">
                    <h4>Réservation de place</h4>
                    <p style="text-align:justify;">
                        Lorsqu’un expéditeur est intéressé par une annonce, il peut effectuer une demande de réservation en ligne.
                        Au moment de la réservation, l'expéditeur prend contact avec le transporteur et se met d'accord sur les
                        modalités du transport. Après acceptation de la réservation par le transporteur,
                        l'expéditeur reçoit une confirmation de réservation.
                    </p>
                </div>
            </div>
            <div class="col s10 offset-s1">
                <div class="card-panel">
                    <h4>Système d’avis</h4>
                    <p style="text-align:justify;">
                        Usain Box vous encourage à laisser un avis sur un transporteur ou un expéditeur avec lequel vous avez
                        effectué un trajet ou avec lequel vous étiez censé effectuer un trajet. En revanche, vous n’êtes pas
                        autorisé à laisser un avis sur un membre avec lequel vous n’avez pas effectué de trajet.
                    </p>
                </div>
            </div>
            <div class="col s10 offset-s1">
                <div class="card-panel">
                    <h4>Conditions financières</h4>
                    <p style="text-align:justify;">
                        L’accès et l’inscription à Usain Box, de même que la recherche, la consultation et la publication
                        d’Annonces sont gratuites. En revanche, la réservation est payante en fonction des modalités définies
                        par le transporteur et l'expéditeur.
                    </p>
                </div>
            </div>
            <div class="col s10 offset-s1">
                <div class="card-panel">
                    <h4>Engagement de tous les utilisateurs</h4>
                    <p style="text-align:justify;">
                        Vous reconnaissez être seul responsable du respect de l’ensemble des lois, règlements et
                        obligations applicables à votre utilisation de Usain Box.
                    </p>
                    <p style="text-align:justify;">
                        En utilisant Usain Box et lors des trajets, vous vous engagez à :
                        <br> ► ne pas utiliser Usain Box à des fins professionnelles, commerciales ou lucratives
                        <br> ► ne transmettre à Usain Box ou aux autres membres aucune information fausse, trompeuse,
                        mensongère ou frauduleuse
                        <br> ► ne tenir aucun propos, n’avoir aucun comportement ou ne publier aucun contenu à
                        caractère diffamatoire, injurieux, obscène, pornographique, vulgaire, offensant, agressif, déplacé,
                        violent, menaçant, harcelant, raciste, xénophobe, à connotation sexuelle, incitant à la haine, à la
                        violence, à la discrimination ou à la haine, encourageant les activités ou l’usage de substances
                        illégales ou, plus généralement, contraires aux finalités de la Plateforme, de nature à porter atteinte
                        aux droits de Usain Box ou d’un tiers ou contraires aux bonnes mœurs
                        <br> ► ne pas porter atteinte aux droits et à l’image de Usain Box, notamment à ses droits de propriété
                        intellectuelle
                        <br> ► ne pas ouvrir plus d’un compte sur Usain Box et ne pas ouvrir de compte au nom d’un tiers
                        <br> ► ne pas contacter un autre membre, notamment par l’intermédiaire de Usain Box, à une autre fin que
                        celle de définir les modalités du colisvoiturage
                    </p>
                </div>
            </div>
            <div class="col s10 offset-s1">
                <div class="card-panel">
                    <h4>Données personnelles</h4>
                    <p style="text-align:justify;">
                        Dans le cadre de votre utilisation, Usain Box est amenée à collecter et traiter certaines de vos
                        données personnelles. En utilisant Usain Box et vous inscrivant en tant que membre,
                        vous reconnaissez et acceptez le traitement de vos données personnelles par Usain Box
                        conformément à la loi applicable et aux stipulations de la
                        <a href="{{route('page', 'privacy')}}">Politique de Confidentialité</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
