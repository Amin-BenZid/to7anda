function message_service(id){
    var res = id.split("/////");
    var id = res[0];
    var id_appa = res[1];
    var id_serv = res[2];
    var id_tag = res[3];
    var id_emp = res[4];

    $("#id_dem_ser_mess").val(id);

    $("#div_dem_ser_mess").hide();
    $("#messageserviceModal").modal("show");
}

function acceptation_service(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_appa = res[1];
    var id_serv = res[2];
    var id_tag = res[3];
    var id_emp = res[4];

    $("#id_dem_ser_acc").val(id);

    $("#div_dem_ser_acc").hide();
    $("#acceptationserviceModal").modal("show");
}
function annulation_service(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_appa = res[1];
    var id_serv = res[2];
    var id_tag = res[3];
    var id_emp = res[4];

    $("#id_dem_ser_ann").val(id);
    $("#div_dem_ser_ann").hide();
    $("#annulationserviceModal").modal("show");
}
function termination_service(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_appa = res[1];
    var id_serv = res[2];
    var id_tag = res[3];
    var id_emp = res[4];

    $("#id_dem_ser_ter").val(id);
    $("#div_dem_ser_ter").hide();
    $("#terminationserviceModal").modal("show");
}
function employe_service(id) {
    var res = id.split("/////");
    var id = res[0];
    var id_appa = res[1];
    var id_serv = res[2];
    var id_tag = res[3];
    var id_emp = res[4];

    $("#id_dem_ser_emp").val(id);
    //id_ser_dem
//list_of_appartement_tags
//***************************************************************
     $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/list_employe_by_service/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id_serv}),
        success: function (data) {

          var arr = data;
          var ch2="";
        ch2+='<option value="0"></option>';
          for (var i = 0 ; i < arr.length; i++) {
            id = arr[i].id;
            nom = arr[i].nom;
            prenom = arr[i].prenom;

            ch2+='<option value="'+id+'">'+nom+' '+prenom+'</option>';
          }  
          $("#s_id_dem_ser_emp").html(ch2);
          $("#employeserviceModal").modal("show");    
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
//***************************************************************
    
}
function tag_service(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_appa = res[1];
    var id_serv = res[2];
    var id_tag = res[3];
    var id_emp = res[4];

    $("#id_dem_ser_tag").val(id);
    $("#id_app_tag").val(id_appa);
    
//list_of_appartement_tags
//***************************************************************
     $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/list_tags_admin_free/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id_appa}),
        success: function (data) {

          var arr = data;
          var ch2="";
        ch2+='<option value="0"></option>';
          for (var i = 0 ; i < arr.length; i++) {
            id = arr[i].id;
            uid = arr[i].uid;
            etat = arr[i].etat;
            ch2+='<option value="'+id+'">'+uid+'</option>';
          }  
          $("#s_id_dem_ser_tag").html(ch2);
          $("#tagserviceModal").modal("show");    
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
//***************************************************************
    
}

$( document ).ready(function() {
//****************** debut *******************************

//**************************************************************

 $('#s_id_dem_ser_emp').on('change', function() {
            var id_emp = $('#s_id_dem_ser_emp').val();
            
            //alert(id_emp);

     /*$.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/get_employe_by_id/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({id: id_emp}),
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
    });*/
  });

//**************************************************************
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