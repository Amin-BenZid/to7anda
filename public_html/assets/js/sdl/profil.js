
function update_profil_user(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var login = res[1];
    var sexe = res[2];
    var nom = res[3];
    var prenom = res[4];
    var tel = res[5];
    var email = res[6];
    var desc = res[7];
    var etat = res[8];
    var photo = res[9];

    $("#aff_photo_modif").html("");
    $("#login_modif_user").val(login);
    $("#id_modif_user").val(id);
    $("#nom_modif_user").val(nom);
    $("#prenom_modif_user").val(prenom);
    $("input[name=sexe_modif_user][value='"+sexe+"']").prop("checked",true);
    $("#tel_modif_user").val(tel);
    $("#email_modif_user").val(email);
    $("#desc_modif_user").val(desc);
    if(photo!=''){
        var src_img = '<img src="'+localStorage.getItem("base_url")+'/uploads/'+photo+'" alt="">';
        $("#aff_photo_modif").html("<a href='#'>"+src_img+"</a>");
    }
    $("#div_message_erreur_modif_user").hide();
    $("#modificationuserModal").modal("show");
}
function update_password_user(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var login = res[1];
    var sexe = res[2];
    var nom = res[3];
    var prenom = res[4];
    var tel = res[5];
    var email = res[6];
    var desc = res[7];
    var etat = res[8];
    var photo = res[9];
    
    $("#login_modif_user_pass").val(login);
    $("#id_modif_user_pass").val(id);
    $("#ancien_mdp_user").val("");
    $("#nouveau_mdp_user").val("");
    $("#r_nouveau_mdp_user").val("");

    $("#div_message_erreur_modif_pass").hide();
    $("#modificationpassModal").modal("show");
}


$( document ).ready(function() {
//****************** debut *******************************

$("#b_modif_pass_action").click(function() {
//****************************************************************
//****************************************************************
$("#div_message_erreur_modif_pass").hide();

var amp = $("#ancien_mdp_user").val();
var nmp = $("#nouveau_mdp_user").val();
var rnmp = $("#r_nouveau_mdp_user").val();
var id =$("#id_modif_user_pass").val();
if(amp =="" || nmp =="" || rnmp==""){
    $("#div_message_erreur_modif_pass").show();
    $("#div_message_erreur_modif_pass").html("<h4><i class='fa fa-key'></i> &nbsp;Remplir tous les champs SVP </h4>");
}
else{
    //********************************************************************
    $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/password_user_existe/' ,
        timeout: 4000,
        type: "POST",
        dataType:'json', 
        data: ({id: id , pw: amp}),
        success: function (data) {
            var arr = data;
            var existe = arr[0].existe;
            if(existe==0){

                $("#div_message_erreur_modif_pass").show();
                $("#div_message_erreur_modif_pass").html("<h4><i class='fa fa-key'></i> &nbsp;L'ancien mot de passe n'est pas correct</h4>");

            }else if(nmp !== rnmp){
                 $("#div_message_erreur_modif_pass").show();
                 $("#div_message_erreur_modif_pass").html("<h4><i class='fa fa-key'></i> &nbsp;Le nouveau mot de passe n'est pas identique</h4>");
                }
            else if(nmp.length < 8 ){
                 $("#div_message_erreur_modif_pass").show();
                 $("#div_message_erreur_modif_pass").html("<h4><i class='fa fa-key'></i> &nbsp;Le mot de passe doit comporter 8 caractères au minimum</h4>");
                }
            else{
                //******************************** modifier ****************************************
                    var urla = localStorage.getItem("base_url")+'sdl/profil/';

                    var form = $(document.createElement('form'));
                    $(form).attr("action", urla);
                    $(form).attr("method", "POST");
                    $(form).css("display", "none");

                    var input_id = $("<input>").attr("type", "text").attr("name", "id_modif_pass_user").val(id);
                    $(form).append($(input_id));
                    var input_pass = $("<input>").attr("type", "text").attr("name", "nmp_modif_pass_user").val(nmp);
                    $(form).append($(input_pass));

                    form.appendTo( document.body );
                    $(form).submit();
                //**********************************************************************************
            }
   },
        error: function() {
            // J'affiche un message d'erreur
        }

    });

    //********************************************************************
}
//****************************************************************
//****************************************************************
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