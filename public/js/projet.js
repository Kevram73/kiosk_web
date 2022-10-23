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

$('#btnhistorique').on('click',function (e) {
    window.location='/historiquedivers'
});

var chargeTable;




$(function () {

    chargeTable =   $('#chargeTable').DataTable({
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

        ajax: '/allprojet',
        "columns": [

            {data: "name",name : 'name'},
            {data: "debut",name : 'debut'},
            {data: "fin",name : 'fin'},
            {data: "action", name : 'action' , orderable: false, searchable: false}
        ]

    });
});

$('#btncharge').on('click', function(){

    $('.modal-title-user').text('ENREGISTREMENT DU PROJET');
    $('#idcharge').val(null);
    $('#name').val(null);
    $('#btnadd').text('Valider');
    $('#btnadd').removeClass('btn-warning');
    $('#btnadd').addClass('btn-primary');

    $('#ajout_charge').modal('show');

});


//post des données
$('#ajout_charge  form').on('submit', function (e) {

    let url,message;
    if (!$('#idcharge').val()){
        url = '/ajoutprojet'
        message = 'Projet enregisetré'


    }
    else{
        url = '/updateprojet'
        message = 'Projet modifiée'

    }
    e.preventDefault();
    if (e.isDefaultPrevented()){
        $.ajax({
            url : url ,
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#ajout_charge form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {

                $('#ajout_charge').modal('hide');
                sweetToast('success',message);

                chargeTable.ajax.reload();
            },
            error : function(data){
                alert('erreur')
            }
        });
    }

});

function editcharge(id){
    $.ajax({
        url : '/showdeprojet-'+id,
        type : "get",
        success : function(data) {

            $('#idcharge').val(data.id);
            $('#name').val(data.name);
            $('#debut').val(data.debut);
            $('#fin').val(data.fin);
            $('#btnadd').text('Modifier');
            $('#btnadd').removeClass('btn-primary');
            $('#btnadd').addClass('btn-warning');
            $('.modal-title-user').text('Modifier les informations');
            $('#ajout_charge').modal('show');

        },
        error : function(data){
            alert('erreur')
        }
    });
}

function deletecharge(id){
    Swal.fire({
        position: 'center',
        title: 'Vous etes sûr',
        text:"Voulez-vous supprimer ce projet ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        confirmButtonText:'Oui effacer'
    }).then ((result)=>{
        if (result.value){
            $.ajax({
                url : '/deleteprojet-'+id,
                type : "get",

                contentType: false,
                processData: false,
                success : function(data) {
                    Swal.fire('Effacé',
                        'Fichier bien effacé',
                        'success')
                    chargeTable.ajax.reload();
                },
                error : function(data){
                    Swal.fire('Impossible',
                        'Projet supprimé',
                        'info')
                }
            });

        }
    });
}

$('#btnjournal').on('click',function (e) {
    $.ajax({
        url : '/fermercharge',
        type : "get",

        contentType: false,
        processData: false,
        success : function(data) {
            if (data==1){
                let message='Journal des charges fermé avec succes'
                sweetToast('success',message);
            }
            else {
                if (data==2) {

                    let message='Impossible.... Ce journal des charges est déja fermé'
                    sweetToast('warning',message);

                }
            }
        },
        error : function(data){
        }
    });

})

