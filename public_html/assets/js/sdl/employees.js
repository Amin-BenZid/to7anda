
function hors_etat_empl(id) {

    var res = id.split("/////");
    var id = res[0];
    var nom = res[1];
    var prenom = res[2];
    var sexe = res[3];
    var tel = res[4];
    var email = res[5];
    var desc = res[6];
    var photo = res[7];
    var etat = res[8];
    var id_service = res[9];

    var ch="";
    if(sexe==1){
        ch+='<i class="fa  fa-male topbar-info-icon top-2"></i>&nbsp;';
    }else{
        ch+='<i class="fa  fa-female topbar-info-icon top-2"></i>&nbsp;';
    }
    $("#div_hors_empl").html("<h2>"+ch+"  "+nom+" "+prenom+"</h2>");
    $("#id_hors_empl").val(id)
    $("#horsemplModal").modal("show");
}
function en_etat_empl(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var nom = res[1];
    var prenom = res[2];
    var sexe = res[3];
    var tel = res[4];
    var email = res[5];
    var desc = res[6];
    var photo = res[7];
    var etat = res[8];
    var id_service = res[9];

    var ch="";
    if(sexe==1){
        ch+='<i class="fa  fa-male topbar-info-icon top-2"></i>&nbsp;';
    }else{
        ch+='<i class="fa  fa-female topbar-info-icon top-2"></i>&nbsp;';
    }
    $("#div_en_empl").html("<h2>"+ch+"  "+nom+" "+prenom+"</h2>");
    $("#id_en_empl").val(id)
    $("#enemplModal").modal("show");
}

function modification_empl(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var nom = res[1];
    var prenom = res[2];
    var sexe = res[3];
    var tel = res[4];
    var email = res[5];
    var desc = res[6];
    var photo = res[7];
    var etat = res[8];
    var id_service = res[9];
    var cin = res[10];
    $("#div_services_modif").find('input[type=checkbox]').each(function () {
             this.checked = false;
        });
    var l_serv = id_service.split(",");
    for (var i =0; i < l_serv.length; i++) {
        $("#up_serv_" +l_serv[i]).prop('checked', true);
    }

    
    $("#aff_photo_modif").html("");
    $("#id_modif_empl").val(id);
    $("#nom_modif_empl").val(nom);
    $("#cin_modif_empl").val(cin);
    $("#l_cin_modif_empl").val(cin);
    $("#prenom_modif_empl").val(prenom);
    $("input[name=sexe_modif_empl][value='"+sexe+"']").prop("checked",true);
    $("#tel_modif_empl").val(tel);
    $("#email_modif_empl").val(email);
    $("#desc_modif_empl").val(desc);
    //$("#service_modif_empl").val(id_service);
    if(photo!=''){
        var src_img = '<img src="'+localStorage.getItem("base_url")+'/uploads/'+photo+'" alt="">';
        $("#aff_photo_modif").html("<a href='#'>"+src_img+"</a>");
    }
    
    $("#div_message_erreur_modif_empl").hide();
    $("#modificationemplModal").modal("show");
}
function suppression_empl(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var nom = res[1];
    var prenom = res[2];
    var sexe = res[3];
    var tel = res[4];
    var email = res[5];
    var desc = res[6];
    var photo = res[7];
    var etat = res[8];
    var id_service = res[9];

    var ch="";
    if(sexe==1){
        ch+='<i class="fa  fa-male topbar-info-icon top-2"></i>&nbsp;';
    }else{
        ch+='<i class="fa  fa-female topbar-info-icon top-2"></i>&nbsp;';
    }
    $("#div_suppression_empl").html("<h2>"+ch+"  "+nom+" "+prenom+"</h2>");
    $("#id_suppression_empl").val(id);
    $("#suppressionemplModal").modal("show");
}


$( document ).ready(function() {
//****************** debut *******************************

$("#b_ajouter_empl").click(function() {

    $('#nom_ajout_empl').val("");
    $('#prenom_ajout_empl').val("");
    $('#cin_ajout_empl').val("");
    $('#tel_ajout_empl').val("");
    $('#email_ajout_empl').val("");
    $('#desc_ajout_empl').val("");
    $('#photo_ajout_empl').val("");
    $('#service_ajout_empl').val("");
    $("input[name=sexe_ajout_empl][value=1]").prop('checked', true);

    $("#div_services_add").find('input[type=checkbox]').each(function () {
             this.checked = false;
        });

    $("#div_message_erreur_add_empl").hide();
    $("#ajouteremplModal").modal("show");
});

//*****************************************************
//**************************************************************

$("#b_modif_empl_action").click(function() {
    var cin = $("#cin_modif_empl").val();
    var l_cin = $("#l_cin_modif_empl").val();
    var nom = $('#nom_modif_empl').val();
    var prenom = $('#prenom_modif_empl').val();
    var ok = cin==l_cin;

      if (cin == "") {
    $("#div_message_erreur_modif_empl").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le CIN SVP </h4>');
    $("#div_message_erreur_modif_empl").show();
  }
  else if (nom == "") {
    $("#div_message_erreur_modif_empl").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le nom SVP </h4>');
    $("#div_message_erreur_modif_empl").show();
  }
  else if (prenom == "") {
    $("#div_message_erreur_modif_empl").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le prénom SVP </h4>');
    $("#div_message_erreur_modif_empl").show();
  }
  else{

      //******************************************************************
        $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/cin_empl_existe/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({cin: cin}),
        success: function (data) {

          var arr = data;
          var e  = arr[0].existe;
          if(e=="1" & !ok){
                $("#div_message_erreur_modif_empl").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce CIN déjà existe </h4>');
                $("#div_message_erreur_modif_empl").show();
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

$("#b_ajouter_empl_action").click(function() {
   

var cin = $('#cin_ajout_empl').val();
var nom = $('#nom_ajout_empl').val();
var prenom = $('#prenom_ajout_empl').val();
  if (cin == "") {
    $("#div_message_erreur_add_empl").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le CIN SVP </h4>');
    $("#div_message_erreur_add_empl").show();
  }
  else if (nom == "") {
    $("#div_message_erreur_add_empl").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le nom SVP </h4>');
    $("#div_message_erreur_add_empl").show();
  }
  else if (prenom == "") {
    $("#div_message_erreur_add_empl").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le prénom SVP </h4>');
    $("#div_message_erreur_add_empl").show();
  }
  else{

      //******************************************************************
        $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/cin_empl_existe/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({cin: cin}),
        success: function (data) {

          var arr = data;
          var e  = arr[0].existe;
          if(e=="1"){
                $("#div_message_erreur_add_empl").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce CIN déjà existe </h4>');
                $("#div_message_erreur_add_empl").show();
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