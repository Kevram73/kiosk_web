

var produitTable;
var venteTable;

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

$('#categorie').on('change',function ( ) {
    $.ajax({
        url: '/recupererproduit-' + $('#categorie').val(),
        type: "get",
        success: function (data) {
            $('#famille').empty();
            $('#famille').append('<option value=""></option>')

            for (var i = 0; i < data.length; i++) {

                $('#famille').append('<option value="'+data[i].id+'">'+data[i].nom+'</option>')
            }

        },
        error: function (data) {
            console.log("erreur")
        },
    })
})

$(function () {
    produitTable =   $('#produitTable').DataTable({
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

        ajax: '/allservice',
        "columns": [
            {data: "libelle",name : 'libelle'},
            {data: "prix",name : 'prix'},
            {data: "action", name : 'action' , orderable: false, searchable: false}
        ]

    });


});
$('#btnproduit').on('click', function(){

    $('.modal-title-user').text('ENREGISTREMENT DU SERVICE');
    $('#idservice').val(null);
    $('#btnadd').text('Valider');
    $('#btnadd').removeClass('btn-warning');
    $('#btnadd').addClass('btn-primary');
    $('#libelle').val(null);
    $('#prix').val(null);
    $('#ajout_produit').modal('show');
});

//post des données
$('#ajout_produit  form').on('submit', function (e) {

    let url,message;
    if (!$('#idservice').val()){
        url = '/ajoutservice'
        message = 'modele enregistré'

    }
    else{
        url = '/updateservice'
        message = 'modele modifié'

    }
    e.preventDefault();
    if (e.isDefaultPrevented()){
        $.ajax({
            url : url ,
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#ajout_produit form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {

                sweetToast('success',message);

                $('#ajout_produit').modal('hide');

                produitTable.ajax.reload();
            },
            error : function(data){
                alert('erreur')
            }
        });
    }



});


function showmodele(id){

let message;
    $.ajax({
        url: '/showservice-'+id,
        type: "get",
        success : function(data) {
            $('#modal-user-title').text('SERVICE : '+ data.libelle);
            $('#sNum').text(data.numero)
            $('#sModele').text(data.libelle);
            $('#sPrix').text(data.prix);
            $('#sCreate').text(data.created_at);
            $('#sUpdate').text(data.updated_at);
            $('#detailproduit').modal('show');

            $('#venteTable').DataTable().destroy()

                venteTable =   $('#venteTable').DataTable({
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

                    ajax: '/allmodelevente-'+id,
                    "columns": [
                        {data: "user",name : 'user'},
                        {data: "date",name : 'date'},
                        {data: "quantite",name : 'quantite'},
                        {data: "montant",name : 'montant'},
                        {data: "numero",name : 'numero'},
                    ]
                });

        },
        error : function(data){
            message='Une erreur est produite. Veuillez recommancer';
            sweetToast('warning',message);
        }
    })
}
function editmodele(id){
    $.ajax({
        url : '/showservice-'+id,
        type : "get",
        success : function(data) {

            $('#idservice').val(data.id);
            $('#btnadd').text('Modifier');
            $('#btnadd').removeClass('btn-primary');
            $('#btnadd').addClass('btn-warning');
            $('.modal-title-user').text('Modifier les informations de : '+data.nom);
            $('#libelle').val(data.libelle);
            $('#prix').val(data.prix);
            $('#ajout_produit').modal('show');

        },
        error : function(data){
            alert('erreur')
        }
    });
}

function deletemodele(id){
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
                url : '/deleteservice-'+id,
                type : "get",

                contentType: false,
                processData: false,
                success : function(data) {

                    produitTable.ajax.reload();

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

