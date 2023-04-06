



</div>

    <!-- END PAGE CONTAINER -->



<!-- BEGIN FOOTER -->
    <div class="footer">
        <div class="container">
            <div class="row">
            <div class="col-md-3 col-sm-3" align="center">
                <br><br>
                <?php if($query_config[0]->logo!="") {?> 
          <img src=" <?php echo base_url('uploads/image/logo/'.$query_config[0]->logo); ?>" id="logoimg" alt="" width="150px" height="150px">
        <?php }else{?>
          <img src=" <?php echo base_url('assets/img/logo.jpg'); ?>" id="logoimg" alt="" width="150px" height="150px">
        <?php }?>
                   
                                                                
                </div>



                   <div class="col-md-5 col-sm-5 space-mobile">
                    <!-- BEGIN CONTACTS -->
                                   
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
                    </dir>
                   
                    <!-- END CONTACTS -->                                    

                                                       
                </div>


                <div class="col-md-4 col-sm-4 space-mobile">
                    <!-- BEGIN ABOUT -->                    
                    <h2>Suivez nous </h2>
                    <p class="margin-bottom-30">
                      <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-page" 
  data-href="<?php echo $query_config[0]->fb ?>"
  data-width="380" 
  data-hide-cover="false"
  data-show-facepile="false"></div>
                    </p>
                    <div class="clearfix"></div>                    
                    <!-- END ABOUT -->          
                            
                </div>
             

            </div>
        </div>
    </div>
    <!-- END FOOTER -->



    <!-- BEGIN COPYRIGHT -->

    <div class="copyright">

        <div class="container">

            <div class="row">

                <div class="col-md-8 col-sm-8">

                    <p>

                         <span class="margin-right-10"><?php echo date("Y");  ?> © <?php echo $query_config[0]->titre ?></span> 

                    </p>

                </div>

                <div class="col-md-4 col-sm-4">

                    <ul class="social-footer">
                          <?php if($query_config[0]->fb!="") {?> 
                           <li><a href="<?php echo $query_config[0]->fb ?>"  target="_blank"><i class="fa fa-facebook"></i></a></li>
                          <?php }?>
                          <?php if($query_config[0]->youtube!="") {?> 
                            <li><a href="<?php echo $query_config[0]->youtube ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                          <?php }?>
                          <?php if($query_config[0]->gplus!="") {?> 
                            <li><a href="<?php echo $query_config[0]->gplus ?>"  target="_blank"><i class="fa fa-google-plus"></i></a></li>
                          <?php }?>
                            <?php if($query_config[0]->twiter!="") {?> 
                            <li><a href="<?php echo $query_config[0]->twiter ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                          <?php }?>
                    </ul>                

                </div>

            </div>

        </div>

    </div>

    <!-- END COPYRIGHT -->



    <!-- Load javascripts at bottom, this will reduce page load time -->

    <!-- BEGIN CORE PLUGINS(REQUIRED FOR ALL PAGES) -->

    <!--[if lt IE 9]>

    <script src="assets/plugins/respond.min.js"></script>  

    <![endif]-->  



    <script src="<?php echo base_url('assets/plugins/jquery-1.10.2.min.js'); ?>" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/plugins/jquery-migrate-1.2.1.min.js'); ?>" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>      

    <script type="text/javascript" src="<?php echo base_url('assets/plugins/back-to-top.js'); ?>"></script>    

    <!-- END CORE PLUGINS -->

    

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->

    <script type="text/javascript" src="<?php echo base_url('assets/plugins/fancybox/source/jquery.fancybox.pack.js'); ?>"></script>  

    <script type="text/javascript" src="<?php echo base_url('assets/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js'); ?>"></script> 

    <script type="text/javascript" src="<?php echo base_url('assets/plugins/bxslider/jquery.bxslider.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/scripts/app.js'); ?>"></script>

    <script src="<?php echo base_url('assets/scripts/index.js'); ?>"></script>

    

    <script src="http://maps.google.com/maps/api/js?key=AIzaSyA_9SbQnLg3KpwvHnjJoR5-ruyE2enqqZE&language=fr" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/plugins/gmaps/gmaps.js'); ?>" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/scripts/contact-us.js'); ?>"></script> 

    <script type="text/javascript">

        jQuery(document).ready(function() {    

           App.init();

           App.initBxSlider();

           Index.initRevolutionSlider();

           ContactUs.init();

           //$("#pubModal").modal("show");

        });

    </script>



    <!-- END PAGE LEVEL JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>