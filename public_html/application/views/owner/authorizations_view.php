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
                                    <div align="center">Autorisation</div>
                                </th>
                                <th align="center">
                                    <div align="center">État</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Les actions</div>
                                </th>
                                
                            </tr>
                            <!--
                                 id
                                , id_appa  
                                , id_prop  
                                , id_tag, 
                                date_debut
                                , date_fin
                                , heur_debut
                                , heur_fin
                                , nom, 
                                prenom, 
                                cin_pass
                                , description
                                ,    etat
                                , created_at
                                , updated_at

                            -->
                            </thead>
                            <tbody>
                                <?php
                                /*a_requests
                                services
                                employees
                                apartments
                                blocs
                                tags*/
                                foreach ($a_requests as $req){
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
                                 echo "<b>".$req->nom." ".$req->prenom."</br> CIN : </b>".$req->cin_pass."";
                                 echo'<br/><b>Début: </b>'.$req->date_debut.'     '.$req->heur_debut.'</br>';
                                 echo'<b>Fin:</b>'.$req->date_fin.'     '.$req->heur_fin.'</br>';
                                 echo''.$req->descption.'</br>'; 
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
                                            echo '<div class="bg-success light-color"> La demande a été effectuée </div>';
                                 } elseif ($req->etat == 6) {
                                            echo '<div class="bg-danger light-color">La demande a été annulée </div>';
                                 }else{

                                         }
                                 echo "</div></td>";                                 
                                 echo "<td><div align='center'>";
                                 $ch=''; 
                                 $ch_s0=''; 
   
      $ch_s0.='<button type="button" class="btn btn-danger" title="Suppression demande service" id="';
    $ch_s0.=$req->id.'/////'.$req->id_appa.'/////'.$req->date_debut.'/////'.$req->heur_debut.'/////'.$req->date_fin.'/////'.$req->heur_fin.'/////'.$req->descption;
    $ch_s0.='" onclick="suppression_demande(this.id);"><i class="fa fa-times"></i></button>';
      $ch_s0.='<button type="button" class="btn btn-success" title="Modification demande service" id="';
    $ch_s0.=$req->id.'/////'.$req->id_appa.'/////'.$req->date_debut.'/////'.$req->heur_debut.'/////'.$req->date_fin.'/////'.$req->heur_fin.'/////'.$req->nom.'/////'.$req->prenom.'/////'.$req->cin_pass.'/////'.$req->descption;
    $ch_s0.='" onclick="modification_demande(this.id);"><i class="fa fa-edit"></i></button>';
/**/
if($req->etat==1){$ch.= $ch_s0;}

/*   else if ($req->etat == 3) { 
        $ch.='<button type="button" class="btn btn-danger" title="Annulation demande service" id="';
    $ch.=$req->id.'/////'.$req->id_appa.'/////'.$req->id_tag;
    $ch.='" onclick="annulation_service(this.id);"><i class="fa fa-times"></i></button>';
    }else{

    }*/
if($req->etat != 5 && $req->etat != 6 && $req->etat != 2 && $req->etat != 1 ){
 $ch.='<button type="button" class="btn btn-danger" title="Annulation demande service" id="';
    $ch.=$req->id.'/////'.$req->id_appa.'/////'.$req->id_tag;
    $ch.='" onclick="annulation_demande(this.id);"><i class="fa fa-times"></i></button>';
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
               
                    <div class="modal fade" id="annulationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Annulation</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('owner/authorizations/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_dem_aut_ann"></div>
                                    <h4>Voulez vous vraiment annuler cette demande d'autorisation ?</h4>
                                    <input type="hidden" name="id_dem_aut_ann" id="id_dem_aut_ann" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_dem_aut_ann_action" class="btn btn-danger" type="submit">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
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
                                    <h4 class="modal-title">Demande autorisation</h4>
                                </div>
                                <?php
    //echo form_open_multipart(base_url('sdl/owners/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <form action="<?php echo base_url('owner/authorizations/');?>" method="POST" role="form" id="form_up" enctype="multipart/form-data" class="form-horizontal">
    <div class="modal-body" align="center">
        <div id="title_div_d">
                                
        </div>
     <div class="row">
       <div class="col-md-4"></div>
       <div class="col-md-8">
         <div class="alert alert-danger" align="center" id="div_message_erreur_demande"></div>
       </div>
      
     </div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Appartement </label>
                                    <div class="col-lg-8">
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
                                    <label  class="col-lg-4 col-sm-4 control-label">Date début </label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="date" class="form-control" placeholder="" id="d_date_d" name="d_date_d" value="" >
                                            <input type="hidden" name="d_id_p" id="d_id_p" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Date fin</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="date" class="form-control" placeholder="" id="d_date_f" name="d_date_f" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Temps début</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="time" class="form-control" placeholder="" id="d_temps_d" name="d_temps_d" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Temps fin</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="time" class="form-control" placeholder="" id="d_temps_f" name="d_temps_f" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Nom de bénéficiaire</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="d_nom_a" name="d_nom_a" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Prénom de bénéficiaire</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="d_prenom_a" name="d_prenom_a" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">CIN de bénéficiaire</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="d_cin_a" name="d_cin_a" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Description</label>
                                    <div class="col-lg-8">
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
    <form action="<?php echo base_url('owner/authorizations/');?>" method="POST" role="form" id="form_up" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label  class="col-lg-4 col-sm-4 control-label">Appartement </label>
                                    <div class="col-lg-8">
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
                                    <label  class="col-lg-4 col-sm-4 control-label">Date début </label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="date" class="form-control" placeholder="" id="date_d" name="date_d" value="" >
                                            <input type="hidden" name="id_p" id="id_p" value="">
                                            <input type="hidden" name="id_d" id="id_d" value="">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Date fin</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="date" class="form-control" placeholder="" id="date_f" name="date_f" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Temps début</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="time" class="form-control" placeholder="" id="temps_d" name="temps_d" required>
                                        </div>
                                    </div>
                            </div>
                           <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Temps fin</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="time" class="form-control" placeholder="" id="temps_f" name="temps_f" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Nom de bénéficiaire</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="nom_a" name="nom_a" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Prénom de bénéficiaire</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="prenom_a" name="prenom_a" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">CIN de bénéficiaire</label>
                                    <div class="col-lg-8">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" placeholder="" id="cin_a" name="cin_a" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label  class="col-lg-4 col-sm-4 control-label">Description</label>
                                    <div class="col-lg-8">
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
    echo form_open_multipart(base_url('owner/authorizations/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_suppression_ac"></div>
                                    <h4> Voulez vous vraiment supprimer cette demande d'autorisation ?</h4>
                                    <input type="hidden" name="id_suppression_d" id="id_suppression_d" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_suppression_aut_action" class="btn btn-danger" type="submit">Supprimer&nbsp;<i class="fa fa-trash-o topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

                                              
                       

            </div>
            <!--body wrapper end-->