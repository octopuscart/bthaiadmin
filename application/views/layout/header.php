
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>Color Admin | Blank Page</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- ================== BEGIN BASE CSS STYLE ================== -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/style.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/style-responsive.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
        <link href="<?php echo base_url(); ?>assets/css/customstyle.css" rel="stylesheet" />

        <!-- ================== END BASE CSS STYLE ================== -->

        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
        <link href="<?php echo base_url(); ?>assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
        <!-- ================== END PAGE LEVEL STYLE ================== -->

        <!-- ================== BEGIN BASE JS ================== -->
        <script src="<?php echo base_url(); ?>assets/plugins/pace/pace.min.js"></script>
        <!-- ================== END BASE JS ================== -->
        <!--angular js-->
        <script src="<?php echo base_url(); ?>assets/angular/angular.min.js"></script>

    </head>
    <body class="" ng-app="Admin">

        <script>
            var Admin = angular.module('Admin', []).config(function ($interpolateProvider, $httpProvider) {
                //$interpolateProvider.startSymbol('{$');
                //$interpolateProvider.endSymbol('$}');
                $httpProvider.defaults.headers.common = {};
                $httpProvider.defaults.headers.post = {};

            });
        </script>
        <!-- begin #page-loader -->
        <div id="page-loader" class="fade in"><span class="spinner"></span></div>
        <!-- end #page-loader -->
        <!-- begin #page-container -->
        <div id="page-container" class="page-sidebar-fixed page-header-fixed">