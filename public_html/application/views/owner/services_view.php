            <!--body wrapper start-->
            <div class="wrapper">
                <!--state overview start-->
                <div class="row state-overview">
                <div>                   
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading ">
                                <button id="b_nouvelle_demande"  type="button" class="btn btn-success " >Nouvelle demande <i class="fa fa-send topbar-info-icon top-2"></i></button>
                                <button id="b_aff_service"  type="button" class="btn btn-success " >Liste des services <i class="fa fa-briefcase topbar-info-icon top-2"></i></button>
                                <span class="tools pull-right">
                                </span>
                            </header>
                            <table class="table " id="dynamic-table">
                            <thead>
                            <tr>
                                <th align="center">
                                    <div align="center">Appartement</div>
                                </th>
                                <th align="center">
                                    <div align="center">Service</div>
                                </th>
                                <th align="center">
                                    <div align="center">État</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Les actions</div>
                                </th>
                                
                            </tr>
                            <!--
                                -- id
                                , id_appa  2
                                , id_prop  13
                                , id_serv, 2
                                date_debut
                                , date_fin
                                , heur_debut
                                , heur_fin
                                , description
                                ,    etat 
                                , id_emp
                                , id_tag
                                , created_at
                                , updated_at

                            -->
                            </thead>
                            <tbody>
                                <?php
                                /*s_requests
                                services
                                employees
                                apartments
                                blocs
                                tags*/
                                foreach ($s_requests as $req){
                                    //if($req->etat != 5 && $req->etat != 6 ){
                                    if(true){
                                 echo "<tr>";
                                 echo "<td><div align='center'>"; 
                                 $id_appartement=0;
                                 $id_bloc=0;
                                 $code="";
                                 $desc="";
                                 $nom_b="";
                                 $desc_b="";
                                 $floor="";
                                 foreach ($apartments as $apartment){
                                    if($apartment->id==$req->id_appa){
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
                                 foreach ($services as $service){
                                    if($req->id_serv == $service->id){
                                        echo "<b>".$service->nom."</b></br>";
                                        echo $service->desc; 
                                    }
                                    
                                    }
                                 echo'<br/><b>Début: </b>'.$req->date_debut.'     '.$req->heur_debut.'</br>';
                                 echo'<b>Fin:</b>'.$req->date_fin.'     '.$req->heur_fin.'</br>';
                                 echo''.$req->description.'</br>';
                                 if($req->message !="") {
                                    echo'<b style="color: green">Message &nbsp;<i class="fa fa-envelope topbar-info-icon top-2"></i></b></br>'.$req->message.'</br>';
                                 }
                                 echo "</div></td>";
                                 
                                 echo "<td><div align='center'>";
                                 if ($req->etat == 1) {
                                    echo '<div class="bg-warning light-color"> Nouvelle demande </div>';
                                 } elseif ($req->etat == 2) {
                                    echo '<div class="bg-danger light-color"> Demande d’annulation </div>';
                                 } elseif ($req->etat == 3) {
                                    echo '<div class="bg-success light-color"> Acceptation de demande </div>';
                                 } elseif ($req->etat == 4) {
                                    echo '<div class="bg-info light-color"> Demande en cours d’exécution </div>';
                                 }elseif ($req->etat == 5) {
                                    
                                    echo "<b>".$req->updated_at."</b>";
                                            echo '<div class="bg-success light-color"> La demande a été effectuée </div>';
                                            if($req->eval==1){
                                        echo "<h5 style='color: green'><i class='fa fa-thumbs-up'></i> &nbsp;&nbsp;<b>Le propriétaire a été satisfait </b></h5>";
                                    }
                                        else if($req->eval==2){
                                            echo "<h5 style='color: red'><i class='fa fa-thumbs-down'></i>&nbsp;&nbsp;<b>Le propriétaire a été non satisfait</b> </h5>";
                                        }
                                            else{

                                            }

                                if($req->eval!=0){echo "<b>".$req->eval_date."</b>";} 
                                if($req->eval!=0){echo "<p>".$req->r_eval."</p>";}
                                 } elseif ($req->etat == 6) {
                                            echo '<div class="bg-danger light-color">La demande a été annulée </div>';

                                 }else{

                                         }
                                 echo "</div></td>";                                 
                                 echo "<td><div align='center'>";
                                 $ch=''; 
                                 $ch_s0=''; 
   
      $ch_s0.='<button type="button" class="btn btn-danger" title="Suppression demande service" id="';
    $ch_s0.=$req->id.'/////'.$req->id_serv.'/////'.$req->id_appa.'/////'.$req->date_debut.'/////'.$req->heur_debut.'/////'.$req->date_fin.'/////'.$req->heur_fin.'/////'.$req->description;
    $ch_s0.='" onclick="suppression_demande(this.id);"><i class="fa fa-times"></i></button>';
      $ch_s0.='<button type="button" class="btn btn-success" title="Modification demande service" id="';
    $ch_s0.=$req->id.'/////'.$req->id_serv.'/////'.$req->id_appa.'/////'.$req->date_debut.'/////'.$req->heur_debut.'/////'.$req->date_fin.'/////'.$req->heur_fin.'/////'.$req->description;
    $ch_s0.='" onclick="modification_demande(this.id);"><i class="fa fa-edit"></i></button>';
/**/
if($req->etat==1){$ch.= $ch_s0;}

   else if ($req->etat == 3) { 
        $ch.='<button type="button" class="btn btn-danger" title="Annulation demande service" id="';
    $ch.=$req->id.'/////'.$req->id_appa.'/////'.$req->id_serv.'/////'.$req->id_tag.'/////'.$req->id_emp;
    $ch.='" onclick="annulation_service(this.id);"><i class="fa fa-times"></i></button>';
    }else{

    }
if($req->etat != 5 && $req->etat != 6 && $req->etat != 2 && $req->etat != 1 && $req->etat != 3 ){
 $ch.='<button type="button" class="btn btn-danger" title="Annulation demande service" id="';
    $ch.=$req->id.'/////'.$req->id_appa.'/////'.$req->id_serv.'/////'.$req->id_tag.'/////'.$req->id_emp;
    $ch.='" onclick="annulation_service(this.id);"><i class="fa fa-times"></i></button>';
}
if($req->etat == 5){
    if($req->eval== 0){
    $ch.='<button type="button" class="btn btn-default" title="Évaluation de service" id="';
    $ch.=$req->id.'/////'.$req->id_appa.'/////'.$req->id_serv.'/////'.$req->id_tag.'/////'.$req->id_emp;
    $ch.='" onclick="evaluation_service(this.id);"><i class="fa fa-certificate ">&nbsp;Évaluation</i></button>';
} 
}

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
               
                    <div class="modal fade" id="annulationserviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Annulation</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('owner/services/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_dem_ser_ann"></div>
                                    <h4>Voulez vous vraiment annuler cette demande de service ?</h4>
                                    <input type="hidden" name="id_dem_ser_ann" id="id_dem_ser_ann" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_dem_ser_ann_action" class="btn btn-danger" type="submit">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
               



                    <div class="modal fade" id="evaluationserviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Évaluation</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('owner/services/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div class="form-group">
                                    <h4>Êtes-vous satisfait de ce service ?</h4>

  <label class="radio-inline"><input type="radio" name="radio_s" checked value="1">Satisfait</label>

  <label class="radio-inline"><input type="radio" name="radio_s" value="2">Non satisfait</label>
</div>

<div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Remarque</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <textarea class="form-control" placeholder="" id="remar_s" name="remar_s"></textarea>
                                        </div>
                                    </div>
                            </div>

                                    <input type="hidden" name="id_eval_ser" id="id_eval_ser" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_eval_ser_action" class="btn btn-success" type="submit">Enregistrer&nbsp;<i class="fa fa-save topbar-info-icon top-2"></i></button>
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
    <form action="<?php echo base_url('owner/services/');?>" method="POST" role="form" id="form_up" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label  class="col-lg-3 col-sm-3 control-label">Appartement </label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <select class="form-control" id="d_id_app" name="d_id_app">
                                                <?php
                                               
                                                foreach ($apartments as $app){ 
                                                    $id_bloc=$app->id_bloc;
                                                    $code=$app->code;
                                                    $desc=$app->desc;
                                                    $floor=$app->floor;

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
                                                     $ff ="";
                                
                                 if($floor == 0){ $ff = "Rez-de-chaussée";}
                                else if($floor == 1){$ff = "1<sup>ère</sup> étage";}
                                else {$ff = $floor."<sup>ème</sup> étage";}
                                 


                                                    echo '<option value="'.$app->id.'">'.$nom_b.' / '.$ff.' / '.$code.'</option>';

                                                }
                                                ?>
                                              </select>

                                            
                                        </div>
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
                                            <input type="hidden" name="d_id_p" id="d_id_p" value="">
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

                <!-- Modal -->
                    <div class="modal fade" id="modificationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Modification</h4>
                                </div>
                                <?php
    //echo form_open_multipart(base_url('sdl/owners/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <form action="<?php echo base_url('owner/services/');?>" method="POST" role="form" id="form_up" enctype="multipart/form-data" class="form-horizontal">
    <div class="modal-body" align="center">
        <div id="title_div">
                                
        </div>
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <div class="alert alert-danger" align="center" id="div_message_erreur_modif"></div>
       </div>
      
     </div>
     
                           
                             <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Appartement </label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                              <select class="form-control" name="id_app" id="id_app">
                                                <?php
                                               
                                                foreach ($apartments as $app){ 
                                                    $id_bloc=$app->id_bloc;
                                                    $code=$app->code;
                                                    $desc=$app->desc;
                                                    $floor=$app->floor;

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
                                                     $ff ="";
                                
                                 if($floor == 0){ $ff = "Rez-de-chaussée";}
                                else if($floor == 1){$ff = "1<sup>ère</sup> étage";}
                                else {$ff = $floor."<sup>ème</sup> étage";}
                                 


                                                    echo '<option value="'.$app->id.'">'.$nom_b.' / '.$ff.' / '.$code.'</option>';

                                                }
                                                ?>
                                              </select>
                                            
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Service </label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                              <select class="form-control" id="serv">
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
                                            <input type="date" class="form-control" placeholder="" id="date_d" name="date_d" value="" >
                                            <input type="hidden" name="id_p" id="id_p" value="">
                                            <input type="hidden" name="id_d" id="id_d" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Date fin</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="date" class="form-control" placeholder="" id="date_f" name="date_f" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Temps début</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="time" class="form-control" placeholder="" id="temps_d" name="temps_d" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Temps fin</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="time" class="form-control" placeholder="" id="temps_f" name="temps_f" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Description</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <textarea class="form-control" placeholder="" id="desc" name="desc" required></textarea>
                                        </div>
                                    </div>
                            </div>
                                                      
                         


                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_modif_action" class="btn btn-success" type="button">Modifier&nbsp;<i class="fa  fa-edit topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

                                <!-- Modal -->
                    <div class="modal fade" id="suppressionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Suppression</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('owner/services/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_suppression_ac"></div>
                                    <h4> Voulez vous vraiment supprimer cette demande service ?</h4>
                                    <input type="hidden" name="id_suppression_d" id="id_suppression_d" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_suppression_service_action" class="btn btn-danger" type="submit">Supprimer&nbsp;<i class="fa fa-trash-o topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

                                                <!-- Modal -->
                    <div class="modal fade" id="viewserviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Liste des services</h4>
                                </div>
                               
                                <div class="modal-body" align="center">
                                    
                                     <?php
                                     echo '<hr/>';
                                                
                                                foreach ($services as $serv){ 
                                                    echo '<h4>'.$serv->nom.'</h4><h5>'.$serv->desc.'</h5><hr/>';
                                                }
                                                ?>

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                       

            </div>
            <!--body wrapper end-->