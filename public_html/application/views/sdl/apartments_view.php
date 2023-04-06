            <!--body wrapper start-->
            <div class="wrapper">
                <!--state overview start-->
                <div class="row state-overview">
                <div  style="overflow-x:auto;">                   
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading ">
                                <button id="b_ajouter_apar"  type="button" class="btn btn-success " >Ajouter un appartement  <i class="fa fa-plus topbar-info-icon top-2"></i></button>
                                <span class="tools pull-right">
                                </span>
                            </header>
                            <table class="table colvis-data-table data-table">
                            <thead>
                            <tr>
                                <th >
                                    <div align="center">Bloc</div>  
                                </th>
                                <th >
                                    <div align="center">Étage</div>  
                                </th>
                                <th >
                                    <div align="center">Code</div>  
                                </th>
                                <th >
                                    <div align="center">SDL ID</div>  
                                </th>
                                <th align="center">
                                    <div align="center">Description</div>
                                </th>
                                <th align="center">
                                    <div align="center">Propriétaire</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Les actions</div>
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($apartments as $apart){
                                echo "<tr>";
                                echo "<td><div align='center'>";
                                echo $apart->nom."";
                                echo "</div></td>";
                                echo "<td><div align='center'>";
                                
                                if($apart->floor == 0){ echo "Rez-de-chaussée";}
                                else if($apart->floor == 1){echo "1<sup>ère</sup> étage";}
                                else {echo $apart->floor."<sup>ème</sup> étage";}
                                echo "</div></td>";
                                echo "<td><div align='center'>";
                                echo $apart->code."";
                                echo "</div></td>";
                                echo "<td><div align='center'>";
                                echo $apart->sdl_id."";
                                echo "</div></td>";
                                echo "<td><div align='center'>"; 
                                echo $apart->desc;
                                echo "</div></td>";
                                echo "<td><div align='center'>"; 
                                $ch='';
                                $ch.='<button type="button" class="btn btn-success" title="" id="';
                                $ch.=$apart->id.'/////'.$apart->id_bloc.'/////'.$apart->nom.'/////'.$apart->code.'/////'.$apart->desc.'/////'.$apart->id_proprietaire.'/////'.$apart->sdl_id.'/////'.$apart->floor;
                                $ch.='" onclick="owner_apartment(this.id);"><i class="fa fa-user"></i></button>';
                                if($apart->id_proprietaire!=0){echo'<div>'.$ch.'</div>';}
                                echo "</div></td>";                                 
                                echo "<td><div align='center'>";
                                $ch=''; 
     
  
    
    $ch.='<button type="button" class="btn btn-default" title="Modification" id="';
    $ch.=$apart->id.'/////'.$apart->id_bloc.'/////'.$apart->nom.'/////'.$apart->code.'/////'.$apart->desc.'/////'.$apart->id_proprietaire.'/////'.$apart->sdl_id.'/////'.$apart->floor;
    $ch.='" onclick="modification_apar(this.id);"><i class="fa fa-edit"></i></button>';

    $ch.='<button type="button" class="btn btn-default" title="Suppression" id="';
    $ch.=$apart->id.'/////'.$apart->id_bloc.'/////'.$apart->nom.'/////'.$apart->code.'/////'.$apart->desc.'/////'.$apart->id_proprietaire.'/////'.$apart->sdl_id.'/////'.$apart->floor;
    $ch.='" onclick="suppression_apar(this.id);"><i class="fa fa-times"></i></button>';
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
                    <div class="modal fade" id="ajouteraparModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Ajouter un appartement</h4>
                                </div>
                                <div class="modal-body" align="center">

                                    
                                    <?php
    echo form_open_multipart(base_url('sdl/apartments/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_add_apar"></div>
       </div>
      
     </div>
     
                           
                            
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Bloc</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                        <select class="form-control m-b-10" id="bloc_ajout_apar" name="bloc_ajout_apar" required>
                                            <?php
                                            echo '<option value=""></option>';
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
                                        <select class="form-control m-b-10" id="etage_ajout_apar" name="etage_ajout_apar" required>
                                            <option value=""></option>
                                            
                                        </select>
                                    </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Code</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="text" class="form-control" placeholder="" id="code_ajout_apar" name="code_ajout_apar" required>
                                        </div>
                                    </div>
                            </div>
                                                         
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Description</label>
                            <div class="col-lg-9">
                                <textarea id="desc_ajout_apar" name="desc_ajout_apar" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">SDL ID</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="text" class="form-control" placeholder="" id="sdl_id_ajout_apar" name="sdl_id_ajout_apar" required>
                                        </div>
                                    </div>
                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_ajouter_apar_action" class="btn btn-success" type="button">Ajouter&nbsp;<i class="fa  fa-plus topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

                <!-- Modal -->
                    <div class="modal fade" id="modificationaparModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modification</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/apartments/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <div class="modal-body" align="center">
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_modif_apar"></div>
       </div>
      
     </div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Bloc</label>
                                    <div class="col-lg-9">
                                        <div class="">
                                        <select class="form-control m-b-10" id="bloc_modif_apar" name="bloc_modif_apar" required>
                                            <?php
                                            echo '<option value=""></option>';
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
                                        <select class="form-control m-b-10" id="etage_modif_apar" name="etage_modif_apar" required>
                                            <option value=""></option>
                                            
                                        </select>
                                    </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Code</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-building"></i>
                                            <input type="text" class="form-control" placeholder="" id="code_modif_apar" name="code_modif_apar" required>
                                            <input type="hidden" name="id_modif_apar" id="id_modif_apar" value="">
                                            <input type="hidden" name="last_code_apar" id="last_code_apar" value="">
                                        </div>
                                    </div>
                            </div>
                           
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Description</label>
                            <div class="col-lg-9">
                                <textarea id="desc_modif_apar" name="desc_modif_apar" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">SDL ID</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-building"></i>
                                            <input type="text" class="form-control" placeholder="" id="sdl_id_modif_apar" name="sdl_id_modif_apar" required>
                                            <input type="hidden" name="last_sdl_id_apar" id="last_sdl_id_apar" value="">
                                        </div>
                                    </div>
                            </div>

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_modif_apar_action" class="btn btn-success" type="button">Modifier&nbsp;<i class="fa  fa-edit topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="suppressionaparModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Suppression</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/apartments/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_suppression_apar"></div>
                                    <h4>Voulez vous vraiment supprimer cet appartement ?</h4>
                                    <input type="hidden" name="id_suppression_apar" id="id_suppression_apar" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_suppression_apar_action" class="btn btn-danger" type="submit">Supprimer&nbsp;<i class="fa fa-trash-o topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

                <!-- Modal -->
                    <div class="modal fade" id="ownerapartmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Le propriétaire</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/apartments/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_apartment_owner">
                                        
                                    </div>
                                    <div id="div_aff_owner">
                                        
                                    </div>
                                    <div id="div_aff_owner_tag">
                                        
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

               

            </div>
            <!--body wrapper end-->