<div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading head-border">
                            <h3 align="center">Les appartements</h3>
                        </header>
                        <table class="table">
                            <thead align="center">
                            
                            </thead>
                            <tbody>
                            
                            <?php
                                foreach ($apartments as $apart){
                                echo "<tr>";
                                echo "<td><div align='center'><h4>";
                                echo $apart->nom." / ";                                
                                if($apart->floor == 0){ echo "Rez-de-chaussée";}
                                else if($apart->floor == 1){echo "1<sup>ère</sup> étage";}
                                else {echo $apart->floor."<sup>ème</sup> étage";}
                                echo " / ";
                                echo $apart->code."";
                                echo "</h4><br>";
                                echo "<div align='center'>"; 
                                echo $apart->desc;
                                echo "</div>";
                                echo "<div align='center'>"; 
                                echo "<h4> Les tags</h4>"; 
                                foreach ($tags as $tag){
                                    // id uid etat
                                    if($apart->id == $tag->id_appartement ){
                                        echo "<b>".$tag->uid."</b>&nbsp;";
                                        if($tag->etat==1){echo"<span class='label label-success label-mini'>Activé</span>";}else{echo"<span class='label label-danger label-mini'>Bloqué</span>";} 
                                        $ch='';
                                        if($tag->etat==0){

                                        $ch.='&nbsp;<button type="button" class="btn btn-success btn-xs" title="Déblocage" id="';
                                        $ch.=$tag->id.'/////'.$tag->uid;
                                        $ch.='" onclick="unlock_tag(this.id);"><i class="fa fa-unlock"></i></button>';
                                    } else if($tag->etat==1){
                                        $ch.='&nbsp;<button type="button" class="btn btn-danger btn-xs" title="Blocage" id="';
                                        $ch.=$tag->id.'/////'.$tag->uid;
                                        $ch.='" onclick="lock_tag(this.id);"><i class="fa fa-lock"></i></button>';
                                        }
                                        
            echo $ch;
            echo "<br/><br/>";
                                    }

                                }
                                echo "</div>";
                                echo "</td>";
                                echo "</tr>";   
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>
                    <br><br><br><br><br>
                </div>
            </div>


 <!-- Modal -->
                    <div class="modal fade" id="blocagetagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Blocage</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('owner/apartments/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">
                                

                                    <div id="div_blocage_tag"></div>
                                    <h4>Voulez vous vraiment bloquer ce tag ?</h4>
                                    <input type="hidden" name="id_blocage_tag" id="id_blocage_tag" value="">
        

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_blocage_tag_action" class="btn btn-danger" type="submit">Bloquer&nbsp;<i class="fa fa-lock topbar-info-icon top-2"></i></button>
                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->
                <!-- Modal -->
                    <div class="modal fade" id="deblocagetagModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Déblocage</h4>
                                </div>
                                <?php
    echo form_open_multipart(base_url('owner/apartments/'), array('role'=>'form' , 'class'=>'form-horizontal') ); ?>
                                <div class="modal-body" align="center">

                                    <div id="div_deblocage_tag"></div>
                                    <h4>Voulez vous vraiment activer ce tag ?</h4>
                                    <input type="hidden" name="id_deblocage_tag" id="id_deblocage_tag" value="">

                                </div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>
                                    <button id="b_deblocage_tag_action" class="btn btn-success" type="submit">Activer&nbsp;<i class="fa fa-unlock topbar-info-icon top-2"></i></button>

                                </div>
                                <?php echo form_close() ; ?>
                            </div>
                        </div>
                    </div>
                <!-- modal -->