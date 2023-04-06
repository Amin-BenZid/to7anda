            <!--body wrapper start-->
            <div class="wrapper">
                <!--state overview start-->
                <div class="row state-overview">
                <div  style="overflow-x:auto;">                   
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading ">
                                <button id="b_ajouter_admin"  type="button" class="btn btn-success " >Ajouter un administrateur <i class="fa fa-plus topbar-info-icon top-2"></i></button>
                                <span class="tools pull-right">
                                </span>
                            </header>
                            <table class="table colvis-data-table data-table">
                            <thead>
                            <tr>
                                <th >
                                    <div align="center">Login</div>  
                                </th>
                                <th align="center">
                                    <div align="center">Administrateur</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Les rôles</div>
                                </th>
                                <th align="center">    
                                    <div align="center">État</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Les actions</div>
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($admins as $admin){
                                 echo "<tr>";
                                 echo "<td><div align='center'>";
                                 echo $admin->login."<br>";
                                 echo "Crée le ".$admin->created_at."<br>";
                                 if($admin->updated_at!=NULL){
                                    echo "Dernière modification le ".$admin->updated_at."<br>";
                                 }
                                 
                                 
                                 echo "</div></td>";
                                 echo "<td><div align='center'>"; 
                                 echo "<div class='team-m'>";
                                 echo "<a href='#'>";?>
                                                               
                            
                            <?php
                                if($admin->photo==""){
                                    if($admin->sexe==1){ ?>
                                        <img src="<?php echo base_url('assets/img/male.png'); ?>" alt="">
                                    <?php }
                                        else{ ?><img src="<?php echo base_url('assets/img/female.png'); ?>" alt=""> <?php }
                                }
                                    else{ ?>
                                        <img src="<?php echo base_url('uploads/'.$admin->photo); ?>" alt=""> <?php

                                    }

                                ?>
                            <?php
                            if($admin->online==1){echo"<i class='online dot'></i>";}else{echo"<i class='busy dot'></i>";}
                                echo"</a> </div>";
                                 if($admin->sexe==1){echo"<i class='fa fa-male'></i> ";}else{echo"<i class='fa fa-female'></i>  ";}
                                 echo $admin->prenom.' '.$admin->nom.'<br>';
                                 if($admin->cin!=""){echo "<b>CIN : </b>".$admin->cin."<br/>";}
                                 if($admin->tel!=""){echo "<b>Tél : </b>".$admin->tel.'<br>';}
                                 if($admin->email!=""){echo "<b>Email : </b>".$admin->email.'<br>';}
                                 echo "".$admin->desc.'<br>';
                                 
                                 echo "</div></td>";
                                 echo "<td><div align='center'>";
                                 $ch='';
                                         $ch.='<button type="button" class="btn btn-success" title="" id="';
        $ch.=$admin->id.'/////'.$admin->login.'/////'.$admin->sexe.'/////'.$admin->nom.'/////'.$admin->prenom.'/////'.$admin->tel.'/////'.$admin->email.'/////'.$admin->desc.'/////'.$admin->etat.'/////'.$admin->roles.'/////'.$admin->cin;
        $ch.='" onclick="edit_roles_admin(this.id);"><i class="fa fa-edit"></i></button>';
                                 echo'<div>'.$ch.'</div>';
                                 echo "</div></td>";
                                 echo "<td><div align='center'>";
                                 if($admin->etat==1){echo"<div class='bg-success light-color'> Activé </div>";}else{echo"<div class='bg-danger light-color'> Bloqué </div>";}
                                 echo "</div></td>";
                                 echo "<td><div align='center'>";
                                 $ch='';

         if($admin->tel!=""){
            $pass ="";
            $this->load->library('encrypt');
            $pass = $this->encrypt->decode($admin->password);
        $ch.='<button type="button" class="btn btn-success" title="Envoi de login et mot de passe par SMS" id="';
        $ch.=$admin->id.'/////'.$admin->login.'/////'.$admin->sexe.'/////'.$admin->nom.'/////'.$admin->prenom.'/////'.$admin->tel.'/////'.$admin->email.'/////'.$admin->desc.'/////'.$admin->etat.'/////'.$admin->cin.'/////'.$pass;
        $ch.='" onclick="envoi_sms_admin(this.id);"><i class="fa fa-share-square"></i></button>';

    }
    $pass ="";
            $this->load->library('encrypt');
            $pass = $this->encrypt->decode($admin->password);
    $ch.='<button type="button" class="btn btn-default" title="Impression" id="';
    $ch.=$admin->id.'/////'.$admin->login.'/////'.$admin->sexe.'/////'.$admin->nom.'/////'.$admin->prenom.'/////'.$admin->tel.'/////'.$admin->email.'/////'.$admin->desc.'/////'.$admin->etat.'/////'.$admin->cin.'/////'.$pass;
    $ch.='" onclick="impression_compte_admin(this.id);"><i class="fa fa-print"></i></button>';

                                 if($admin->etat==1){
        $ch.='<button type="button" class="btn btn-default" title="Blocage" id="';
        $ch.=$admin->id.'/////'.$admin->login.'/////'.$admin->sexe.'/////'.$admin->nom.'/////'.$admin->prenom.'/////'.$admin->tel.'/////'.$admin->email.'/////'.$admin->desc.'/////'.$admin->etat.'/////'.$admin->cin;
        $ch.='" onclick="blocage_compte_admin(this.id);"><i class="fa fa-lock"></i></button>';
    }else{
        $ch.='<button type="button" class="btn btn-default" title="Déblocage" id="';
        $ch.=$admin->id.'/////'.$admin->login.'/////'.$admin->sexe.'/////'.$admin->nom.'/////'.$admin->prenom.'/////'.$admin->tel.'/////'.$admin->email.'/////'.$admin->desc.'/////'.$admin->etat.'/////'.$admin->cin;
        $ch.='" onclick="deblocage_compte_admin(this.id);"><i class="fa fa-unlock"></i></button>';
    }
   
     
    $ch.='<button type="button" class="btn btn-default" title="Réinitialisation de mot de passe" id="';
    $ch.=$admin->id.'/////'.$admin->login.'/////'.$admin->sexe.'/////'.$admin->nom.'/////'.$admin->prenom.'/////'.$admin->tel.'/////'.$admin->email.'/////'.$admin->desc.'/////'.$admin->etat.'/////'.$admin->cin;
    $ch.='" onclick="reinitialisation_compte_admin(this.id);"><i class="fa fa-key"></i></button>';
    
    $ch.='<button type="button" class="btn btn-default" title="Modification" id="';
    $ch.=$admin->id.'/////'.$admin->login.'/////'.$admin->sexe.'/////'.$admin->nom.'/////'.$admin->prenom.'/////'.$admin->tel.'/////'.$admin->email.'/////'.$admin->desc.'/////'.$admin->etat.'/////'.$admin->photo.'/////'.$admin->cin;
    $ch.='" onclick="modification_compte_admin(this.id);"><i class="fa fa-edit"></i></button>';

    $ch.='<button type="button" class="btn btn-default" title="Suppression" id="';
    $ch.=$admin->id.'/////'.$admin->login.'/////'.$admin->sexe.'/////'.$admin->nom.'/////'.$admin->prenom.'/////'.$admin->tel.'/////'.$admin->email.'/////'.$admin->desc.'/////'.$admin->etat.'/////'.$admin->cin;
    $ch.='" onclick="suppression_compte_admin(this.id);"><i class="fa fa-times"></i></button>';
    echo $ch;




                                 echo "</div></td>";
                                 echo "</tr>";   
                                }
                                ?>
                                                    
                            
                            
                            </tbody>
                            </table>
                        </section>
                    </div>
                </div>
                </div>   
                    
                </div>
                <!--state overview end-->
                <!-- Modal -->
                    <div class="modal fade" id="ajouteradminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Ajouter un administrateur</h4>
                                </div>
                                <div class="modal-body" align="center">

                                    
                                    <?php
    //echo form_open_multipart(base_url('sdl/administrators/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
        <form action="<?php echo base_url('sdl/administrators/');?>" method="POST" role="form" id="form_add" enctype="multipart/form-data" class="form-horizontal">
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_add_admin"></div>
       </div>
      
     </div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">CIN</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="cin_ajout_admin" name="cin_ajout_admin" required >
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Nom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="nom_ajout_admin" name="nom_ajout_admin" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Prénom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="prenom_ajout_admin" name="prenom_ajout_admin" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Sexe</label>
                                    <div class="col-lg-9">
                                        <div class="radio-list" align="center">
                                    
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_ajout_admin" name="sexe_ajout_admin"  value="1" checked> Homme
                                    </label>
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_ajout_admin" name="sexe_ajout_admin"  value="2" > Femme 
                                    </label> 
                                 </div>
                                    </div>
                            </div>
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Téléphone</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="tel_ajout_admin" name="tel_ajout_admin">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Email</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="email" class="form-control" placeholder="" id="email_ajout_admin" name="email_ajout_admin">
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Description</label>
                            <div class="col-lg-9">
                                <textarea id="desc_ajout_admin" name="desc_ajout_admin" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Photo</label>
                            <div class="col-lg-9">
                                <input id="photo_ajout_admin" name="photo_ajout_admin" class="file" type="file" multiple=false>
                            </div>
                            </div>
                            
                         


                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_ajouter_admin_action" class="btn btn-success" type="button">Ajouter&nbsp;<i class="fa  fa-plus topbar-info-icon top-2"></i></button>
                                </div>
                                <?php //echo form_close() ; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="blocageadminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Blocage</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/administrators/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">
                                

                                    <div id="div_blocage_admin"></div>
                                    <h4>Voulez vous vraiment bloquer ce compte ?</h4>
                                    <input type="hidden" name="id_blocage_admin" id="id_blocage_admin" value="">
        

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_blocage_admin_action" class="btn btn-danger" type="submit">Bloquer&nbsp;<i class="fa fa-lock topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="deblocageadminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Déblocage</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/administrators/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_deblocage_admin"></div>
                                    <h4>Voulez vous vraiment activer ce compte ?</h4>
                                    <input type="hidden" name="id_deblocage_admin" id="id_deblocage_admin" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_deblocage_admin_action" class="btn btn-success" type="submit">Activer&nbsp;<i class="fa fa-unlock topbar-info-icon top-2"></i></button>

                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="roleseadminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Les rôles</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/administrators/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_roles_admin">
         
        <div align="center">
        <label class="checkbox-inline"><b>Gestion des appartements</b></label><br/>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_11"  value="11">Les blocs</label>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_12"  value="12">Les appartements</label>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_13"  value="13">Les tags</label>
                
        </div>
        <hr/>
        <div align="center">
        <label class="checkbox-inline"><b>Gestion des utilisateurs</b></label><br/>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_21"  value="21">Les propriétaires</label>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_22"  value="22">Les réclamations</label>

        
        
        </div>
         <hr/>
        <div align="center">
        <label class="checkbox-inline"><b>Gestion des services</b></label><br/>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_31"  value="31">Les services</label>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_32"  value="32">Les employés</label>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_33"  value="33">Salle de sport</label>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_34"  value="34">Demande service</label>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_35"  value="35">Les appels</label>
        
        
        </div>
        <hr/>
        <div align="center">
        <label class="checkbox-inline"><b>Gestion des demandes</b></label><br/>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_41"  value="41">Les services</label>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_42"  value="42">Les autorisations</label>
        
        </div>
        <hr/>
        <div align="center">
        <label class="checkbox-inline"><b>Les historiques </b></label><br/>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_51"  value="51">Les services</label>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_52"  value="52">Les autorisations</label>
        <!--<label class="checkbox-inline"><input type="checkbox" id="ch_role_53"  value="53">Les actions</label>-->
        
        </div>
        <hr/>
        <div align="center">
        <label class="checkbox-inline"><b>Les statistiques </b></label><br/>
        <label class="checkbox-inline"><input type="checkbox" id="ch_role_61"  value="61">Les services</label>
        
        
        </div>
        <hr/>
        </div>
        <div id="div_conf_update_roles_admin"><h2>Voulez-vous vraiment enregistrer les rôles ?</h2></div>

        <input type="hidden" name="id_roles_admin" id="id_roles_admin" value="">
        <input type="hidden" name="roles_admin" id="roles_admin" value="">

                                </div>
                                <div class="modal-footer">
                                    <button id="b_roles_up_admin" type="button" class="btn btn-success" title="Modification"><i class="fa fa-edit"></i></button>
                                    <button id="b_roles_an_up_admin" type="button" class="btn btn-danger" title="Annulation"><i class="fa fa-times"></i></button>
                                    <button id="b_roles_update_admin_action" type="button" class="btn btn-success">Modifier&nbsp;<i class="fa fa-edit"></i></button>
                                    <button id="b_roles_save_update_admin_action" type="submit" class="btn btn-success">Enregistrer&nbsp;<i class="fa fa-save topbar-info-icon top-2"></i></button>
                                    <button id="b_roles_annuler_update_admin_action" type="button" class="btn btn-danger">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button type="button" class="btn" data-dismiss="modal">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="reinitialisationadminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Réinitialisation de mot de passe</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/administrators/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_reinitialisation_admin"></div>
                                    <h4>Voulez vous vraiment réinitialiser le mot de passe de ce compte ?</h4>
                                    <input type="hidden" name="id_reinitialisation_admin" id="id_reinitialisation_admin" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_reinitialisation_admin_action" class="btn btn-success" type="submit">Réinitialiser&nbsp;<i class="fa fa-key topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="modificationadminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modification</h4>
                                </div>
                                <?php
    //echo form_open_multipart(base_url('sdl/administrators/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
        <form action="<?php echo base_url('sdl/administrators/');?>" method="POST" role="form" id="form_up" enctype="multipart/form-data" class="form-horizontal">
    <div class="modal-body" align="center">
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_modif_admin"></div>
       </div>
      
     </div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Login</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="login_modif_admin" name="login_modif_admin" value="" disabled="true">
                                            <input type="hidden" name="id_modif_admin" id="id_modif_admin" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">CIN</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="cin_modif_admin" name="cin_modif_admin" required>
                                            <input type="hidden" id="l_cin_modif_admin" name="l_cin_modif_admin" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Nom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="nom_modif_admin" name="nom_modif_admin" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Prénom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="prenom_modif_admin" name="prenom_modif_admin" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Sexe</label>
                                    <div class="col-lg-9">
                                        <div class="radio-list" align="center">
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_modif_admin" name="sexe_modif_admin"  value="1" checked> Homme
                                    </label>
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_modif_admin" name="sexe_modif_admin"  value="2" > Femme 
                                    </label> 
                                 </div>
                                    </div>
                            </div>
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Téléphone</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="tel_modif_admin" name="tel_modif_admin">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Email</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="email" class="form-control" placeholder="" id="email_modif_admin" name="email_modif_admin">
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Description</label>
                            <div class="col-lg-9">
                                <textarea id="desc_modif_admin" name="desc_modif_admin" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Photo</label>
                            <div class="col-lg-9">
                                <input id="photo_modif_admin" name="photo_modif_admin" class="file" type="file" multiple=false>
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
                                    <button id="b_modif_admin_action" class="btn btn-success" type="button">Modifier&nbsp;<i class="fa  fa-edit topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="suppressionadminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Suppression</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/administrators/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_suppression_admin"></div>
                                    <h4>Voulez vous vraiment supprimer ce compte ?</h4>
                                    <input type="hidden" name="id_suppression_admin" id="id_suppression_admin" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_suppression_admin_action" class="btn btn-danger" type="submit">Supprimer&nbsp;<i class="fa fa-trash-o topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
    <!-- ********************************************************************* -->
