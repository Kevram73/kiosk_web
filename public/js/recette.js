function sweetToast(type,text){
    return  Swal.fire({
        position: 'top-end',
        icon: type,
        title: text,
        showConfirmButton: false,
        timer: 2000,
        animation : true,
    });
}

var clientTable;



$(function () {

    clientTable =   $('#clientTable').DataTable({
        processing: true,
        serverSide: true,
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
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
            "sPrint": "Imprimer",
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

        ajax: '/recetteslist',
        "columns": [
            {data: "fournisseur",name : 'fournisseur'},
            {data: "type",name: 'type'},
            {data :  "montant",name : 'montant'},
            {data :  "created_at",name : 'created_at'},
            {data :  "observation",name : 'observation'},
            {data: "action", name : 'action' , orderable: false, searchable: false}
        ]
    });


});
$('#btnclient').on('click', function(){

    $('.modal-title-user').text("ENREGISTREMENT D'UNE RECETTE");
    $('#recette_id').val(null);
    $('#montant').val(null);
    $('#observation').val(null);
    $('#btnadd').text('Valider');
    $('#btnadd').removeClass('btn-warning');
    $('#btnadd').addClass('btn-primary');
    $('#ajout_client').modal('show');
});

//post des données
$('#ajout_client  form').on('submit', function (e) {
    var id = $('#recette_id').val();
    let url,message;
    if (!$('#recette_id').val()){
        url = '/recettestore'
        message = 'Recette enregistré'


    }
    else{
        url = '/recetteupdate-'+id;
        message = 'Recette modifié'

    }
    e.preventDefault();
    if (e.isDefaultPrevented()){
        $.ajax({
            url : url ,
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#ajout_client form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {

                $('#ajout_client').modal('hide');
                sweetToast('success',message);

               clientTable.ajax.reload();
            },
            error : function(data){
              alert('erreur')
            }
        });
    }
});


function showclt(id){

    $.ajax({
        url: '/recettesshow-'+id,
        type: "get",
        success : function(data) {
            $('#modal-user-title').text('RECCETE : '+data.montant);
            $('#sId').text(data.id);
            $('#sNom').text(data.montant);
            $('#sPrenom').text(data.fournisseur);
            $('#sEmail').text(data.type);
            $('#sContact').text(data.observation);
            $('#sCreate').text(data.created_at);
            $('#sUpdate').text(data.updated_at);
            $('#detailClient').modal('show');
        },
        error : function(data){
            sweetToast('Une erreur c\'est produite. Veuillez recommancer')
        }
    })
}
function editclt(id){
    $.ajax({
        url : '/recettesshow-'+id,
        type : "get",
        success : function(data) {

            $('#recette_id').val(data.id);
            $('#nom').val(data.nom);
            $('#montant').val(data.montant);
            $('#observation').val(data.observation);
            $('#fournisseur').val(data.fournisseur_id);
            $('#type').val(data.type_id);
            $('#btnadd').text('Modifier');
            $('#btnadd').removeClass('btn-primary');
            $('#btnadd').addClass('btn-warning');
            $('.modal-title-user').text('Modifier les informations de : '+data.montant);
            $('#ajout_client').modal('show');

        },
        error : function(data){
alert('erreur')
        }
    });
}

function deleteclt(id){

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
                url : '/recettedelete-'+id,
                type : "get",

                contentType: false,
                processData: false,
                success : function(data) {

               console.log(data)

                    clientTable.ajax.reload();
                    Swal.fire('Effacé',
                    'Recette supprimé',
                    'success');

                },
                error : function(data){
                    console.log(data)
                    Swal.fire('Effacé',
                    'Erreur lors de la suppression',
                    'danger');
                }
            });

        }
    });
}
