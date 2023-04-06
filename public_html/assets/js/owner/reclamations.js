


$( document ).ready(function() {
//****************** debut *******************************


init_dynamic_table();
function init_dynamic_table() {
                    //initiate dataTables plugin
                    
                $('#dynamic-table').DataTable( {

                    bAutoWidth: false,
                    
                    "aaSorting": [],
                    "language": {
                  "decimal":        "",
    "emptyTable":     "aucune donnée disponible",
    "info":           "Affichage _START_ à _END_ des entrées de _TOTAL_",
    "infoEmpty":      "Affichage 0 à 0 de 0 entrées",
    "infoFiltered":   "(filtré _MAX_ entrées totales)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Afficher  _MENU_  Entrées",
    "loadingRecords": "Chargement...",
    "processing":     "En traitement...",
    "search":         "Recherche : ",
    "zeroRecords":    "Aucun enregistrements correspondants trouvés",
    "paginate": {
        "first":      "Premier",
        "last":       "Dernier",
        "next":       "Suivant",
        "previous":   "Précédent"
    },
    "aria": {
        "sortAscending":  ": activer pour trier la colonne ascendante",
        "sortDescending": ": activer pour trier la colonne descendante"
    }
    },
            
            
                    select: {
                        style: 'multi'
                    }
                } );
                    
}



    

//*********************************************************************
$("#b_nouvelle_reclam").click(function() {
    $("#reclamationModal").modal("show");
});
//**********************************************************************

//**********************************************************************



//*********************************************************************

//******************************** fin ********************************
    });



