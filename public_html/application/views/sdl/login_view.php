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

          <img src="<?php echo base_url('assets/img/gcs.png'); ?>"  alt=""  style="width:200px"/>

          <!-- <img src="<?php echo base_url('assets/img/gcs.png'); ?>" width="120" height="120" alt=""/> -->

      </div>



      <h2 class="form-heading">

                       <!--  <img src="<?php echo base_url('assets/img/sdl_logo_icon.png'); ?>" width=""  alt=""> -->

                        <!--<i class="fa fa-maxcdn"></i>-->

                        <b>GCS</b> --- Room Service---



      </h2>

      <div class="container log-row">

          <?php echo form_open(base_url('sdl/login/'), 'role="form" class="form-signin"') ; ?>

              <div class="login-wrap">



            

            <?php if (isset($login_fail)) : ?>

             <div class="alert alert-danger" align="center"><i class="fa fa-exclamation-triangle fa-2x"></i><b>&nbsp;Utilisateur incorrecte</b></div>

            <?php endif ; ?>

            <?php if (isset($password_fail)) : ?>

             <div class="alert alert-danger" align="center"><i class="fa fa-exclamation-triangle fa-2x"></i><b>&nbsp;Mot de passe incorrecte</b></div>

            <?php endif ; ?>

            <?php if (isset($login_bloquer)) : ?>

             <div class="alert alert-danger" align="center"><i class="fa fa-exclamation-triangle fa-2x"></i><b>&nbsp;Cet utilisateur bloqué</b></div>

            <?php endif ; ?>

            

            <?php echo validation_errors(); ?>

            <?php 

                        if($this->session->has_userdata('user_login') && $this->session->has_userdata('user_password')){

                            $login = $this->session->userdata("user_login");

                            $password = $this->session->userdata("user_password");

                        }

                            else{

                                $login = $this->input->post('login');

                                $password = $this->input->post('password');

                        }

                        

                        

                        

                         

                         



                        ?>

                  <input type="text" class="form-control" placeholder="Utilisateur" name="login"  value="<?php echo $login; ?>" autofocus required>

                  <input type="password" class="form-control" placeholder="Mot de passe" name="password" value="<?php echo $password; ?>" required>

                  <button class="btn btn-lg btn-success btn-block" type="submit">Connexion</button>

                  

                  <label class="checkbox-custom check-success">

                   



                            <?php



                            echo '<input type="checkbox" id="checkbox1" name="remember"';

                            if($this->session->has_userdata('user_remember')&& $this->session->userdata('user_remember') == 1){

                            echo' checked="true"';

                            }

                            echo '>';

                            ?>

                     <label for="checkbox1">Se rappeler de moi</label>

                      

                  </label>

                  



                  <label> 

                      Si vous oubliez votre mot de passe alors contactez l'administration pour le réinitialiser.

                  </label>



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