<div id="sms_admin_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4  class="modal-title">Envoi SMS</h4>

      </div>
      <div  class="modal-body">
        <div class="form-body" align="center">
        <input type="hidden" name="id_client_sms" id="id_client_sms" value="">
        <input type="hidden" name="log_client_sms" id="log_client_sms" value="">
        <input type="hidden" name="pass_client_sms" id="pass_client_sms" value="">
        <input type="hidden" name="num_client_sms" id="num_client_sms" value="">
        <input type="hidden" name="nom_client_sms" id="nom_client_sms" value="">
        <input type="hidden" name="type_client_sms" id="type_client_sms" value="">
        <input type="hidden" name="pass_client_sms" id="pass_client_sms" value="">
        <input type="hidden" name="entete_client_sms" id="entete_client_sms" value="">
        <div id="entete_sms"></div>       
        <div><h4>Voulez-vous vraiment envoyer le login et le mot de passe par SMS ?</h4></div>

      </div>
      <div class="modal-footer">
        <button id="b_sms_admin_action" type="button" class="btn btn-success">Envoyer&nbsp;<i class="fa  fa-location-arrow topbar-info-icon top-2"></i></button>
        <button type="button" class="btn " data-dismiss="modal">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
      </div>
      </div>
    </div>

  </div>
</div>
    <!-- ********************************************************************* -->
               

            </div>
            <!--body wrapper end-->