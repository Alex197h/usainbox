@extends('layouts.admin')
@section('title', 'Offre de transport de '.$user->full_name.' <a href="'.route('detail_transport_offer', $transport->id).'" title="Voir sur le site" target="_blank"><i class="fa fa-arrow-right"></i></a>')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="{{$part=='default'?'active':''}}"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Informations</a></li>
                            <li role="presentation" class="{{$part=='steps'?'active':''}}"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Etapes</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade {{$part=='default'?'active in':''}}" id="tab_content1" aria-labelledby="home-tab">
                                <form class="form-horizontal form-label-left input_mask" method="post" action="">
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                                        <input name="date_start" type="datetime" placeholder="Date de départ" value="{{ Input::get('date_start', $transport->date_start) }}" class="form-control has-feedback-left">
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <span class="fa fa-car form-control-feedback right" aria-hidden="true"></span>
                                        <input name="max_weight" placeholder="Poids" value="{{ Input::get('max_weight', $transport->max_weight) }}" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input name="max_volume" placeholder="Volume" value="{{ Input::get('max_volume', $transport->max_volume) }}" class="form-control has-feedback-left">
                                        <span class="fa fa-arrows-alt form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <span class="fa fa-arrows-h form-control-feedback right" aria-hidden="true"></span>
                                        <input name="max_length" placeholder="Longueur" value="{{ Input::get('max_length', $transport->max_length) }}" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input name="max_width" placeholder="Largeur" value="{{ Input::get('max_width', $transport->max_width) }}" class="form-control has-feedback-left">
                                        <span class="fa fa-car form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <span class="fa fa-arrows-v form-control-feedback right" aria-hidden="true"></span>
                                        <input name="max_height" placeholder="Hauteur" value="{{ Input::get('max_height', $transport->max_height) }}" class="form-control">
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <textarea name="description" class="form-control" rows="3" placeholder="Une description ici...">{{ Input::get('description', $transport->description) }}</textarea>
                                    </div>
                                    
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                        <label><input name="is_regular" type="checkbox" class="js-switch" value="1"{{ Input::get('is_regular', $transport->is_regular) == 1 ?' checked' : '' }}> Trajet régulier</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                        <label><input name="highway" type="checkbox" class="js-switch" value="1"{{ Input::get('highway', $transport->highway) == 1 ?' checked' : '' }}> Prend l'autoroute</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                        <label><input name="detour" type="checkbox" class="js-switch" value="1"{{ Input::get('detour', $transport->detour) == 1 ?' checked' : '' }}> Détour(s)</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                                        <label><input name="full" type="checkbox" class="js-switch" value="1"{{ Input::get('full', $transport->full) == 1 ?' checked' : '' }}> Complet</label>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                            <button class="btn btn-danger" type="reset">Effacer</button>
                                            <button type="submit" class="btn btn-success">Enregistrer</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="save_infos" value="true">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade {{$part=='steps'?'active in':''}}" id="tab_content2" aria-labelledby="profile-tab">
                                <form class="form-horizontal form-label-left" method="post" action="">
                                    @foreach($steps as $step)
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Step {{ $step->step }}</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="steps[]" value="{{ $step->label }}" required class="tstep form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success">Enregistrer</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="save_steps" value="true">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUTW7_sKsarvYpb8HJdG1cWptczyG3Jf0&callback=init&libraries=places"></script>
                            <script>
                                function init(){
                                    var options = {types: ['(cities)']};
                                    $('.tstep').each(function(){
                                        new google.maps.places.Autocomplete(this, options);
                                    });
                                    
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection