

function annulation_service(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_appa = res[1];
    var id_serv = res[2];
    var id_tag = res[3];
    var id_emp = res[4];

    $("#id_dem_ser_ann").val(id);
    $("#div_dem_ser_ann").hide();
    $("#annulationserviceModal").modal("show");
}

function evaluation_service(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_appa = res[1];
    var id_serv = res[2];
    var id_tag = res[3];
    var id_emp = res[4];
   $("#id_eval_ser").val(id);
    $("#evaluationserviceModal").modal("show");
}

function modification_demande(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_serv = res[1];
    var id_appa = res[2];
    var date_debut = res[3];
    var heur_debut = res[4];
    var date_fin = res[5];
    var heur_fin = res[6];
    var description = res[7];

    

    $("#date_d").val(date_debut);
    $("#date_f").val(date_fin);
    $("#temps_d").val(heur_debut);
    $("#temps_f").val(heur_fin);

    $("#id_app").val(id_appa);
    $("#id_d").val(id);
    $("#desc").val(description);
    $("#serv").val(id_serv);


    $("#div_message_erreur_modif").hide();
    $("#modificationModal").modal("show");
}
function suppression_demande(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_serv = res[1];
    var id_appa = res[2];
    var date_debut = res[3];
    var heur_debut = res[4];
    var date_fin = res[5];
    var heur_fin = res[6];
    var description = res[7];


    $("#div_suppression_ac").html("<h3></h3>");
    $("#id_suppression_d").val(id);
    $("#suppressionModal").modal("show");
}


