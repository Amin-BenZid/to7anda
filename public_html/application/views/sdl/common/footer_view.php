<!--footer section start-->
            <footer>
                <?php echo date("Y"); ?> &copy; SDL by SWATEK
            </footer>
            <!--footer section end-->


            <!-- Right Slidebar start -->
            
            <!-- Right Slidebar end -->

        </div>
        <!-- body content end-->
    </section>



<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.min.js'); ?>"></script>

<!--jquery-ui-->
<script src="<?php echo base_url('assets/js/jquery-ui/jquery-ui-1.10.1.custom.min.js'); ?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/js/jquery-migrate.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/modernizr.min.js'); ?>"></script>

<!--Nice Scroll-->
<script src="<?php echo base_url('assets/js/jquery.nicescroll.js'); ?>" type="text/javascript"></script>

<!--right slidebar-->
<script src="<?php echo base_url('assets/js/slidebars.min.js'); ?>"></script>

<!--switchery-->
<script src="<?php echo base_url('assets/js/switchery/switchery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/switchery/switchery-init.js'); ?>"></script>

<!--flot chart -->
<script src="<?php echo base_url('assets/js/flot-chart/jquery.flot.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/flot-chart/jquery.flot.resize.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/flot-chart/jquery.flot.tooltip.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/flot-chart/jquery.flot.pie.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/flot-chart/jquery.flot.selection.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/flot-chart/jquery.flot.stack.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/flot-chart/jquery.flot.crosshair.js'); ?>"></script>


<!--earning chart init-->
<script src="<?php echo base_url('assets/js/earning-chart-init.js'); ?>"></script>


<!--Sparkline Chart-->
<script src="<?php echo base_url('assets/js/sparkline/jquery.sparkline.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sparkline/sparkline-init.js'); ?>"></script>

<!--easy pie chart-->
<script src="<?php echo base_url('assets/js/jquery-easy-pie-chart/jquery.easy-pie-chart.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/easy-pie-chart.js'); ?>"></script>


<!--vectormap-->
<script src="<?php echo base_url('assets/js/vector-map/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/vector-map/jquery-jvectormap-world-mill-en.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/dashboard-vmap-init.js'); ?>"></script>

<!--Icheck-->
<script src="<?php echo base_url('assets/js/icheck/skins/icheck.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/todo-init.js'); ?>"></script>

<!--jquery countTo-->
<script src="<?php echo base_url('assets/js/jquery-countTo/jquery.countTo.js'); ?>"  type="text/javascript"></script>

<!--owl carousel-->
<script src="<?php echo base_url('assets/js/owl.carousel.js'); ?>"></script>

<!--Data Table-->
<script src="<?php echo base_url('assets/js/data-table/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/data-table/js/dataTables.tableTools.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/data-table/js/bootstrap-dataTable.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/data-table/js/dataTables.colVis.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/data-table/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/data-table/js/dataTables.scroller.min.js'); ?>"></script>
<!--data table init-->
<script src="<?php echo base_url('assets/js/data-table-init.js'); ?>"></script>
<!--common scripts for all pages-->
<!--pulsate-->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.pulsate.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/pulstate.js'); ?>" type="text/javascript"></script>
<!--gritter-->
<script type="text/javascript" src="<?php echo base_url('assets/js/gritter/js/jquery.gritter.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/gritter.js'); ?>" type="text/javascript"></script>
<!--bootstrap-fileinput-master-->
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-fileinput-master/js/fileinput.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/file-input-init.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>

<script type="text/javascript">

    $(document).ready(function() {

        //countTo
        

        $('.timer').countTo();

        //owl carousel

        $("#news-feed").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true,
            autoPlay:true
        });

        
    });

    $(window).on("resize",function(){
        var owl = $("#news-feed").data("owlCarousel");
        owl.reinit();
    });

</script>




</body>
</html>
