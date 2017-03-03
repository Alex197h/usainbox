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
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                    DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                </p>
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
                            <td><th><input type="checkbox" id="check-all" class="flat"></th></td>
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