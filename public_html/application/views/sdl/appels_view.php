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
                                    <div align="center">Appartement</div>  
                                </th>
                                <th align="center">
                                    <div align="center">L’appel</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Les actions</div>
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id_prop = 0;
                                foreach ($appels as $appel){
                                 echo "<tr>";
                                 echo "<td><div align='center'>";
                                 //echo $appel->id."";
                                 
                                 foreach ($apartments as $apart){
                                    if($apart->id==$appel->id_a){
                                        //print_r($apart);
                                        $id_prop = $apart->id_proprietaire;
                                        echo $apart->nom."";
                                echo " / ";
                                
                                if($apart->floor == 0){ echo "Rez-de-chaussée";}
                                else if($apart->floor == 1){echo "1<sup>ère</sup> étage";}
                                else {echo $apart->floor."<sup>ème</sup> étage";}
                                echo " / ";
                                echo $apart->code."";
                                echo "<br>"; 
                                echo $apart->desc;
                                    }

                                 }
                                 
                                 
                                 
                                 echo "</div></td>";
                                 echo "<td><div align='center'>"; 
                                 echo $appel->date;
                                 echo '<div class="bg-danger light-color"> Appel </div>';
                                 if($appel->vu == 1){
                                 echo $appel->d_vu;
                                 echo '<div class="bg-success light-color"> Réponse </div>';
                                 echo $appel->remarque_vu."<br/>";
                                 
                                 if($appel->service==1){
                                    echo '<b><i class="fa fa-check">Demande service</i></b><br/>';
                                 }
                                    }

                                 echo "</div></td>";                                 
                                 echo "<td><div align='center'>";
                                 $ch=''; 
     
  
    
    $ch.='<button type="button" class="btn btn-success" title="Réponse" id="';
    $ch.=$appel->id.'/////'.$appel->id_a.'/////'.$id_prop;
    $ch.='" onclick="reponse_appel(this.id);"><i class="fa fa-check"></i></button>';
/*
    $ch.='<button type="button" class="btn btn-default" title="Suppression" id="';
    $ch.=$service->id.'/////'.$service->nom.'/////'.$service->desc;
    $ch.='" onclick="suppression_service(this.id);"><i class="fa fa-times"></i></button>';
    */
    if($appel->vu == 0){ echo $ch;}


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
                    <div class="modal fade" id="reponseappelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Réponse</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/appels/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_suppression_service"></div>
                                    <h4>L’appel a-t-il été satisfait ?</h4>
                                    <input type="hidden" name="id_appel" id="id_appel" value="">

                                    <div class="row">
                                    
                                    <div class="form-group">
                                    <label  class="col-lg-2 col-sm-2 control-label"></label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <textarea class="form-control" rows="5" id="remar_sat" name="remar_sat" required></textarea>
                                        </div>
                                    </div>
                                    <label  class="col-lg-2 col-sm-2 control-label"></label>
                                    </div>

                                </div>

                                </div>
                                
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_ds_action" class="btn btn-success" type="button">Demande service &nbsp;<i class="fa fa-briefcase topbar-info-icon top-2"></i></button>
                                    <button id="b_oui_action" class="btn btn-success" type="submit">Envoyer&nbsp;<i class="fa fa-send topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
 <!-- Modal -->
                    <div class="modal fade" id="demandeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Demande service</h4>
                                </div>
                                <?php
    //echo form_open_multipart(base_url('sdl/owners/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <form action="<?php echo base_url('sdl/service_r/');?>" method="POST" role="form" id="form_up" enctype="multipart/form-data" class="form-horizontal">
    <div class="modal-body" align="center">
        <div id="title_div_d">
                                
        </div>
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_demande"></div>
       </div>
      
     </div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Service </label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                              <select class="form-control" id="d_serv">
                                                <?php
                                                
                                                foreach ($services as $serv){ 
                                                    echo '<option value="'.$serv->id.'">'.$serv->nom.'</option>';
                                                }
                                                ?>
                                              </select>
                                            
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Date début </label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="date" class="form-control" placeholder="" id="d_date_d" name="d_date_d" value="" >
                                            <input type="hidden" name="d_id_app" id="d_id_app" value="">
                                            <input type="hidden" name="d_id_p" id="d_id_p" value="">
                                            <input type="hidden" name="d_id_appel" id="d_id_appel" value="">
                                            <input type="hidden" name="d_remar_sat" id="d_remar_sat" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Date fin</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="date" class="form-control" placeholder="" id="d_date_f" name="d_date_f" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Temps début</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="time" class="form-control" placeholder="" id="d_temps_d" name="d_temps_d" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Temps fin</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="time" class="form-control" placeholder="" id="d_temps_f" name="d_temps_f" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Description</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <textarea class="form-control" placeholder="" id="d_desc" name="d_desc" required></textarea>
                                        </div>
                                    </div>
                            </div>
                                                      
                         


                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_demande_action" class="btn btn-success" type="button">Demander&nbsp;<i class="fa  fa-send topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
               

            </div>
            <!--body wrapper end-->