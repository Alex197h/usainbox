<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Usainbox Admin Panel </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.min.css">
        {{ Html::style('public/admin/style.css') }}
        {{ Html::style('public/admin/libs/nprogress.css') }}
        {{ Html::style('public/admin/libs/green.css') }}
        {{ Html::style('public/admin/libs/tables/tables.css') }}
        {{ Html::style('public/admin/libs/tables/buttons.css') }}
        {{ Html::style('public/admin/libs/tables/fixheader.css') }}
        {{ Html::style('public/admin/libs/tables/reponsive.css') }}
        {{ Html::style('public/admin/libs/tables/scroller.css') }}
        {{ HTML::script('public/admin/libs/jquery.min.js') }}
        {{ HTML::script('public/admin/libs/bootstrap.min.js') }}
        {{ HTML::script('public/admin/libs/icheck.min.js') }}
    </head>
    <body class="nav-md">
        <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-bolt"></i> <span>Usainbox Admin</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li>
                                    <a><i class="fa fa-users"></i> Membres <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="">Liste</a></li>
                                        <li><a href="">Ajouter</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a><i class="fa fa-car"></i> Vehicules</a>
                                </li>
                                <li>
                                    <a><i class="fa fa-car"></i> Transports</a>
                                </li>
                                <li>
                                    <a><i class="fa fa-car"></i> Réservations</a>
                                </li>
                                <li>
                                    <a><i class="fa fa-comments-o"></i> Commentaires</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="images/img.jpg" alt="">John Doe
                                <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="javascript:;"> Profile</a></li>
                                    <li>
                                        <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                        </a>
                                    </li>
                                    <li><a href="javascript:;">Help</a></li>
                                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                    <li>
                                        <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                                        <span>John Smith</span>
                                        <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                                        <span>John Smith</span>
                                        <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                                        <span>John Smith</span>
                                        <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                                        <span>John Smith</span>
                                        <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="right_col" role="main">
                @yield('content')
                <footer>
                    <div class="pull-right">
                        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
            </div>
        </div>
        {{ HTML::script('public/admin/libs/fastclick.js') }}
        {{ HTML::script('public/admin/libs/nprogress.js') }}
        {{ HTML::script('public/admin/libs/date.js') }}
        {{ HTML::script('public/admin/libs/moment.min.js') }}
        {{ HTML::script('public/admin/libs/bootstrap-progressbar.min.js') }}
        
        {{ HTML::script('public/admin/libs/tables/tables.js') }}
        {{ HTML::script('public/admin/libs/tables/dtables.js') }}
        {{ HTML::script('public/admin/libs/tables/buttons.js') }}
        {{ HTML::script('public/admin/libs/tables/buttons.js') }}
        {{ HTML::script('public/admin/libs/tables/buttons.flash.js') }}
        {{ HTML::script('public/admin/libs/tables/buttons.html5.js') }}
        {{ HTML::script('public/admin/libs/tables/buttons.print.js') }}
        {{ HTML::script('public/admin/libs/tables/fixheader.js') }}
        {{ HTML::script('public/admin/libs/tables/keytable.js') }}
        {{ HTML::script('public/admin/libs/tables/responsive.js') }}
        {{ HTML::script('public/admin/libs/tables/responsivebs.js') }}
        {{ HTML::script('public/admin/libs/tables/scroller.js') }}
        
        {{ HTML::script('public/admin/script.js') }}
    </body>
</html>