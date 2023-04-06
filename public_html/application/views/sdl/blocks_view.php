            <!--body wrapper start-->
            <div class="wrapper">
                <!--state overview start-->
                <div class="row state-overview">
                <div  style="overflow-x:auto;">                   
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading ">
                                <button id="b_ajouter_bloc"  type="button" class="btn btn-success " >Ajouter un bloc <i class="fa fa-plus topbar-info-icon top-2"></i></button>
                                <span class="tools pull-right">
                                </span>
                            </header>
                            <table class="table colvis-data-table data-table">
                            <thead>
                            <tr>
                                <th >
                                    <div align="center">Nom</div>  
                                </th>
                                <th >
                                    <div align="center">Nombre des étages</div>  
                                </th>
                                <th align="center">
                                    <div align="center">Description</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Les actions</div>
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($blocs as $bloc){
                                 echo "<tr>";
                                 echo "<td><div align='center'>";
                                 echo $bloc->nom."";
                                 echo "</div></td>";
                                 echo "<td><div align='center'>";
                                 echo $bloc->floors."";
                                 echo "</div></td>";
                                 echo "<td><div align='center'>"; 
                                 echo $bloc->desc;
                                 echo "</div></td>";                                 
                                 echo "<td><div align='center'>";
                                 $ch=''; 
     
  
    
    $ch.='<button type="button" class="btn btn-default" title="Modification" id="';
    $ch.=$bloc->id.'/////'.$bloc->nom.'/////'.$bloc->floors.'/////'.$bloc->desc;
    $ch.='" onclick="modification_bloc(this.id);"><i class="fa fa-edit"></i></button>';

    $ch.='<button type="button" class="btn btn-default" title="Suppression" id="';
    $ch.=$bloc->id.'/////'.$bloc->nom.'/////'.$bloc->floors.'/////'.$bloc->desc;
    $ch.='" onclick="suppression_bloc(this.id);"><i class="fa fa-times"></i></button>';
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
                    <div class="modal fade" id="ajouterblocModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Ajouter un bloc</h4>
                                </div>
                                <div class="modal-body" align="center">

                                    
                                    <?php
    echo form_open_multipart(base_url('sdl/blocks/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_add_bloc"></div>
       </div>
      
     </div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Nom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-building"></i>
                                            <input type="text" class="form-control" placeholder="" id="nom_ajout_bloc" name="nom_ajout_bloc" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Nombre des étages</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-building"></i>
                                            <input type="number" class="form-control" placeholder="" id="etage_ajout_bloc" name="etage_ajout_bloc"  onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" required>
                                        </div>
                                    </div>
                            </div>                            
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Description</label>
                            <div class="col-lg-9">
                                <textarea id="desc_ajout_bloc" name="desc_ajout_bloc" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_ajouter_bloc_action" class="btn btn-success" type="button">Ajouter&nbsp;<i class="fa  fa-plus topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

                <!-- Modal -->
                    <div class="modal fade" id="modificationblocModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modification</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/blocks/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <div class="modal-body" align="center">
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_modif_bloc"></div>
       </div>
      
     </div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Nom</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-building"></i>
                                            <input type="text" class="form-control" placeholder="" id="nom_modif_bloc" name="nom_modif_bloc" required>
                                            <input type="hidden" name="id_modif_bloc" id="id_modif_bloc" value="">
                                            <input type="hidden" name="last_nom_bloc" id="last_nom_bloc" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Nombre des étages</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-building"></i>
                                            <input type="number" class="form-control" placeholder="" id="etage_modif_bloc" name="etage_modif_bloc"  onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" min="0" required>
                                        </div>
                                    </div>
                            </div>
                           
                            <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Description</label>
                            <div class="col-lg-9">
                                <textarea id="desc_modif_bloc" name="desc_modif_bloc" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            </div>

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_modif_bloc_action" class="btn btn-success" type="button">Modifier&nbsp;<i class="fa  fa-edit topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="suppressionblocModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Suppression</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/blocks/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_suppression_bloc"></div>
                                    <h4>Voulez vous vraiment supprimer ce bloc ?</h4>
                                    <input type="hidden" name="id_suppression_bloc" id="id_suppression_bloc" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_suppression_bloc_action" class="btn btn-danger" type="submit">Supprimer&nbsp;<i class="fa fa-trash-o topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

               

            </div>
            <!--body wrapper end-->