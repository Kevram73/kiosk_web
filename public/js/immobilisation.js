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

var immoTable;



$(function () {

    immoTable =   $('#immoTable').DataTable({
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

        ajax: '/allimmo',
        "columns": [

            {data: "libelle",name : 'libelle'},
            {data: "montant",name: 'montant'},
            {data :  "date",name : 'date'},
            {data :  "amor",name : 'amor'},
            {data: "action", name : 'action' , orderable: false, searchable: false}


        ]

    });


});
$('#btnimmo').on('click', function(){

    $('.modal-title-user').text('ENREGISTREMENT');
    $('#idimmo').val(null);
    $('#libelle').val(null);
    $('#btnadd').text('Valider');
    $('#btnadd').removeClass('btn-warning');
    $('#btnadd').addClass('btn-primary');
    $('#montant').val(null);
    $('#dateacqui').val(null);
    $('#type').val(null);
    $('#ajout_immo').modal('show');
});

//post des données
$('#ajout_immo  form').on('submit', function (e) {

    let url,message;
    if (!$('#idimmo').val()){
        url = '/ajoutimmo'
        message = 'Immobilisation enregistré'


    }
    else{
        url = '/updateimmo'
        message = 'Immobilisation modifié'

    }
    e.preventDefault();
    if (e.isDefaultPrevented()){
        $.ajax({
            url : url ,
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#ajout_immo form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {

                $('#ajout_immo').modal('hide');
                sweetToast('success',message);

               immoTable.ajax.reload();
            },
            error : function(data){
              alert('erreur')
            }
        });
    }
});

function showimmo(id){

    $.ajax({
        url: '/detailimmo-'+id,
        type: "get",
        success : function(data) {
            $('#modal-user-title').text('ARTICLE : '+data.immo[0].libelle);
            $('#sLibelle').text(data.immo[0].libelle);
            $('#sMontant').text(data.immo[0].montant);
            $('#sType').text(data.immo[0].amor);
            $('#sTaux').text(data.immo[0].taux);
            $('#sDuree').text(data.immo[0].vie);
            $('#sDate').text(data.immo[0].date);
            $('#sExpire').text(data.expire);
            $('#sCreate').text(data.immo[0].created_at);
            $('#sUpdate').text(data.immo[0].updated_at);
            $('#detailimmo').modal('show');



        },
        error : function(data){
            sweetToast('Une erreur c\'est produite. Veuillez recommancer')
        }
    })
}

function editimmo(id){
    $.ajax({
        url : '/showimmo-'+id,
        type : "get",
        success : function(data) {

            $('#idimmo').val(data.id);
            $('#libelle').val(data.libelle);
            $('#btnadd').text('Modifier');
            $('#btnadd').removeClass('btn-primary');
            $('#btnadd').addClass('btn-warning');
            $('.modal-title-user').text('Modifier les informations ');
            $('#montant').val(data.montant);
            $('#dateacqui').val(data.date);
            $('#type').val(data.amortissement_id);
            $('#ajout_immo').modal('show');

        },
        error : function(data){
alert('erreur')
        }
    });
}

function deleteimmo(id){
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
                url : '/deleteimmo-'+id,
                type : "get",

                contentType: false,
                processData: false,
                success : function(data) {

                    immoTable.ajax.reload();

                },
                error : function(data){
                    alert('erreur delete')
                }
            });
            Swal.fire('Effacé',
                'Fichier bien effacé',
                'success')
        }
    });
}

