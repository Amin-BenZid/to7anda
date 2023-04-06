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
                                <th >
                                    <div align="center">Administrateur</div>  
                                </th>
                                <th align="center">
                                    <div align="center">Action</div>
                                </th>
                                <th align="center">
                                    <div align="center">Date</div>
                                </th>
                                
                                
                            </tr>
                            <!--admins
                                actions
                                -- id
                                , id_ad
                                , action
                                date_ac --
                                

                            -->
                            </thead>
                            <tbody>
                                <?php
                                
                                
                                foreach ($actions as $action){
                                    if(true ){
                                 echo "<tr>";
                                 echo "<td><div align='center'>";
                                 
    
                                 foreach ($admins as $owner){
                                    if($owner->id==$action->id_ad){
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

                                ?>
                            <?php
                            if($owner->online==1){echo"<i class='online dot'></i>";}else{echo"<i class='busy dot'></i>";}
                                echo"</a> </div>";
                                 if($owner->sexe==1){echo"<i class='fa fa-male'></i> ";}else{echo"<i class='fa fa-female'></i>  ";}
                                 echo $owner->prenom.' '.$owner->nom.'<br>';
                                 echo $owner->tel.'<br>';
                                 echo $owner->email.'<br>';
                                 echo $owner->desc.'<br>';

                                    }
                                 }
                                 
                                 echo "</div></td>";
                                 echo "<td><div align='center'>"; 
                                
                                
                                echo "".$action->action;
                                 

                                 echo "</div></td>";
                                 echo "<td><div align='center'>";
                                 echo "".$action->date_ac;
                                 echo'</br>'; 
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
                    <div class="modal fade" id="tagautoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Tag</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/a_requests/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <div class="modal-body" align="center">
     <div class="row"></div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Tag</label>
                                    <div class="col-lg-9">
                                        <div class="">

                                        <input type="hidden" name="id_dem_auto_tag" id="id_dem_auto_tag" value="">
                                        <input type="hidden" name="id_app_tag" id="id_app_tag" value="">
                                        <select class="form-control m-b-10" id="s_id_dem_auto_tag" name="s_id_dem_auto_tag" required>
                                            
                                        </select>
                                    </div>
                                    </div>
                            </div>

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_save_tag_action" class="btn btn-success" type="submit">Enregistrer&nbsp;<i class="fa  fa-save topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->


                    <div class="modal fade" id="acceptationautoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Acceptation</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/a_requests/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_dem_auto_acc"></div>
                                    <h4>Voulez vous vraiment accepter cette demande d'autorisation ?
</h4>
                                    <input type="hidden" name="id_dem_auto_acc" id="id_dem_auto_acc" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_dem_auto_acc_action" class="btn btn-success" type="submit">Accepter&nbsp;<i class="fa fa-check topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                    <div class="modal fade" id="annulationautoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Annulation</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/a_requests/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_dem_auto_ann"></div>
                                    <h4>Voulez vous vraiment annuler cette demande d'autorisation ?</h4>
                                    <input type="hidden" name="id_dem_auto_ann" id="id_dem_auto_ann" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_dem_auto_ann_action" class="btn btn-danger" type="submit">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- modal -->
                    <div class="modal fade" id="terminationautoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Termination</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/a_requests/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_dem_auto_ter"></div>
                                    <h4>Voulez vous vraiment terminer cette demande d'autorisation ?</h4>
                                    <input type="hidden" name="id_dem_auto_ter" id="id_dem_auto_ter" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_dem_auto_ter_action" class="btn btn-success" type="submit">Terminer&nbsp;<i class="fa fa-certificate topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->               

            </div>
            <!--body wrapper end-->