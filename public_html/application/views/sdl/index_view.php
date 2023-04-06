            
            <!--body wrapper start-->
            <div class="wrapper" style="background-image:url('<?php echo base_url('assets/img/gloulouk2.png'); ?>');">
                <?php
                /*
                11: Les blocs,
                12: Les appartements,
                13: Les tags,
                21: Les propriétaires,
                31: Les services,
                32: Les employés,
                41: Les services,
                42: Les autorisations,
                51: Les services,
                52: Les autorisations,
                53: Les actions
                */
                
                $tab_roles = explode(",", $info[0]->roles);
                 ?>
                <!--state overview start-->
                <div class="row state-overview">
                    <?php 
                    if ($info[0]->type == 1 || in_array("11", $tab_roles)) {               
                    ?>
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel blue">
                            <div class="symbol">
                                <i class="fa fa-building-o"></i>

                            </div>
                            <div class="value white">
                                <h1 class="timer" data-from="0" data-to="320"
                                    data-speed="1000">
                                    <?php echo $nb_bloc[0]->nb_bloc; ?>
                                </h1>
                                <p>Les blocs</p>
                            </div>
                            <div align="center">
                            <a href="<?php echo base_url('sdl/blocks/'); ?>" class="btn btn-round btn-default">Voir plus</a>
                                <br/><br/>
                            </div>
                        </section>
                    </div>
                    <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("12", $tab_roles)) {               
                    ?>
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel ">
                            <div class="symbol blue-color">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="value gray">
                                <h1 class="blue-color timer" data-from="0" data-to="123"
                                    data-speed="1000">
                                    <?php echo $nb_appartement[0]->nb_appartement; ?>
                                </h1>
                                <p>Les appartements</p>
                            </div>
                            <div align="center">
                            <a href="<?php echo base_url('sdl/apartments/'); ?>" class="btn btn-round btn-info">Voir plus</a>
                                <br/><br/>
                            </div>
                        </section>
                    </div>
                    <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("13", $tab_roles)) {               
                    ?>
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel blue">
                            <div class="symbol">
                                <i class="fa fa-credit-card"></i>

                            </div>
                            <div class="value white">
                                <h1 class="timer" data-from="0" data-to="320"
                                    data-speed="1000">
                                    <?php echo $nb_tags[0]->nb_tags; ?>
                                </h1>
                                <p>Les tags</p>
                            </div>
                            <div align="center">
                            <a href="<?php echo base_url('sdl/tags/'); ?>" class="btn btn-round btn-default">Voir plus</a>
                                <br/><br/>
                            </div>
                        </section>
                    </div>
                    <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("21", $tab_roles)) {               
                    ?>
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel ">
                            <div class="symbol blue-color">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="value gray">
                                <h1 class="blue-color timer" data-from="0" data-to="123"
                                    data-speed="1000">
                                    <?php echo $nb_prop[0]->nb_prop; ?>
                                </h1>
                                <p>Les propriétaires</p>
                            </div>
                            <div align="center">
                            <a href="<?php echo base_url('sdl/owners/'); ?>" class="btn btn-round btn-info">Voir plus</a>
                                <br/><br/>
                            </div>
                        </section>
                    </div>
                    <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("31", $tab_roles)) {               
                    ?>
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel blue">
                            <div class="symbol">
                                <i class="fa fa-briefcase"></i>

                            </div>
                            <div class="value white">
                                <h1 class="timer" data-from="0" data-to="320"
                                    data-speed="1000">
                                    <?php echo $nb_service[0]->nb_service; ?>
                                </h1>
                                <p>Les services</p>
                            </div>
                            <div align="center">
                            <a href="<?php echo base_url('sdl/services/'); ?>" class="btn btn-round btn-default">Voir plus</a>
                                <br/><br/>
                            </div>
                        </section>
                    </div>
                    <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("32", $tab_roles)) {               
                    ?>
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel ">
                            <div class="symbol blue-color">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="value gray">
                                <h1 class="blue-color timer" data-from="0" data-to="123"
                                    data-speed="1000">
                                    <?php echo $nb_employe[0]->nb_employe; ?>
                                </h1>
                                <p>Les employés</p>
                            </div>
                            <div align="center">
                            <a href="<?php echo base_url('sdl/employees/'); ?>" class="btn btn-round btn-info">Voir plus</a>
                                <br/><br/>
                            </div>
                        </section>
                    </div>
                    <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("41", $tab_roles)) {               
                    ?>
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel blue">
                            <div class="symbol">
                                <i class="fa fa-envelope"></i>

                            </div>
                            <div class="value white">
                                <h1 class="timer" data-from="0" data-to="320"
                                    data-speed="1000">
                                    <?php echo $nb_demandeservice[0]->nb_demandeservice; ?>
                                </h1>
                                <p>Demande des services</p>
                            </div>
                            <div align="center">
                            <a href="<?php echo base_url('sdl/s_requests/'); ?>" class="btn btn-round btn-default">Voir plus</a>
                                <br/><br/>
                            </div>
                        </section>
                    </div>
                    <?php } ?>
                    <?php 
                    if ($info[0]->type == 1 || in_array("42", $tab_roles)) {               
                    ?>
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel ">
                            <div class="symbol blue-color">
                                <i class="fa fa-key"></i>
                            </div>
                            <div class="value gray">
                                <h1 class="blue-color timer" data-from="0" data-to="123"
                                    data-speed="1000">
                                  <?php echo $nb_demandeautorisation[0]->nb_demandeautorisation; ?>
                                </h1>
                                <p>Demande des autorisations</p>
                            </div>
                            <div align="center">
                                <a href="<?php echo base_url('sdl/a_requests/'); ?>" class="btn btn-round btn-info">Voir plus</a>
                                <br/><br/>
                            </div>
                        </section>
                    </div>
                    <?php } ?>
                </div>
                <!--state overview end-->
             


            </div>
            <!--body wrapper end-->