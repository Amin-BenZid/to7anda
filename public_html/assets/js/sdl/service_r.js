function demande_service(id) {

    var res = id.split("/////");
    var id = res[0];
    var id_bloc = res[1];
    var nom = res[2];
    var code = res[3];
    var desc = res[4];
    var id_proprietaire = res[5];
    var sdl_id = res[6];
    var floor = res[7];

    $("#d_id_app").val(id);
    $("#d_id_p").val(id_proprietaire);
    $("#d_date_d").val("");
    $("#d_date_f").val("");
    $("#d_temps_d").val("");
    $("#d_temps_f").val("");
    $("#d_desc").val("");
    $("#title_div_d").html("<h3>Appartement "+code+"</h3>");
    $("#div_message_erreur_demande").hide();
    $("#demandeModal").modal("show");
}

function modification_demande(id) {
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
    var service_d = res[12];
    var desc_serv = res[13];
    var id_d = res[14];
    var etat_d = res[15];
    var nom_s = res[16];
    

    $("#date_d").val(d_deut);
    $("#date_f").val(d_fin);
    $("#temps_d").val(t_debut);
    $("#temps_f").val(t_fin);

    $("#id_app").val(id);
    $("#id_p").val(id_proprietaire);
    $("#id_d").val(id_d);
    $("#desc").val(desc_serv);
    $("#serv").val(service_d);


    $("#title_div").html("<h3>Modification demande service pour l'appartement "+code+"</h3>");
    $("#div_message_erreur_modif").hide();
    $("#modificationModal").modal("show");
}
function suppression_demande(id) {
    // body...
    var res = id.split("/////");
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
    var service_d = res[12];
    var desc_serv = res[13];
    var id_d = res[14];
    var etat_d = res[15];
    var nom_s = res[16];


    $("#div_suppression_ac").html("<h3> Appartement "+code+" : "+nom_s+"</h3>");
    $("#id_suppression_d").val(id_d);
    $("#suppressionModal").modal("show");
}


$( document ).ready(function() {
//****************** debut *******************************
//********************************************************
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
    //if (true) {}

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
            //************************************************************

            var urla = localStorage.getItem("base_url")+'sdl/service_r/';

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
//********************************************************
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

            var urla = localStorage.getItem("base_url")+'sdl/service_r/';

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