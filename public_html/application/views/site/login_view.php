
<!-- ******************************   BEGIN  ********************************************** -->

  

        <!-- BEGIN CONTAINER -->   
        <div class="container margin-bottom-40">
          <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 login-signup-page">
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
            <?php echo form_open(base_url('site/login/'), 'role="form"') ; ?>
                        
                    
                    <h2><i class="fa fa-unlock"></i>&nbsp;Connexion</h2>

                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
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

                        <input type="text" class="form-control" name="login" value="<?php echo $login; ?>" placeholder="Utilisateur" required >
                    </div>                    
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" placeholder="Mot de passe" required>

                        
                    </div>                    

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="checkbox-list"><label class="checkbox">
                            <?php

                            echo '<input type="checkbox" name="remember"';
                            if($this->session->has_userdata('user_remember')&& $this->session->userdata('user_remember') == 1){
                            echo' checked="true"';
                            }
                            echo '>';
                            ?>
                          
                             Se rappeler de moi</label></div>                        
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn theme-btn pull-right"><i class="fa fa-key"></i>&nbsp;Connexion</button>                        
                        </div>
                    </div>

                    <hr>

                    <div class="login-socio">
                        <p class="text-muted">Si vous oubliez votre mot de passe alors contactez l'administration sur le numéro <?php echo $query_config[0]->tel;?> pour le réinitialiser . <i class="fa fa-smile-o yellow fa-1x"></i></p>

                       
                    </div>
               <?php echo form_close() ; ?>
            </div>
          </div>
        </div>
        <!-- END CONTAINER -->

<!-- *******************************  END     ********************************************** -->