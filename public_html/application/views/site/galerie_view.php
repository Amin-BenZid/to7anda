<link href="<?php echo base_url('assets/css/pages/gallery.css'); ?>" rel="stylesheet" type="text/css"/>
<!-- BEGIN CONTAINER -->   
        <div class="container min-hight gallery-page margin-bottom-40">
          <div class="row">
          <div class="col-md-4 col-sm-4 gallery-item" align="center">
            <div class="row">
                        <?php
                        $nb=count($query_galerie);
                        

                        $tab1=array();
                        $tab2=array();
                        $tab3=array();

         for ($i=0; $i < $nb; $i+=3) {
            if($i < $nb){array_push($tab1,$query_galerie[$i]);}
            if($i+1 < $nb){array_push($tab2,$query_galerie[$i+1]);}
            if($i+2 < $nb){array_push($tab3,$query_galerie[$i+2]);}
           }
           //print_r($tab1);
           //print_r($tab2);
           //print_r($tab3);
           $nb1=count($tab1);
           $nb2=count($tab2);
           $nb3=count($tab3);



          for ($i=0; $i < $nb1; $i++) { 
            ?>

            <div class=""  align="center">
              <a data-rel="fancybox-button" title="<?php echo $tab1[$i]->titre; ?>" href="<?php echo base_url('uploads/image/galerie/'.$tab1[$i]->photo.''); ?>" class="fancybox-button">
                <img alt="" src="<?php echo base_url('uploads/image/galerie/'.$tab1[$i]->photo.''); ?>" class="img-responsive">
                <div class="zoomix"><i class="fa fa-search"></i></div>
              </a> 
            </div>

            <?php
          }



           ?>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 gallery-item" align="center">
             <div class="row">
                        <?php


          for ($j=0; $j < $nb2; $j++) { 
            ?>

            <div class=""  align="center">
              <a data-rel="fancybox-button" title="<?php echo $tab2[$j]->titre; ?>" href="<?php echo base_url('uploads/image/galerie/'.$tab2[$j]->photo.''); ?>" class="fancybox-button">
                <img alt="" src="<?php echo base_url('uploads/image/galerie/'.$tab2[$j]->photo.''); ?>" class="img-responsive">
                <div class="zoomix"><i class="fa fa-search"></i></div>
              </a> 
            </div>

            <?php
          }



           ?>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 gallery-item" align="center">
             <div class="row">
                        <?php

          for ($i=0; $i < $nb3; $i++) { 
            ?>

            <div class=""  align="center">
              <a data-rel="fancybox-button" title="<?php echo $tab3[$i]->titre; ?>" href="<?php echo base_url('uploads/image/galerie/'.$tab3[$i]->photo.''); ?>" class="fancybox-button">
                <img alt="" src="<?php echo base_url('uploads/image/galerie/'.$tab3[$i]->photo.''); ?>" class="img-responsive">
                <div class="zoomix"><i class="fa fa-search"></i></div>
              </a> 
            </div>

            <?php
          }



           ?>
            </div>
          </div>
          

            
            
          </div>

          
        </div>
        <!-- END CONTAINER -->
