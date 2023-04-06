
function blocage_ap_tag(id){
    var res = id.split("/////");
    var id = res[0];
    var uid = res[1];
    var etat = res[2];
    var id_appartement = res[3];

    $("#div_blocage_tag").html("<h1><b>Tag UID</b> "+uid+"</h1>");
    $("#id_blocage_tag").val(id);
    $("#blocagetagModal").modal("show");
}
function deblocage_ap_tag(id){
    var res = id.split("/////");
    var id = res[0];
    var uid = res[1];
    var etat = res[2];
    var id_appartement = res[3];

    $("#div_deblocage_admin").html("<h1><b>Tag UID</b> "+uid+"</h1>");
    $("#id_deblocage_tag").val(id);
    $("#deblocagetagModal").modal("show");
}
function modification_tag(id) {
    // body...
    var res = id.split("/////");
    var id_tag = res[0];
    var uid = res[1];
    var type = res[2];
    var etat = res[3];
    var id_appartement = res[4];
    var id_bloc  = res[5];
    var floor  = res[6];
    $("#bloc_modif_tag").val("");
    $('#appar_modif_tag').html('<option value=""></option>');
    $('#appar_modif_tag').val("");

    if(id_appartement!=0){
    //**********************************************************
        $('#appar_modif_tag').html('');
        $('#appar_modif_tag').append('<option value=""></option>');
        $('#etage_modif_tag').html('');
        $('#etage_modif_tag').append('<option value=""></option>');

     $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/list_apartements_by_bloc_id/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id_appartement}),
        success: function (data) {

          var arr = data;
          for (var i = 0 ; i < arr.length; i++) {
            var id = arr[i].id;
            var id_bloc = arr[i].id_bloc;
            var floors  = arr[i].floors;
            var code = arr[i].code;
            $("#bloc_modif_tag").val(id_bloc);
            $('#appar_modif_tag').append('<option value="'+id+'">'+code+'</option>');
          }
          //****************************************************************************
            for (var i = 0 ; i < parseInt(floors)+1; i++) {
            if(i == 0){$('#etage_modif_tag').append('<option value="'+i+'">Rez-de-chaussée</option>');}
            else if(i == 1){$('#etage_modif_tag').append('<option value="'+i+'">1 ère étage</option>');}
            else {$('#etage_modif_tag').append('<option value="'+i+'">'+i+' ème étage</option>');}
            
          }
          //****************************************************************************
            $("#appar_modif_tag").val(id_appartement);
            $("#etage_modif_tag").val(floor);
            
            $("#id_modif_tag").val(id_tag);
            $("#uid_modif_tag").val(uid);
            $("#last_uid_tag").val(uid);
            $("#type_modif_tag").val(type);
            $("#div_message_erreur_modif_tag").hide();
            $("#modificationtagModal").modal("show");

   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
    //**********************************************************
}else{
    
    $("#id_modif_tag").val(id_tag);
    $("#uid_modif_tag").val(uid);
    $("#last_uid_tag").val(uid);
    $("#div_message_erreur_modif_tag").hide();
    $("#modificationtagModal").modal("show");
}
    
}
function suppression_tag(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var uid = res[1];
    var etat = res[2];
    var id_appartement = res[3];

    $("#div_suppression_tag").html("<h1><b>Tag UID</b> "+uid+"</h1>");
    $("#id_suppression_tag").val(id);
    $("#suppressionatagModal").modal("show");
}


$( document ).ready(function() {
//****************** debut *******************************

$("#b_ajouter_tag").click(function() {

    $('#uid_ajout_tag').val("");
    $('#bloc_ajout_tag').val("");
    $('#appar_ajout_tag').html("<option value=''></option>");
    $('#etage_ajout_tag').html("<option value=''></option>");
    

    $("#div_message_erreur_add_tag").hide();
    $("#ajoutertagModal").modal("show");
});
//**************************************************************
//
$("#b_modifier_passtag").click(function() {

    var uid_tagpass = $('#uid_tagpass').val();
    $('#uid_up_tag_pass').val(uid_tagpass);
    $("#div_message_erreur_up_tag_pass").hide();

    $("#modifiertagpassModal").modal("show");
});
//**************************************************************
//**************************************************************

 $('#bloc_ajout_tag').on('change', function() {
            var id_bloc = $('#bloc_ajout_tag').val();

            $('#etage_ajout_tag').html('');
            $('#etage_ajout_tag').append('<option value=""></option>');
            $('#appar_ajout_tag').html('');
            $('#appar_ajout_tag').append('<option value=""></option>');

     $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/get_bloc_by_id/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id_bloc}),
        success: function (data) {

          var arr = data;
          var floors = arr[0].floors;
          for (var i = 0 ; i < parseInt(floors)+1; i++) {
            if(i == 0){$('#etage_ajout_tag').append('<option value="'+i+'">Rez-de-chaussée</option>');}
            else if(i == 1){$('#etage_ajout_tag').append('<option value="'+i+'">1 ère étage</option>');}
            else {$('#etage_ajout_tag').append('<option value="'+i+'">'+i+' ème étage</option>');}
            
          }       
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
  });

//**************************************************************
//**************************************************************

 $('#etage_ajout_tag').on('change', function() {
            var etage = $('#etage_ajout_tag').val();
            var id_bloc =  $('#bloc_ajout_tag').val();
            
            $('#appar_ajout_tag').html('');
            $('#appar_ajout_tag').append('<option value=""></option>');
            if(etage!="" && id_bloc !=""){
                     $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/list_apartements_by_bloc_etage/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id_bloc, etage: etage}),
        success: function (data) {

          var arr = data;
          for (var i = 0 ; i < arr.length; i++) {
            id = arr[i].id;
            code = arr[i].code;
            $('#appar_ajout_tag').append('<option value="'+id+'">'+code+'</option>');
          }      
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
            }

  });

