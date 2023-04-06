
function blocage_compte_admin(id) {

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

    var ch="";
    if(sexe==1){
        ch+='<i class="fa  fa-male topbar-info-icon top-2"></i>&nbsp;';
    }else{
        ch+='<i class="fa  fa-female topbar-info-icon top-2"></i>&nbsp;';
    }
    $("#div_blocage_admin").html("<h2>"+login+"<br>"+ch+"  "+nom+" "+prenom+"</h2>");
    $("#id_blocage_admin").val(id)
    $("#blocageadminModal").modal("show");
}
function deblocage_compte_admin(id) {
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

    var ch="";
    if(sexe==1){
        ch+='<i class="fa  fa-male topbar-info-icon top-2"></i>&nbsp;';
    }else{
        ch+='<i class="fa  fa-female topbar-info-icon top-2"></i>&nbsp;';
    }
    $("#div_deblocage_admin").html("<h2>"+login+"<br>"+ch+"  "+nom+" "+prenom+"</h2>");
    $("#id_deblocage_admin").val(id)
    $("#deblocageadminModal").modal("show");
}
function reinitialisation_compte_admin(id) {
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


    var ch="";
    if(sexe==1){
        ch+='<i class="fa  fa-male topbar-info-icon top-2"></i>&nbsp;';
    }else{
        ch+='<i class="fa  fa-female topbar-info-icon top-2"></i>&nbsp;';
    }
    $("#div_reinitialisation_admin").html("<h2>"+login+"<br>"+ch+"  "+nom+" "+prenom+"</h2>");
    $("#id_reinitialisation_admin").val(id);
    $("#reinitialisationadminModal").modal("show");
}

function impression_compte_admin(id) {
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
    var cin = res[9];
    var password = res[10];


    var ch="";
    ch+='<div align="center">';
    ch+='<hr/><hr/><div align="center"><h1> Gloulou K2</h1><h2>Administrateur</h2></div><hr/>';

    ch+='<table style="width:100%">';
    

    ch+='<tr align="center">';
    ch+='<h2>'+nom+' '+prenom+'</h2>';
    if(cin!=""){ch+='<h3>CIN : '+cin+'</h3>';}
    if(email!=""){ch+='<h3>Email : '+email+'</h3>';}
    if(tel!=""){ch+='<h3>Tel : '+tel+'</h3>';}
    
    ch+='</tr>';

    ch+='<tr align="center"><hr/>';
    ch+='<h2>------   Login : '+login+'   ------   Mot de passe : '+password+'   ------</h2>';
    ch+='<h2>'+localStorage.getItem("base_url")+'</h2>';
    ch+='<hr/><hr/></tr>';




    ch+='</table>';
    ch+='</div>'; 

    var newWin=window.open('','Print-Window');

     newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">'+ch+'</body></html>');

    newWin.document.close();

    setTimeout(function(){newWin.close();},10);
}

function envoi_sms_admin(id) {
        // body...
    
    /**/
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
    var cin = res[9];
    var password = res[10];

    var nom_pre = prenom+" "+nom;



    //sms_client_modal
    //$('#login_blocage_client').val(login);
    $('#id_client_sms').val(id);
    $('#log_client_sms').val(login);
    $('#num_client_sms').val(tel);
    $('#nom_client_sms').val(nom_pre);
    $('#type_client_sms').val(1);
    $('#pass_client_sms').val(password);
    $('#entete_client_sms').val("GloulouK2");
    
    //alert($("#entete_client_sms").val());

    var ch="";
    if(sexe==1){
        ch+='<i class="fa  fa-male topbar-info-icon top-2"></i>&nbsp;';
    }else{
        ch+='<i class="fa  fa-female topbar-info-icon top-2"></i>&nbsp;';
    }

    $('#entete_sms').html("<h3>"+ch+" "+nom_pre+"</h3>");
    $("#sms_admin_modal").modal("show");
}
function modification_compte_admin(id) {
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
    var cin = res[10];
    $("#aff_photo_modif").html("");
    $("#login_modif_admin").val(login);
    $("#id_modif_admin").val(id);
    $("#cin_modif_admin").val(cin);
    $("#l_cin_modif_admin").val(cin);
    $("#nom_modif_admin").val(nom);
    $("#prenom_modif_admin").val(prenom);
    //$("#sexe_modif_admin").val(sexe);
    $("input[name=sexe_modif_admin][value='"+sexe+"']").prop("checked",true);
    $("#tel_modif_admin").val(tel);
    $("#email_modif_admin").val(email);
    $("#desc_modif_admin").val(desc);
    if(photo!=''){
        var src_img = '<img src="'+localStorage.getItem("base_url")+'/uploads/'+photo+'" alt="">';
        $("#aff_photo_modif").html("<a href='#'>"+src_img+"</a>");
    }
    
    $("#div_message_erreur_modif_admin").hide();
    $("#modificationadminModal").modal("show");
}
function suppression_compte_admin(id) {
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

    var ch="";
    if(sexe==1){
        ch+='<i class="fa  fa-male topbar-info-icon top-2"></i>&nbsp;';
    }else{
        ch+='<i class="fa  fa-female topbar-info-icon top-2"></i>&nbsp;';
    }
    $("#div_suppression_admin").html("<h2>"+login+"<br>"+ch+"  "+nom+" "+prenom+"</h2>");
    $("#id_suppression_admin").val(id);
    $("#suppressionadminModal").modal("show");
}

