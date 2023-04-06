            <!--body wrapper start-->
            <div class="wrapper">
                <!--state overview start-->
                <div class="row state-overview">

                 
                <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Taux de satisfaction 
                        </header>
                        <div class="panel-body">
                            <form class="form-inline" role="form">
                                <div class="form-group">
                                    <label>Service</label>
                                    <div class="right">
                                        <select class="form-control" id="s_serv" name="s_serv">
                                            <option value="t">Tous les services</option>
                                            <?php
                                foreach ($services as $service){
                                
  
echo "<option value='".$service->id."'>".$service->nom."</option>";
   
                                }
                                ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Employé</label>
                                    <div class="right">
                                        <select class="form-control" id="s_emp" name="s_emp">
                                            <option value="t">Tous les employés</option>
                                                 <?php
                                foreach ($employees as $employee){
                                
  
echo "<option value='".$employees->id."'>".$employee->nom." ".$employee->prenom."</option>";
   
                                }
                                ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Date début</label>
                                    <div class="right">
                                            <input type="date" class="form-control" placeholder="" id="date_d" name="date_d" value="" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Date fin</label>
                                    <div class="right">
                                        <input type="date" class="form-control" placeholder="" id="date_f" name="date_f" value="" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label></label>
                                    <div class="right">
                                        <button type="button" class="btn btn-success" id="b_chercher">Chercher  <i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div>
                                </div>

                                

                                
                            </form>
                            <div align="center" style="color: red;" id="div_err"></div>

                        </div>
                    </section>

                </div>
            </div>



                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading ">
                               <div id="div_ree_title" align="center">
                                    
                                </div>
                            </header>
                            <body>
                                <div id="" align="center">
                                    <h3>TAUX DE SATISFACTION</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4" id="row_conv"></div>
                                    <div class="col-md-4"></div>
                                </div>
                                <div class="row" >
    <h3></h3>
    
    </div>
                            </body>
                            
                            
                        </section>
                    </div>
                </div>
                
                </div>
                <!--state overview end-->
                
               
            

               

            </div>
            <!--body wrapper end-->