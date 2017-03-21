@extends('layouts.app')

@section('title', 'Mes annonces')

@section('content')
<style media="screen">
@import "{!! asset('public/css/tables.min.css') !!}";
</style>
<div class="container">
    <div class="row">
        <div class="col s10 card offset-s1">
            <div class="section center">
                <h5>
                    Liste de vos annonces
                    {{
                        Html::image('public/img/reservation/list.svg',
                        'Icon d\'une annonce',
                        array('class' => 'responsive-img icon','style' => 'vertical-align: middle;'))
                    }}
                </h5>
            </div>

            @if (session('message'))
                <script type="text/javascript">
                function toast() {
                    Materialize.toast('{{ session('message') }}', 4000)
                }
                window.onload = toast;
                </script>
            @endif

            @if(!empty($ads))
                <table class="responsive-table">
                    <thead class="">
                        <tr>
                            <th>Trajet</th>
                            <th>Date</th>
                            <th>Annonce</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ads as $ad)
                            <tr class="res-line">
                                <td>
                                    @foreach($steps[$ad->id] as $step)
                                        @foreach($step as $s)
                                            @if(!$loop->last)
                                                {{ $s->label }} →
                                            @else
                                                {{ $s->label }}
                                            @endif
                                        @endforeach
                                    @endforeach
                                </td>

                                <td>{!! ucfirst(utf8_encode(strftime('%A %d %B %Y', strtotime($ad->date_start)))) !!}</td>
                                <td>
                                    <a class="tooltipped" data-tooltip="Voir le détail de l'annonce" href="{{ route('detail_transport_offer', $ad->id) }}">Voir l'annonce</a>
                                </td>
                                <td>
                                    <a href="#" class="tooltipped" data-tooltip="Supprimer l'annonce">
                                        {{
                                            Html::image('public/img/user/dustbin.svg',
                                            'Icon d\'une poubelle',
                                            array('class' => 'responsive-img icon deletead', 'data-id' => $ad->id))
                                        }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
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
<script src="{!! asset('public/js/tables.min.js') !!}"></script>
<script>

$(document).ready(function(){
    $('.modal').modal();
    $('.btn-modal').on('click', function(){
        $('#sendreview')[0].reset();

        var id = $(this).attr('data-id');
        $('#reservation').val(id);
        var type = $(this).parents('.res-line').find('.type_offer span').attr('data-type');
        $('#type').val(type);
    });
    $('table').DataTable();
});
</script>


@endsection
