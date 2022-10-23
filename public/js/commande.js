$('#credit').on('click', function(){

    $('.modal-title-user').text('LISTE DES CREANCIERS');
    $('#infocredit').modal('show');
});
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

var provisionTable;




$(function () {

    provisionTable =   $('#provisionTable').DataTable({
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
        "order": [[ 0, "desc" ]],
        ajax: '/allcommande',
        "columns": [

            {data: "numero",name : 'numero'},
            {data: "date_commande",name : 'date_commande'},
            {data: "action", name : 'action' , orderable: false, searchable: false}


        ]

    });
});




//post des données

function show(id){

    $.ajax({
        url: '/showcommande-'+id,
        type: "get",
        success : function(data) {

         window.location='/detailcommande-'+id

        },
        error : function(data){
            sweetToast('Une erreur c\'est produite. Veuillez recommancer')
        }
    })
}


function deletepro(id){
    Swal.fire({
        position: 'center',
        title: 'Vous etes sûr',
        text:"Les produits enregistrés sur la commande seront supprimé aussi",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        confirmButtonText:'Oui effacer'
    }).then ((result)=>{
        if (result.value){
            $.ajax({
                url : '/deletecommande-'+id,
                type : "get",

                contentType: false,
                processData: false,
                success : function(data) {
                    Swal.fire('Effacé',
                        'Fichier bien effacé',
                        'success')
                    provisionTable.ajax.reload();
                },
                error : function(data){
                    Swal.fire('Impossible',
                        'Cette commande a été deja livrée',
                        'info')
                }
            });

        }
    });
}

$('#btnjournalachat').on('click',function (e) {
    $.ajax({
        url : '/fermer_achat',
        type : "get",

        contentType: false,
        processData: false,
        success : function(data) {
            if (data==1){
                let message='Journal des achats fermé avec succes'
                sweetToast('success',message);
            }
            else {
                if (data==2) {

                    let message='Impossible.... Ce journal des achats est déja fermé'
                    sweetToast('warning',message);

                }
            }
        },
        error : function(data){
        }
    });

})
$('#btnhistorique').on('click',function (e) {
    window.location='/historiqueachat'
});

$('#btncommandedirecte').on('click',function (e) {
    $.ajax({
        url : '/verificationachat',
        type : "get",

        contentType: false,
        processData: false,
        success : function(data) {
            if (data==1  || data==2){
                Swal.fire({
                    position: 'center',
                    title: 'Voulez-vous creer un journal des achats?',
                    text:"",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor:'#3085d6',
                    cancelButtonColor:'#d33',
                    confirmButtonText:'Oui '
                }).then ((result)=>{
                    if (result.value){
                        $.ajax({
                            url : '/journalachat',
                            type : "get",

                        });

                        Swal.fire('Effectué',
                            'Journal des achats bien enregistré')
                        window.location='/newcommande'
                    }
                });
            }
            else {
                if (data==3) {

                    window.location='/newcommande'

                }
            }
        },
        error : function(data){
            Swal.fire('Impossible',

                'info')
        }
    });

})



$('#btncommandeindirecte').on('click',function (e) {
    $.ajax({
        url : '/verificationachat',
        type : "get",

        contentType: false,
        processData: false,
        success : function(data) {
            if (data==2  || data==1){
                Swal.fire({
                    position: 'center',
                    title: 'Voulez-vous creer un journal des achats?',
                    text:"",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor:'#3085d6',
                    cancelButtonColor:'#d33',
                    confirmButtonText:'Oui '
                }).then ((result)=>{
                    if (result.value){
                        $.ajax({
                            url : '/journalachat',
                            type : "get",

                        });

                        Swal.fire('Effectué',
                            'Journal des achats bien enregistré')
                        window.location='/newcommande2'
                    }
                });
            }
            else {
                if (data==3) {

                    window.location='/newcommande2'

                }
            }

        },
        error : function(data){
            Swal.fire(' Action impossible',
                'info')
        }
    });

})
