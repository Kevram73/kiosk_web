

var fournisseurTable;
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

    fournisseurTable =   $('#fournisseurTable').DataTable({
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
        ajax: '/allfournisseur',
        "columns": [

            {data: "nom",name : 'nom'},
            {data: "adresse",name: 'adresse'},
            {data :  "email",name : 'email'},
            {data :  "contact",name : 'contact'},
            {data :  "description",name : 'description'},
            {data: "action", name : 'action' , orderable: false, searchable: false}


        ]

    });


});
$('#btnfournisseur').on('click', function(){

    $('.modal-title-user').text('ENREGISTREMENT DU FOURNISSEUR');
    $('#btnadd').text('Valider');
    $('#btnadd').removeClass('btn-warning');
    $('#btnadd').addClass('btn-primary');
    $('#idfournisseur').val(null);
    $('#nom').val(null);
    $('#adresse').val(null);
    $('#email').val(null);
    $('#contact').val(null);
    $('#description').val(null);
    $('#ajout_fournisseur').modal('show');
});

//post des données
$('#ajout_fournisseur form').on('submit', function (e) {

    let url,message;
    if (!$('#idfournisseur').val()){
        url = '/ajoutfournisseur'
        message = 'Fournisseur enregistré'


    }
    else{
        url = '/updatefournisseur'
        message = 'Fournisseur enregistré'


    }
    e.preventDefault();
    if (e.isDefaultPrevented()){
        $.ajax({
            url : url ,
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#ajout_fournisseur form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {
                sweetToast('success',message);

                $('#ajout_fournisseur').modal('hide');

              fournisseurTable.ajax.reload();
            },
            error : function(data){
              alert('erreur')
            }
        });
    }

});


function showfournisseur(id){

    $.ajax({
        url: '/showfournisseur-'+id,
        type: "get",
        success : function(data) {
            $('#modal-user-title').text('FOURNISSEUR : '+data.nom);
            $('#sId').text(data.id);
            $('#sNom').text(data.nom);
            $('#sAdresse').text(data.adresse);
            $('#sEmail').text(data.email);
            $('#sContact').text(data.contact);
            $('#sDescription').text(data.description);
            $('#sCreate').text(data.created_at);
            $('#sUpdate').text(data.updated_at);
            $('#detailfournisseur').modal('show');



        },
        error : function(data){
            sweetToast('Une erreur c\'est produite. Veuillez recommancer')
        }
    })
}

function editfournisseur(id){
    $.ajax({
        url : '/showfournisseur-'+id,
        type : "get",
        success : function(data) {

            $('#idfournisseur').val(data.id);
            $('#nom').val(data.nom);
            $('#btnadd').text('Modifier');
            $('#btnadd').removeClass('btn-primary');
            $('#btnadd').addClass('btn-warning');
            $('.modal-title-user').text('Modifier les informations de : '+data.nom);
            $('#adresse').val(data.adresse);
            $('#email').val(data.email);
            $('#contact').val(data.contact);
            $('#description').val(data.description);
            $('#ajout_fournisseur').modal('show');

        },
        error : function(data){
alert('erreur')
        }
    });
}


function deletefournisseur(id){
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
                url : '/deletefournisseur-'+id,
                type : "get",

                contentType: false,
                processData: false,
                success : function(data) {

                    console.log(data)

                    fournisseurTable.ajax.reload();

                },
                error : function(data){
                    console.log(data)
                }
            });
            Swal.fire('Effacé',
                'Fichier bien effacé',
                'success')
        }
    });
}

$('#info').on('click', function(){

    $('.modal-title-user').text('LISTE DES PRODUITS A APPROVISIONNER');
    $('#infoproduit').modal('show');
});
$('#credit').on('click', function(){

    $('.modal-title-user').text('LISTE DES CREANCIERS');
    $('#infocredit').modal('show');
});