//**************************************************************

//**************************************************************
$("#b_ajouter_tag_action").click(function() {
    var uid = $('#uid_ajout_tag').val();
    var type = $('#type_ajout_tag').val();
    var bloc = $('#bloc_ajout_tag').val();
    var appar = $('#appar_ajout_tag').val();
    if(uid==""){
        $("#div_message_erreur_add_tag").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le UID  de tag SVP </h4>');
        $("#div_message_erreur_add_tag").show();
       }
    else if(type==""){
        $("#div_message_erreur_add_tag").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Choisir le type  de tag SVP </h4>');
        $("#div_message_erreur_add_tag").show();
       }
    else{
    //****************************************************************
    $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/uid_tag_existe/' ,
        timeout: 4000,
        type: "POST",
        dataType:'json', 
        data: ({uid: uid}),
        success: function (data) {
            // Je charge les données dans box
            var arr = data;
            var existe = arr[0].existe;
            if(existe=="1"){
                $("#div_message_erreur_add_tag").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce UID de tag déjà existe </h4>');
                $("#div_message_erreur_add_tag").show();
            }
            else{
            //************************************************************
            var urla = localStorage.getItem("base_url")+'sdl/tags/';

            var form = $(document.createElement('form'));
            $(form).attr("action", urla);
            $(form).attr("method", "POST");
            $(form).css("display", "none");

            var input_uid = $("<input>").attr("type", "text").attr("name", "uid_ajout_tag").val(uid);
            $(form).append($(input_uid));
            var input_type = $("<input>").attr("type", "text").attr("name", "type_ajout_tag").val(type);
            $(form).append($(input_type));
            var input_appar = $("<input>").attr("type", "text").attr("name", "appar_ajout_tag").val(appar);
            $(form).append($(input_appar));

            form.appendTo( document.body );
            $(form).submit();
            //************************************************************
            }
        },
        error: function(){}

    });

    //****************************************************************


    }
});
//************************************************************************
//**************************************************************

//**************************************************************

 $('#bloc_modif_tag').on('change', function() {
            var id_bloc = $('#bloc_modif_tag').val();

            $('#etage_modif_tag').html('');
            $('#etage_modif_tag').append('<option value=""></option>');
            $('#appar_modif_tag').html('');
            $('#appar_modif_tag').append('<option value=""></option>');

     $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/get_bloc_by_id/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id_bloc}),
        success: function (data) {

          var arr = data;
          var floors = arr[0].floors;
          for (var i = 0 ; i < parseInt(floors)+1; i++) {
            if(i == 0){$('#etage_modif_tag').append('<option value="'+i+'">Rez-de-chaussée</option>');}
            else if(i == 1){$('#etage_modif_tag').append('<option value="'+i+'">1 ère étage</option>');}
            else {$('#etage_modif_tag').append('<option value="'+i+'">'+i+' ème étage</option>');}
            
          }       
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
  });

//**************************************************************
//**************************************************************

 $('#etage_modif_tag').on('change', function() {
            var etage = $('#etage_modif_tag').val();
            var id_bloc =  $('#bloc_modif_tag').val();
            
            $('#appar_modif_tag').html('');
            $('#appar_modif_tag').append('<option value=""></option>');
            if(etage!="" && id_bloc !=""){
                     $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/list_apartements_by_bloc_etage/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id_bloc, etage: etage}),
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
    });
            }

  });

//**************************************************************

$("#b_modif_tag_action").click(function() {
    var uid = $('#uid_modif_tag').val();
    var type = $('#type_modif_tag').val();
    var l_uid = $('#last_uid_tag').val();
    var bloc = $('#bloc_modif_tag').val();
    var appar = $('#appar_modif_tag').val();
    var id = $('#id_modif_tag').val();
    var ok = uid==l_uid;
    if(uid==""){
        $("#div_message_erreur_modif_tag").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le UID  de tag SVP </h4>');
        $("#div_message_erreur_modif_tag").show();
        }
    else if(type==""){
        $("#div_message_erreur_modif_tag").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Choisir le type  de tag SVP </h4>');
        $("#div_message_erreur_modif_tag").show();
       }
    else{
    //****************************************************************
    $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/uid_tag_existe/' ,
        timeout: 4000,
        type: "POST",
        dataType:'json', 
        data: ({uid: uid}),
        success: function (data) {
            // Je charge les données dans box
            var arr = data;
            var existe = arr[0].existe;
            if(existe=="1" && ok==false){
                $("#div_message_erreur_modif_tag").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce UID de tag déjà existe </h4>');
                $("#div_message_erreur_modif_tag").show();
            }
            else{
            //************************************************************

            var urla = localStorage.getItem("base_url")+'sdl/tags/';

            var form = $(document.createElement('form'));
            $(form).attr("action", urla);
            $(form).attr("method", "POST");
            $(form).css("display", "none");

            var input_uid = $("<input>").attr("type", "text").attr("name", "uid_modif_tag").val(uid);
            $(form).append($(input_uid));
            var input_type = $("<input>").attr("type", "text").attr("name", "type_modif_tag").val(type);
            $(form).append($(input_type));
            var input_appar = $("<input>").attr("type", "text").attr("name", "appar_modif_tag").val(appar);
            $(form).append($(input_appar));
            var input_id = $("<input>").attr("type", "text").attr("name", "id_modif_tag").val(id);
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
});
//*************************************************************************
//*************************************************************************
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