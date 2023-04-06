<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="author" content="Mosaddek" />
    <meta name="keyword" content="slick, flat, dashboard, bootstrap, admin, template, theme, responsive, fluid, retina" />
    <meta name="description" content="" />
    <link rel="shortcut icon" href="javascript:;" type="image/png">

    <title>SDL ---SMART DOOR LOCK ---</title>

    <!--easy pie chart-->
    <link href="<?php echo base_url('assets/js/jquery-easy-pie-chart/jquery.easy-pie-chart.css'); ?>" rel="stylesheet" type="text/css" media="screen" />

    <!--vector maps -->
    <link rel="stylesheet" href="<?php echo base_url('assets/js/vector-map/jquery-jvectormap-1.1.1.css'); ?>">

    <!--right slidebar-->
    <link href="<?php echo base_url('assets/css/slidebars.css'); ?>" rel="stylesheet">

    <!--switchery-->
    <link href="<?php echo base_url('assets/js/switchery/switchery.min.css'); ?>" rel="stylesheet" type="text/css" media="screen" />


    <!--gritter-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/gritter/css/jquery.gritter.css'); ?>" />

    <!--jquery-ui-->
    <link href="<?php echo base_url('assets/js/jquery-ui/jquery-ui-1.10.1.custom.min.css'); ?>" rel="stylesheet" />

    <!--iCheck-->
    <link href="<?php echo base_url('assets/js/icheck/skins/all.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/css/owl.carousel.css'); ?>" rel="stylesheet">

    <!--Data Table-->
    <link href="<?php echo base_url('assets/js/data-table/css/jquery.dataTables.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/js/data-table/css/dataTables.tableTools.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/js/data-table/css/dataTables.colVis.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/js/data-table/css/dataTables.responsive.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/js/data-table/css/dataTables.scroller.css'); ?>" rel="stylesheet">
    <!-- Base Styles -->

    <!--bootstrap-fileinput-master-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/bootstrap-fileinput-master/css/fileinput.css'); ?>" />

    <!--common style-->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style-responsive.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/js/jquery-1.10.2.min.js'); ?>"></script>
   
    <script type="text/javascript">
          localStorage.setItem("base_url", "<?php echo base_url(); ?>");
    </script>
    

        <?php
         if (isset($tabjs)) 
         {
             foreach ($tabjs as $js)
             {
                 echo '<script type="text/javascript" src="'.base_url().''.$js.'"></script>';
             }
         }
         ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
                <?php
                /*
                11: Les blocs,
                12: Les appartements,
                13: Les tags,
                21: Les propriétaires,
                31: Les services,
                32: Les employés,
                41: Les services,
                42: Les autorisations,
                51: Les services,
                52: Les autorisations,
                53: Les actions
                */
                
                $tab_roles = explode(",", $info[0]->roles);
                 ?>
