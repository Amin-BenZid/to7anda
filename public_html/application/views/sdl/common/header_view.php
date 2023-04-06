<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="author" content="SWATEK" />
    <meta name="keyword" content="GloulouK2" />
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
    <script src="<?php echo base_url('assets/js/chart.min.js'); ?>" type="text/javascript"></script>
    
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
                <a href="<?php echo base_url('sdl/'); ?>">
                    <img src="<?php echo base_url('assets/img/gcs.png'); ?>" alt="" style="width:100px">
                    <!--<i class="fa fa-maxcdn"></i>-->
                   <!--  <span class="brand-name">SDL</span> -->
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
                    <li <?php if($menu == 1){ echo'class="active"';} ?> ><a href="<?php echo base_url('sdl/'); ?>"><i class="fa fa-dashboard"></i> <span>Tableau de bord</span></a></li>
                    <?php 
                    if ($info[0]->type == 1 ) {               
                    ?>
                    <li >
                        <a href="<?php echo base_url('sdl/residences/'); ?>"><i class="fa fa-building"></i>  <span>Les résidences</span></a>
                        
                    </li>
                    <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("11", $tab_roles)|| in_array("12", $tab_roles)|| in_array("13", $tab_roles)) {               
                    ?>
                    <li class="menu-list <?php if($menu == 21 || $menu == 22 || $menu == 23){ echo'nav-active';} ?>">
                        <a href=""><i class="fa fa-building"></i>  <span>Les appartements</span></a>
                        <ul class="child-list">
                            <li></li>
                            <?php 
                            if ($info[0]->type == 1 || in_array("11", $tab_roles)) {     
                            ?>
                            <li <?php if($menu == 21){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/blocks/'); ?>">Les blocs</a></li>
                            <?php } ?>
                            <?php 
                            if ($info[0]->type == 1 || in_array("12", $tab_roles)) {     
                            ?>
                            <li <?php if($menu == 22){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/apartments/'); ?>">Les appartements</a></li>
                            <?php } ?>
                            <?php 
                            if ($info[0]->type == 1 || in_array("13", $tab_roles)) {     
                            ?>
                            <li <?php if($menu == 23){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/tags/'); ?>">Les tags</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("21", $tab_roles)|| in_array("22", $tab_roles)|| in_array("23", $tab_roles)) {               
                    ?>
                    <li class="menu-list <?php if($menu == 31 || $menu == 32 || $menu == 33){ echo'nav-active';} ?>">
                        <a href=""><i class="fa fa-user"></i>  <span>Les utilisateurs</span></a>
                        <ul class="child-list">
                            <li></li>
                            <?php 
                    if ($info[0]->type == 1 || in_array("21", $tab_roles)) {               
                    ?>
                            <li <?php if($menu == 31){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/owners/'); ?>"> Les propriétaires</a></li>
                            <?php } ?>
                            <?php 
                    if ($info[0]->type == 1) {               
                    ?>
                            <li <?php if($menu == 32){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/administrators/'); ?>"> Les administrateurs</a></li>
                            <?php } ?>

                              <?php 
                    if ($info[0]->type == 1 || in_array("23", $tab_roles)) {               
                    ?>
                            <li <?php if($menu == 33){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/reclamations/'); ?>"> Les réclamations</a></li>
                            <?php } ?>

                        </ul>
                    </li>
                    <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("31", $tab_roles) || in_array("32", $tab_roles) || in_array("33", $tab_roles) || in_array("34", $tab_roles) || in_array("35", $tab_roles)) {               
                    ?>
                    <li class="menu-list <?php if($menu == 41 || $menu == 42  || $menu == 43 || $menu == 44 || $menu == 45 ){ echo'nav-active';} ?>"><a href=""><i class="fa fa-briefcase"></i> <span>Les services</span></a>
                        <ul class="child-list">
                            <?php 
                    if ($info[0]->type == 1 || in_array("31", $tab_roles)) {               
                    ?>
                            <li <?php if($menu == 41){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/services/'); ?>"> Les services</a></li>
                            <?php } ?>
                            <?php 
                    if ($info[0]->type == 1 || in_array("32", $tab_roles)) {               
                    ?>
                            <li <?php if($menu == 42){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/employees/'); ?>"> Les employés</a></li>
                            <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("33", $tab_roles)) {               
                    ?>
                            <li <?php if($menu == 43){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/sport/'); ?>"> Salle de sport</a></li>
                            <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("34", $tab_roles)) {               
                    ?>
                            <li <?php if($menu == 44){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/service_r/'); ?>"> Demande service</a></li>
                            <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("35", $tab_roles)) {               
                    ?>
                            <!--<li <?php if($menu == 45){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/appels/'); ?>"> Les appels </a></li> -->
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    
                    <?php 
                    if ($info[0]->type == 1 || in_array("41", $tab_roles) || in_array("42", $tab_roles)) {               
                    ?>
                    <li class="menu-list <?php if($menu == 51 || $menu == 52){ echo'nav-active';} ?>"><a href="javascript:;"><i class="fa fa-envelope-o"></i> <span>Les demandes</span></a>
                        <ul class="child-list">
                            <?php 
                    if ($info[0]->type == 1 || in_array("41", $tab_roles)) {               
                    ?>
                            <li <?php if($menu == 51){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/s_requests/'); ?>"> Les services</a></li>
                            <?php } ?>
                            <?php 
                    if ($info[0]->type == 1 || in_array("42", $tab_roles)) {               
                    ?>
                            <li <?php if($menu == 52){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/a_requests/'); ?>"> Les autorisations</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php 
                    if ($info[0]->type == 1 || in_array("51", $tab_roles)|| in_array("52", $tab_roles) || in_array("53", $tab_roles)) {               
                    ?>

                    <li class="menu-list <?php if($menu == 61 || $menu == 62 || $menu == 63){ echo'nav-active';} ?>"><a href=""><i class="fa fa-calendar"></i> <span>Les historiques</span></a>
                        <ul class="child-list">
                            <?php 
                    if ($info[0]->type == 1 || in_array("51", $tab_roles)) {               
                    ?>
                            <li <?php if($menu == 61){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/s_histories/'); ?>"> Les services</a></li>
                            <?php } ?>
                            <?php 
                    if ($info[0]->type == 1 || in_array("52", $tab_roles)) {               
                    ?>
                            <li <?php if($menu == 62){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/a_histories/'); ?>"> Les autorisations</a></li>
                            <?php } ?>
                        
                        <?php 
                    if ($info[0]->type == 1) {               
                    ?>
                            <li <?php if($menu == 63){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/ac_histories/'); ?>"> Les actions</a></li>
                            <?php } ?>    
                        </ul>
                    </li>

                    <li class="menu-list <?php if($menu == 71){ echo'nav-active';} ?>"><a href=""><i class="fa fa-bar-chart"></i> <span>Les statistiques</span></a>
                        <ul class="child-list">
                            <?php 
                    if ($info[0]->type == 1 || in_array("61", $tab_roles)) {               
                    ?>
                            <li <?php if($menu == 71){ echo'class="active"';} ?>><a href="<?php echo base_url('sdl/s_statistiques/'); ?>"> Les services</a></li>
                            <?php } ?>
                            
                   
                     

                            
                        </ul>
                    </li>
                    <?php } ?>

                                        

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
                    <a href="<?php echo base_url('sdl/'); ?>">
                        <img src="<?php echo base_url('assets/img/gcs.png'); ?>" alt="" style="width: 100px;">
                        <!--<i class="fa fa-maxcdn"></i>-->
                       <!--  <span class="brand-name">GCS</span> -->
                    </a>
                </div>

                <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="<?php echo base_url('sdl/'); ?>">
                        <img src="<?php echo base_url('assets/img/gcs.png'); ?>" alt=""  style="width: 100px;">
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
               <li>
                    <a href="javascript:;" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge bg-danger" id="nb_not_s0"> 
                          <?php 
                            $n = 0;
                            if(isset($nb_demandeservice[0]->nb_demandeservice)){
                                $n = $nb_demandeservice[0]->nb_demandeservice;
                            }
                            echo $n; 
                            ?> 
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-title ">

                        <div class="title-row" >
                            <h5 class="title yellow" id="div_nb_mot_s0">
                                
                                <?php
                                if($n>1){$ch = "Vous avez ".$n." nouvelles<br> demandes";}
            else{$ch = "Vous avez ".$n." nouvel<br> demande";}
            echo $ch;
            ?>
                                
                            </h5>
                            <a href="<?php echo base_url('sdl/s_requests/'); ?>" class="btn-danger btn-view-all">Voir tout</a> 
                            <input type="hidden" id="nb_n" value="">

                        </div>
                        
                    </div>
                </li>
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
                                <li><a href="<?php echo base_url('sdl/profil/'); ?>"><i class="fa fa-user pull-right"></i>  Profil</a></li>
                                <li><a href="<?php echo base_url('login/logout/'); ?>"><i class="fa fa-sign-out pull-right"></i> Se déconnecter</a></li>
                            </ul>
                        </li>
                        

                    </ul>
                </div>
                <!--right notification end-->
                </div>

            </div>
            <!-- header section end-->