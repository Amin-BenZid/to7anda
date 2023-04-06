
function owner_apartment(id) {
    var res = id.split("/////");
    var id = res[0];
    var id_bloc = res[1];
    var nom = res[2];
    var code = res[3];
    var desc = res[4];
    var id_proprietaire = res[5];
    var sdl_id = res[6]; 
    var floor = res[7];
    var aff ='';
    if(floor == 0){ aff ="Rez-de-chaussée";}
    else if(floor == 1){aff ="1<sup>ère</sup> étage";}
    else {aff =floor+"<sup>ème</sup> étage";} 
    
    var ch ='<h2>'+nom+' / '+aff+' / '+code+'</h2>'+desc+'<br>';
    $("#div_apartment_owner").html(ch);    

    //list_of_appartement_tags
//***************************************************************
     $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/list_of_appartement_tags/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id}),
        success: function (data) {

          var arr = data;
          var ch2="<h4>Les tags</h4>";
          for (var i = 0 ; i < arr.length; i++) {
            id = arr[i].id;
            uid = arr[i].uid;
            etat = arr[i].etat;
            ch2+='<b>'+uid+' </b>/';
          }  
          $("#div_aff_owner_tag").html(ch2);    
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
//***************************************************************
     $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/get_owner_by_id/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id_proprietaire}),
        success: function (data) {

          var arr = data;
          var ch3="<h3>Le propriétaire</h3>";
          for (var i = 0 ; i < arr.length; i++) {
            var id = arr[i].id;
            var login = arr[i].login;
            var nom = arr[i].nom;
            var prenom = arr[i].prenom;
            var sexe = arr[i].sexe;
            var email = arr[i].email;
            var tel = arr[i].tel;
            var desc = arr[i].desc;
            var photo = arr[i].photo;
            var etat = arr[i].etat;
            var online = arr[i].online;
            ch3+="<b>"+login+"</b>";
            if(etat==1){ch3+="<div class='bg-success light-color'> Activé </div>";}else{ch3+="<div class='bg-danger light-color'> Bloqué </div>";}
            ch3+="<div align='center'>"; 
            ch3+="<div class='team-m'>";
            ch3+="<a href='#'>";
            if(photo==""){
                if(sexe==1){
                    ch3+="<img src='"+localStorage.getItem("base_url")+"assets/img/male.png' alt=''>";
                }
                else{ ch3+="<img src='"+localStorage.getItem("base_url")+"assets/img/female.png' alt=''>"; }
                }
            else{ 
                    ch3+="<img src='"+localStorage.getItem("base_url")+"uploads/"+photo+"' alt=''>";
                }

            if(online==1){ch3+="<i class='online dot'></i>";}else{ch3+="<i class='busy dot'></i>";}
            ch3+="</a> </div>";
            if(sexe==1){ch3+="<i class='fa fa-male'></i> ";}else{ch3+="<i class='fa fa-female'></i>  ";}
            ch3+=prenom+' '+nom+'<br>';
            ch3+=tel+'<br>';
            ch3+=email+'<br>';
            ch3+=desc+'<br>';
            ch3+="</div>";
          }  
            $("#div_aff_owner").html(ch3);   
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
//***************************************************************
    

    $("#ownerapartmentModal").modal("show");
}
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

    
    $("#id_modif_apar").val(id);
    $("#bloc_modif_apar").val(id_bloc);
    $("#code_modif_apar").val(code);
    $("#last_code_apar").val(code);
    $("#sdl_id_modif_apar").val(sdl_id);
    $("#last_sdl_id_apar").val(sdl_id);
    $("#desc_modif_apar").val(desc);
    //*************************************************************

            
            $('#etage_modif_apar').html('');
            $('#etage_modif_apar').append('<option value=""></option>');

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
            if(i == 0){$('#etage_modif_apar').append('<option value="'+i+'">Rez-de-chaussée</option>');}
            else if(i == 1){$('#etage_modif_apar').append('<option value="'+i+'">1 ère étage</option>');}
            else {$('#etage_modif_apar').append('<option value="'+i+'">'+i+' ème étage</option>');}
            
          }
          //if(i == parseInt(floors)+1){ alert("floor : "+floor);}
          $('#etage_modif_apar').val(""+floor+"");

   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
    //*************************************************************
    
    
    $("#div_message_erreur_modif_apar").hide();
    $("#modificationaparModal").modal("show");
}
function suppression_apar(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_bloc = res[1];
    var nom = res[2];
    var code = res[3];
    var desc = res[4];

    $("#div_suppression_apar").html("<h1>"+nom+"<br>"+code+" </h1><h4>"+desc+"</h4>");
    $("#id_suppression_apar").val(id);
    $("#suppressionaparModal").modal("show");
}


