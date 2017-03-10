@extends('layouts.admin')
@section('title', 'Gestion des Véhicules')

@section('content')

<?php
    $jsBrands = [];
?>
@foreach($brands as $k => $brand)
    <?php
        $jsBrands[$k] = json_encode($brand);
    ?>
@endforeach
<script>
    var Brands = JSON.stringify({!! json_encode($jsBrands,JSON_FORCE_OBJECT) !!});
    Brands = JSON.parse(Brands);
    
    for(i in Brands){
        Brands[i] = JSON.parse(Brands[i]);
    }
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="{{$part=='default'?'active':''}}"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Types</a></li>
                            <li role="presentation" class="{{$part=='modeles'?'active':''}}"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Marques & Modèles</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade {{$part=='default'?'active in':''}}" id="tab_content1" aria-labelledby="home-tab">
                                <button class="btn btn-success btnaddtype"><i class="fa fa-plus fa-fw"></i>Ajouter</button>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                        </tr>
                                    </thead>
                                    <tbody id="liste_types_vehicles">
                                        @foreach($types_vehicles as $vehicle)
                                        <tr data-line="{{ $vehicle->id }}">
                                            <td>
                                                <div class="col-md-3 col-sm-3 col-xs-10 form-group">
                                                    <input class="inputsavetype form-control" value="{{ $vehicle->label }}">
                                                </div>
                                                <div class="col-md-9 col-sm-9 col-xs-1 form-group">
                                                    <i class="btnremtypevehicle btn btn-danger fa fa-remove"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <script>
                                    $('.btnaddtype').on('click', function(){
                                        var divinput = $('<div class="col-md-3 col-sm-3 col-xs-10 form-group">');
                                        divinput.append('<input class="inputsavetype form-control">');
                                        
                                        var divrem = $('<div class="col-md-9 col-sm-9 col-xs-1 form-group">');
                                        divrem.append('<i class="btnremtypevehicle btn btn-danger fa fa-remove"></i>');
                                        
                                        var td = $('<td>');
                                        td.append(divinput);
                                        td.append(divrem);
                                        var tr = $('<tr data-line="">');
                                        tr.append(td);
                                        
                                        $('#liste_types_vehicles').append(tr);
                                    });
                                    
                                    $(document).on('blur', '.inputsavetype', function(){
                                        var line = $(this).parents('tr');
                                        var id = line.attr('data-line');
                                        var val = this.value;
                                        
                                        $.ajax({
                                            url: '{{ route('admin_page', ['vehicles', 'save']) }}/'+(id || 0),
                                            method: 'POST',
                                            dataType: 'json',
                                            data: {
                                                id: id,
                                                label: val,
                                                _token: '{{ csrf_token() }}',
                                            },
                                            success: function(result){
                                                if(result.type == 'create'){
                                                    line.attr('data-line', result.id);
                                                    Notif('Succès', 'Le type "'+result.label+'" a bien été créé !');
                                                } else if(result.type == 'update'){
                                                    Notif('Succès', 'Le type "'+result.label+'" a bien été changé par '+result.old+' !', 'info');
                                                }
                                            }
                                        });
                                    });
                                    
                                    $(document).on('click', '.btnremtypevehicle', function(){
                                        var line = $(this).parents('tr');
                                        var id = line.attr('data-line');
                                        
                                        if(id){
                                            $.ajax({
                                                url: '{{ route('admin_page', ['vehicles', 'remove']) }}/'+id,
                                                method: 'POST',
                                                dataType: 'json',
                                                data: {
                                                    id: id,
                                                    _token: '{{ csrf_token() }}',
                                                },
                                                success: function(result){
                                                    if(result.delete){
                                                        line.remove();
                                                        Notif('Succès', 'Le type "'+result.name+'" a bien été supprimé !');
                                                    } else {
                                                        Notif('Erreur', 'Erreur lors de la suppression !', 'error');
                                                    }
                                                }
                                            });
                                        } else line.remove();
                                    });
                                </script>
                            </div>
                            <div role="tabpanel" class="tab-pane fade {{$part=='modeles'?'active in':''}}" id="tab_content2" aria-labelledby="profile-tab">
                                <table id="datatable-checkbox" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:1px">
                                                <th style="width:15px"><input type="checkbox" id="check-all" class="flat"></th>
                                            </th>
                                            <th><a>Marque</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($brands as $k => $brand)
                                        <tr class="brand-line" data-brand="{{ $k }}">
                                            <td><th><input type="checkbox" class="tocheck flat"></th></td>
                                            <td style="cursor:pointer" data-toggle="modal" data-target=".modal-edit-model"><a>{{ $k }}</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="modal fade modal-edit-model" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                <h4 class="title" id="myModalLabel"></h4>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Text in a modal</h4>
                                                <p></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                <button type="button" class="btn btn-success">Enregistrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $('.brand').on('click', function(){
                                        var brand = $(this).attr('data-brand');
                                        console.log(brand)
                                        $(this).find('.title').text(brand);
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
