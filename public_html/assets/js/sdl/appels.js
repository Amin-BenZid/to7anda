
function reponse_appel(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_a = res[1];
    var id_p = res[2];

    $("#id_appel").val(id);
    $("#remar_sat").val("");

    $("#d_id_app").val(id_a);
    $("#d_id_p").val(id_p);
    $("#d_id_appel").val(id);
    $("#d_remar_sat").val("");

    $("#div_message_erreur_demande").hide();
    $("#reponseappelModal").modal("show");
}



$( document ).ready(function() {
//****************** debut *******************************
//b_ds_action
$("#b_ds_action").click(function() {
    $("#demandeModal").modal("show");
    $("#reponseappelModal").modal("hide");
});

//***************************************************************************
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

    var id_appel = $("#d_id_appel").val();
    var remar_sat = $("#remar_sat").val();

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

            var urla = localStorage.getItem("base_url")+'sdl/appels/';

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

            var input_id_appel = $("<input>").attr("type", "text").attr("name", "add_id_appel").val(id_appel);
            $(form).append($(input_id_appel));

            var input_remar_sat = $("<input>").attr("type", "text").attr("name", "add_remar_sat").val(remar_sat);
            $(form).append($(input_remar_sat));

            form.appendTo( document.body );
            $(form).submit();
            //************************************************************
            }

    
});
//********************************************************
//***************************************************************************
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

//**************************************************************
//**************************************************************

//******************* fin ********************************
    });