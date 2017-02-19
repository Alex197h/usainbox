@extends('layouts.app')

@section('title', 'Comment ça marche ? ')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 ">
            <h3>Conditions générales</h3>
            <div class="col s9 offset-s1 card-panel">
                <h4>Inscription à la plateforme</h4>
                <p>L’utilisation de la plateforme est réservée aux personnes physiques âgées de 18 ans ou plus.
                    Toute inscription sur la plateforme par une personne mineure est strictement interdite.
                    En accédant, utilisant ou vous inscrivant sur la plateforme, vous déclarez et garantissez avoir 18 ans ou plus.
                </p>
            </div>
            <div class="col s9 offset-s1 card-panel">
                <h4>Création de compte</h4>
                <p>La Plateforme permet aux Membres de publier et consulter des Annonces ainsi que d’interagir
                    entre eux pour la réservation de Place. Vous pouvez consulter les Annonces même si vous n’êtes
                    pas inscrit sur la Plateforme. En revanche, vous ne pouvez ni publier une Annonce ni réserver
                    une Place sans avoir, au préalable, créé un Compte et être devenu Membre.
                    <br>
                    Pour créer votre Compte, vous pouvez :
                    <ul>
                        <li>soit remplir l’ensemble des champs obligatoires figurant sur le formulaire d’inscription ;
                        </li>
                        <li>soit vous connecter, via notre Plateforme, à votre compte Facebook
                            (ci-après, votre « Compte Facebook »). En utilisant une telle fonctionnalité, vous
                            comprenez que BlaBlaCar aura accès, publiera sur la Plateforme et conservera certaines
                            informations de votre Compte Facebook. Vous pouvez à tout moment supprimer le lien entre
                            votre Compte et votre Compte Facebook par l’intermédiaire de la rubrique « Vérifications »
                            de votre profil. Si vous souhaitez en savoir plus sur l’utilisation de vos données dans le
                            cadre de votre Compte Facebook, consultez notre Politique de Confidentialité et celle de Facebook.
                        </li>
                    </ul>
                </p>
                <p>Pour vous inscrire sur la Plateforme, vous devez avoir lu et accepter les présentes CGU ainsi que la Politique de Confidentialité.
                </p>
                <p>A l’occasion de la création de votre Compte, et ce quelle que soit la méthode choisie pour ce faire, vous vous engagez à
                    fournir des informations personnelles exactes et conformes à la réalité et à les mettre à jour, par l’intermédiaire de
                    votre profil ou en en avertissant BlaBlaCar, afin d’en garantir la pertinence et l’exactitude tout au long de votre relation
                    contractuelle avec BlaBlaCar.
                </p>
                <p>En cas d’inscription par email, vous vous engagez à garder secret le mot de passe choisi lors de la création de votre
                    Compte et à ne le communiquer à personne. En cas de perte ou divulgation de votre mot de passe,
                    vous vous engagez à en informer sans délai BlaBlaCar. Vous êtes seul responsable de l’utilisation faite de votre
                    Compte par un tiers, tant que vous n’avez pas expressément notifié BlaBlaCar de la perte, l’utilisation frauduleuse
                    par un tiers ou la divulgation de votre mot de passe à un tiers.
                </p>
                <p>Vous vous engagez à ne pas créer ou utiliser, sous votre propre identité ou celle d’un tiers, d’autres Comptes que celui initialement créé.
                </p>
            </div>
            <div class="col s9 offset-s1 card-panel">
                <h4>Publication des Annonces</h4>
                <p>En tant que Membre, et sous réserve que vous remplissiez les conditions ci-dessous, vous pouvez créer et
                    publier des Annonces sur la Plateforme en indiquant des informations quant au Trajet que vous comptez effectuer
                    (dates/heures et lieux de départ et d’arrivée, nombre de places offertes, options proposées,
                    montant de la Participation aux Frais, etc.).

                    Lors de la publication de votre Annonce, vous pouvez indiquer des villes étapes, dans lesquelles
                    vous acceptez de vous arrêter pour prendre ou déposer des Passagers. Les tronçons du Trajet entre ces villes
                    étapes ou entre l’une de ces villes étapes et le point de départ ou d’arrivée du Trajet constituent
                    des « Sous-Trajets ».

                    Vous n’êtes autorisé à publier une Annonce que si vous remplissez l’ensemble des conditions suivantes :
                    <ul>
                        <li>
                            vous êtes titulaire d’un permis de conduire valide ;
                        </li>
                        <li>
                            vous ne proposez des Annonces que pour des véhicules dont vous êtes le propriétaire ou que
                            vous utilisez avec l’autorisation expresse du propriétaire, et dans tous les cas, que vous êtes
                            autorisés à utiliser à des fins de covoiturage ;
                        </li>
                        <li>
                            vous êtes et demeurez le conducteur principal du véhicule, objet de l’Annonce ;
                        </li>
                        <li>
                            le véhicule bénéficie d’une assurance au tiers valide ;
                        </li>
                        <li>
                            vous n’avez aucune contre-indication ou incapacité médicale à conduire ;
                        </li>
                        <li>
                            le véhicule que vous comptez utiliser pour le Trajet est une voiture de tourisme à 4 roues,
                            disposant d’un maximum de 7 places assises, à l’exclusion des voitures dites « sans permis » ;
                        </li>
                        <li>
                            vous ne comptez pas publier une autre annonce pour le même Trajet sur la Plateforme ;
                        </li>
                        <li>
                            vous n’offrez pas plus de Places que celles disponibles dans votre véhicule ;
                        </li>
                        <li>
                            toutes les Places offertes ont une ceinture de sécurité, et ce même si le véhicule est homologué en
                            présence de sièges dépourvus de ceinture de sécurité ;
                        </li>
                        <li>
                            vous utilisez un véhicule en parfait état de fonctionnement et conforme aux usages et dispositions
                            légales applicables, notamment avec un contrôle technique à jour.
                        </li>
                    </ul>

                    <p> Vous reconnaissez être le seul responsable du contenu de l’Annonce que vous publiez sur la Plateforme.
                        En conséquence, vous déclarez et garantissez l’exactitude et la véracité de toute information contenue dans
                        votre Annonce et vous engagez à effectuer le Trajet selon les modalités décrites dans votre Annonce.
                    </p>
                    <p>
                        Sous réserve que votre Annonce soit conforme aux CGU, elle sera publiée sur la Plateforme et donc visible
                        des Membres et de tous visiteurs, même non Membre, effectuant une recherche sur la Plateforme ou sur le site
                        internet des partenaires de BlaBlaCar. BlaBlaCar se réserve la possibilité, à sa seule discrétion et sans préavis,
                        de ne pas publier ou retirer, à tout moment, toute Annonce qui ne serait pas conforme aux CGU ou qu’elle considérerait
                        comme préjudiciable à son image, celle de la Plateforme ou celle des Services.
                    </p>
                    <p>
                        Vous reconnaissez et acceptez que les critères pris en compte dans le classement et l’ordre d’affichage de votre
                        Annonce parmi les autres Annonces relèvent de la seule discrétion de BlaBlaCar.
                    </p>
                </p>
            </div>
            <div class="col s9 offset-s1 card-panel">
                <h4>Réservation d’une Place</h4>
                <p>
                </p>
            </div>
            <div class="col s9 offset-s1 card-panel">
                <h4>Système d’avis</h4>
                <p>
                </p>
            </div>
            <div class="col s9 offset-s1 card-panel">
                <h4>Conditions financières</h4>
                <p>
                </p>
            </div>
            <div class="col s9 offset-s1 card-panel">
                <h4>Politique d’annulation</h4>
                <p>
                </p>
            </div>
            <div class="col s9 offset-s1 card-panel">
                <h4>Comportement des utilisateurs de la Plateforme et Membres</h4>
                <p>
                </p>
            </div>
            <div class="col s9 offset-s1 card-panel">
                <h4>Données personnelles</h4>
                <p>
                </p>
            </div>
            <div class="col s9 offset-s1 card-panel">
                <h4>Fonctionnement, disponibilité et fonctionnalités de la Plateforme</h4>
                <p>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