$( document ).ready(function() {
//****************** debut *******************************

$("#b_ajouter_apar").click(function() {

    $('#bloc_ajout_apar').val("");
    $('#code_ajout_apar').val("");
    $('#sdl_id_ajout_apar').val("");
    $('#desc_ajout_apar').val("");
    $('#etage_ajout_apar').html('<option value=""></option>');
    $("#div_message_erreur_add_apar").hide();
    $("#ajouteraparModal").modal("show");
});
//**************************************************************
$("#b_modif_apar_action").click(function() {
//**************************************************************
//****************************************************************

    var bloc = $('#bloc_modif_apar').val();
    var etage = $('#etage_modif_apar').val();
    var code = $('#code_modif_apar').val();
    var l_code = $('#last_code_apar').val();
    var sdl_id = $('#sdl_id_modif_apar').val();
    var l_sdl_id = $('#last_sdl_id_apar').val();
    var desc = $('#desc_modif_apar').val();
    var id = $('#id_modif_apar').val();
    var ok = code==l_code;
    var ok1 = sdl_id==l_sdl_id;
        if(bloc==""){
        $("#div_message_erreur_modif_apar").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Choisir le bloc SVP </h4>');
        $("#div_message_erreur_modif_apar").show();
       }
    else if(etage==""){
        $("#div_message_erreur_modif_apar").html("<h4 class='text-danger'><i class='fa  fa-exclamation-triangle text-danger'></i>  Choisir l'étage SVP </h4>");
        $("#div_message_erreur_modif_apar").show();
       }
    else if(code==""){
        $("#div_message_erreur_modif_apar").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le code SVP </h4>');
        $("#div_message_erreur_modif_apar").show();
       }
    else{
    //****************************************************************
    $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/code_apartement_existe/' ,
        timeout: 4000,
        type: "POST",
        dataType:'json', 
        data: ({code: code}),
        success: function (data) {
            // Je charge les données dans box
            var arr = data;
            var existe = arr[0].existe;
            if(existe=="1" && ok==false){
                $("#div_message_erreur_modif_apar").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce code déjà existe </h4>');
                $("#div_message_erreur_modif_apar").show();
            }
            else{
            //************************************************************
            //************************************************************
    $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/sdl_id_apartement_existe/' ,
        timeout: 4000,
        type: "POST",
        dataType:'json', 
        data: ({sdl_id: sdl_id}),
        success: function (data) {
            // Je charge les données dans box
            var arr = data;
            var existe = arr[0].existe;
            if(existe=="1" && ok1==false && sdl_id!=""){
                $("#div_message_erreur_modif_apar").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce SDL ID déjà existe </h4>');
                $("#div_message_erreur_modif_apar").show();
            }
            else{
            //************************************************************

            var urla = localStorage.getItem("base_url")+'sdl/apartments/';

            var form = $(document.createElement('form'));
            $(form).attr("action", urla);
            $(form).attr("method", "POST");
            $(form).css("display", "none");

            var input_bloc = $("<input>").attr("type", "text").attr("name", "bloc_modif_apar").val(bloc);
            $(form).append($(input_bloc));
            var input_etage = $("<input>").attr("type", "text").attr("name", "etage_modif_apar").val(etage);
            $(form).append($(input_etage));
            var input_code = $("<input>").attr("type", "text").attr("name", "code_modif_apar").val(code);
            $(form).append($(input_code));
            var input_sdl = $("<input>").attr("type", "text").attr("name", "sdl_id_modif_apar").val(sdl_id);
            $(form).append($(input_sdl));
            var input_desc = $("<input>").attr("type", "text").attr("name", "desc_modif_apar").val(desc);
            $(form).append($(input_desc));
            var input_id = $("<input>").attr("type", "text").attr("name", "id_modif_apar").val(id);
            $(form).append($(input_id));

            form.appendTo( document.body );
            $(form).submit();
            //************************************************************

                    }
        },
        error: function(){}

    });
            //************************************************************
            }
        },
        error: function(){}

    });

    //****************************************************************


    }

//****************************************************************
//**************************************************************
});

