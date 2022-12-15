

var historiqueTable;
function sweetToast(type,text){
    return  Swal.fire({
        position: 'top-end',
        icon: type,
        title: text,
        showConfirmButton: false,
        timer: 1500,
        animation : true,
    });
}



$(function () {

    historiqueTable =   $('#historiqueTable').DataTable({
        processing: true,
        serverSide: true,
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        language: {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher&nbsp;:",
            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix": "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "Pr&eacute;c&eacute;dent",
                "sNext": "Suivant",
                "sLast": "Dernier"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            },
            "select": {
                "rows": {
                    _: "%d lignes séléctionnées",
                    0: "Aucune ligne séléctionnée",
                    1: "1 ligne séléctionnée"
                }
            }
        },
        ajax: '/allhistorique',
        "columns": [

            {data: "actions",name : 'actions'},
            {data: "cible",name : 'cible'},
            {data: "nom",name : 'nom'},
            {data: "prenom",name : 'prenom'},
            {data: "created_at",name : 'created_at'},
            {data: "action", name : 'action' , orderable: false, searchable: false}


        ]

    });
});

function deletehistorique(id){
Swal.fire({
    position: 'center',
    title: 'Vous etes sûr',
    text:"Pas de retour en arriere",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor:'#3085d6',
    cancelButtonColor:'#d33',
    confirmButtonText:'Oui effacer'
}).then ((result)=>{
    if (result.value){
        $.ajax({
            url : '/deletecategorie-'+id,
            type : "get",
            contentType: false,
            processData: false,
            success : function(data) {
                categorieTable.ajax.reload();
            },
            error : function(data){
            }
        });
        Swal.fire('Effacé',
            'Fichier bien effacé',
            'success')
    }
});
}



