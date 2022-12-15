

var produitTable;
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

        ajax: '/allproduit',
        "columns": [
            {data :  "categorie.nom",name : 'categorie_id'},
            {data: "nom",name : 'nom'},
            {data: "action", name : 'action' , orderable: false, searchable: false}


        ]

    });


});
$('#btnproduit').on('click', function(){
    $.ajax({
        url: '/recuperercategorie',
        type: "get",
        success: function (data) {
            $('#categories').empty();
            $('#categories').append('<option value=""></option>')
            for (var i = 0; i < data.length; i++) {
                $('#categories').append('<option value="'+data[i].id+'">'+data[i].nom+'</option>')
            }

        },
        error: function (data) {
            console.log("erreur")
        },
    })
    $('.modal-title-user').text('ENREGISTREMENT DU PRODUIT');
    $('#idproduit').val(null);
    $('#noms').val(null);
    $('#btnadd').text('Valider');
    $('#btnadd').removeClass('btn-warning');
    $('#btnadd').addClass('btn-primary');
    $('#ajout_produit').modal('show');
});

//post des données
$('#ajout_produit  form').on('submit', function (e) {

    let url,message;
    if (!$('#idproduit').val()){
        url = '/ajoutproduit'
        message = 'produit enregistré'

    }
    else{
        url = '/updateproduit'
        message = 'produit modifié'

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


function showproduit(id){

    $.ajax({
        url: '/showproduit-'+id,
        type: "get",
        success : function(data) {
            $('#modal-user-title').text('PRODUIT : '+data.nom);
            $('#sNumero').text(data.numero);
            $('#sNomP').text(data.nom);
            $('#sCategorie').text(data.categorie.nom);
            $('#Create').text(data.created_at);
            $('#Update').text(data.updated_at);
            $('#detailproduit').modal('show');



        },
        error : function(data){
            sweetToast('Une erreur c\'est produite. Veuillez recommancer')
        }
    })
}
function editproduit(id){
    $.ajax({
        url : '/showproduit-'+id,
        type : "get",
        success : function(data) {

            $('#idproduit').val(data.id);
            $('#noms').val(data.nom);
            $('#categories').val(data.categorie_id);
            $('#btnadd').text('Modifier');
            $('#btnadd').removeClass('btn-primary');
            $('#btnadd').addClass('btn-warning');
            $('.modal-title-user').text('Modifier les informations de : '+data.nom);
            $('#ajout_produit').modal('show');

        },
        error : function(data){
alert('erreur')
        }
    });
}

function deleteproduit(id){
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
                url : '/deleteproduit-'+id,
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

