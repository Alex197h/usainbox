@extends('layouts.admin')
@section('title', 'Profil de '.$user->full_name)

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>User Report <small>Activity report</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <div class="profile_img">
                        <div id="crop-avatar">
                            <img class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar" title="Change the avatar">
                        </div>
                    </div>
                    <h3>Samuel Doe</h3>
                    <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA
                        </li>
                        <li>
                            <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
                        </li>
                        <li class="m-top-xs">
                            <i class="fa fa-external-link user-profile-icon"></i>
                            <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
                        </li>
                    </ul>
                    <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                    <br>
                    <h4>Skills</h4>
                    <ul class="list-unstyled user_data">
                        <li>
                            <p>Web Applications</p>
                            <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                            </div>
                        </li>
                        <li>
                            <p>Website Design</p>
                            <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                            </div>
                        </li>
                        <li>
                            <p>Automation & Testing</p>
                            <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                            </div>
                        </li>
                        <li>
                            <p>UI / UX</p>
                            <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Informations</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                <form class="form-horizontal form-label-left input_mask">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Nom">
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control" id="inputSuccess3" placeholder="Prénom">
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email">
                                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control" id="inputSuccess5" placeholder="Téléphone">
                                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                            <button class="btn btn-danger" type="reset">Effacer</button>
                                            <button type="submit" class="btn btn-success">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                <table class="data table table-striped no-margin">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Project Name</th>
                                            <th>Client Company</th>
                                            <th class="hidden-phone">Hours Spent</th>
                                            <th>Contribution</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>New Company Takeover Review</td>
                                            <td>Deveint Inc</td>
                                            <td class="hidden-phone">18</td>
                                            <td class="vertical-align-mid">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>New Partner Contracts Consultanci</td>
                                            <td>Deveint Inc</td>
                                            <td class="hidden-phone">13</td>
                                            <td class="vertical-align-mid">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Partners and Inverstors report</td>
                                            <td>Deveint Inc</td>
                                            <td class="hidden-phone">30</td>
                                            <td class="vertical-align-mid">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>New Company Takeover Review</td>
                                            <td>Deveint Inc</td>
                                            <td class="hidden-phone">28</td>
                                            <td class="vertical-align-mid">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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