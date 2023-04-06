            <!--body wrapper start-->
            <div class="wrapper">
                <!--state overview start-->
                <div class="row state-overview">
                <div  style="overflow-x:auto;">                   
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading ">
                                <button id="b_ajouter_empl"  type="button" class="btn btn-success " >Ajouter un employé <i class="fa fa-plus topbar-info-icon top-2"></i></button>
                                <span class="tools pull-right">
                                </span>
                            </header>
                            <table class="table colvis-data-table data-table">
                            <thead>
                            <tr>
                                <th >
                                    <div align="center">Employé</div>  
                                </th>
                                <th align="center">
                                    <div align="center">Contact</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Services</div>
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

                                foreach ($employees as $empl){
                                 echo "<tr>";
                                 echo "<td><div align='center'>"; 
                                 echo "<div class='team-m'>";
                                 echo "<a href='#'>";?>
                                                               
                            
                            <?php
                                if($empl->photo==""){
                                    if($empl->sexe==1){ ?>
                                        <img src="<?php echo base_url('assets/img/male.png'); ?>" alt="">
                                    <?php }
                                        else{ ?><img src="<?php echo base_url('assets/img/female.png'); ?>" alt=""> <?php }
                                }
                                    else{ ?>
                                        <img src="<?php echo base_url('uploads/'.$empl->photo); ?>" alt=""> <?php

                                    }

                                ?>
                            <?php
                            if($empl->etat==1){echo"<i class='online dot'></i>";}else{echo"<i class='busy dot'></i>";}
                                echo"</a> </div>";
                                 if($empl->sexe==1){echo"<i class='fa fa-male'></i> ";}else{echo"<i class='fa fa-female'></i>  ";}
                                 echo $empl->prenom.' '.$empl->nom.'<br>';
                                 if($empl->cin!=""){echo '<b>CIN : </b>'.$empl->cin.'<br>';}
                                 echo $empl->desc.'<br>';
                                 
                                 echo "</div></td>";
                                 echo "<td><div align='center'>";
                                 if($empl->tel!=""){echo '<b>Tél : </b>'.$empl->tel.'<br>';}                      
                                 if($empl->email!=""){echo '<b>Email : </b>'.$empl->email.'<br>';}
                                 echo "</div></td>";
                                 echo "<td><div align='center'>";
                                 $sevs_ar = explode(',', $empl->id_service);
                                 for ($i=0; $i < count($sevs_ar) ; $i++) { 
                                     foreach ($services as $service){
                                        if($sevs_ar[$i]==$service->id){
                                            echo '<b>'.$service->nom.'</b><br/>'.$service->desc.'<br/>';
                                        }
                                                
                                            }
                                 }

                                 echo "</div></td>";
                                 echo "<td><div align='center'>";
                                 if($empl->etat==1){echo"<div class='bg-success light-color'> En service </div>";}else{echo"<div class='bg-danger light-color'> Hors-service </div>";}
                                 echo "</div></td>";
                                 echo "<td><div align='center'>";
                                 $ch='';

                                 if($empl->etat==1){
        //id,nom,prenom,sexe,tel,email,desc,photo,etat,id_service,non_s,desc_s
        $ch.='<button type="button" class="btn btn-default" title="Hors-service" id="';
        $ch.=$empl->id.'/////'.$empl->nom.'/////'.$empl->prenom.'/////'.$empl->sexe.'/////'.$empl->tel.'/////'.$empl->email.'/////'.$empl->desc.'/////'.$empl->photo.'/////'.$empl->etat.'/////'.$empl->id_service.'/////'.$empl->cin;
        $ch.='" onclick="hors_etat_empl(this.id);"><i class="fa fa-exchange"></i></button>';
    }else{
        $ch.='<button type="button" class="btn btn-default" title="En service" id="';
        $ch.=$empl->id.'/////'.$empl->nom.'/////'.$empl->prenom.'/////'.$empl->sexe.'/////'.$empl->tel.'/////'.$empl->email.'/////'.$empl->desc.'/////'.$empl->photo.'/////'.$empl->etat.'/////'.$empl->id_service.'/////'.$empl->cin;
        $ch.='" onclick="en_etat_empl(this.id);"><i class="fa fa-exchange"></i></button>';
    }
   

    
    $ch.='<button type="button" class="btn btn-default" title="Modification" id="';
    $ch.=$empl->id.'/////'.$empl->nom.'/////'.$empl->prenom.'/////'.$empl->sexe.'/////'.$empl->tel.'/////'.$empl->email.'/////'.$empl->desc.'/////'.$empl->photo.'/////'.$empl->etat.'/////'.$empl->id_service.'/////'.$empl->cin;
    $ch.='" onclick="modification_empl(this.id);"><i class="fa fa-edit"></i></button>';

    $ch.='<button type="button" class="btn btn-default" title="Suppression" id="';
    $ch.=$empl->id.'/////'.$empl->nom.'/////'.$empl->prenom.'/////'.$empl->sexe.'/////'.$empl->tel.'/////'.$empl->email.'/////'.$empl->desc.'/////'.$empl->photo.'/////'.$empl->etat.'/////'.$empl->id_service.'/////'.$empl->cin;
    $ch.='" onclick="suppression_empl(this.id);"><i class="fa fa-times"></i></button>';
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
                    <div class="modal fade" id="ajouteremplModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Ajouter un employé</h4>
                                </div>
                                <div class="modal-body" align="center">

                                    
                                    <?php
    //echo form_open_multipart(base_url('sdl/employees/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <form action="<?php echo base_url('sdl/employees/');?>" method="POST" role="form" id="form_add" enctype="multipart/form-data" class="form-horizontal">
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_add_empl"></div>
       </div>
      
     </div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">CIN</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="cin_ajout_empl" name="cin_ajout_empl" required >
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Nom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="nom_ajout_empl" name="nom_ajout_empl" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Prénom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="prenom_ajout_empl" name="prenom_ajout_empl" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Sexe</label>
                                    <div class="col-lg-9">
                                        <div class="radio-list" align="center">
                                    
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_ajout_empl" name="sexe_ajout_empl"  value="1" checked> Homme
                                    </label>
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_ajout_empl" name="sexe_ajout_empl"  value="2" > Femme 
                                    </label> 
                                 </div>
                                    </div>
                            </div>
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Téléphone</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="tel_ajout_empl" name="tel_ajout_empl">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Email</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="email" class="form-control" placeholder="" id="email_ajout_empl" name="email_ajout_empl">
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Description</label>
                            <div class="col-lg-9">
                                <textarea id="desc_ajout_empl" name="desc_ajout_empl" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Photo</label>
                            <div class="col-lg-9">
                                <input id="photo_ajout_empl" name="photo_ajout_empl" class="file" type="file" multiple=false>
                            </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Services</label>
                                    <div class="col-lg-9">
                                        <div class="" id="div_services_add">
                                            <?php
                                            foreach ($services as $service){
                                                echo'<label class="checkbox-custom inline check-info">';
                                                echo'<input type="checkbox" name="services[]" value="'.$service->id.'" id="'.$service->id.'">';
                                                echo'<label for="'.$service->id.'">'.$service->nom.'</label>';
                                                echo'</label>';
                                            }
                                            ?>
                                    </div>
                                    </div>
                            </div>
                            
                         


                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_ajouter_empl_action" class="btn btn-success" type="button">Ajouter&nbsp;<i class="fa  fa-plus topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="horsemplModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Hors-service</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/employees/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">
                                

                                    <div id="div_hors_empl"></div>
                                    <h4>Voulez-vous vraiment mettre cet employé hors-service ?</h4>
                                    <input type="hidden" name="id_hors_empl" id="id_hors_empl" value="">
        

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_hors_empl_action" class="btn btn-danger" type="submit">Oui&nbsp;<i class="fa fa-save topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="enemplModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">En service</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/employees/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_en_empl"></div>
                                    <h4>Voulez-vous vraiment mettre cet employé en service ?</h4>
                                    <input type="hidden" name="id_en_empl" id="id_en_empl" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_en_empl_action" class="btn btn-success" type="submit">Oui&nbsp;<i class="fa fa-save topbar-info-icon top-2"></i></button>

                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                
                
                <!-- Modal -->
                    <div class="modal fade" id="modificationemplModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modification</h4>
                                </div>
                                <?php
    //echo form_open_multipart(base_url('sdl/employees/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
     <form action="<?php echo base_url('sdl/employees/');?>" method="POST" role="form" id="form_up" enctype="multipart/form-data" class="form-horizontal">
    <div class="modal-body" align="center">
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_modif_empl"></div>
       </div>
      
     </div>
     
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">CIN</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="cin_modif_empl" name="cin_modif_empl" required>
                                            <input type="hidden" id="l_cin_modif_empl" name="l_cin_modif_empl" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Nom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="nom_modif_empl" name="nom_modif_empl" required>
                                            <input type="hidden" name="id_modif_empl" id="id_modif_empl" value="">
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Prénom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="prenom_modif_empl" name="prenom_modif_empl" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Sexe</label>
                                    <div class="col-lg-9">
                                        <div class="radio-list" align="center">
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_modif_empl" name="sexe_modif_empl"  value="1" checked> Homme
                                    </label>
                                    <label class="radio-inline">
                                    <input type="radio" id="sexe_modif_empl" name="sexe_modif_empl"  value="2" > Femme 
                                    </label> 
                                 </div>
                                    </div>
                            </div>
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Téléphone</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="tel_modif_empl" name="tel_modif_empl">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Email</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="email" class="form-control" placeholder="" id="email_modif_empl" name="email_modif_empl">
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Description</label>
                            <div class="col-lg-9">
                                <textarea id="desc_modif_empl" name="desc_modif_empl" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Photo</label>
                            <div class="col-lg-9">
                                <input id="photo_modif_empl" name="photo_modif_empl" class="file" type="file" multiple=false>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label"></label>
                            <div class="col-lg-9">
                                <div id="aff_photo_modif" class='team-m'></div>
                            </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Services</label>
                                    <div class="col-lg-9">
                                    <div class="" id="div_services_modif">
                                            <?php
                                            foreach ($services as $service){
                                                echo'<label class="checkbox-custom inline check-info">';
                                                echo'<input type="checkbox" name="upservices[]" value="'.$service->id.'" id="up_serv_'.$service->id.'">';
                                                echo'<label for="up_serv_'.$service->id.'">'.$service->nom.'</label>';
                                                echo'</label>';
                                            }
                                            ?>
                                    </div>
                                    </div>
                            </div>
                            
                         


                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_modif_empl_action" class="btn btn-success" type="button">Modifier&nbsp;<i class="fa  fa-edit topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="suppressionemplModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Suppression</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/employees/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_suppression_empl"></div>
                                    <h4>Voulez vous vraiment supprimer cet employé ?</h4>
                                    <input type="hidden" name="id_suppression_empl" id="id_suppression_empl" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_suppression_empl_action" class="btn btn-danger" type="submit">Supprimer&nbsp;<i class="fa fa-trash-o topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

               

            </div>
            <!--body wrapper end-->