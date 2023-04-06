
function unlock_tag(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var uid = res[1];

    $("#div_deblocage_tag").html("<h2>"+uid+"</h2>");
    $("#id_deblocage_tag").val(id);
    $("#deblocagetagModal").modal("show");
}
function lock_tag(id) {
    // body...
    var res = id.split("/////");
    var id = res[0];
    var uid = res[1];

    $("#div_blocage_tag").html("<h2>"+uid+"</h2>");
    $("#id_blocage_tag").val(id);
    $("#blocagetagModal").modal("show");
}


$( document ).ready(function() {
//****************** debut *******************************

//**************************************************************
//**************************************************************

//******************* fin ********************************
    });