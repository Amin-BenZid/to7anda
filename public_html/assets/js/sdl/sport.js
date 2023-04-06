
function modification_apar(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_bloc = res[1];
    var nom = res[2];
    var code = res[3];
    var desc = res[4];
    var id_proprietaire = res[5];
    var sdl_id = res[6];
    var floor = res[7];
    var d_deut = res[8];
    var d_fin = res[9];
    var t_debut = res[10];
    var t_fin = res[11];
    var id_s = res[12];
    var sup = res[13];
    if(sup==0)
    {
    $("#date_d").val(d_deut);
    $("#date_f").val(d_fin);
    $("#temps_d").val(t_debut);
    $("#temps_f").val(t_fin);
    }
    $("#id_app").val(id);
    $("#id_p").val(id_proprietaire);
    
    

    $("#title_div").html("<h3>Accès au salle de sport via les tags d'appartement "+code+"</h3>");
    $("#div_message_erreur_modif").hide();
    $("#modificationModal").modal("show");
}
function suppression_apar(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_bloc = res[1];
    var nom = res[2];
    var code = res[3];
    var desc = res[4];
    var id_proprietaire = res[5];
    var sdl_id = res[6];
    var floor = res[7];
    var d_deut = res[8];
    var d_fin = res[9];
    var t_debut = res[10];
    var t_fin = res[11];
    var id_s = res[12];
    var sup = res[13];


    $("#div_suppression_ac").html("<h1>"+code+"</h1><h4>"+desc+"</h4>");
    $("#id_suppression_ac").val(id_s);
    $("#suppressionModal").modal("show");
}


$( document ).ready(function() {
//****************** debut *******************************

$("#b_modif_action").click(function() {

    var date_d = $('#date_d').val();
    var date_f = $('#date_f').val();
    var temps_d = $('#temps_d').val();
    var temps_f = $('#temps_f').val();
    var id_app = $('#id_app').val();
    var id_p = $('#id_p').val();
    

   
   if(date_d =="" || date_f ==""  || temps_d ==""  || temps_f =="" ){
    $('#div_message_erreur_modif').html("<b>Remplir tous les champs SVP</b>");
    $("#div_message_erreur_modif").show();
   } 
    else if(date_d>date_f){
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

            var urla = localStorage.getItem("base_url")+'sdl/sport/';

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

            form.appendTo( document.body );
            $(form).submit();
            //************************************************************
            }



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