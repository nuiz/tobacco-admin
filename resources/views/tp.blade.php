<!DOCTYPE html>
<html class="sidebar sidebar-discover">
<head>
    <title>Tobacco Admin</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <!--
	**********************************************************
	In development, use the LESS files and the less.js compiler
	instead of the minified CSS loaded by default.
	**********************************************************
	-->
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="<?php echo URL::to("/assets/components/library/bootstrap/css/bootstrap.min.css");?>" />
    <![endif]-->
    <link rel="stylesheet" href="<?php echo URL::to("/assets/css/admin/module.admin.stylesheet-complete.sidebar_type.collapse.min.css");?>" />
    <link rel="stylesheet" href="<?php echo URL::to("/assets/css/admin/module.admin.stylesheet-complete.sidebar_type.collapse.min.css");?>" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo URL::to("/assets/components/library/jquery/jquery.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("/assets/components/library/jquery/jquery-migrate.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("/assets/components/library/modernizr/modernizr.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("/assets/components/plugins/less-js/less.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("/assets/components/modules/admin/charts/flot/assets/lib/excanvas.js?v=v1.0.3-rc2");?>"></script>
    <script src="<?php echo URL::to("/assets/components/plugins/browser/ie/ie.prototype.polyfill.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script>
        if ( /*@cc_on!@*/ false && document.documentMode === 10)
        {
            document.documentElement.className += ' ie ie10';
        }
    </script>
</head>
<body>
<?php $u = Session::get("userlogin");?>
<!-- Main Container Fluid -->
<div class="container-fluid menu-hidden">
    <!-- Sidebar Menu -->
    <div id="menu" class="hidden-print hidden-xs ">
        <div id="sidebar-collapse-wrapper">
            <ul class="list-unstyled">
                <?php if(in_array($u->level_id, [1])){?>
                <li><a class="glyphicons user" href="<?php echo URL::to("/config");?>"><i></i><span>ตั้งค่าระบบ</span></a></li>
                <?php }?>
                <?php if(in_array($u->level_id, [1, 2])){?>
                <li><a class="glyphicons user" href="<?php echo URL::to("/usercluster");?>"><i></i><span>ผู้ใช้งาน(Cluster)</span></a></li>
                <?php }?>
                <?php if(in_array($u->level_id, [1, 2, 3])){?>
                <li><a class="glyphicons user" href="<?php echo URL::to("/userwriter");?>"><i></i><span>ผู้ใช้งาน(Writer)</span></a></li>
                <?php }?>
                <li><a class="glyphicons notes_2" href="<?php echo URL::to("/content");?>"><i></i><span>เนื้อหา</span></a></li>
                <li><a class="icon-newspaper" href="<?php echo URL::to("/news");?>"><i></i><span>ข่าวสาร</span></a></li>
                <li><a class="icon-user-1" href=""><i></i><span>ผู้เชี่ยวชาญ</span></a></li>
            </ul>
        </div>
    </div>
    <!-- // Sidebar Menu END -->
    <!-- Content -->
    <div id="content">
        <nav class="navbar hidden-print main " role="navigation">
            <div class="navbar-header pull-left">
                <div class="user-action user-action-btn-navbar pull-left border-right">
                    <button class="btn btn-sm btn-navbar btn-inverse btn-stroke"><i class="fa fa-bars fa-2x"></i>
                    </button>
                </div>
            </div>
            <ul class="main pull-right ">

                <li class="dropdown username">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <!--<img src="<?php //echo URL::to("/assets/images/people/35/2.jpg");?>" class="img-circle"
                             width="30" />Administrator-->
                        <?php echo $u->username;?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        {{--<li><a href="#" class="glyphicons user"><i></i> Account</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#" class="glyphicons envelope"><i></i>Messages</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="#" class="glyphicons settings"><i></i>Settings</a>--}}
                        {{--</li>--}}
                        <li><a href="<?php echo URL::to("logout");?>" class="glyphicons lock no-ajaxify"><i></i>Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a data-toggle="dropdown" style="font-weight:bolder" href="" >Tobacco Admin</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div>
            @yield('content')
        </div>
    </div>
    <div id="footer" class="hidden-print">
        <!--  Copyright Line -->
        <div class="copy">&copy; 2013 - 2015 - <a href="http://www.tufftexgroup.com">Tufftex Group Co., Ltd.</a> -
            All Rights Reserved. - Current version: v1.0
        </div>
        <!--  End Copyright Line -->
    </div>
    <!-- // Footer END -->
    <script data-id="App.Config">
        var App = {};
        var basePath = '',
                commonPath = '../assets/',
                rootPath = '../',
                DEV = false,
                componentsPath = '../assets/components/';
        var primaryColor = '#3695d5',
                dangerColor = '#b55151',
                successColor = '#609450',
                infoColor = '#4a8bc2',
                warningColor = '#ab7a4b',
                inverseColor = '#45484d';
        var themerPrimaryColor = primaryColor;
    </script>
    <script src="<?php echo URL::to("/assets/components/library/bootstrap/js/bootstrap.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("/assets/components/plugins/nicescroll/jquery.nicescroll.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("/assets/components/plugins/breakpoints/breakpoints.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("/assets/components/plugins/preload/pace/pace.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("/assets/components/plugins/preload/pace/preload.pace.init.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("/assets/components/core/js/animations.init.js?v=v1.0.3-rc2");?>"></script>

    <script src="<?php echo URL::to("/assets/components/modules/admin/maps/vector/assets/lib/jquery-jvectormap-1.2.2.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("/assets/components/modules/admin/maps/vector/assets/lib/maps/jquery-jvectormap-world-mill-en.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("/assets/components/modules/admin/maps/vector/assets/custom/maps-vector.world-map-markers.init.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo URL::to("/assets/components/core/js/sidebar.main.init.js?v=v1.0.3-rc2");?>"></script>
    <script src="<?php echo URL::to("/assets/components/core/js/sidebar.discover.init.js?v=v1.0.3-rc2");?>"></script>
    <script src="<?php echo URL::to("/assets/components/core/js/core.init.js?v=v1.0.3-rc2");?>"></script>
</body>
</html>