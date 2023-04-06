
$( document ).ready(function() {
//****************** debut *******************************

//*******************************************************************************
//b_chercher
$("#b_chercher").click(function() {
  
    var s_serv = $('#s_serv').val();
    var s_emp = $('#s_emp').val();
    var date_d = $('#date_d').val();
    var date_f = $('#date_f').val();
    var err = false;
    if(date_d!='' && date_f!=''){
        const d = new Date(date_d);
        const f = new Date(date_f);
        if(d > f){err = true;}
        
    }
 
    if(err){
        $("#div_err").html("<b>Date début doit être inférieure à date fin</b>");
    }else{
        $("#div_err").html("");
    //**************************************************************************
    var ch = "";
    ch += "<h4>";
    if(s_serv=="t"){
    ch += "Tous les services";
    }else{ch += "Service : "+$( "#s_serv option:selected" ).text();}
    ch += " / ";
    if(s_emp=="t"){
    ch += "Tous les employés";
    }else{ch += "Employé : "+$( "#s_emp option:selected" ).text();}
    ch += "</h4>";
    ch += "<h4>";
    if(date_d!='' && date_f!=''){ch += date_d+" >>>>>> "+date_f;}
    else if(date_d!=''){ch += date_d+" >>>>>> ";} 
        else if(date_f!=''){ch += " >>>>>> "+date_f;}
    ch += "</h4>";
    ch += "";
    $("#div_ree_title").html(ch);
    //**************************************************************************
         $.ajax({
        url: localStorage.getItem("base_url")+'Sdl_WS/satisfaction/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({s: s_serv, e: s_emp, dd: date_d, df: date_f}),
        success: function (data) {
        var arr = data;
        var nb_t = arr[0].nb_t;
        var nb_nd = arr[0].nb_nd;
        var nb_s = arr[0].nb_s;
        var nb_ns = arr[0].nb_ns;
       
        //***********************************************************************
        const data1 = {
  labels: [
    'Propriétaire non déclaré',
    'Propriétaire non satisfait',
    'Propriétaire satisfait'
  ],
  datasets: [{
    label: 'TAUX DE SATISFACTION',
    data: [nb_nd, nb_ns, nb_s],
    backgroundColor: [
      'rgb(211,211,211)',
      'rgb(255, 99, 132)',
      'rgb(50,205,50)'
    ],
    hoverOffset: 4
  }]
};
        var ch = '<canvas id="chart_mm" style="height:10px; width:20px"></canvas>';
        $("#row_conv").html(ch);
var chart_mm = new Chart(document.getElementById("chart_mm"), {
    type: 'pie',
    data: data1,
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: ''
      }
    }
});
//************************************************************************
          
 
   },
        error: function() {
            // J'affiche un message d'erreur 
        }

    });
    //**************************************************************************
    }
});
//*******************************************************************************

 $('#s_serv').on('change', function() {
            var s = $('#s_serv').val();
            
            $('#s_emp').html('');
            $('#s_emp').append('<option value="t">Tous les employés</option>');

     $.ajax({
        url: localStorage.getItem("base_url")+'/Sdl_WS/employees_by_service/' ,
        timeout: 4000,
        type: "POST",
      dataType:'json', 
      data: ({s: s}),
        success: function (data) {

          var arr = data;
          for (var i = 0 ; i < arr.length; i++) {
            id = arr[i].id;
            nom = arr[i].nom;
            prenom = arr[i].prenom;
            $('#s_emp').append('<option value="'+id+'">'+nom+' '+prenom+'</option>');
          }
 
   },
        error: function() {
            // J'affiche un message d'erreur 
        }

    });

  });
//*****************************************************


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