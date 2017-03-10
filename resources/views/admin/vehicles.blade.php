@extends('layouts.admin')
@section('title', 'Liste des Véhicules')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Types de Véhicules</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                {{ csrf_field() }}
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
        </div>
    </div>
</div>

@endsection
