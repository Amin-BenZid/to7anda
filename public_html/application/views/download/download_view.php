<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Template">
    <meta name="keywords" content="admin dashboard, admin, flat, flat ui, ui kit, app, web app, responsive">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/ico/favicon.png'); ?>">
    <title>Connexion</title>

    <!-- Base Styles -->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style-responsive.css'); ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->


</head>

  <body class="login-body">

      <div class="login-logo">
          <img src="<?php echo base_url('assets/img/gloulou.png'); ?>"  alt=""/>
          <img src="<?php echo base_url('assets/img/k2.png'); ?>" width="120" height="120" alt=""/>
      </div>

      <h2 class="form-heading">
                        <img src="<?php echo base_url('assets/img/sdl_logo_icon.png'); ?>" width=""  alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                        <b>Application mobile</b><br/>Propriétaire

      </h2>
      <div class="container log-row">
          <?php echo form_open(base_url('login/'), 'role="form" class="form-signin"') ; ?>
              <div class="login-wrap">

            
            
           
                  
                  <a href="<?php echo base_url('assets/apk/v1/Gloulou K2.apk'); ?>" class="btn btn-lg btn-success btn-block"><i class="fa fa-download"></i> &nbsp;Télécharger</a>
                  
                 
                  


              </div>

              

          
          <?php echo form_close() ; ?>
      </div>


      <!--jquery-1.10.2.min-->
      <script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js'); ?>"></script>
      <!--Bootstrap Js-->
      <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
      <script src="<?php echo base_url('assets/js/jrespond..min.js'); ?>"></script>

  </body>
</html>