$( document ).ready(function() {
//****************** debut *******************************


init_dynamic_table();
function init_dynamic_table() {
                    //initiate dataTables plugin
                    
                $('#dynamic-table').DataTable( {

                    bAutoWidth: false,
                    
                    "aaSorting": [],
                    "language": {
                  "decimal":        "",
    "emptyTable":     "aucune donnée disponible",
    "info":           "Affichage _START_ à _END_ des entrées de _TOTAL_",
    "infoEmpty":      "Affichage 0 à 0 de 0 entrées",
    "infoFiltered":   "(filtré _MAX_ entrées totales)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher  _MENU_  Entrées",
    "loadingRecords": "Chargement...",
    "processing":     "En traitement...",
    "search":         "Recherche : ",
    "zeroRecords":    "Aucun enregistrements correspondants trouvés",
    "paginate": {
        "first":      "Premier",
        "last":       "Dernier",
        "next":       "Suivant",
        "previous":   "Précédent"
    },
    "aria": {
        "sortAscending":  ": activer pour trier la colonne ascendante",
        "sortDescending": ": activer pour trier la colonne descendante"
    }
    },
            
            
                    select: {
                        style: 'multi'
                    }
                } );
                    
}



    

//*********************************************************************
$("#b_nouvelle_demande").click(function() {
    $("#div_message_erreur_demande").hide();
    $("#demandeModal").modal("show");
});
//**********************************************************************
$("#b_modif_action").click(function() {

    var date_d = $('#date_d').val();
    var date_f = $('#date_f').val();
    var temps_d = $('#temps_d').val();
    var temps_f = $('#temps_f').val();
    var id_app = $('#id_app').val();
    var id_p = $('#id_p').val();
    var id_d = $("#id_d").val();
    var desc = $("#desc").val();
    var serv = $("#serv").val();

        function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
    
    var dd = new Date(date_d); 
    var df = new Date(date_f); 
    var dn = new Date();
    var dnf = formatDate(dn);
    var dnf = new Date(dnf);
    

   
   if(date_d =="" || date_f ==""  || temps_d ==""  || temps_f =="" || desc =="" ){
    $('#div_message_erreur_modif').html("<b>Remplir tous les champs SVP</b>");
    $("#div_message_erreur_modif").show();
   } 
    else if(dnf>dd){
        $('#div_message_erreur_modif').html("<b>Date début doit être supérieure ou égale à date d'aujourd'hui</b>");
        $("#div_message_erreur_modif").show();
    }
    else if(dd>df){
        $('#div_message_erreur_modif').html("<b>Date début doit être inférieur ou égale à date fin</b>");
        $("#div_message_erreur_modif").show();
    } 
        else if(temps_d >= temps_f){
            $('#div_message_erreur_modif').html("<b>Temps début doit être inférieur à temps fin</b>");
            $("#div_message_erreur_modif").show();
        }
            else{
                $('#div_message_erreur_modif').html("");
                $("#div_message_erreur_modif").hide();
            //************************************************************

            var urla = localStorage.getItem("base_url")+'owner/services/';

            var form = $(document.createElement('form'));
            $(form).attr("action", urla);
            $(form).attr("method", "POST");
            $(form).css("display", "none");

            var input_date_d = $("<input>").attr("type", "date").attr("name", "date_d").val(date_d);
            $(form).append($(input_date_d));
            var input_date_f = $("<input>").attr("type", "date").attr("name", "date_f").val(date_f);
            $(form).append($(input_date_f));
            var input_temps_d = $("<input>").attr("type", "time").attr("name", "temps_d").val(temps_d);
            $(form).append($(input_temps_d));
            var input_temps_f = $("<input>").attr("type", "time").attr("name", "temps_f").val(temps_f);
            $(form).append($(input_temps_f));
            var input_id_app = $("<input>").attr("type", "text").attr("name", "id_app").val(id_app);
            $(form).append($(input_id_app));
            var input_id_p = $("<input>").attr("type", "text").attr("name", "id_p").val(id_p);
            $(form).append($(input_id_p));
            var input_id_d = $("<input>").attr("type", "text").attr("name", "id_d").val(id_d);
            $(form).append($(input_id_d));
            var input_desc = $("<input>").attr("type", "text").attr("name", "desc").val(desc);
            $(form).append($(input_desc));
            var input_serv = $("<input>").attr("type", "text").attr("name", "serv").val(serv);
            $(form).append($(input_serv));

            form.appendTo( document.body );
            $(form).submit();
            //************************************************************
            }



});
//**********************************************************************
$("#b_demande_action").click(function() {
    
    var id_app = $("#d_id_app").val();
    var id_p = $("#d_id_p").val();
    var date_d = $("#d_date_d").val();
    var date_f = $("#d_date_f").val();
    var temps_d = $("#d_temps_d").val();
    var temps_f = $("#d_temps_f").val();
    var desc = $("#d_desc").val();
    var serv = $("#d_serv").val();

    function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
    
    var dd = new Date(date_d); 
    var df = new Date(date_f); 
    var dn = new Date();
    var dnf = formatDate(dn);
    var dnf = new Date(dnf);
 

    if(date_d =="" || date_f ==""  || temps_d ==""  || temps_f =="" || desc =="" ){
    $('#div_message_erreur_demande').html("<b>Remplir tous les champs SVP</b>");
    $("#div_message_erreur_demande").show();
   } 
    else if(dnf>dd){
        $('#div_message_erreur_demande').html("<b>Date début doit être supérieure ou égale à date d'aujourd'hui</b>");
        $("#div_message_erreur_demande").show();
    }
    else if(dd>df){
        $('#div_message_erreur_demande').html("<b>Date début doit être inférieur ou égale à date fin</b>");
        $("#div_message_erreur_demande").show();
    } 
    else if(temps_d >= temps_f){
            $('#div_message_erreur_demande').html("<b>Temps début doit être inférieur à temps fin</b>");
            $("#div_message_erreur_demande").show();
         
    } 
        
            else{
                $('#div_message_erreur_demande').html("");
                $("#div_message_erreur_demande").hide();
               	$("#demandeModal").modal("hide");
            //************************************************************

            var urla = localStorage.getItem("base_url")+'owner/services/';

            var form = $(document.createElement('form'));
            $(form).attr("action", urla);
            $(form).attr("method", "POST");
            $(form).css("display", "none");

            var input_date_d = $("<input>").attr("type", "date").attr("name", "add_date_d").val(date_d);
            $(form).append($(input_date_d));
            var input_date_f = $("<input>").attr("type", "date").attr("name", "add_date_f").val(date_f);
            $(form).append($(input_date_f));
            var input_temps_d = $("<input>").attr("type", "time").attr("name", "add_temps_d").val(temps_d);
            $(form).append($(input_temps_d));
            var input_temps_f = $("<input>").attr("type", "time").attr("name", "add_temps_f").val(temps_f);
            $(form).append($(input_temps_f));
            var input_id_app = $("<input>").attr("type", "text").attr("name", "add_id_app").val(id_app);
            $(form).append($(input_id_app));
            var input_id_p = $("<input>").attr("type", "text").attr("name", "add_id_p").val(id_p);
            $(form).append($(input_id_p));
            var input_desc = $("<input>").attr("type", "text").attr("name", "add_desc").val(desc);
            $(form).append($(input_desc));
            var input_serv = $("<input>").attr("type", "text").attr("name", "add_serv").val(serv);
            $(form).append($(input_serv));

            form.appendTo( document.body );
            $(form).submit();
            //************************************************************
            }

    
});


$("#b_aff_service").click(function() {
    $("#viewserviceModal").modal("show");
   
});



//*********************************************************************

 $('#s_id_dem_ser_emp').on('change', function() {
            var id_emp = $('#s_id_dem_ser_emp').val();
            
            //alert(id_emp);

     /*$.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/get_employe_by_id/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id_emp}),
        success: function (data) {

          var arr = data;
          for (var i = 0 ; i < arr.length; i++) {
            id = arr[i].id;
            code = arr[i].code;
            $('#appar_modif_tag').append('<option value="'+id+'">'+code+'</option>');
          }      
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });*/
  });

//**************************************************************
//**************************************************************
//**************************************************************

//******************* fin ********************************
    });



