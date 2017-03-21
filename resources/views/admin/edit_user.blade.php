@extends('layouts.admin')
@section('title', 'Profil de '.$user->full_name.' <a href="'.route('profile', $user->id).'" title="Voir sur le site" target="_blank"><i class="fa fa-arrow-right"></i></a>')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="{{$part=='profil'?'active':''}}"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Informations</a></li>
                            <li role="presentation" class="{{$part=='vehicle'?'active':''}}"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Véhicules</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade {{$part=='profil'?'active in':''}}" id="tab_content1" aria-labelledby="home-tab">
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
                            <div role="tabpanel" class="tab-pane fade {{$part=='vehicle'?'active in':''}}" id="tab_content2" aria-labelledby="profile-tab">
                                @foreach($vehicles as $vehicle)
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2><i class="fa fa-bars"></i> {{ $vehicle->car_brand ?: "Nouveau Véhicule" }} {{ $vehicle->car_model }}</h2>
                                                 <form method="POST" action="">
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" style="float:right" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                            <ul class="dropdown-menu" role="menu">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="rem_vehicle" value="{{ $vehicle->id }}">
                                                                <li><button type="submit" class="btn-link">Supprimer</button></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </form>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <form method="POST" action="">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                        <input name="car_brand" placeholder="Marque" value="{{ $vehicle->car_brand }}" class="form-control has-feedback-left">
                                                        <span class="fa fa-car form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                        <input name="car_model" placeholder="Modèle" value="{{ $vehicle->car_model }}" class="form-control">
                                                        <span class="fa fa-car form-control-feedback right" aria-hidden="true"></span>
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                        <select class="form-control" name="type_vehicle_id">
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
                                                    
                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                        <input name="max_volume" placeholder="Volume" value="{{ $vehicle->max_volume }}" class="form-control has-feedback-left">
                                                        <span class="fa fa-arrows-alt form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                        <span class="fa fa-car form-control-feedback right" aria-hidden="true"></span>
                                                        <input name="max_weight" placeholder="Poids" value="{{ $vehicle->max_weight }}" class="form-control">
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                        <input name="max_width" placeholder="Largeur" value="{{ $vehicle->max_width }}" class="form-control has-feedback-left">
                                                        <span class="fa fa-car form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                        <span class="fa fa-arrows-h form-control-feedback right" aria-hidden="true"></span>
                                                        <input name="max_length" placeholder="Longueur" value="{{ $vehicle->max_length }}" class="form-control">
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                        <input name="max_height" placeholder="Hauteur" value="{{ $vehicle->max_height }}" class="form-control has-feedback-left">
                                                        <span class="fa fa-arrows-v form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <button type="submit" class="btn btn-success">Enregistrer</button>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="save_vehicle" value="{{ $vehicle->id ?: 'new' }}">
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <script>
                                    $('.check_default').on('click', function(){
                                        if(this.checked){
                                            $('.check_default').prop('checked', false);
                                            this.checked = true;
                                        }
                                        // if(this.checked){
                                            // $('.check_default').each(function(index){
                                                // this.checked = false;
                                            // });
                                            // $(this).prop('checked', true);
                                            // this.checked = true;
                                        // }
                                        // else this.checked = true;
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