function edit_roles_admin(id) {
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
    var roles = res[9];
    $('#div_roles_admin input[type=checkbox]').prop('checked', false);
    var tab_r = roles.split(",");
    for (var i = tab_r.length - 1; i >= 0; i--) {
        $("#ch_role_"+tab_r[i]+"").prop('checked', true);
    }
    
    $('#div_roles_admin input[type=checkbox]').attr('disabled','true');
    //div_roles_admin
    $('#id_roles_admin').val(id);
    $('#b_roles_up_admin').show();
    $('#b_roles_an_up_admin').hide();
    $('#div_conf_update_roles_admin').hide();
    $('#b_roles_save_update_admin_action').hide();
    $('#b_roles_annuler_update_admin_action').hide();
    $('#b_roles_update_admin_action').hide();
    $("#roleseadminModal").modal("show");
}

$( document ).ready(function() {
//****************** debut *******************************

$("#b_ajouter_admin").click(function() {

    $('#cin_ajout_admin').val("");
    $('#nom_ajout_admin').val("");
    $('#prenom_ajout_admin').val("");
    $('#tel_ajout_admin').val("");
    $('#email_ajout_admin').val("");
    $('#desc_ajout_admin').val("");
    $('#sexe_ajout_admin').val("");
    //$("[name=sexe_ajout_admin]").val(["1"]);

    $("#div_message_erreur_add_admin").hide();
    $("#ajouteradminModal").modal("show");
});
//**************************************************************
//**************************************************************

$("#b_modif_admin_action").click(function() {
    var cin = $("#cin_modif_admin").val();
    var l_cin = $("#l_cin_modif_admin").val();
    var nom = $('#nom_modif_admin').val();
    var prenom = $('#prenom_modif_admin').val();
    var ok = cin==l_cin;

      if (cin == "") {
    $("#div_message_erreur_modif_admin").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le CIN SVP </h4>');
    $("#div_message_erreur_modif_admin").show();
  }
  else if (nom == "") {
    $("#div_message_erreur_modif_admin").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le nom SVP </h4>');
    $("#div_message_erreur_modif_admin").show();
  }
  else if (prenom == "") {
    $("#div_message_erreur_modif_admin").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le prénom SVP </h4>');
    $("#div_message_erreur_modif_admin").show();
  }
  else{

      //******************************************************************
        $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/cin_admin_existe/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({cin: cin}),
        success: function (data) {

          var arr = data;
          var e  = arr[0].existe;
          if(e=="1" & !ok){
                $("#div_message_erreur_modif_admin").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce CIN déjà existe </h4>');
                $("#div_message_erreur_modif_admin").show();
          }else{
            
            $("#form_up").submit();
          }
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
  //******************************************************************
  }
    

});
//***********************************************************************************
$("#b_sms_admin_action").click(function() {  
    
    //hist_sms : id, message, date, destinataire, nbr_sms, type
    var id = $('#id_client_sms').val();
    var login = $('#log_client_sms').val();
    var pass = $('#pass_client_sms').val();
    var tel = $('#num_client_sms').val();
    var nom = $('#nom_client_sms').val();
    var type = $('#type_client_sms').val();
    var entete_sms = $("#entete_client_sms").val();
    var message = "Gloulou K2  Login : "+login+"  Password : "+pass+" "+ localStorage.getItem("base_url");
    var message_h = "Gloulou K2  Login : "+login+"  Password : ******** "+localStorage.getItem("base_url");
    var nbr_sms = 1;
    var tel_sms='216'+tel;
  entete_sms = 'GloulouK2';
  message =encodeURIComponent(message);
    //******************************************************************
        $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/sendsms/',
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({message: message, entete_sms:entete_sms, tel_sms: tel_sms}),
        success: function (data) { 
          consol.log(data);
   },
        error: function() {
        }
    });
  //******************************************************************
   
    //****************************************************************************************

//*****************************************************************************************
    $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/add_hist_sms/' ,
        timeout: 4000,
        type: "POST",
        async: false,
        dataType:'json',
        data: ({message:message_h,id:id,nbr_sms: nbr_sms,type: type}),
        
        success: function (data) {
          
   },
        error: function() {  
        
        }

    });
//****************************************************************************************
$("#sms_admin_modal").modal("hide");
//****************************************************************************************

});
//***********************************************************************************

