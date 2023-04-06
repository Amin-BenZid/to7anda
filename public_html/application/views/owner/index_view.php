             
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
                
                 ?>
                <!--state overview start-->
                <div class="row state-overview">
                   
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel ">
                            <div class="symbol blue-color">
                                <i class="fa fa-building"></i>
                            </div>
                            <div class="value gray">
                                <h1 class="blue-color timer" data-from="0" data-to="123"
                                    data-speed="1000">
                                    <?php echo $nb_appartement[0]->nb_appartement; ?>
                                </h1>
                                <p>Les appartements</p>
                            </div>
                            <div align="center">
                            <a href="<?php echo base_url('owner/apartments/'); ?>" class="btn btn-round btn-info">Voir plus</a>
                                <br/><br/>
                            </div>
                        </section>
                    </div>
                    
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
                            <a href="<?php echo base_url('owner/apartments/'); ?>" class="btn btn-round btn-default">Voir plus</a>
                                <br/><br/>
                            </div>
                        </section>
                    </div>
                    
                    
                   
                    
                    
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel blue">
                            <div class="symbol">
                                <i class="fa fa-briefcase"></i>

                            </div>
                            <div class="value white">
                                <h1 class="timer" data-from="0" data-to="320"
                                    data-speed="1000">
                                    <?php echo $nb_demandeservice[0]->nb_demandeservice; ?>
                                </h1>
                                <p>Demande des services</p>
                            </div>
                            <div align="center">
                            <a href="<?php echo base_url('owner/services/'); ?>" class="btn btn-round btn-default">Voir plus</a>
                                <br/><br/>
                            </div>
                        </section>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6">
                        <section class="panel ">
                            <div class="symbol blue-color">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="value gray">
                                <h1 class="blue-color timer" data-from="0" data-to="123"
                                    data-speed="1000">
                                  <?php echo $nb_demandeautorisation[0]->nb_demandeautorisation; ?>
                                </h1>
                                <p>Demande des autorisations</p>
                            </div>
                            <div align="center">
                                <a href="<?php echo base_url('owner/authorizations/'); ?>" class="btn btn-round btn-info">Voir plus</a>
                                <br/><br/>
                            </div>
                        </section>
                    </div>
                  
                </div>
                <!--state overview end-->
             


            </div>
            <!--body wrapper end-->