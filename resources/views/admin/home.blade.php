@extends('layouts.admin')
@section('title', 'Administration')

@section('content')



<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel tile">
            <div class="x_content">
                <div class="row tile_count">
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-users"></i> Membres</span>
                        <div class="count">{{ $stats->countUsers }}</div>
                        <span class="count_bottom"><i class="green">{{ $stats->countDailyUsers }} </i> aujourd'hui</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-mars"></i> Hommes</span>
                        <div class="count">{{ $stats->countMales }}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-venus"></i> Femmes</span>
                        <div class="count">{{ $stats->countFemales }}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-clock-o"></i> Connectés aujourd'hui</span>
                        <div class="count">{{ $stats->countDailyLogUsers }}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-list"></i> Offres transport</span>
                        <div class="count">{{ $stats->countTOffers }}</div>
                        <span class="count_bottom">Hier: <i class="green">{{ $stats->countTOffersPrev }} </i></span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-list"></i> Offres d'expédition</span>
                        <div class="count">{{ $stats->countEOffers }}</div>
                        <span class="count_bottom">Hier: <i class="green">{{ $stats->countEOffersPrev }}</i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel tile">
            <div class="x_title">
                <h2>Tranches d'ages</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="graph_bar" style="height:200px;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel tile">
            <div class="x_title">
                <h2>Dernières inscriptions <small>les 7 derniers jours</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="graph_inscriptions" style="height:200px;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel tile">
            <div class="x_title">
                <h2>Véhicules les plus utilisés <small>sur un total de {{ $stats->countVehicles }} véhicule</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="" style="width:100%">
                    <tr>
                        <th style="width:37%;">
                            <p>Graphique</p>
                        </th>
                        <th>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                <p class="">Vehicule</p>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <p class="">Pourcentage</p>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                        </td>
                        <td>
                            <table class="tile_info">
                                <?php $color = 0; ?>
                                @foreach($stats->countEachVehicles as $k => $c)
                                    <tr>
                                        <td><p><i class="fa fa-square" style="color:{{ $colors[$color] }}"></i>{{ $k }}</p></td>
                                        <td>{{ round($c*100/$stats->countVehicles) }} %</td>
                                    </tr>
                                    <?php $color++; ?>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')


<script>
    $("#graph_bar").length&&Morris.Bar( {
        element:"graph_bar", data: [
            @foreach($stats->countAges as $k => $a)
                {age: "{{$k}}", valeur: {{$a}}},
            @endforeach
        ], xkey:"age", ykeys:["valeur"], labels:["Nombre"], barRatio:.4, barColors:["#26B99A", "#34495E", "#ACADAC", "#3498DB"], xLabelAngle:35, hideHover:"auto", resize:!0
    });
    
    $("#graph_inscriptions").length&&Morris.Bar({
        element:"graph_inscriptions", data: [
            @for($i=7-1;$i>=0;$i--)
                <?php
                    $day = date('Y-m-d', strtotime("- $i days"));
                ?>
                {day: "{{date('d/m/Y', strtotime($day))}}", valeur: '{{ isset($stats->countRegDays[$day]) ? $stats->countRegDays[$day] : '0' }}'},
            @endfor
        ], xkey:"day", ykeys:["valeur"], labels:["Inscriptions"], barRatio:.4, barColors:["#26B99A", "#34495E", "#ACADAC", "#3498DB"], xLabelAngle:35, hideHover:"auto", resize:!0
    });
    
    
    if("undefined"!=typeof Chart&&($(".canvasDoughnut").length)) {
        var a = {
            type:"doughnut",
            tooltipFillColor:"rgba(51, 51, 51, 0.55)",
            data: {
                labels: {!! json_encode(array_keys($stats->countEachVehicles)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($stats->countEachVehicles)) !!},
                    backgroundColor: {!! json_encode(array_slice($colors, 0, count($stats->countEachVehicles))) !!},
                }]
            }
            ,
            options: {
                legend: !1, responsive: !1
            }
        };
        $(".canvasDoughnut").each(function(){
            var b=$(this);
            new Chart(b, a)
        })
    }
</script>

@endsection