<!DOCTYPE html>
<html class="sidebar sidebar-discover">
<head>
    <title>ED/DS Backend</title>
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
    <!--[if lt IE 9]><link rel="stylesheet" href="<?php echo URL::to("/assets/components/library/bootstrap/css/bootstrap.min.css");?>" /><![endif]-->
    <link rel="stylesheet" href="<?php echo URL::to("/assets/css/admin/module.admin.stylesheet-complete.sidebar_type.collapse.min.css");?>"/>
    <link rel="stylesheet" href="<?php echo URL::to("/assets/css/admin/module.admin.stylesheet-complete.sidebar_type.collapse.min.css");?>"
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
<!-- Main Container Fluid -->
<div class="container-fluid menu-hidden">

    <div>
        @yield('content')
    </div>

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