//**************************************************************

 $('#bloc_modif_apar').on('change', function() {
            var id_bloc = $('#bloc_modif_apar').val();
            
            $('#etage_modif_apar').html('');
            $('#etage_modif_apar').append('<option value=""></option>');

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
            if(i == 0){$('#etage_modif_apar').append('<option value="'+i+'">Rez-de-chaussée</option>');}
            else if(i == 1){$('#etage_modif_apar').append('<option value="'+i+'">1 ère étage</option>');}
            else {$('#etage_modif_apar').append('<option value="'+i+'">'+i+' ème étage</option>');}
            
          }      
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
  });

//**************************************************************
//**************************************************************

 $('#bloc_ajout_apar').on('change', function() {
            var id_bloc = $('#bloc_ajout_apar').val();
            
            $('#etage_ajout_apar').html('');
            $('#etage_ajout_apar').append('<option value=""></option>');

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
            if(i == 0){$('#etage_ajout_apar').append('<option value="'+i+'">Rez-de-chaussée</option>');}
            else if(i == 1){$('#etage_ajout_apar').append('<option value="'+i+'">1 ère étage</option>');}
            else {$('#etage_ajout_apar').append('<option value="'+i+'">'+i+' ème étage</option>');}
            
          }      
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
  });

//**************************************************************
//**************************************************************
$("#b_ajouter_apar_action").click(function() {
//**************************************************************
//********************************************************
    var bloc = $('#bloc_ajout_apar').val();
    var etage = $('#etage_ajout_apar').val();
    var code = $('#code_ajout_apar').val();
    var sdl_id = $('#sdl_id_ajout_apar').val();
    var desc = $('#desc_ajout_apar').val();

    if(bloc==""){
        $("#div_message_erreur_add_apar").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Choisir le bloc SVP </h4>');
        $("#div_message_erreur_add_apar").show();
       }
    else if(etage==""){
        $("#div_message_erreur_add_apar").html("<h4 class='text-danger'><i class='fa  fa-exclamation-triangle text-danger'></i>  Choisir l'étage SVP </h4>");
        $("#div_message_erreur_add_apar").show();
       }
    else if(code==""){
        $("#div_message_erreur_add_apar").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Remplir le code SVP </h4>');
        $("#div_message_erreur_add_apar").show();
       }
    else{
    //****************************************************************
    $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/code_apartement_existe/' ,
        timeout: 4000,
        type: "POST",
        dataType:'json', 
        data: ({code: code}),
        success: function (data) {
            // Je charge les données dans box
            var arr = data;
            var existe = arr[0].existe;
            if(existe=="1"){
                $("#div_message_erreur_add_apar").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce code déjà existe </h4>');
                $("#div_message_erreur_add_apar").show();
            }
            else{
            //************************************************************
$.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/sdl_id_apartement_existe/' ,
        timeout: 4000,
        type: "POST",
        dataType:'json', 
        data: ({sdl_id: sdl_id}),
        success: function (data) {
            // Je charge les données dans box
            var arr = data;
            var existe = arr[0].existe;
            if(existe=="1" && sdl_id!=""){
                
                $("#div_message_erreur_add_apar").html('<h4 class="text-danger"><i class="fa  fa-exclamation-triangle text-danger"></i>  Ce SDL ID déjà existe </h4>');
                $("#div_message_erreur_add_apar").show();
            }
            else{
            //*************************************************************
            var urla = localStorage.getItem("base_url")+'sdl/apartments/';

            var form = $(document.createElement('form'));
            $(form).attr("action", urla);
            $(form).attr("method", "POST");
            $(form).css("display", "none");

            var input_bloc = $("<input>").attr("type", "text").attr("name", "bloc_ajout_apar").val(bloc);
            $(form).append($(input_bloc));

            var input_etage = $("<input>").attr("type", "text").attr("name", "etage_ajout_apar").val(etage);
            $(form).append($(input_etage));


            var input_code = $("<input>").attr("type", "text").attr("name", "code_ajout_apar").val(code);
            $(form).append($(input_code));
            var input_sdl = $("<input>").attr("type", "text").attr("name", "sdl_id_ajout_apar").val(sdl_id);
            $(form).append($(input_sdl));
            var input_desc = $("<input>").attr("type", "text").attr("name", "desc_ajout_apar").val(desc);
            $(form).append($(input_desc));

            form.appendTo( document.body );
            $(form).submit();
            //************************************************************

                   }
        },
        error: function(){}

    });


            //*************************************************************
            }
        },
        error: function(){}

    });

    //****************************************************************


    }
//********************************************************
//**************************************************************
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
//******************* fin ********************************
    });