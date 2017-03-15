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
                                        <tr class="brand-line">
                                            <td><th><input type="checkbox" class="tocheck flat"></th></td>
                                            <td style="cursor:pointer" data-toggle="modal" data-target=".modal-edit-model" data-brand="{{ $k }}">
                                                {{ $k }} ({{ count($brand) }})
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="modal fade modal-edit-model" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                <h4><span class="title"></span> <span id="edittitle" class="fa fa-edit"></span></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="content">
                                                    
                                                    <div class="form-inline">
                                                      <div class="form-group">
                                                        <input class="form-control" placeholder="">
                                                        <label><i class="fa fa-arrow-right"></i></label>
                                                        <input class="form-control" placeholder="">
                                                      </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                <button type="button" id="savemodelchange" class="btn btn-success">Enregistrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $('.modal-edit-model').on('show.bs.modal', function(){
                                        var td = $(event.srcElement);
                                        var brand = td.attr('data-brand');
                                        var title = $(this).find('.title');
                                        title.replaceWith('<span class="title">'+brand+'</span>');
                                        $('#edittitle').attr('class', 'fa fa-edit');
                                        
                                        var content = $(this).find('.content');
                                        var Brand = Brands[brand];
                                        
                                        content.html('');
                                        for(i in Brand){
                                            var group = $('<div class="form-group">');
                                            group.append('<input class="form-control old" value="'+Brand[i]+'" readonly="readonly"">');
                                            group.append('<label>&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>&nbsp;&nbsp;</label>');
                                            group.append('<input class="form-control new">');
                                            content.append($('<div class="form-inline">').append(group));
                                            content.append('<hr>');
                                        }
                                    });
                                    
                                    $('#savemodelchange').on('click', function(){
                                        var content = $('.modal-edit-model').find('.content');
                                        var values = {};
                                        var count = 0;
                                        var brand = $('.modal-edit-model').find('.title').text();
                                        
                                        content.find('.form-group').each(function(){
                                            var o = $(this).find('.old');
                                            var n = $(this).find('.new');
                                            
                                            if(n.val() && o.val() != n.val()){
                                                values[o.val()] = n.val();
                                                count++;
                                            }
                                        });
                                        
                                        if(count > 0){
                                            $.ajax({
                                                url: '{{ route('admin_page', ['vehicles', 'editmodel']) }}',
                                                method: 'POST',
                                                dataType: 'json',
                                                data: {
                                                    models: values,
                                                    _token: '{{ csrf_token() }}',
                                                },
                                                success: function(result){
                                                    if(result.success == 'update'){
                                                        Notif('Succès', 'Les modèles ont bien été enregistrés !');
                                                    }
                                                    
                                                    content.find('.form-group').each(function(){
                                                        var o = $(this).find('.old');
                                                        var n = $(this).find('.new');
                                                        var old = values[o.val()];
                                                        
                                                        if(old){
                                                            Brands[brand].push(n.val());
                                                            Brands[brand].splice($.inArray(o.val(), Brands[brand]), 1);
                                                            
                                                            o.val(n.val())
                                                            $(this).find('.new').val('');
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                    });
                                    
                                    $('#edittitle').on('click', function(){
                                        var title = $('.modal-edit-model .title');
                                        var val = title.val() || title.text();
                                        var old = title.attr('data-old');
                                        
                                        if($(this).hasClass('fa-edit')){
                                            $(this).attr('class', 'fa fa-save');
                                            
                                            title.replaceWith('<input class="title" data-old="'+val+'" value="'+val+'" placeholder="'+val+'">');
                                        } else {
                                            if(val){
                                                $(this).attr('class', 'fa fa-edit');
                                                title.replaceWith('<span class="title" data-old="'+old+'">'+(val || old)+'</span>');
                                                $.ajax({
                                                    url: '{{ route('admin_page', ['vehicles', 'editbrandname']) }}',
                                                    method: 'POST',
                                                    dataType: 'json',
                                                    data: {
                                                        old: old,
                                                        new: val,
                                                        _token: '{{ csrf_token() }}',
                                                    },
                                                    success: function(result){
                                                        if(result.success == 'savedname'){
                                                            Notif('Succès', 'La marque "'+old+'" a bien été changée par "'+val+'" !');
                                                            location.reload();
                                                        }
                                                    }
                                                });
                                            } else Notif('Erreur', 'Vous devez saisir un nom !', 'error');
                                        }
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
