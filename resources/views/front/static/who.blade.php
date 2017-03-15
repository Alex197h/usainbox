@extends('layouts.app')

@section('title', 'Qui sommes nous ?')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 ">
            <h3>Qui sommes nous ?</h3>
            <div class="col s10 offset-s1">
                <div class="card-panel">
                    <h4>Les fondateurs</h4>
                    <p style="text-align:justify;">
                        Au court de notre formation en licence professionnelle
                        <a href="http://www.gap.univ-mrs.fr/miw/" target=_blank>
                            Activités et Techniques de Communication,
                            Mention Multimédia Internet Webmaster,
                        </a>
                        nous avons été ammené par groupe de quatre à réaliser un site de
                        colis voiturage. C'est donc la qu'est né Usain Box, beaucoup d'imagination, de créativité et un zet d'amitié.
                    </p>
                    <p style="text-align:justify;">
                        Ce groupe est composé de : <br>
                        <div class="col s12">
                            <p class="col s6">
                                {{
                                    Html::image('public/img/static/who/clara.svg',
                                    'Icon d\'une personnage feminin',
                                    array('class' => 'responsive-img iconS'))
                                }}
                                Clara Bouyer
                            </p>
                            <p class="col s6">
                                {{
                                    Html::image('public/img/static/who/alexandre.svg',
                                    'Icon d\'un personnage mario',
                                    array('class' => 'responsive-img iconS'))
                                }}
                                Alexandre Hennequin
                            </p>
                        </div>
                        <div class="col s12">
                            <p class="col s6">
                                {{
                                    Html::image('public/img/static/who/adrien.svg',
                                    'Icon d\'un personnage',
                                    array('class' => 'responsive-img iconS'))
                                }}
                                Adrien Michel
                            </p>
                            <p class="col s6">
                                {{
                                    Html::image('public/img/static/who/quentin.svg',
                                    'Icon d\'un personnage ',
                                    array('class' => 'responsive-img iconS'))
                                }}
                                Quentin Picard
                            </p>
                        </div>
                    </p>

                    <p>Pour toutes questions vous pouvez nous <a href="{{route('contact')}}">contacter</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
