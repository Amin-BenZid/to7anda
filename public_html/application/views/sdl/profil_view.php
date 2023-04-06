<section class="panel">
                    <div class="panel-body">
                        <div class="s-p-info text-center">
                            <div class="avatar">
                                <?php
                                if($info[0]->photo==""){
                                    if($info[0]->sexe==1){ ?><img class="img-circle" src="<?php echo base_url('assets/img/male.png'); ?>" alt=""><?php }
                                        else{ ?><img class="img-circle" src="<?php echo base_url('assets/img/female.jpg'); ?>" alt=""> <?php }
                                }
                                    else{ ?>
                                        <img class="img-circle" src="<?php echo base_url('uploads/'.$info[0]->photo); ?>" alt=""> <?php

                                    }
                                ?>

                            </div>
                            <h2 class="text-uppercase">

                                <?php
                                 echo $info[0]->login; 
                                ?>
                            </h2>
                            <h2 class="text-uppercase">

                                <?php
                                if($info[0]->sexe==1){echo"<i class='fa fa-male'></i> ";}else{echo"<i class='fa fa-female'></i>  ";}
                                 echo $info[0]->prenom.' '.$info[0]->nom; 
                                ?>
                            </h2>
                            <p>
                               <?php echo $info[0]->email ?> 
                            </p>
                            <p>
                               <?php echo $info[0]->tel ?> 
                            </p>
                            <p>
                               <?php echo $info[0]->desc ?> 
                            </p>
                            <ul class="user-p-list">                              
                            <div class="panel-body">
                            <?php
                            $ch='';
                            $ch.='<button type="button" class="btn btn-success btn-block" title="" id="';
                            $ch.=$info[0]->id.'/////'.$info[0]->login.'/////'.$info[0]->sexe.'/////'.$info[0]->nom.'/////'.$info[0]->prenom.'/////'.$info[0]->tel.'/////'.$info[0]->email.'/////'.$info[0]->desc.'/////'.$info[0]->etat.'/////'.$info[0]->photo;
                            $ch.='" onclick="update_profil_user(this.id);">Modification de profil</button>';
                                 echo''.$ch.'';
                                 ?>

                            <?php
                            $ch='';
                            $ch.='<button type="button" class="btn btn-success btn-block" title="" id="';
                            $ch.=$info[0]->id.'/////'.$info[0]->login.'/////'.$info[0]->sexe.'/////'.$info[0]->nom.'/////'.$info[0]->prenom.'/////'.$info[0]->tel.'/////'.$info[0]->email.'/////'.$info[0]->desc.'/////'.$info[0]->etat.'/////'.$info[0]->photo;
                            $ch.='" onclick="update_password_user(this.id);">Modification de mot de passe</button>';
                                 echo''.$ch.'';
                                 ?>
                            </div>
                            </ul>
                        </div>
                    </div>
                </section>


<!-- Modal -->
                    <div class="modal fade" id="modificationuserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modification</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/profil/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <div class="modal-body" align="center">
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_modif_user"></div>
       </div>
      
     </div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Login</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="login_modif_user" name="login_modif_user" value="" disabled="true">
                                            <input type="hidden" name="id_modif_user" id="id_modif_user" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Nom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="nom_modif_user" name="nom_modif_user" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Prénom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="prenom_modif_user" name="prenom_modif_user" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Sexe</label>
                                    <div class="col-lg-9">
                                        <div class="radio-list" align="center">
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_modif_user" name="sexe_modif_user"  value="1" checked> Homme
                                    </label>
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_modif_user" name="sexe_modif_user"  value="2" > Femme 
                                    </label> 
                                 </div>
                                    </div>
                            </div>
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Téléphone</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="tel_modif_user" name="tel_modif_user">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Email</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="email" class="form-control" placeholder="" id="email_modif_user" name="email_modif_user">
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Description</label>
                            <div class="col-lg-9">
                                <textarea id="desc_modif_user" name="desc_modif_user" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Photo</label>
                            <div class="col-lg-9">
                                <input id="photo_modif_user" name="photo_modif_user" class="file" type="file" multiple=false>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label"></label>
                            <div class="col-lg-9">
                                <div id="aff_photo_modif" class='team-m'></div>
                            </div>
                            </div>
                            
                         


                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_modif_user_action" class="btn btn-success" type="submit">Modifier&nbsp;<i class="fa  fa-edit topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
               

<!-- Modal -->
                    <div class="modal fade" id="modificationpassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modification</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/profil/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <div class="modal-body" align="center">
     <div class="row">
       <div class="col-md-4"></div>
       <div class="col-md-8">
         <div class="alert alert-danger" align="center" id="div_message_erreur_modif_pass"></div>
       </div>
      
     </div>
 
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Login</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="login_modif_user_pass" name="login_modif_user_pass" value="" disabled="true">
                                            <input type="hidden" name="id_modif_user_pass" id="id_modif_user_pass" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Ancien mot de passe</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-key"></i>
                                            <input type="password" class="form-control" placeholder="Tapez l’ancien  mot de passe ici" id="ancien_mdp_user" name="ancien_mdp_user" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Nouveau mot de passe</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-key"></i>
                                            <input type="password" class="form-control" placeholder="Tapez le nouveau mot de passe ici" id="nouveau_mdp_user" name="nouveau_mdp_user" required>
                                        </div>
                                    </div>
                            </div>
                           
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label"></label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-key"></i>
                                            <input type="password" class="form-control" placeholder="Retapez le nouveau mot de passe ici" id="r_nouveau_mdp_user" name="r_nouveau_mdp_user">
                                        </div>
                                    </div>
                            </div>
                            
                         


                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_modif_pass_action" class="btn btn-success" type="button">Modifier&nbsp;<i class="fa  fa-edit topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                                                                