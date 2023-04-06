<!-- ******************************   BEGIN  ********************************************** -->


        <!-- BEGIN GOOGLE MAP -->
        <div class="row">
            <div id="map" class="gmaps margin-bottom-40" style="height:400px;"></div>
        </div>
        <!-- END GOOGLE MAP -->

        <!-- BEGIN CONTAINER -->   
        <div class="container min-hight">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <h2>Formulaire de contact</h2>
                    <p></p>
                    <div class="space20"></div>
                    <!-- BEGIN FORM-->
                    <?php echo form_open_multipart(base_url('site/contact/'), array('role'=>'form' , 'class'=>'horizontal-form margin-bottom-40') ); ?>

                        <div class="form-group">
                            <label class="control-label">Nom <span class="color-red">*</span></label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="nom" name="nom" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" >Email <span class="color-red">*</span></label>
                            <div class="col-lg-12">
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" >Message <span class="color-red">*</span></label>
                            <div class="col-lg-12">
                                <textarea class="form-control" rows="8" id="message" name="message" required></textarea>
                                <br/>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                        <button type="submit" class="btn btn-default theme-btn"><i class="icon-ok"></i> Envoyer </button>
                        <button type="button" class="btn btn-default" id="b_annuler">Annuler</button>
                        </div>
                    <?php echo form_close() ; ?>
                    <!-- END FORM-->                  
                </div>

                <div class="col-md-4 col-sm-4">


                    <h2><?php echo $query_config[0]->titre ?></h2>
                    <dir class="row">
                      <?php if($query_config[0]->adresse!="") {?> 
                      <div> 
                      <p><b><i class="fa fa-map-marker topbar-info-icon top-2"></i> Adresse</b></p>
                      <p><?php echo $query_config[0]->adresse ?> </p>
                      </div>
                      <?php }?>
                      <?php if($query_config[0]->tel!="") {?> 
                      <div>
                      <p><b><i class="fa fa-phone topbar-info-icon top-2"></i> Tél</b></p>
                      <p><?php echo $query_config[0]->tel ?></p>
                      </div>
                      <?php }?>
                      <?php if($query_config[0]->fax!="") {?> 
                      <div>
                      <p><b><i class="fa fa-phone topbar-info-icon top-2"></i> Fax</b></p>
                      <p> <?php echo $query_config[0]->fax ?></p>
                      </div>
                      <?php }?>
                      <?php if($query_config[0]->email!="") {?> 
                      <div>
                      <p><b><i class="fa fa-envelope topbar-info-icon top-2"></i> Email</b></p>
                      <p><?php echo $query_config[0]->email ?></p>
                      </div>
                      <?php }?>
                      <div align="center">
                    <ul class="social-icons margin-bottom-10">
                        
                        <?php if($query_config[0]->fb!="") {?> 
                            <li><a href="<?php echo $query_config[0]->fb;?>" data-original-title="facebook" class="facebook" target="_blank"></a></li>
                          <?php }?>
                          <?php if($query_config[0]->youtube!="") {?> 
                            <li><a href="<?php echo $query_config[0]->youtube;?>" data-original-title="youtube" class="youtube" target="_blank"></a></li>
                          <?php }?>
                          <?php if($query_config[0]->gplus!="") {?> 
                            <li><a href="" data-original-title="googleplus" class="googleplus" target="_blank"></a></li>
                          <?php }?>
                            <?php if($query_config[0]->twiter!="") {?> 
                            <li><a href="" data-original-title="twitter" class="twitter" target="_blank"></a></li>
                          <?php }?>
                        
                    </ul>
                    </div>
                    </dir>
                    

                    <div class="clearfix margin-bottom-30"></div>
                               
                </div>            
            </div>
        </div>
        <!-- END CONTAINER -->

<!-- *******************************  END     ********************************************** -->
