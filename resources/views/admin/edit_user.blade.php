@extends('layouts.admin')
@section('title', 'Profil de '.$user->full_name)

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Informations</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Véhicules</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                <form class="form-horizontal form-label-left input_mask" method="post" action="">
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input name="last_name" placeholder="Nom" value="{{ Input::get('last_name', $user->last_name) }}" class="form-control has-feedback-left">
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input name="first_name" placeholder="Prénom" value="{{ Input::get('first_name', $user->first_name) }}" class="form-control">
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input name="email" type="email" placeholder="Email" value="{{ Input::get('email', $user->email) }}" class="form-control has-feedback-left">
                                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input name="phone" type="phone" placeholder="Téléphone" value="{{ Input::get('phone', $user->phone) }}" class="form-control">
                                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input name="birthday" type="date" placeholder="Date de naissance" value="{{ Input::get('birthday', $user->birthday) }}" class="form-control has-feedback-left">
                                        <span class="fa fa-birthday-cake form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="gender" class="btn-group" data-toggle="buttons">
                                                <label class="btn {{ Input::get('gender', $user->gender) == 0 ?'btn-default' : 'btn-primary' }}">
                                                    <input type="radio" name="gender" value="1"> &nbsp; Homme &nbsp;
                                                </label>
                                                <label class="btn {{ Input::get('gender', $user->gender) == 0 ?'btn-primary' : 'btn-default' }}">
                                                    <input type="radio" name="gender" value="0"> Femme
                                                </label>
                                                <script>
                                                    $('input[name=gender]').on('change', function(){
                                                        $('input[name=gender]').parent().toggleClass('btn-primary');
                                                        $('input[name=gender]').parent().toggleClass('btn-default');
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <textarea name="description" class="form-control" rows="3" placeholder="Une description ici...">{{ Input::get('description', $user->description) }}</textarea>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input name="password" type="password" placeholder="Changer le mot de passe" class="form-control">
                                        <span class="fa fa-lock form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                    
                                    
                                    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                                        <label>
                                            <input name="help_charge" type="checkbox" class="js-switch" value="1"{{ Input::get('help_charge', $user->help_charge) == 1 ?' checked' : '' }}> Aide au chargement
                                        </label>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                                        <label>
                                            <input name="is_admin" type="checkbox" class="js-switch" value="1"{{ Input::get('is_admin', $user->is_admin) == 1 ?' checked' : '' }}> Administrateur
                                        </label>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                            <button class="btn btn-danger" type="reset">Effacer</button>
                                            <button type="submit" class="btn btn-success">Enregistrer</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="save_user" value="true">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                <form method="POST" action="">
                                    @foreach($user->vehicles as $vehicle)
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2><i class="fa fa-bars"></i> {{ $vehicle->car_brand }} {{ $vehicle->car_model }}</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#">Supprimer</a></li>
                                                            <li><a href="#">Settings 2</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                {{-- var_dump($vehicle->toArray()) --}}
                                                <!--<form class="form-horizontal form-label-left input_mask" method="post" action="">-->
                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                        <input name="car_brand" placeholder="Marque" value="{{ Input::get('car_brand', $vehicle->car_brand) }}" class="form-control has-feedback-left">
                                                        <span class="fa fa-car form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                        <input name="car_model" placeholder="Modèle" value="{{ Input::get('car_model', $vehicle->car_model) }}" class="form-control">
                                                        <span class="fa fa-car form-control-feedback right" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                        <select class="form-control">
                                                            @foreach($type_vehicles as $type)
                                                                <option value="{{ $type->id }}" {{ $type->id == $vehicle->type_vehicle_id ? 'selected' : '' }}>{{ $type->label }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                        <label>
                                                            <input name="default" type="checkbox" class="check_default js-switch" value="1"{{ $vehicle->default == 1 ? ' checked' : '' }}> Véhicule par défaut
                                                        </label>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <button type="submit" class="btn btn-success">Enregistrer</button>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="save_vehicle" value="true">
                                                    {{ csrf_field() }}
                                                <!--</form>-->
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </form>
                                <script>
                                    $('.check_default').on('change', function(){
                                        console.log(this.checked)
                                        if(this.checked){
                                            $('.check_default').each(function(index){
                                                this.checked = false;
                                            });
                                            // $(this).prop('checked', true);
                                            this.checked = true;
                                        }
                                        else this.checked = true;
                                    });
                                </script>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                                    photo booth letterpress, commodo enim craft beer mlkshk 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection