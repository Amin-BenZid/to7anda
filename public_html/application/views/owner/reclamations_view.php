            <!--body wrapper start-->
            <div class="wrapper">
                <!--state overview start-->
                <div class="row state-overview">
                <div>                   
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading ">
                                <button id="b_nouvelle_reclam"  type="button" class="btn btn-success " >Nouvelle réclamation <i class="fa fa-send topbar-info-icon top-2"></i></button>
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
                                    <div align="center">Réclamation</div>
                                </th>
                                <th align="center">    
                                    <div align="center">Date</div>
                                </th>
                                
                            </tr>
                            <!--
                                reclamations : id, id_prop, id_app, reclam, date

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
                                foreach ($reclamations as $req){
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
                                    if($apartment->id==$req->id_app){
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
                                 
                                 echo'<br/>'.$req->reclam.'</br>';
                                 echo "</div></td>";                                
                                 echo "<td><div align='center'>";

                                 echo'<br/>'.$req->date.'</br>';

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
                    <div class="modal fade" id="reclamationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Nouvelle réclamation</h4>
                                </div>
                                <?php
    //echo form_open_multipart(base_url('sdl/owners/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
    <form action="<?php echo base_url('owner/reclamations/');?>" method="POST" role="form" id="form_up" enctype="multipart/form-data" class="form-horizontal">
    <div class="modal-body" align="center">
       
     <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-9">
         <input type="hidden" name="id_prop" id="id_prop" value="">
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
                                    <label  class="col-lg-3 col-sm-3 control-label">Réclamation</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input">
                                            <textarea class="form-control" placeholder="" id="reclam" name="reclam" required></textarea>
                                        </div>
                                    </div>
                            </div>
                                                      
                         


                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_reclam_action" class="btn btn-success" type="submit">Envoyer&nbsp;<i class="fa  fa-send topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->

                       

            </div>
            <!--body wrapper end-->