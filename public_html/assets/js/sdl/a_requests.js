
function acceptation_auto(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_appa = res[1];
    var id_prop = res[2];
    var id_tag = res[3];
    var cin_pass = res[4];

    $("#id_dem_auto_acc").val(id);

    $("#div_dem_auto_acc").hide();
    $("#acceptationautoModal").modal("show");
}
function annulation_auto(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_appa = res[1];
    var id_prop = res[2];
    var id_tag = res[3];
    var cin_pass = res[4];

    $("#id_dem_auto_ann").val(id);
    $("#div_dem_auto_ann").hide();
    $("#annulationautoModal").modal("show");
}
function termination_auto(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_appa = res[1];
    var id_prop = res[2];
    var id_tag = res[3];
    var cin_pass = res[4];

    $("#id_dem_auto_ter").val(id);
    $("#div_dem_auto_ter").hide();
    $("#terminationautoModal").modal("show");
}

function tag_auto(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var id_appa = res[1];
    var id_prop = res[2];
    var id_tag = res[3];
    var cin_pass = res[4];

    $("#id_dem_auto_tag").val(id);
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
          $("#s_id_dem_auto_tag").html(ch2);
          $("#tagautoModal").modal("show");    
   },
        error: function() {
            // J'affiche un message d'erreur
        }
    });
//***************************************************************
    
}

$( document ).ready(function() {
//****************** debut *************************************

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
//**************************************************************
//**************************************************************
//**************************************************************

//******************* fin **************************************
    });