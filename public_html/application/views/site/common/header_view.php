<!DOCTYPE html>


<!--[if !IE]><!--> <html lang="fr"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

           <script type="text/javascript">

          localStorage.setItem("base_url", "<?php echo base_url(); ?>");

        </script> 

    <meta charset="utf-8" />

    <title><?php echo $titre;  ?></title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />





   <!-- BEGIN GLOBAL MANDATORY STYLES -->          

   <link href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"/>

   <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>

   <!-- END GLOBAL MANDATORY STYLES -->



   <!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 

   <link href="<?php echo base_url('assets/plugins/fancybox/source/jquery.fancybox.css'); ?>" rel="stylesheet" />              

   <link rel="stylesheet" href="<?php echo base_url('assets/plugins/revolution_slider/css/rs-style.css'); ?>" media="screen">

   <link rel="stylesheet" href="<?php echo base_url('assets/plugins/revolution_slider/rs-plugin/css/settings.css'); ?>" media="screen"> 

   <link href="<?php echo base_url('assets/plugins/bxslider/jquery.bxslider.css'); ?>" rel="stylesheet" />                

   <!-- END PAGE LEVEL PLUGIN STYLES -->

  

   <!-- BEGIN THEME STYLES --> 

   <link href="   <?php echo base_url('assets/css/style-metronic.css'); ?>" rel="stylesheet" type="text/css"/>

   <link href="   <?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>

   <link href="   <?php echo base_url('assets/css/themes/blue.css'); ?>" rel="stylesheet" type="text/css" id="style_color"/>

   <link href="   <?php echo base_url('assets/css/style-responsive.css'); ?>" rel="stylesheet" type="text/css"/>

   <link href="   <?php echo base_url('assets/css/pages/prices.css'); ?>" rel="stylesheet" type="text/css"/>

   <link href="   <?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet" type="text/css"/>

   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

   <!-- END THEME STYLES -->
       <script src="<?php echo base_url('assets/plugins/jquery-1.10.2.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-migrate-1.2.1.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>  
    <?php
         if (isset($tabjs)) 
         {
             foreach ($tabjs as $js)
             {
                 echo '<script type="text/javascript" src="'.base_url().''.$js.'"></script>';
             }
         }
         ?>



   <link rel="shortcut icon" href="favicon.ico" />





</head>
























<!-- BEGIN BODY -->
<body>
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-default navbar-static-top">
        <!-- BEGIN TOP BAR -->
        <div class="front-topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <ul class=" list-unstyled inline">
                            <li><h2><i class="fa fa-phone topbar-info-icon top-2"></i>Appelez-nous: <span><?php echo $query_config[0]->tel;?></span></h2></li>

                        </ul>
                       
                    </div>
                    <div class="col-md-3 col-sm-3">
                       <ul class="social-icons  social-icons-color list-unstyled inline">

                         <?php if($query_config[0]->fb!="") {?> 
                            <li><a href="<?php echo $query_config[0]->fb;?>" data-original-title="facebook" class="facebook" target="_blank"></a></li>
                          <?php }?>
                          <?php if($query_config[0]->youtube!="") {?> 
                            <li><a href="<?php echo $query_config[0]->youtube;?>" data-original-title="youtube" class="youtube" target="_blank"></a></li>
                          <?php }?>
                          <?php if($query_config[0]->gplus!="") {?> 
                            <li><a href="" data-original-title="googleplus" class="googleplus" target="_blank"></a></li>
                          <?php }?>
                            <?php if($query_config[0]->twiter!="") {?> 
                            <li><a href="" data-original-title="twitter" class="twitter" target="_blank"></a></li>
                          <?php }?>
                            
                        </ul>
                    </div>
                    <div class="col-md-5 col-sm-5 login-reg-links">
                        <ul class=" inline">
                            <li><h2><a href="<?php echo base_url('site/login/'); ?>"><i class="fa fa-user topbar-info-icon -2"></i>
                            <?php
                             if($this->session->has_userdata('logged_in')){
                            $logged_in = $this->session->userdata('logged_in');
                            if($logged_in){echo "Mon Compte";}
                            else{ echo "Connectez-vous à votre compte";}

                          }else{ echo "Connectez-vous à votre compte";}
                            

                             ?>
                            
                            </a></h2></li>
                          
                            
                        </ul>
                    </div>
                </div>
            </div>        
        </div>
        <!-- END TOP BAR -->
		<div class="container">
			<div class="navbar-header">
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<button class="navbar-toggle btn navbar-btn" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN LOGO (you can use logo image instead of text)-->
				<a href=" <?php echo base_url(''); ?>">
        <?php if($query_config[0]->logo!="") {?> 
          <img src=" <?php echo base_url('uploads/image/logo/'.$query_config[0]->logo); ?>" id="logoimg" alt="" width="70px" height="70px">
        <?php }else{?>
          <img src=" <?php echo base_url('assets/img/logo.jpg'); ?>" id="logoimg" alt="" width="70px" height="70px">
        <?php }?>
				</a>
				<!-- END LOGO -->
			</div>
		
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					
        <li <?php if($menu == 1){ echo'class="active"';} ?> ><a href="<?php echo base_url('site/'); ?>">Accueil  </a></li>
         
        <li <?php if($menu == 2){ echo'class="active"';} ?> ><a href="<?php echo base_url('site/fondateur/'); ?>">Fondateur de l’établissement  </a></li>
        <li <?php if($menu == 3){ echo'class="active"';} ?> ><a href="<?php echo base_url('site/mot_du_directeur/'); ?>">Mot du directeur  </a></li>

          <li <?php if($menu == 4){ echo'class="active"';} ?> ><a href="<?php echo base_url('site/equipe/'); ?>">Equipe pédagogique  </a></li>                       
          <li <?php if($menu == 5){ echo'class="active"';} ?> ><a href="<?php echo base_url('site/galerie/'); ?>">Galerie  </a></li>
					
					<li <?php if($menu == 6){ echo'class="active"';} ?>><a href="<?php echo base_url('site/contact/'); ?>">Contact </a></li>
                    
                </ul>                         
            </div>
            <!-- BEGIN TOP NAVIGATION MENU -->
		</div>
    </div>
    <!-- END HEADER -->

    <!-- BEGIN PAGE CONTAINER -->  
    <div class="page-container">

    <!-- Trigger the modal with a button -->

<!-- Modal -->
<div id="pubModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">
      <div align="center">
        <img src="<?php echo base_url('assets/img/pub.png'); ?>" class="img-responsive">
      </div>
      </div>

    </div>

  </div>
</div>


