@extends('layouts.app')

@section('title', 'Mes réservations')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 ">
            <h3>
                Liste de vos annonces
            </h3>

            @if (session('message'))
                <script type="text/javascript">
                    function toast() {
                        Materialize.toast('{{ session('message') }}', 4000)
                    }
                    window.onload = toast;
                </script>
            @endif

            @if(!empty($ads))

                @foreach($ads as $ad)
                    <div class="col s6">
                        <div class="card-panel">
                            <h5>
                                @foreach($steps[$ad->id] as $step)
                                    @foreach($step as $s)
                                        @if($loop->first)
                                            {{ $s->label }} →
                                        @elseif($loop->last)
                                            {{ $s->label }}
                                        @endif
                                    @endforeach
                                @endforeach
                            </h5>
                            <div class="divider"></div>
                            <div class="section">
                                <b>Résumé du trajet : </b>
                                @foreach($steps[$ad->id] as $step)
                                    @foreach($step as $s)
                                        @if(!$loop->last)
                                            {{ $s->label }} →
                                        @else
                                            {{ $s->label }}
                                        @endif
                                    @endforeach
                                @endforeach
                                <br>
                                <b>Date
                                    : </b>{!! ucfirst(utf8_encode(strftime('%A %d %B', strtotime($ad->date_start)))) !!}
                            </div>
                            <div class="divider"></div>
                            <div class="section ">
                                <a href="#" class="tooltipped" data-tooltip="Supprimer l'annonce">
                                    {{
                                    Html::image('public/img/user/dustbin.svg',
                                    'Icon d\'une poubelle',
                                    array('class' => 'responsive-img icon deletead', 'data-id' => $ad->id))
                                    }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col s10 offset-s1">
                    <div class="card-panel">
                        <div class="section center">
                            <p>
                                {{ Html::image('public/img/vehicles/warning.svg',
                                    'Icon d\'un panneau de signalisation',
                                    array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                                }}
                                Vous n'avez pas encore ajouté d'annonce. Vous pouvez en ajouter en
                                <a href="{{route('create_transport_offer')}}">cliquant ici</a>.
                                {{ Html::image('public/img/vehicles/warning.svg',
                                    'Icon d\'un panneau de signalisation',
                                    array('class' => 'responsive-img iconW', 'style' => 'vertical-align:middle;'))
                                }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        </div>
    </div>

    <script>
        $('.deletead').on('click', function () {
            var id = $(this).attr('data-id');
            var r = confirm("Etes-vous sûr de vouloir supprimer l'annonce ?");
            if (r == true) {
                location.href = '{{ route('delete_ad')}}' + '/' + id;
            }
        });

    </script>


@endsection
