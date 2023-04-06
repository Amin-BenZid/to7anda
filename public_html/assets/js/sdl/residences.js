

function modification_residence(id) {

    // body...

    var res = id.split("/////");

    var id = res[0];

    var nom = res[1];

   /*  var desc = res[2];
 */


    $("#id_modif_residence").val(id);

    $("#nom_modif_residence").val(nom);

    /* $("#desc_modif_residence").val(desc); */

    

    $("#div_message_erreur_modif_residence").hide();

    $("#modificationresidenceModal").modal("show");

}

function suppression_residence(id) {

    // body...

    var res = id.split("/////");

    var id = res[0];

    var nom = res[1];

    /* var desc = res[2]; */



    $("#div_suppression_residence").html("<h1>"+nom+"</h1>");

    $("#id_suppression_residence").val(id);

    $("#suppressionresidenceModal").modal("show");

}





$( document ).ready(function() {

//****************** debut *******************************



$("#b_ajouter_residence").click(function() {



    $('#nom_ajout_residence').val("");

   /*  $('#desc_ajout_residence').val(""); */

    $("#div_message_erreur_add_residence").hide();

    $("#ajouterresidenceModal").modal("show");

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