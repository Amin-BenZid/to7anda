            <!--body wrapper start-->
            <div class="wrapper">
                <!--state overview start-->
                <div class="row state-overview">
                <div  style="overflow-x:auto;">                   
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel"> 
                            <header class="panel-heading ">
                                <button id="b_ajouter_tag"  type="button" class="btn btn-success " >Ajouter un tag  <i class="fa fa-plus topbar-info-icon top-2"></i></button>
                                <button id="b_modifier_passtag"  type="button" class="btn btn-success " >Modifier tag pass  <i class="fa fa-edit topbar-info-icon top-2"></i></button>
                                <span class="tools pull-right">
                                </span>
                            </header>
                            <table class="table colvis-data-table data-table">
                            <thead>
                            <tr>
                                <th >
                                    <div align="center">UID</div>  
                                </th>
                                <th >
                                    <div align="center">Type</div>  
                                </th>
                                <th >
                                    <div align="center">Appartement</div>  
                                </th>
                                <th align="center">    
                                    <div align="center">Les actions</div>
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($tags as $tag){
                                    if($tag->type!=2){
                                //id,uid,etat,id_appartement,id_bloc,code,desc,id_proprietaire,nom_b,desc_b
                                 echo "<tr>";
                                 echo "<td><div align='center'>";
                                 echo $tag->uid."";
                                 echo "</div></td>";
                                 echo "<td><div align='center'>";
                                 if ($tag->type==0) {
                                    echo"Tag administration";
                                 }
                                 else if ($tag->type==1){
                                    echo"Tag propriétaire";
                                 }
                                 echo "</div></td>";
                                 echo "<td><div align='center'>";
                                 $id_appartement=0;
                                 $id_bloc=0;
                                 $floor = "";
                                 $code="";
                                 $desc="";
                                 $nom_b="";
                                 $desc_b="";
                                 foreach ($apartments as $apartment){
                                    if($apartment->id==$tag->id_appartement){
                                        $id_bloc=$apartment->id_bloc;
                                        $floor=$apartment->floor;
                                        $code=$apartment->code;
                                        $desc=$apartment->desc;
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
                                 $ch="";
                                if($floor == ""){$ch="";}
                                else if($floor == 0){ $ch="Rez-de-chaussée";}
                                else if($floor == 1){$ch="1<sup>ère</sup> étage";}
                                else {$ch= $floor."<sup>ème</sup> étage";}
                                 echo "<b>".$nom_b."<br>".$ch."<br>".$code."</b><br/>".$desc;
                                 echo "</div></td>";
                                                                  
                                 echo "<td><div align='center'>";
                                 $ch=''; 
   
  
    
    $ch.='<button type="button" class="btn btn-default" title="Modification" id="';
    $ch.=$tag->id.'/////'.$tag->uid.'/////'.$tag->type.'/////'.$tag->etat.'/////'.$tag->id_appartement.'/////'.$id_bloc.'/////'.$floor;
    $ch.='" onclick="modification_tag(this.id);"><i class="fa fa-edit"></i></button>';

    $ch.='<button type="button" class="btn btn-default" title="Suppression" id="';
    $ch.=$tag->id.'/////'.$tag->uid.'/////'.$tag->etat.'/////'.$tag->id_appartement;
    $ch.='" onclick="suppression_tag(this.id);"><i class="fa fa-times"></i></button>';
    echo $ch;


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
                    <div class="modal fade" id="ajoutertagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Ajouter un tag</h4>
                                </div>
                                <div class="modal-body" align="center">

                                    
                                    <?php
    echo form_open_multipart(base_url('sdl/tags/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_add_tag"></div>
       </div>
      
     </div>
     
                           
                            
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">UID</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="text" class="form-control" placeholder="" id="uid_ajout_tag" name="uid_ajout_tag" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Type</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                        <select class="form-control m-b-10" id="type_ajout_tag" name="type_ajout_tag">
                                            <option value=""></option>
                                            <option value="0">Tag administration</option>
                                            <option value="1">Tag propriétaire</option>
                                            
                                        </select>
                                    </div>
                                    </div>
                            </div> 
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Bloc</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                        <select class="form-control m-b-10" id="bloc_ajout_tag" name="bloc_ajout_tag">
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
                                    <label  class="col-lg-3 col-sm-3 control-label">Étage</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                        <select class="form-control m-b-10" id="etage_ajout_tag" name="etage_ajout_tag">
                                            
                                        </select>
                                    </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Appartement</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                        <select class="form-control m-b-10" id="appar_ajout_tag" name="appar_ajout_tag" >

                                            
                                        </select>
                                    </div>
                                    </div>
                            </div>
                                                       
                            
                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_ajouter_tag_action" class="btn btn-success" type="button">Ajouter&nbsp;<i class="fa  fa-plus topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

                <!-- Modal -->
                    <div class="modal fade" id="modifiertagpassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modifier tag pass</h4>
                                </div>
                                <div class="modal-body" align="center">

                                    
                                    <?php
    echo form_open_multipart(base_url('sdl/tags/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
            </div>
      
     </div>
       
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">UID</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="text" class="form-control" placeholder="" id="uid_up_tag_pass" name="uid_up_tag_pass">
                                            <input type="hidden" name="uid_tagpass" id="uid_tagpass" value="<?php echo $t_pass; ?>">
                                        </div>
                                    </div>
                            </div>
                            
                                                       
                            
                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_modifier_tagpass_action" class="btn btn-success" type="submit">Modifier&nbsp;<i class="fa  fa-edit topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

                <!-- Modal -->
                    <div class="modal fade" id="modificationtagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modification</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/tags/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <div class="modal-body" align="center">
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_modif_tag"></div>
       </div>
      
     </div>
     
                           
                            
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">UID</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="text" class="form-control" placeholder="" id="uid_modif_tag" name="uid_modif_tag" required>
                                            <input type="hidden" name="id_modif_tag" id="id_modif_tag" value="">
                                            <input type="hidden" name="last_uid_tag" id="last_uid_tag" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Type</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                        <select class="form-control m-b-10" id="type_modif_tag" name="type_modif_tag">
                                            <option value=""></option>
                                            <option value="0">Tag administration</option>
                                            <option value="1">Tag propriétaire</option>
                                            
                                        </select>
                                    </div>
                                    </div>
                            </div> 
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Bloc</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                        <select class="form-control m-b-10" id="bloc_modif_tag" name="bloc_modif_tag">
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
                                    <label  class="col-lg-3 col-sm-3 control-label">Étage</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                        <select class="form-control m-b-10" id="etage_modif_tag" name="etage_modif_tag">
                                        </select>
                                    </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Appartement</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                        <select class="form-control m-b-10" id="appar_modif_tag" name="appar_modif_tag" >
                                            
                                        </select>
                                    </div>
                                    </div>
                            </div>
                            

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_modif_tag_action" class="btn btn-success" type="button">Modifier&nbsp;<i class="fa  fa-edit topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="suppressionatagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Suppression</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/tags/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_suppression_tag"></div>
                                    <h4>Voulez vous vraiment supprimer ce tag ?</h4>
                                    <input type="hidden" name="id_suppression_tag" id="id_suppression_tag" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_suppression_tag_action" class="btn btn-danger" type="submit">Supprimer&nbsp;<i class="fa fa-trash-o topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="blocagetagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Blocage</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/tags/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">
                                

                                    <div id="div_blocage_tag"></div>
                                    <h4>Voulez vous vraiment bloquer ce tag ?</h4>
                                    <input type="hidden" name="id_blocage_tag" id="id_blocage_tag" value="">
        

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_blocage_tag_action" class="btn btn-danger" type="submit">Bloquer&nbsp;<i class="fa fa-lock topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="deblocagetagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Déblocage</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/tags/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_deblocage_admin"></div>
                                    <h4>Voulez vous vraiment activer ce tag ?</h4>
                                    <input type="hidden" name="id_deblocage_tag" id="id_deblocage_tag" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_deblocage_tag_action" class="btn btn-success" type="submit">Activer&nbsp;<i class="fa fa-unlock topbar-info-icon top-2"></i></button>

                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

               

            </div>
            <!--body wrapper end-->