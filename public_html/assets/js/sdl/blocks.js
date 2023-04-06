
function modification_bloc(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var nom = res[1];
    var etage = res[2];
    var desc = res[3];

    $("#id_modif_bloc").val(id);
    $("#nom_modif_bloc").val(nom);
    $("#etage_modif_bloc").val(etage);
    $("#last_nom_bloc").val(nom);
    $("#desc_modif_bloc").val(desc);
    
    $("#div_message_erreur_modif_bloc").hide();
    $("#modificationblocModal").modal("show");
}
function suppression_bloc(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var nom = res[1];
    var etage = res[2];
    var desc = res[3];

    $("#div_suppression_bloc").html("<h1>"+nom+"</h1><h4>"+desc+"</h4>");
    $("#id_suppression_bloc").val(id);
    $("#suppressionblocModal").modal("show");
}


$( document ).ready(function() {
//****************** debut *******************************

$("#b_ajouter_bloc").click(function() {

    $('#nom_ajout_bloc').val("");
    $('#etage_ajout_bloc').val("");
    $('#desc_ajout_bloc').val("");
    $("#div_message_erreur_add_bloc").hide();
    $("#ajouterblocModal").modal("show");
});

$("#b_modif_bloc_action").click(function() {
//****************************************************************

    var nom = $('#nom_modif_bloc').val();
    var l_nom = $('#last_nom_bloc').val();
    var etage = $('#etage_modif_bloc').val();
    var desc = $('#desc_modif_bloc').val();
    var id = $('#id_modif_bloc').val();
    var ok = nom==l_nom;
    if(nom==""){
        $("#div_message_erreur_modif_bloc").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le nom de bloc SVP </h4>');
        $("#div_message_erreur_modif_bloc").show();
        }
    else if(etage==""){
        $("#div_message_erreur_modif_bloc").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le nombre des étages de bloc SVP </h4>');
        $("#div_message_erreur_modif_bloc").show();
        }
    else{
    //****************************************************************
    $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/nom_bloc_existe/' ,
        timeout: 4000,
        type: "POST",
        dataType:'json', 
        data: ({nom: nom}),
        success: function (data) {
            // Je charge les données dans box
            var arr = data;
            var existe = arr[0].existe;
            if(existe=="1" && ok==false){
                $("#div_message_erreur_modif_bloc").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce nom de bloc déjà existe </h4>');
                $("#div_message_erreur_modif_bloc").show();
            }
            else{
            //************************************************************

            var urla = localStorage.getItem("base_url")+'sdl/blocks/';

            var form = $(document.createElement('form'));
            $(form).attr("action", urla);
            $(form).attr("method", "POST");
            $(form).css("display", "none");

            var input_nom = $("<input>").attr("type", "text").attr("name", "nom_modif_bloc").val(nom);
            $(form).append($(input_nom));
            var input_etage = $("<input>").attr("type", "text").attr("name", "etage_modif_bloc").val(etage);
            $(form).append($(input_etage));
            var input_desc = $("<input>").attr("type", "text").attr("name", "desc_modif_bloc").val(desc);
            $(form).append($(input_desc));
            var input_id = $("<input>").attr("type", "text").attr("name", "id_modif_bloc").val(id);
            $(form).append($(input_id));

            form.appendTo( document.body );
            $(form).submit();
            //************************************************************
            }
        },
        error: function(){}

    });

    //****************************************************************


    }

//****************************************************************
});

$("#b_ajouter_bloc_action").click(function() {
//********************************************************
    var nom = $('#nom_ajout_bloc').val();
    var etage = $('#etage_ajout_bloc').val();
    var desc = $('#desc_ajout_bloc').val();

    if(nom==""){
        $("#div_message_erreur_add_bloc").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le nom de bloc SVP </h4>');
        $("#div_message_erreur_add_bloc").show();
       }
    else if(etage==""){
        $("#div_message_erreur_add_bloc").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le nombre des étages de bloc SVP </h4>');
        $("#div_message_erreur_add_bloc").show();
        }
    else{
    //****************************************************************
    $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/nom_bloc_existe/' ,
        timeout: 4000,
        type: "POST",
        dataType:'json', 
        data: ({nom: nom}),
        success: function (data) {
            // Je charge les données dans box
            var arr = data;
            var existe = arr[0].existe;
            if(existe=="1"){
                $("#div_message_erreur_add_bloc").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce nom de bloc déjà existe </h4>');
                $("#div_message_erreur_add_bloc").show();
            }
            else{
            //************************************************************
            var urla = localStorage.getItem("base_url")+'sdl/blocks/';

            var form = $(document.createElement('form'));
            $(form).attr("action", urla);
            $(form).attr("method", "POST");
            $(form).css("display", "none");

            var input_nom = $("<input>").attr("type", "text").attr("name", "nom_ajout_bloc").val(nom);
            $(form).append($(input_nom));
            var input_etage = $("<input>").attr("type", "text").attr("name", "etage_ajout_bloc").val(etage);
            $(form).append($(input_etage));
            var input_desc = $("<input>").attr("type", "text").attr("name", "desc_ajout_bloc").val(desc);
            $(form).append($(input_desc));

            form.appendTo( document.body );
            $(form).submit();
            //************************************************************
            }
        },
        error: function(){}

    });

    //****************************************************************


    }
//********************************************************
});
//**************************************************************
//**************************************************************
function notifications(){
    $.ajax({
    url: localStorage.getItem("base_url")+'/Sdl_WS/appels_notifications/' ,
    timeout: 4000,
    type: "POST",
    dataType:'json', 
    data: ({id: 0}),
        success: function (data) {

            var arr = data;
            var ch='';
            var n = arr.length;
            var ch ="";
            if(n>1){ch = "Vous avez "+n+" nouvels<br> appels";}
            else{ch = "Vous avez "+n+" nouvel<br> appel";}
            $("#nb_not_s").html(n);
            $("#div_nb_mot_s").html(ch);
            var nb_n = $("#nb_n").val();
            if(nb_n==""){$("#nb_n").val(n);}
            else if (nb_n!=n) {
                var url = localStorage.getItem("base_url")+"sdl/appels/";
                if(window.location.href == url){$("#nb_n").val(""); location.reload();}
            }

            setTimeout(notifications, 5000);
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
     
}
notifications();
//******************* fin ********************************
    });