$("#b_ajouter_admin_action").click(function() {
   

var cin = $('#cin_ajout_admin').val();
var nom = $('#nom_ajout_admin').val();
var prenom = $('#prenom_ajout_admin').val();
  if (cin == "") {
    $("#div_message_erreur_add_admin").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le CIN SVP </h4>');
    $("#div_message_erreur_add_admin").show();
  }
  else if (nom == "") {
    $("#div_message_erreur_add_admin").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le nom SVP </h4>');
    $("#div_message_erreur_add_admin").show();
  }
  else if (prenom == "") {
    $("#div_message_erreur_add_admin").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le prénom SVP </h4>');
    $("#div_message_erreur_add_admin").show();
  }
  else{

      //******************************************************************
        $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/cin_admin_existe/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({cin: cin}),
        success: function (data) {

          var arr = data;
          var e  = arr[0].existe;
          if(e=="1"){
                $("#div_message_erreur_add_admin").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce CIN déjà existe </h4>');
                $("#div_message_erreur_add_admin").show();
          }else{
            
            $("#form_add").submit();
          }
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
  //******************************************************************
  }
});
//**************************************************************



//**************************************************************
//b_roles_up_admin
//b_roles_an_up_admin
$('#b_roles_up_admin').click(function() {
    $('#b_roles_an_up_admin').show();
    $('#b_roles_up_admin').hide();
    $('#b_roles_update_admin_action').show();
    //$('input[type=checkbox]').attr('disabled','false');
    $("#div_roles_admin input[type=checkbox]").removeAttr('disabled');

});
$('#b_roles_an_up_admin').click(function() {
    $('#b_roles_an_up_admin').hide();
    $('#b_roles_up_admin').show();
    $('#b_roles_update_admin_action').hide();
     $('#div_roles_admin input[type=checkbox]').attr('disabled','true');
});
//b_roles_update_admin_action
$('#b_roles_update_admin_action').click(function() { 

    $('#div_conf_update_roles_admin').show();
    $('#b_roles_save_update_admin_action').show();
    $('#b_roles_annuler_update_admin_action').show();
    $('#b_roles_update_admin_action').hide();
    $('#b_roles_an_up_admin').hide();
    var selected = [];
    $('#div_roles_admin input:checked').each(function() {
        selected.push($(this).attr('value'));
    });
    var roles = selected.toString();
    $('#roles_admin').val(roles);
    $('#div_roles_admin input[type=checkbox]').attr('disabled','true');
});
//b_roles_save_update_admin_action
$('#b_roles_save_update_admin_action').click(function() { 
});
//b_roles_annuler_update_admin_action
$('#b_roles_annuler_update_admin_action').click(function() { 
    
    $('#div_conf_update_roles_admin').hide();
    $('#b_roles_save_update_admin_action').hide();
    $('#b_roles_annuler_update_admin_action').hide();
    $('#b_roles_update_admin_action').hide();
    $('#b_roles_up_admin').show();
    $('#div_roles_admin input[type=checkbox]').attr('disabled','true');
});
//****************************************************************************************************


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



//*****************************************************

//******************* fin ********************************
    });