<!DOCTYPE html>
<html lang="en" class="">
    <head>
        <meta charset="utf-8" />
        <title><?=PROJECT_NAME;?></title>
        <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="stylesheet" href="<?=base_url('assets/libs/assets/animate.css/animate.css');?>" type="text/css" />
        <link rel="stylesheet" href="<?=base_url('assets/libs/assets/font-awesome/css/font-awesome.min.css');?>" type="text/css" />
        <link rel="stylesheet" href="<?=base_url('assets/libs/assets/simple-line-icons/css/simple-line-icons.css');?>" type="text/css" />
        <link rel="stylesheet" href="<?=base_url('assets/libs/jquery/bootstrap/dist/css/bootstrap.css');?>" type="text/css" />

        <link rel="stylesheet" href="<?=base_url('assets/css/font.css');?>" type="text/css" />
        <link rel="stylesheet" href="<?=base_url('assets/css/app.css');?>" type="text/css" />

        <link rel="stylesheet" href="<?=base_url('assets/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.css');?>" type="text/css" />
        <script src="<?=base_url('assets/libs/jquery/jquery/dist/jquery.js');?>"></script>

        <!-- sweetalert Stylesheets -->
        <link rel="stylesheet" href="<?=base_url('assets/regform/sweetalert.css');?>" type="text/css">
        <link rel="stylesheet" href="<?=base_url('assets/regform/jquery.toast.css');?>">
    </head>
    <body>
        <div class="app app-header-fixed ">

            <!-- header -->
            <header id="header" class="app-header navbar" role="menu">
                <!-- navbar header -->
                <div class="navbar-header bg-dark">
                    <button class="pull-right visible-xs dk" ui-toggle-class="show" target=".navbar-collapse">
                        <i class="glyphicon glyphicon-cog"></i>
                    </button>
                    <button class="pull-right visible-xs" ui-toggle-class="off-screen" target=".app-aside" ui-scroll="app">
                        <i class="glyphicon glyphicon-align-justify"></i>
                    </button>
                    <!-- brand -->
                    <a href="#/" class="navbar-brand text-lt">
                      <!--<img src="img/logo.png" alt="." class="hide">-->
                        <span class="hidden-folded m-l-xs"><?=PROJECT_NAME;?></span>
                    </a>
                    <!-- / brand -->
                </div>
                <!-- / navbar header -->

                <!-- navbar collapse -->
                <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
                    <!-- buttons -->
                    <div class="nav navbar-nav hidden-xs">
                        <a href="#" class="btn no-shadow navbar-btn" ui-toggle-class="app-aside-folded" target=".app">
                            <i class="fa fa-dedent fa-fw text"></i>
                            <i class="fa fa-indent fa-fw text-active"></i>
                        </a>
                    </div>
                    <!-- / buttons -->

                    <!-- nabar right -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="javascript:;" onclick="getNotificationData()" data-toggle="dropdown" class="dropdown-toggle clear">
                                <i class="icon-bell fa-fw"></i>
                                <span class="visible-xs-inline">Notifications</span>
                                <span class="badge badge-sm up bg-danger pull-right-xs">2</span>
                            </a>
                            <!-- dropdown
                            <div class="dropdown-menu w-xl animated fadeInUp">
                                <div class="panel bg-white">
                                    <div class="panel-heading b-light bg-light">
                                        <strong>You have <span>2</span> notifications</strong>
                                    </div>
                                    <div class="list-group">
                                        <a href class="list-group-item">
                                            <span class="pull-left m-r thumb-sm">
                                                <img src="<?php //echo base_url() . PROFILEPIC . 'a0.jpg';?>" alt="..." class="img-circle">
                                            </span>
                                            <span class="clear block m-b-none">
                                                Use awesome animate.css<br>
                                                <small class="text-muted">10 minutes ago</small>
                                            </span>
                                        </a>
                                        <a href class="list-group-item">
                                            <span class="clear block m-b-none">
                                                1.0 initial released<br>
                                                <small class="text-muted">1 hour ago</small>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="panel-footer text-sm">
                                        <a href class="pull-right"><i class="fa fa-cog"></i></a>
                                        <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
                                    </div>
                                </div>
                            </div>
                            <!-- / dropdown -->
                        </li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
                                <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                                    <img src="<?=base_url() . PROFILEPIC . 'a0.jpg';?>" alt="...">
                                    <i class="on md b-white bottom"></i>
                                </span>
                                <span class="hidden-sm hidden-md">John.Smith</span> <b class="caret"></b>
                            </a>
                            <!-- dropdown -->
                            <ul class="dropdown-menu animated fadeInRight w">
                                <li class="wrapper b-b m-b-sm bg-light m-t-n-xs">
                                    <a href="<?=base_url('admin/home/profile');?>">Profile</a>
                                </li>
                                <li>
                                    <a href="#">Change Password</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="<?php echo base_url('admin/setting') ?>">Institution Setting</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="<?php echo base_url('admin/setting/challan') ?>">Challan Setting</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="<?=base_url('admin/login/logout');?>">Logout</a>
                                </li>
                            </ul>
                            <!-- / dropdown -->
                        </li>
                    </ul>
                    <!-- / navbar right -->
                </div>
                <!-- / navbar collapse -->
            </header>
            <!-- / header -->

        <div class="hbox hbox-auto-xs hbox-auto-sm">