            <!--body wrapper start-->
            <div class="wrapper">
                <!--state overview start-->
                <div class="row state-overview">
                <div  style="overflow-x:auto;">                   
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading ">
                                
                                <span class="tools pull-right">
                                </span>
                            </header>
                            
                            
                            <table class="table colvis-data-table data-table">
                            <thead>
                            <tr>
                                <th align="center">
                                    <div align="center">Propriétaire</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Appartement</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Réclamation</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Date</div>
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                foreach ($reclamations as $req){
                                    //if($req->etat != 5 && $req->etat != 6 ){
                                    if(true){
                                 echo "<tr>";
                                 echo "<td>";







                                foreach ($owners as $owner){
                                    if($owner->id == $req->id_prop){
                                 
                                 echo "<div align='center'>"; 
                                 echo "<div class='team-m'>";
                                 echo "<a href='#'>";?>
                                                               
                            
                            <?php
                                if($owner->photo==""){
                                    if($owner->sexe==1){ ?>
                                        <img src="<?php echo base_url('assets/img/male.png'); ?>" alt="">
                                    <?php }
                                        else{ ?><img src="<?php echo base_url('assets/img/female.png'); ?>" alt=""> <?php }
                                }
                                    else{ ?>
                                        <img src="<?php echo base_url('uploads/'.$owner->photo); ?>" alt=""> <?php

                                    }

                               
                            if($owner->online==1){echo"<i class='online dot'></i>";}else{echo"<i class='busy dot'></i>";}
                                echo"</a> </div>";
                                 if($owner->sexe==1){echo"<i class='fa fa-male'></i> ";}else{echo"<i class='fa fa-female'></i>  ";}
                                 echo $owner->prenom.' '.$owner->nom.'<br>';
                                 if($owner->cin!=""){echo "<b>CIN : </b>".$owner->cin."<br/>";}
                                 if($owner->tel!=""){echo "<b>Tél : </b>".$owner->tel.'<br>';}
                                 if($owner->email!=""){echo "<b>Email : </b>".$owner->email.'<br>';}
                                 echo "".$owner->desc.'<br>';
}
                            }









                                 echo "</td>";
                                 echo "<td><div align='center'>"; 
                                 $id_appartement=0;
                                 $id_bloc=0;
                                 $code="";
                                 $desc="";
                                 $nom_b="";
                                 $desc_b="";
                                 $floor="";
                                 foreach ($apartments as $apartment){
                                    if($apartment->id==$req->id_app){
                                        $id_bloc=$apartment->id_bloc;
                                        $code=$apartment->code;
                                        $desc=$apartment->desc;
                                        $floor=$apartment->floor;
                                    }

                                 }
                                 if($id_bloc!=0){
                                    foreach ($blocs as $bloc){
                                    if($bloc->id==$id_bloc){
                                        $nom_b=$bloc->nom;
                                        $desc_b=$bloc->desc;
                                    }

                                 }
                                 }
                                 //print_r($apartments);
                                 //print_r($blocs);
                                 echo "<b>".$nom_b."</b><br/><b>";
                                 if($floor == 0){ echo "Rez-de-chaussée";}
                                else if($floor == 1){echo "1<sup>ère</sup> étage";}
                                else {echo $floor."<sup>ème</sup> étage";}
                                echo " / ";
                                echo $code."";
                                echo "</b><br>"; 
                                echo $desc;

                                echo "</div></td>";
                                echo "<td><div align='center'>";
                                 
                                echo'<br/>'.$req->reclam.'</br>';
                                echo "</div></td>";                                
                                echo "<td><div align='center'>";

                                echo'<br/>'.$req->date.'</br>';

                                echo "</div></td>";
                                echo "</tr>"; 

                                }
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
                    <div class="modal fade" id="ajouterownerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Ajouter un propriétaire</h4>
                                </div>
                                <div class="modal-body" align="center">

                                    
                                    <?php
                                    //return validateFormAdd();
    //echo form_open_multipart(base_url('sdl/owners/'), array('role'=>'form' , 'class'=>'form-horizontal', 'onsubmit' => 'validateFormAdd()') ); ?>
    <form action="<?php echo base_url('sdl/owners/');?>" method="POST" role="form" id="form_add" enctype="multipart/form-data" class="form-horizontal">
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_add_owner"></div>
       </div>
      
     </div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">CIN</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="cin_ajout_owner" name="cin_ajout_owner" required >
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Nom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="nom_ajout_owner" name="nom_ajout_owner" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Prénom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="prenom_ajout_owner" name="prenom_ajout_owner" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Sexe</label>
                                    <div class="col-lg-9">
                                        <div class="radio-list" align="center">
                                    
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_ajout_owner" name="sexe_ajout_owner"  value="1" checked> Homme
                                    </label>
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_ajout_owner" name="sexe_ajout_owner"  value="2" > Femme 
                                    </label> 
                                 </div>
                                    </div>
                            </div>
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Téléphone</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="tel_ajout_owner" name="tel_ajout_owner">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Email</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="email" class="form-control" placeholder="" id="email_ajout_owner" name="email_ajout_owner">
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Description</label>
                            <div class="col-lg-9">
                                <textarea id="desc_ajout_owner" name="desc_ajout_owner" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Photo</label>
                            <div class="col-lg-9">
                                <input id="photo_ajout_owner" name="photo_ajout_owner" class="file" type="file" multiple=false>
                            </div>
                            </div>
                            
                         


                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_ajouter_owner_action" class="btn btn-success" type="button">Ajouter&nbsp;<i class="fa  fa-plus topbar-info-icon top-2"></i></button>
                                </div>
                                <?php //echo form_close() ; ?>
                            </form>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="blocageownerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Blocage</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/owners/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">
                                

                                    <div id="div_blocage_owner"></div>
                                    <h4>Voulez vous vraiment bloquer ce compte ?</h4>
                                    <input type="hidden" name="id_blocage_owner" id="id_blocage_owner" value="">
        

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_blocage_owner_action" class="btn btn-danger" type="submit">Bloquer&nbsp;<i class="fa fa-lock topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="deblocageownerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Déblocage</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/owners/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_deblocage_owner"></div>
                                    <h4>Voulez vous vraiment activer ce compte ?</h4>
                                    <input type="hidden" name="id_deblocage_owner" id="id_deblocage_owner" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_deblocage_owner_action" class="btn btn-success" type="submit">Activer&nbsp;<i class="fa fa-unlock topbar-info-icon top-2"></i></button>

                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                
                <!-- Modal -->
                    <div class="modal fade" id="reinitialisationownerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Réinitialisation de mot de passe</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/owners/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_reinitialisation_owner"></div>
                                    <h4>Voulez vous vraiment réinitialiser le mot de passe de ce compte ?</h4>
                                    <input type="hidden" name="id_reinitialisation_owner" id="id_reinitialisation_owner" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_reinitialisation_owner_action" class="btn btn-success" type="submit">Réinitialiser&nbsp;<i class="fa fa-key topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="modificationownerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modification</h4>
                                </div>
                                <?php
    //echo form_open_multipart(base_url('sdl/owners/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <form action="<?php echo base_url('sdl/owners/');?>" method="POST" role="form" id="form_up" enctype="multipart/form-data" class="form-horizontal">
    <div class="modal-body" align="center">
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_modif_owner"></div>
       </div>
      
     </div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Login</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="login_modif_owner" name="login_modif_owner" value="" disabled="true">
                                            <input type="hidden" name="id_modif_owner" id="id_modif_owner" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">CIN</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="cin_modif_owner" name="cin_modif_owner" required>
                                            <input type="hidden" id="l_cin_modif_owner" name="l_cin_modif_owner" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Nom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="nom_modif_owner" name="nom_modif_owner" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Prénom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="prenom_modif_owner" name="prenom_modif_owner" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Sexe</label>
                                    <div class="col-lg-9">
                                        <div class="radio-list" align="center">
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_modif_owner" name="sexe_modif_owner"  value="1" checked> Homme
                                    </label>
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_modif_owner" name="sexe_modif_owner"  value="2" > Femme 
                                    </label> 
                                 </div>
                                    </div>
                            </div>
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Téléphone</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="tel_modif_owner" name="tel_modif_owner">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Email</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="email" class="form-control" placeholder="" id="email_modif_owner" name="email_modif_owner">
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Description</label>
                            <div class="col-lg-9">
                                <textarea id="desc_modif_owner" name="desc_modif_owner" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Photo</label>
                            <div class="col-lg-9">
                                <input id="photo_modif_owner" name="photo_modif_owner" class="file" type="file" multiple=false>
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
                                    <button id="b_modif_owner_action" class="btn btn-success" type="button">Modifier&nbsp;<i class="fa  fa-edit topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="suppressionownerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Suppression</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/owners/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_suppression_owners"></div>
                                    <h4>Voulez vous vraiment supprimer ce compte ?</h4>
                                    <input type="hidden" name="id_suppression_owner" id="id_suppression_owner" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_suppression_owner_action" class="btn btn-danger" type="submit">Supprimer&nbsp;<i class="fa fa-trash-o topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                                <!-- Modal -->
                    <div class="modal fade" id="apartmentsownerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Les appartements</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/owners/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_aff_owner"></div>
                                    <div id="div_aff_owner_add">
                                        <button id="b_ajouter_owner_app"  type="button" class="btn btn-success " >Ajouter un appartement <i class="fa fa-plus topbar-info-icon top-2"></i></button>
                                    </div>
                                    
   
                                    <div id="div_add_apartment_owner">
                                        <hr>
                                        <div id="err_message_add_app" align="center"></div>
                                        <div class="form-group">
                                                <label  class="col-lg-3 col-sm-3 control-label">Bloc</label>
                                                <div class="col-lg-8">
                                                    <div class="">
                                                    <select class="form-control m-b-10" id="bloc_apar_add" name="bloc_apar_add" required>
                                                        <option value=""></option>
                                                        <?php
                                                        foreach ($blocs as $bloc){
                                                            echo '<option value="'.$bloc->id.'">'.$bloc->nom.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <label  class="col-lg-3 col-sm-3 control-label">Appartement</label>
                                                <div class="col-lg-8">
                                                    <div class="">
                                                    <select class="form-control m-b-10" id="appar_add_own" name="appar_add_own" >
                                                        <option value=""></option>
                                                        
                                                    </select>
                                                </div>
                                                </div>
                                        </div>
                                        <div class="">
                                    <button id="b_fermer_ajouter_app_owner_action" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_ajouter_app_owner_action" class="btn btn-success" type="button">Ajouter&nbsp;<i class="fa  fa-plus topbar-info-icon top-2"></i></button>
                                </div>

                                        <hr>
                                    </div>
                                    <div id="div_delete_apartment_owner">
                                        
                                    </div>
                                    <div id="div_show_apartments_owner">
                                        
                                    </div>
                                    <input type="hidden" name="id_apartments_owner" id="id_apartments_owner" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->


    <!-- ********************************************************************* -->
<div id="sms_owner_modal" class="modal fade" role="dialog">
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
        <button id="b_sms_owner_action" type="button" class="btn btn-success">Envoyer&nbsp;<i class="fa  fa-location-arrow topbar-info-icon top-2"></i></button>
        <button type="button" class="btn " data-dismiss="modal">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
      </div>
      </div>
    </div>

  </div>
</div>
    <!-- ********************************************************************* -->
    <!-- ******************************************************************** -->

               

            </div>
            <!--body wrapper end-->