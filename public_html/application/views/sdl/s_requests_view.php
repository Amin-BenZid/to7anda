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
                                    <div align="center">Propriétaire</div>  
                                </th>
                                <th align="center">
                                    <div align="center">Appartement</div>
                                </th>
                                <th align="center">
                                    <div align="center">Service</div>
                                </th>
                                <th align="center">
                                    <div align="center">Employé</div>
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
                                    if($req->etat != 5 && $req->etat != 6 ){
                                 echo "<tr>";
                                 echo "<td><div align='center'>";
    
                                 foreach ($owners as $owner){
                                    if($owner->id==$req->id_prop){
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
                                 echo "<div class='team-m'>";
                                 echo "<a href='#'>";

                                 foreach ($employees as $empl){
                                    if($empl->id == $req->id_emp){
                                        ?>
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
                                 
                                 echo $empl->desc.'<br>';
                                 echo $empl->tel.'<br>';
                                 echo $empl->email.'<br>';
                                 echo "</div>";
                                 ?>

                                        <?php
                                    }
                                 }

                                 foreach ($tags as $tag){
                                    if($req->id_tag == $tag->id){
                                        echo "<div><b>Tag : ".$tag->uid."</b></br></div>";
                                    }
                                    
                                    }
                                 echo "</td>";
                                 echo "<td><div align='center'>";
                                 if ($req->etat == 1) {
                                    echo '<div class="bg-warning light-color"> Nouvelle demande </div>';
                                 } elseif ($req->etat == 2) {
                                    echo '<div class="bg-danger light-color"> Demande d’annulation </div>';
                                 } elseif ($req->etat == 3) {
                                    echo '<div class="bg-success light-color"> Acceptation de demande </div>';
                                 } elseif ($req->etat == 4) {
                                    echo '<div class="bg-info light-color"> Demande en cours d’exécution </div>';
                                 }else{

                                 }
                                 echo "</div></td>";                                 
                                 echo "<td><div align='center'>";
                                 $ch=''; 
     
  
   if ($req->etat == 1) { 
    $ch.='<button type="button" class="btn btn-default" title="Acceptation" id="';
    $ch.=$req->id.'/////'.$req->id_appa.'/////'.$req->id_serv.'/////'.$req->id_tag.'/////'.$req->id_emp;
    $ch.='" onclick="acceptation_service(this.id);"><i class="fa fa-check"></i></button>';
    }
    $ch.='<button type="button" class="btn btn-default" title="Annulation" id="';
    $ch.=$req->id.'/////'.$req->id_appa.'/////'.$req->id_serv.'/////'.$req->id_tag.'/////'.$req->id_emp;
    $ch.='" onclick="annulation_service(this.id);"><i class="fa fa-times"></i></button>';
 if ($req->etat == 4) { 

    $ch.='<button type="button" class="btn btn-default" title="Termination" id="';
    $ch.=$req->id.'/////'.$req->id_appa.'/////'.$req->id_serv.'/////'.$req->id_tag.'/////'.$req->id_emp;
    $ch.='" onclick="termination_service(this.id);"><i class="fa fa-certificate"></i></button>';
 }
    $ch.='<button type="button" class="btn btn-default" title="Employé" id="';
    $ch.=$req->id.'/////'.$req->id_appa.'/////'.$req->id_serv.'/////'.$req->id_tag.'/////'.$req->id_emp;
    $ch.='" onclick="employe_service(this.id);"><i class="fa fa-user"></i></button>';

    $ch.='<button type="button" class="btn btn-default" title="Message" id="';
    $ch.=$req->id.'/////'.$req->id_appa.'/////'.$req->id_serv.'/////'.$req->id_tag.'/////'.$req->id_emp;
    $ch.='" onclick="message_service(this.id);"><i class="fa fa-envelope"></i></button>';

    //$ch.='<button type="button" class="btn btn-default" title="Tag" id="';
    //$ch.=$req->id.'/////'.$req->id_appa.'/////'.$req->id_serv.'/////'.$req->id_tag.'/////'.$req->id_emp;
    //$ch.='" onclick="tag_service(this.id);"><i class="fa fa-credit-card"></i></button>';
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
                    <div class="modal fade" id="employeserviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Employé</h4>
                                </div>
                                <div class="modal-body" align="center">

                                    
                                    <?php
    echo form_open_multipart(base_url('sdl/s_requests/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
     
     
                           
                            
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Employé</label>
                                    <div class="col-lg-9">
                                        <div class="">

                                        <input type="hidden" name="id_dem_ser_emp" id="id_dem_ser_emp" value="">
                                        <input type="hidden" name="id_ser_dem" id="id_ser_dem" value="">
                                        <select class="form-control m-b-10" id="s_id_dem_ser_emp" name="s_id_dem_ser_emp" required>
                                            
                                        </select>
                                    </div>
                                    </div>
                            </div>
                            <div class="form-group" align="center">
                                    
                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_save_employe_service" class="btn btn-success" type="submit">Enregistrer&nbsp;<i class="fa  fa-save topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

                <!-- Modal -->
                    <div class="modal fade" id="tagserviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Tag</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/s_requests/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <div class="modal-body" align="center">
     <div class="row"></div>
     
                           
                            <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Tag</label>
                                    <div class="col-lg-9">
                                        <div class="">

                                        <input type="hidden" name="id_dem_ser_tag" id="id_dem_ser_tag" value="">
                                        <input type="hidden" name="id_app_tag" id="id_app_tag" value="">
                                        <select class="form-control m-b-10" id="s_id_dem_ser_tag" name="s_id_dem_ser_tag" required>
                                            
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


                    <div class="modal fade" id="acceptationserviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Acceptation</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/s_requests/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_dem_ser_acc"></div>
                                    <h4>Voulez vous vraiment accepter cette demande de service ?</h4>
                                    <input type="hidden" name="id_dem_ser_acc" id="id_dem_ser_acc" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_dem_ser_acc_action" class="btn btn-success" type="submit">Accepter&nbsp;<i class="fa fa-check topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>

                    <!-- modal -->
                    <div class="modal fade" id="messageserviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Message</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/s_requests/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_dem_ser_mess"></div>
                                    <h4>Message à envoyer au propriétaire</h4>
                                    <div class="form-group">
                                    <label  class="col-lg-1 col-sm-1 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="iconic-input">
                                            <textarea class="form-control" placeholder="" id="message" name="message" required></textarea>
                                        </div>
                                    </div>
                            </div>
                                    <input type="hidden" name="id_dem_ser_mess" id="id_dem_ser_mess" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_dem_ser_mess_action" class="btn btn-success" type="submit">Envoyer&nbsp;<i class="fa fa-envelope topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- modal -->
                    <div class="modal fade" id="annulationserviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Annulation</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/s_requests/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
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
                <!-- modal -->
                    <div class="modal fade" id="terminationserviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Termination</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('sdl/s_requests/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_dem_ser_ter"></div>
                                    <h4>Voulez vous vraiment terminer cette demande de service ?</h4>
                                    <input type="hidden" name="id_dem_ser_ter" id="id_dem_ser_ter" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_dem_ser_ter_action" class="btn btn-success" type="submit">Terminer&nbsp;<i class="fa fa-certificate topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->               

            </div>
            <!--body wrapper end-->