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
                                    if($req->etat == 5 || $req->etat == 6 ){
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
                                        echo "<div align='center'><b>Tag : ".$tag->uid."</b></br></div>";
                                    }
                                    
                                    }
                                 echo "</td>";
                                 echo "<td><div align='center'>";
                                 //etatdemande
                                 foreach ($etatdemande as $etatd){
                                    if($req->id == $etatd->id_demande){
                                        echo "<div align='center'><b>".$etatd->date."</b></br></div>";
                                        if ($etatd->etat == 1) {
                                            echo '<div class="bg-warning light-color"> Nouvelle demande </div>';
                                         } elseif ($etatd->etat == 2) {
                                            echo '<div class="bg-danger light-color"> Demande d’annulation </div>';
                                         } elseif ($etatd->etat == 3) {
                                            echo '<div class="bg-success light-color"> Acceptation de demande </div>';
                                         } elseif ($etatd->etat == 4) {
                                            echo '<div class="bg-info light-color"> Demande en cours d’exécution </div>';
                                         }elseif ($etatd->etat == 5) {
                                            echo '<div class="bg-success light-color"> La demande a été effectuée </div>';
                                         } elseif ($etatd->etat == 6) {
                                            echo '<div class="bg-danger light-color">La demande a été annulée </div>';
                                         }else{

                                         }

                                    }
                                    
                                    }
                                     
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
                
                

            </div>
            <!--body wrapper end-->