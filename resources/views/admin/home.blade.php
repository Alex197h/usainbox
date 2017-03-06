@extends('layouts.admin')
@section('title', 'Home')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel tile fixed_height_320">
            <div class="x_title">
                <h2>Panel d'Administration</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p>
                    Je suis le contenu e de la page accueil d'administration
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Utilisateurs</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                    <thead>
                        <tr>
                            <th>
                                <th><input id="checker" type="checkbox" id="check-all" class="flat"></th>
                            </th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Sexe</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td><th><input type="checkbox" id="check-all" class="flat"><label class="checkbox-label"></label></th></td>
                            <td><a href="">{{ $user->full_name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->is_admin }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                var Allchecked = false;
                $('#checker').change(function(){
                    console.log('ok')
                    $('.flat').prop('checked', Allchecked);
                    Allchecked = !Allchecked;
                });
            </script>
        </div>
    </div>
</div>

@endsection