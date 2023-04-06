            <!--body wrapper start-->

            <div class="wrapper">

                <!--state overview start-->

                <div class="row state-overview">

                    <div style="overflow-x:auto;">

                        <div class="row">

                            <div class="col-sm-12">

                                <section class="panel">

                                    <header class="panel-heading ">

                                        <button id="b_ajouter_residence" type="button" class="btn btn-success ">Ajouter une résidence <i class="fa fa-plus topbar-info-icon top-2"></i></button>

                                        <span class="tools pull-right">

                                        </span>

                                    </header>

                                    <table class="table colvis-data-table data-table">

                                        <thead>

                                            <tr>

                                                <th>

                                                    <div align="center">Nom de la résidence</div>

                                                </th>

                                                <!--  <th align="center">

                                    <div align="center">Logo</div>

                                </th> -->

                                                <th align="center">

                                                    <div align="center">Les actions</div>

                                                </th>



                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                            foreach ($residences as $residence) {

                                                echo "<tr>";

                                                echo "<td><div align='center'>";

                                                echo $residence->nom . "";







                                                echo "</div></td>";

                                                /* echo "<td><div align='center'>"; 

                                 echo $service->desc;

                                 echo "</div></td>";    */

                                                echo "<td><div align='center'>";

                                                $ch = '';







                                                $ch .= '<button type="button" class="btn btn-default" title="Modification" id="';

                                                $ch .= $residence->id . '/////' . $residence->nom;

                                                $ch .= '" onclick="modification_residence(this.id);"><i class="fa fa-edit"></i></button>';



                                                $ch .= '<button type="button" class="btn btn-default" title="Suppression" id="';

                                                $ch .= $residence->id . '/////' . $residence->nom;

                                                $ch .= '" onclick="suppression_residence(this.id);"><i class="fa fa-times"></i></button>';

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

                <div class="modal fade" id="ajouterresidenceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                <h4 class="modal-title">Ajouter une résidence</h4>

                            </div>

                            <div class="modal-body" align="center">





                                <?php

                                echo form_open_multipart(base_url('sdl/residences/'), array('role' => 'form', 'class' => 'form-horizontal')); ?>

                                <div class="row">

                                    <div class="col-md-3"></div>

                                    <div class="col-md-9">

                                        <div class="alert alert-danger" align="center" id="div_message_erreur_add_residence"></div>

                                    </div>



                                </div>





                                <div class="form-group">

                                    <label class="col-lg-3 col-sm-3 control-label">Nom de la résidence</label>

                                    <div class="col-lg-9">

                                        <div class="iconic-input">

                                            <i class="fa fa-briefcase"></i>

                                            <input type="text" class="form-control" placeholder="" id="nom_ajout_residence" name="nom_ajout_residence" required>

                                        </div>

                                    </div>

                                </div>
                                <hr>
                                <h5 style="text-align : center">Informations du Résponsable</h5>
                                
                                <div class="form-group">

                                    <label  class="col-lg-3 col-sm-3 control-label">CIN</label>

                                    <div class="col-lg-9">

                                        <div class="iconic-input">

                                            <i class="fa fa-user"></i>

                                            <input type="text" class="form-control" placeholder="" id="cin_ajout_admin" name="cin_ajout_admin" required >

                                        </div>

                                    </div>

                            </div>

                            <div class="form-group">

                                    <label  class="col-lg-3 col-sm-3 control-label">Nom</label>

                                    <div class="col-lg-9">

                                        <div class="iconic-input">

                                            <i class="fa fa-user"></i>

                                            <input type="text" class="form-control" placeholder="" id="nom_ajout_admin" name="nom_ajout_admin" required>

                                        </div>

                                    </div>

                            </div>

                           <div class="form-group">

                                    <label  class="col-lg-3 col-sm-3 control-label">Prénom</label>

                                    <div class="col-lg-9">

                                        <div class="iconic-input">

                                            <i class="fa fa-user"></i>

                                            <input type="text" class="form-control" placeholder="" id="prenom_ajout_admin" name="prenom_ajout_admin" required>

                                        </div>

                                    </div>

                            </div>

                           <div class="form-group">

                                    <label  class="col-lg-3 col-sm-3 control-label">Sexe</label>

                                    <div class="col-lg-9">

                                        <div class="radio-list" align="center">

                                    

                                    <label class="radio-inline">

                                    <input type="radio" id="sexe_ajout_admin" name="sexe_ajout_admin"  value="1" checked> Homme

                                    </label>

                                    <label class="radio-inline">

                                    <input type="radio" id="sexe_ajout_admin" name="sexe_ajout_admin"  value="2" > Femme 

                                    </label> 

                                 </div>

                                    </div>

                            </div>

                           

                            <div class="form-group">

                                    <label  class="col-lg-3 col-sm-3 control-label">Téléphone</label>

                                    <div class="col-lg-9">

                                        <div class="iconic-input">

                                            <i class="fa fa-user"></i>

                                            <input type="text" class="form-control" placeholder="" id="tel_ajout_admin" name="tel_ajout_admin">

                                        </div>

                                    </div>

                            </div>

                            <div class="form-group">

                                    <label  class="col-lg-3 col-sm-3 control-label">Email</label>

                                    <div class="col-lg-9">

                                        <div class="iconic-input">

                                            <i class="fa fa-user"></i>

                                            <input type="email" class="form-control" placeholder="" id="email_ajout_admin" name="email_ajout_admin">

                                        </div>

                                    </div>

                            </div>

                            

                            <div class="form-group">

                            <label class="col-lg-3 col-sm-3 control-label">Description</label>

                            <div class="col-lg-9">

                                <textarea id="desc_ajout_admin" name="desc_ajout_admin" class="form-control" cols="30" rows="3"></textarea>

                            </div>

                            </div>

                            <div class="form-group">

                                <label class="col-lg-3 col-sm-3 control-label">Photo</label>

                                <div class="col-lg-9">

                                    <input id="photo_ajout_admin" name="photo_ajout_admin" class="file" type="file" multiple=false>

                                </div>

                            </div>

                                <!--   <div class="form-group">

                            <label class="col-lg-3 col-sm-3 control-label">Description</label>

                            <div class="col-lg-9">

                                <textarea id="desc_ajout_service" name="desc_ajout_service" class="form-control" cols="30" rows="3"></textarea>

                            </div>

                            </div> -->

                            </div>

                            <div class="modal-footer">

                                <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>

                                <button id="b_ajouter_bloc_residence" class="btn btn-success" type="submit">Ajouter&nbsp;<i class="fa  fa-plus topbar-info-icon top-2"></i></button>

                            </div>

                            <?php echo form_close(); ?>

                        </div>

                    </div>

                </div>

                <!-- modal -->



                <!-- Modal -->

                <div class="modal fade" id="modificationresidenceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                <h4 class="modal-title">Modification</h4>

                            </div>

                            <?php

                            echo form_open_multipart(base_url('sdl/residences/'), array('role' => 'form', 'class' => 'form-horizontal')); ?>

                            <div class="modal-body" align="center">

                                <div class="row">

                                    <div class="col-md-3"></div>

                                    <div class="col-md-9">

                                        <div class="alert alert-danger" align="center" id="div_message_erreur_modif_residence"></div>

                                    </div>



                                </div>







                                <div class="form-group">

                                    <label class="col-lg-3 col-sm-3 control-label">Nom</label>

                                    <div class="col-lg-9">

                                        <div class="iconic-input">

                                            <i class="fa fa-briefcase"></i>

                                            <input type="text" class="form-control" placeholder="" id="nom_modif_residence" name="nom_modif_residence" required>

                                            <input type="hidden" name="id_modif_residence" id="id_modif_residence" value="">

                                        </div>

                                    </div>

                                </div>



                                <!--  <div class="form-group">

                            <label class="col-lg-3 col-sm-3 control-label">Description</label>

                            <div class="col-lg-9">

                                <textarea id="desc_modif_service" name="desc_modif_service" class="form-control" cols="30" rows="3"></textarea>

                            </div>

                            </div> -->



                            </div>

                            <div class="modal-footer">

                                <button data-dismiss="modal" class="btn btn-default" type="button">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>

                                <button id="b_modif_residence_action" class="btn btn-success" type="submit">Modifier&nbsp;<i class="fa  fa-edit topbar-info-icon top-2"></i></button>

                            </div>

                            <?php echo form_close(); ?>

                        </div>

                    </div>

                </div>

                <!-- modal -->

                <!-- Modal -->

                <div class="modal fade" id="suppressionresidenceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                <h4 class="modal-title">Suppression</h4>

                            </div>

                            <?php

                            echo form_open_multipart(base_url('sdl/residences/'), array('role' => 'form', 'class' => 'form-horizontal')); ?>

                            <div class="modal-body" align="center">



                                <div id="div_suppression_residence"></div>

                                <h4>Voulez vous vraiment supprimer cette résidence ?</h4>

                                <input type="hidden" name="id_suppression_residence" id="id_suppression_residence" value="">



                            </div>

                            <div class="modal-footer">

                                <button data-dismiss="modal" class="btn btn-default" type="button">Annuler&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>

                                <button id="b_suppression_residence_action" class="btn btn-danger" type="submit">Supprimer&nbsp;<i class="fa fa-trash-o topbar-info-icon top-2"></i></button>

                            </div>

                            <?php echo form_close(); ?>

                        </div>

                    </div>

                </div>

                <!-- modal -->







            </div>

            <!--body wrapper end-->