<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <div class="sidebar-left">
            <!--responsive view logo start-->
            <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
                <a href="<?php echo base_url('owner/'); ?>">
                    <img src="<?php echo base_url('assets/img/sdl_logo_icon.png'); ?>" alt="">
                    <!--<i class="fa fa-maxcdn"></i>-->
                    <span class="brand-name">SDL</span>
                </a>
            </div>
            <!--responsive view logo end-->

            <div class="sidebar-left-info">
                <!-- visible small devices start-->
                <div class=" search-field">  </div>
                <!-- visible small devices end-->

                <!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked side-navigation">
                    <li>
                        <h3 class="navigation-title">Navigation</h3>
                    </li>
                    <li <?php if($menu == 1){ echo'class="active"';} ?> ><a href="<?php echo base_url('owner/'); ?>"><i class="fa fa-dashboard"></i> <span>Tableau de bord</span></a></li>
                    <li <?php if($menu == 2){ echo'class="active"';} ?> ><a href="<?php echo base_url('owner/apartments/'); ?>"><i class="fa fa-building"></i> <span>Les appartements</span></a></li>
                    <li <?php if($menu == 3){ echo'class="active"';} ?> ><a href="<?php echo base_url('owner/services/'); ?>"><i class="fa fa-briefcase"></i> <span>Les services</span></a></li>
                    <li <?php if($menu == 4){ echo'class="active"';} ?> ><a href="<?php echo base_url('owner/authorizations/'); ?>"><i class="fa fa-users"></i> <span>Les autorisations</span></a></li>
                    <li <?php if($menu == 5){ echo'class="active"';} ?> ><a href="<?php echo base_url('owner/reclamations/'); ?>"><i class="fa fa-paper-plane"></i> <span>Les réclamations</span></a></li>                  

                                        

                </ul>
                <!--sidebar nav end-->

            </div>
        </div>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" >

            <!-- header section start-->
            <div class="header-section">

                <!--logo and logo icon start-->
                <div class="logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="<?php echo base_url('owner/'); ?>">
                        <img src="<?php echo base_url('assets/img/sdl_logo_icon.png'); ?>" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                        <span class="brand-name">SDL</span>
                    </a>
                </div>

                <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="<?php echo base_url('owner/'); ?>">
                        <img src="<?php echo base_url('assets/img/sdl_logo_icon.png'); ?>" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                    </a>
                </div>
                <!--logo and logo icon end-->

                <!--toggle button start-->
                <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
                <!--toggle button end-->

                <!--mega menu start-->
                <div id="navbar-collapse-1" class="navbar-collapse collapse yamm mega-menu">
                    <ul class="nav navbar-nav">
                        <!-- Classic list -->
                        
                        

                    </ul>
                </div>
                <!--mega menu end-->
                <div class="notification-wrap">
                <!--left notification start-->
                <div class="left-notification">
                <ul class="notification-menu">
                <!--mail info start-->
                
                <!--mail info end-->

                <!--task info start-->
                
                <!--task info end-->

                <!--notification info start-->
               <!-- <li>
                    <a href="javascript:;" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge bg-warning">4</span>
                    </a>

                    <div class="dropdown-menu dropdown-title ">

                        <div class="title-row">
                            <h5 class="title yellow">
                                <?php
                                $n=4;
                                if($n>1){echo "Vous avez ".$n." nouvelles<br> notifications";}
                                else{echo "Vous avez ".$n." nouvelle<br> notification";}

                                ?>
                            </h5>
                            <a href="<?php echo base_url('sdl/notifications/'); ?>" class="btn-warning btn-view-all">Voir tout</a>                           
                        </div>
                        <div class="notification-list-scroll sidebar">
                            <div class="notification-list mail-list not-list">
                                <a href="javascript:;" class="single-mail">
                                    <span class="icon bg-primary">
                                        <i class="fa fa-envelope-o"></i>
                                    </span>
                                    <strong>New User Registration</strong>

                                    <p>
                                        <small>Just Now</small>
                                    </p>
                                    <span class="un-read tooltips" data-original-title="Mark as Read" data-toggle="tooltip" data-placement="left">
                                        <i class="fa fa-circle"></i>
                                    </span>
                                </a>
                                <a href="javascript:;" class="single-mail">
                                    <span class="icon bg-success">
                                        <i class="fa fa-comments-o"></i>
                                    </span>
                                    <strong> Private message Send</strong>

                                    <p>
                                        <small>30 Mins Ago</small>
                                    </p>
                                    <span class="un-read tooltips" data-original-title="Mark as Read" data-toggle="tooltip" data-placement="left">
                                        <i class="fa fa-circle"></i>
                                    </span>
                                </a>
                                <a href="javascript:;" class="single-mail">
                                    <span class="icon bg-warning">
                                        <i class="fa fa-warning"></i>
                                    </span> Application Error
                                    <p>
                                        <small> 2 Days Ago</small>
                                    </p>
                                    <span class="read tooltips" data-original-title="Mark as Unread" data-toggle="tooltip" data-placement="left">
                                        <i class="fa fa-circle-o"></i>
                                    </span>
                                </a>
                                <a href="javascript:;" class="single-mail">
                                    <span class="icon bg-dark">
                                       <i class="fa fa-database"></i>
                                    </span> Database Overloaded 24%
                                    <p>
                                        <small>1 Week Ago</small>
                                    </p>
                                    <span class="read tooltips" data-original-title="Mark as Unread" data-toggle="tooltip" data-placement="left">
                                        <i class="fa fa-circle-o"></i>
                                    </span>
                                </a>
                                <a href="javascript:;" class="single-mail">
                                    <span class="icon bg-danger">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                    <strong>Server Failed Notification</strong>

                                    <p>
                                        <small>10 Days Ago</small>
                                    </p>
                                    <span class="un-read tooltips" data-original-title="Mark as Read" data-toggle="tooltip" data-placement="left">
                                        <i class="fa fa-circle"></i>
                                    </span>
                                </a>

                            </div>
                        </div>
                    </div>
                </li> -->
                <!--notification info end-->
                </ul>
                </div>
                <!--left notification end-->


                <!--right notification start-->
                <div class="right-notification">
                    <ul class="notification-menu">
                        

                        <li>
                            <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                
                                <?php
                                if($info[0]->photo==""){
                                    if($info[0]->sexe==1){ ?><img class="" src="<?php echo base_url('assets/img/male.png'); ?>" alt=""><?php }
                                        else{ ?><img class="" src="<?php echo base_url('assets/img/female.jpg'); ?>" alt=""> <?php }
                                }
                                    else{ ?>
                                        <img class="" src="<?php echo base_url('uploads/'.$info[0]->photo); ?>" alt=""> <?php

                                    }
                                ?>
                                <?php echo $info[0]->prenom.' '.$info[0]->nom; ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu purple pull-right">
                                <li><a href="<?php echo base_url('owner/profil/'); ?>"><i class="fa fa-user pull-right"></i>  Profil</a></li>
                                <li><a href="<?php echo base_url('login/logout/'); ?>"><i class="fa fa-sign-out pull-right"></i> Se déconnecter</a></li>
                            </ul>
                        </li>
                        

                    </ul>
                </div>
                <!--right notification end-->
                </div>

            </div>
            <!-- header section end-->