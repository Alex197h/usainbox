<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Usainbox Admin Panel</title>
        {{ Html::style('public/css/font-awesome.min.css') }}
        {{ Html::style('public/css/bootstrap.min.css') }}
        {{ Html::style('public/admin/style.css') }}
        {{ Html::style('public/admin/libs/nprogress.css') }}
        {{ Html::style('public/admin/libs/green.css') }}
        {{ Html::style('public/admin/libs/select2.min.css') }}
        {{ Html::style('public/admin/libs/switchery.min.css') }}
        {{ Html::style('public/admin/libs/tables/tables.css') }}
        {{ Html::style('public/admin/libs/tables/buttons.css') }}
        {{ Html::style('public/admin/libs/tables/fixheader.css') }}
        {{ Html::style('public/admin/libs/tables/reponsive.css') }}
        {{ Html::style('public/admin/libs/tables/scroller.css') }}
        {{ Html::style('public/admin/libs/pnotify.css') }}
        {{ Html::style('public/admin/libs/pnotify.buttons.css') }}
        {{ Html::style('public/admin/libs/pnotify.nonblock.css') }}
        {{ HTML::script('public/admin/libs/jquery.min.js') }}
        {{ HTML::script('public/admin/libs/bootstrap.min.js') }}
    </head>
    <body class="nav-md">
        <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{ route('admin') }}" class="site_title"><i class="fa fa-bolt"></i> <span>Usainbox Admin</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="{{ route('admin_page', 'users') }}"><i class="fa fa-users"></i> Membres</a></li>
                                <li><a href="{{ route('admin_page', 'vehicles') }}"><i class="fa fa-car"></i> Vehicules</a></li>
                                <li><a href="{{ route('admin_page', 'transports') }}"><i class="fa fa-car"></i> Transports</a></li>
                                <li><a><i class="fa fa-car"></i> Réservations</a></li>
                                <li><a><i class="fa fa-comments-o"></i> Commentaires</a></li>
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
                </div>
            </div>
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                        <h3>@yield('title', '')</h3>
                    </div>
                </div>
                @yield('content')
                <footer>
                    <div class="pull-right">
                        &copy; Usainbox - Tous droits réservés - Administration
                    </div>
                    <div class="clearfix"></div>
                </footer>
            </div>
        </div>
        <script>
            function Notif(title, text, color){
                new PNotify({
                    title: title,
                    text: text,
                    type: color || 'success',
                    delay: 2000,
                    styling: 'bootstrap3'
                });
            }
        </script>
        {{ HTML::script('public/admin/libs/fastclick.js') }}
        {{ HTML::script('public/admin/libs/nprogress.js') }}
        {{ HTML::script('public/admin/libs/icheck.min.js') }}
        {{ HTML::script('public/admin/libs/date.js') }}
        {{ HTML::script('public/admin/libs/moment.min.js') }}
        {{ HTML::script('public/admin/libs/switchery.min.js') }}
        {{ HTML::script('public/admin/libs/select2.min.js') }}
        {{ HTML::script('public/admin/libs/validator.js') }}
        {{ HTML::script('public/admin/libs/bootstrap-progressbar.min.js') }}
        {{ HTML::script('public/admin/libs/pnotify.js') }}
        {{ HTML::script('public/admin/libs/pnotify.buttons.js') }}
        {{ HTML::script('public/admin/libs/pnotify.nonblock.js') }}
        
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
        
        @yield('script', '')
    </body>
</html>