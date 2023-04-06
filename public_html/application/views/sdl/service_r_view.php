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
                            <?php
                            $ch='';
                            foreach ($apartments as $ap){
                            $ch.=$ap->id.',';
                            }
                            
                            $ch = substr($ch, 0, -1);
                            echo'<input type="hidden" name="appar_not_aff" id="appar_not_aff" value="'.$ch.'">';

                            ?>
                            
                            <table class="table colvis-data-table data-table">
                            <thead>
                            <tr>
                               
                                <th align="center">
                                    <div align="center">Propriétaire</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Les appartements</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Services demandés</div>
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($owners as $owner){
                                    $ch_a='<hr>';
                                    $ch_s='<hr>';
                                    $etat=0;
                                 echo "<tr>";
                                 
                                 echo "<td><div align='center'>"; 
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
                                 if($owner->cin!=""){echo "<b>CIN : </b>".$owner->cin."<br/>";}
                                 if($owner->tel!=""){echo "<b>Tél : </b>".$owner->tel.'<br>';}
                                 if($owner->email!=""){echo "<b>Email : </b>".$owner->email.'<br>';}
                                 echo "".$owner->desc.'<br>';
                                 
                                 echo "</div></td>";
                                 echo "<td><div align='center'>";


                                echo "<hr>";
                                foreach ($apartments as $apart){
                                   $sup=0;
                                   $etat=0;
                                if ($apart->id_proprietaire == $owner->id) {
                                
                                echo $apart->nom."";
                                echo " / ";
                                
                                if($apart->floor == 0){ echo "Rez-de-chaussée";}
                                else if($apart->floor == 1){echo "1<sup>ère</sup> étage";}
                                else {echo $apart->floor."<sup>ème</sup> étage";}
                                echo " / ";
                                echo $apart->code."";
                                echo "<br>"; 
                                echo $apart->desc;
                                $badd='';
                                $badd.='<div align="center"><button type="button" class="btn btn-success" title="Demande service pour l\'appartement '.$apart->code.'" id="';
    $badd.=$apart->id.'/////'.$apart->id_bloc.'/////'.$apart->nom.'/////'.$apart->code.'/////'.$apart->desc.'/////'.$apart->id_proprietaire.'/////'.$apart->sdl_id.'/////'.$apart->floor;
    $badd.='" onclick="demande_service(this.id);">Demande service&nbsp;<i class="fa fa-send"></i></button></div>';
                                echo $badd;
                                echo "<hr>";


    //sports
$d_deut ="";
$d_fin ="";
$t_debut ="";
$t_fin ="";
$id_s="";
$etat=0;

foreach ($s_requests as $req){ 
$etat=0;
if ($req->id_appa == $apart->id) {
    //id, id_appa, id_prop, id_serv, date_debut, date_fin, heur_debut,  heur_fin,description,   etat,id_emp,    id_tag,created_at,updated_at,id_add,    type_add
    $ch_s0='';
    $nom_s="";
    $etat=$req->etat;


    
    foreach ($services as $serv){ 
        if($req->id_serv == $serv->id) {$nom_s=$serv->nom;}
    }
    $ch_s0.='<b>Appartement '.$apart->code.' : '.$nom_s.'</b><br/>';
    
    $ch_s0.="[<b>Début: </b>".$req->date_debut." ".$req->heur_debut."]  ";
    $ch_s0.="[<b>Fin: </b>".$req->date_fin." ".$req->heur_fin."]<br/>";
    $ch_s0.='<b> '.$req->description.'</b><br/>';

    $d_debut = $req->date_debut;
    $d_fin = $req->date_fin;
    $t_debut = $req->heur_debut;
    $t_fin = $req->heur_fin;
    $service_d = $req->id_serv;
    $desc_serv= $req->description;
    $id_d= $req->id;
    $etat_d= $req->etat;

    $ch_s0.='<div align="center"><button type="button" class="btn btn-danger" title="Suppression demande service pour l\'appartement '.$apart->code.'" id="';
    $ch_s0.=$apart->id.'/////'.$apart->id_bloc.'/////'.$apart->nom.'/////'.$apart->code.'/////'.$apart->desc.'/////'.$apart->id_proprietaire.'/////'.$apart->sdl_id.'/////'.$apart->floor.'/////'.$d_debut.'/////'.$d_fin.'/////'.$t_debut.'/////'.$t_fin.'/////'.$service_d.'/////'.$desc_serv.'/////'.$id_d.'/////'.$etat_d.'/////'.$nom_s;
    $ch_s0.='" onclick="suppression_demande(this.id);"><i class="fa fa-times"></i></button>';
    $ch_s0.='<button type="button" class="btn btn-success" title="Modification demande service pour l\'appartement '.$apart->code.'" id="';
    $ch_s0.=$apart->id.'/////'.$apart->id_bloc.'/////'.$apart->nom.'/////'.$apart->code.'/////'.$apart->desc.'/////'.$apart->id_proprietaire.'/////'.$apart->sdl_id.'/////'.$apart->floor.'/////'.$d_debut.'/////'.$d_fin.'/////'.$t_debut.'/////'.$t_fin.'/////'.$service_d.'/////'.$desc_serv.'/////'.$id_d.'/////'.$etat_d.'/////'.$nom_s;
    $ch_s0.='" onclick="modification_demande(this.id);"><i class="fa fa-edit"></i></button></div><hr>';

    


if($etat_d==1){$ch_s.= $ch_s0;}
    

 }
 }








                                }
                                
     
  

                                  
                                }
                                



                                 echo "</div></td>";
                                 echo "<td><div align='center'>";
                                 //if($etat==1){echo $ch_s;}
                                 
                                 echo $ch_s;

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
                                    <button id="b_demande_action" class="btn btn-success" type="button">Demander&nbsp;<i class="fa  fa-edit topbar-info-icon top-2"></i></button>
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
    <form action="<?php echo base_url('sdl/service_r/');?>" method="POST" role="form" id="form_up" enctype="multipart/form-data" class="form-horizontal">
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
                                            <input type="hidden" name="id_app" id="id_app" value="">
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
    echo form_open_multipart(base_url('sdl/service_r/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
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
            

               

            </div>
            <!--body wrapper end-->