
function udate_list_app_aff() {
    
        $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/list_apartements_not_affected/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: 0}),
        success: function (data) {

          var arr = data;
          var ch='';
          for (var i = 0 ; i < arr.length; i++) {

                    var id_a  = arr[i].id;
                    ch+=id_a+',';
            } 
            ch = ch.slice(0, -1);
            $("#appar_not_aff").val(ch);
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
}
function annuler_delete_app_owner_action(id) {

    $("#div_delete_apartment_owner").hide();
    $("#div_show_apartments_owner").show();
}
function delete_app_owner_action(id) {

    var res = id.split("/////");
    var id_a = res[0];
    var id_p = res[1];

    $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/update_proprietaire_app/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id_a,val: 0}),
        success: function (data) {

          var arr = data;
          own_appart_list(id_p);
          udate_list_app_aff();    
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
}

function delete_app_owner(id) {

    var res = id.split("/////");
    var nom_b = res[0];
    var code = res[1];
    var desc = res[2];
    var id_proprietaire = res[3];
    var id_a  = res[4];
    var ch='<hr> <b>Voulez vous vraiment supprimer cet appartement ?</b><br>';
    ch+='<b>'+nom_b+' / '+code+'<b><br>'+desc+'<br>';

    ch+='<div class=""><button id="'+id_a+'/////'+id_proprietaire+'" class="btn btn-default" type="button" onclick="annuler_delete_app_owner_action(this.id);">Fermer&nbsp;<i class="fa fa-times topbar-info-icon top-2"></i></button>';
    ch+='<button id="'+id_a+'/////'+id_proprietaire+'" class="btn btn-danger" type="button" onclick="delete_app_owner_action(this.id);">Supprimer&nbsp;<i class="fa  fa-trash-o topbar-info-icon top-2"></i></button></div>';

    $("#div_delete_apartment_owner").html(ch);
    $("#div_delete_apartment_owner").show();
    $("#div_show_apartments_owner").hide();
}
function own_appart_list(id) {
    // body...
    $("#div_show_apartments_owner").html("");
    //*******************************************************************
         $.ajax({
                url: localStorage.getItem("base_url")+'/Sdl_WS/list_apartements_by_owner/' ,
                timeout: 4000,
                type: "POST",
              dataType:'json',
              data: ({id: id}),
                success: function (data) {

                  var arr = data;
                  var ch='<h1>Liste des appartements</h1><hr>';
                  for (var i = 0 ; i < arr.length; i++) {

                    var id_a  = arr[i].id_a;
                    var id_bloc  = arr[i].id_bloc;
                    var code  = arr[i].code;
                    var desc  = arr[i].desc;
                    var id_proprietaire  = arr[i].id_proprietaire;
                    var nom_b  = arr[i].nom_b;
                    var desc_b  = arr[i].desc_b;
                    ch+='<b>'+nom_b+' / '+code+'<b><br>'+desc+'<br>';
                    var id_b =nom_b+'/////'+code+'/////'+desc+'/////'+id_proprietaire+'/////'+id_a;
                    ch+='<button  id="'+id_b+'" type="button" class="btn btn-danger btn-sm" onclick="delete_app_owner(this.id);" ><i class="fa fa-times topbar-info-icon top-2"></i></button>';
                    ch+='<hr>';

                  }   
                    $("#div_show_apartments_owner").html(ch);
                    $("#div_show_apartments_owner").show();
                    $("#div_delete_apartment_owner").hide();   
           },
                error: function() {
                    // J'affiche un message d'erreur
                }
            });
    //*******************************************************************

}
function apartments_owner(id) {
    
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
    $("#div_aff_owner").html("<h2>Le propriétaire <br>"+ch+"  "+nom+" "+prenom+"</h2>");
    $("#id_apartments_owner").val(id)
    $("#div_add_apartment_owner").hide();
    own_appart_list(id);
    $("#apartmentsownerModal").modal("show");
}
function blocage_compte_owner(id) {

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
    $("#div_blocage_owner").html("<h2>"+login+"<br>"+ch+"  "+nom+" "+prenom+"</h2>");
    $("#id_blocage_owner").val(id)
    $("#blocageownerModal").modal("show");
}
function deblocage_compte_owner(id) {
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
    $("#div_deblocage_owner").html("<h2>"+login+"<br>"+ch+"  "+nom+" "+prenom+"</h2>");
    $("#id_deblocage_owner").val(id)
    $("#deblocageownerModal").modal("show");
}
function envoi_sms_owner(id) {
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
    $("#sms_owner_modal").modal("show");
}
function impression_compte_owner(id) {
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
    ch+='<hr/><hr/><div align="center"><h1> Gloulou K2</h1><h2>Propriétaire</h2></div><hr/>';

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
function reinitialisation_compte_owner(id) {
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
    $("#div_reinitialisation_owner").html("<h2>"+login+"<br>"+ch+"  "+nom+" "+prenom+"</h2>");
    $("#id_reinitialisation_owner").val(id);
    $("#reinitialisationownerModal").modal("show");
}
function modification_compte_owner(id) {
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
    $("#login_modif_owner").val(login);
    $("#id_modif_owner").val(id);
    $("#cin_modif_owner").val(cin);
    $("#l_cin_modif_owner").val(cin);
    $("#nom_modif_owner").val(nom);
    $("#prenom_modif_owner").val(prenom);
    //$("#sexe_modif_admin").val(sexe);
    $("input[name=sexe_modif_owner][value='"+sexe+"']").prop("checked",true);
    $("#tel_modif_owner").val(tel);
    $("#email_modif_owner").val(email);
    $("#desc_modif_owner").val(desc);
    if(photo!=''){
        var src_img = '<img src="'+localStorage.getItem("base_url")+'/uploads/'+photo+'" alt="">';
        $("#aff_photo_modif").html("<a href='#'>"+src_img+"</a>");
    }
    
    $("#div_message_erreur_modif_owner").hide();
    $("#modificationownerModal").modal("show");
}
function suppression_compte_owner(id) {
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
    $("#div_suppression_owner").html("<h2>"+login+"<br>"+ch+"  "+nom+" "+prenom+"</h2>");
    $("#id_suppression_owner").val(id);
    $("#suppressionownerModal").modal("show");
  
}

function edit_roles_owner(id) {
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
    $('#div_roles_owner input[type=checkbox]').prop('checked', false);
    var tab_r = roles.split(",");
    for (var i = tab_r.length - 1; i >= 0; i--) {
        $("#ch_role_"+tab_r[i]+"").prop('checked', true);
    }
    
    $('#div_roles_owner input[type=checkbox]').attr('disabled','true');
    //div_roles_admin
    $('#id_roles_owner').val(id);
    $('#b_roles_up_owner').show();
    $('#b_roles_an_up_owner').hide();
    $('#div_conf_update_roles_owner').hide();
    $('#b_roles_save_update_owner_action').hide();
    $('#b_roles_annuler_update_owner_action').hide();
    $('#b_roles_update_owner_action').hide();
    $("#roleseownerModal").modal("show");
}

$( document ).ready(function() {
//****************** debut *******************************

$("#b_ajouter_owner").click(function() {


    $('#nom_ajout_owner').val("");
    $('#cin_ajout_owner').val("");
    $('#prenom_ajout_owner').val("");
    $('#tel_ajout_owner').val("");
    $('#email_ajout_owner').val("");
    $('#desc_ajout_owner').val("");
    $('#sexe_ajout_owner').val("");
    //$("[name=sexe_ajout_admin]").val(["1"]);

    $("#div_message_erreur_add_owner").hide();
    $("#ajouterownerModal").modal("show");
});
//**************************************************************

$("#b_modif_owner_action").click(function() {
    var cin = $("#cin_modif_owner").val();
    var l_cin = $("#l_cin_modif_owner").val();
    var nom = $('#nom_modif_owner').val();
    var prenom = $('#prenom_modif_owner').val();
    var ok = cin==l_cin;

      if (cin == "") {
    $("#div_message_erreur_modif_owner").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le CIN SVP </h4>');
    $("#div_message_erreur_modif_owner").show();
  }
  else if (nom == "") {
    $("#div_message_erreur_modif_owner").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le nom SVP </h4>');
    $("#div_message_erreur_modif_owner").show();
  }
  else if (prenom == "") {
    $("#div_message_erreur_modif_owner").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le prénom SVP </h4>');
    $("#div_message_erreur_modif_owner").show();
  }
  else{

      //******************************************************************
        $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/cin_owner_existe/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({cin: cin}),
        success: function (data) {

          var arr = data;
          var e  = arr[0].existe;
          if(e=="1" & !ok){
                $("#div_message_erreur_modif_owner").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce CIN déjà existe </h4>');
                $("#div_message_erreur_modif_owner").show();
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

$("#b_ajouter_owner_action").click(function() {
   

var cin = $('#cin_ajout_owner').val();
var nom = $('#nom_ajout_owner').val();
var prenom = $('#prenom_ajout_owner').val();
  if (cin == "") {
    $("#div_message_erreur_add_owner").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le CIN SVP </h4>');
    $("#div_message_erreur_add_owner").show();
  }
  else if (nom == "") {
    $("#div_message_erreur_add_owner").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le nom SVP </h4>');
    $("#div_message_erreur_add_owner").show();
  }
  else if (prenom == "") {
    $("#div_message_erreur_add_owner").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le prénom SVP </h4>');
    $("#div_message_erreur_add_owner").show();
  }
  else{

      //******************************************************************
        $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/cin_owner_existe/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({cin: cin}),
        success: function (data) {

          var arr = data;
          var e  = arr[0].existe;
          if(e=="1"){
                $("#div_message_erreur_add_owner").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce CIN déjà existe </h4>');
                $("#div_message_erreur_add_owner").show();
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

$("#b_ajouter_owner_app").click(function() {
    $("#bloc_apar_add").val("");
    $("#appar_add_own").html("<option value=''></option>");
    $("#err_message_add_app").html("");
    $("#div_add_apartment_owner").show();
    $("#div_show_apartments_owner").hide();
    $("#div_delete_apartment_owner").hide();
});
$("#b_fermer_ajouter_app_owner_action").click(function() {    
    $("#bloc_apar_add").val("");
    $("#appar_add_own").html("<option value=''></option>");
    $("#err_message_add_app").html("");
    $("#div_add_apartment_owner").hide();
    $("#div_show_apartments_owner").show();
});
$("#b_ajouter_app_owner_action").click(function() {    
    var bloc = $("#bloc_apar_add").val();
    var appar = $("#appar_add_own").val();
    var id_own = $("#id_apartments_owner").val();

    if(appar==""){
        $("#err_message_add_app").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Choisir un appartement SVP </h4>');
        $("#err_message_add_app").show();
    }
    else{

    $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/update_proprietaire_app/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: appar,val: id_own}),
        success: function (data) {

            var arr = data;
            $("#err_message_add_app").html('');
            $("#err_message_add_app").hide();
            own_appart_list(id_own);
            udate_list_app_aff();
            $("#div_add_apartment_owner").hide();    
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
        //*********************************************************************

        //*********************************************************************

    }
    
    
    //$("#div_add_apartment_owner").hide();
});


//**************************************************************
$('#bloc_apar_add').on('change', function() {
            var id_bloc = $('#bloc_apar_add').val();
            var l_ana = $('#appar_not_aff').val();
            var res = l_ana.split(",");

            $('#appar_add_own').html('');
            $('#appar_add_own').append('<option value=""></option>');

     $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/list_apartements_by_bloc/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id_bloc}),
        success: function (data) {
          var arr = data;
          for (var i = 0 ; i < arr.length; i++) {
            id = arr[i].id;
            code = arr[i].code;
            for (var j = res.length - 1; j >= 0; j--) {
                if(res[j]==id){
                    $('#appar_add_own').append('<option value="'+id+'">'+code+'</option>');
                }
            }
          }      
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
  });
//**************************************************************

//****************************************************************************************************

$("#b_sms_owner_action").click(function() {  
    
    //hist_sms : id, message, date, destinataire, nbr_sms, type
    var id = $('#id_client_sms').val();
    var login = $('#log_client_sms').val();
    var pass = $('#pass_client_sms').val();
    var tel = $('#num_client_sms').val();
    var nom = $('#nom_client_sms').val();
    var type = $('#type_client_sms').val();
    var entete_sms = 'GloulouK2';
    var message = "Gloulou K2  Login : "+login+"  Password : "+pass+" "+ localStorage.getItem("base_url");
    var message_h = "Gloulou K2  Login : "+login+"  Password : ********"+" "+ localStorage.getItem("base_url");
    var nbr_sms = 1;
    var tel_sms='216'+tel;
  message =encodeURIComponent(message);



    //****************************************************************************************
  
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
$("#sms_owner_modal").modal("hide");
//****************************************************************************************

});
//****************************************************************************************************
$("#b_sms_owner_action_2").click(function() {

    var id = $('#id_client_sms').val();
    var login = $('#log_client_sms').val();
    var pass = $('#pass_client_sms').val();
    var tel = $('#num_client_sms').val();
    var nom = $('#nom_client_sms').val();
    var type = $('#type_client_sms').val();

    var entete_sms = 'GloulouK2';
    var message = entete_sms+"  Login : "+login+"  Password : "+pass+"  ( "+localStorage.getItem("base_url")+" )";
    var message_h = entete_sms+"  Login : "+login+"  Password : ********  ( "+localStorage.getItem("base_url")+" )";

   

    var destinataire = "("+tel+") "+nom;
    var tel_sms='216'+tel;
  message =encodeURIComponent(message);
    
    var user = 'Administration';
    var nbr_sms = 1;
//***********************************************************************************
//****************************************************************************************

  
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
//*****************************************************************************************
    $.ajax({
        url: localStorage.getItem("base_url")+'/Administration_WS/add_hist_sms/' ,
        timeout: 4000,
        type: "POST",
        async: false,
        dataType:'json',
        data: ({message:message_h,destinataire:destinataire,nbr_sms: nbr_sms,user: user,type: type}),
        //data: ({message:message,destinataire:'('+tel+')'+prenom+' '+nom,nbr_sms:nbr_sms*nbr_sms_par_personne,type:0,}),
       
        success: function (data) {
          
   },
        error: function() {  
        
        }

    });
//****************************************************************************************
$("#sms_client_modal").modal("hide");
//****************************************************************************************
});
//*********************************************************************************



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