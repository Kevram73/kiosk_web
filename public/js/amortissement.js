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

var amorTable;



$(function () {

    amorTable =   $('#amorTable').DataTable({
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

        ajax: '/allamor',
        "columns": [

            {data: "libelle",name : 'libelle'},
            {data: "taux",name: 'taux'},
            {data :  "duree_vie",name : 'duree_vie'},
            {data: "action", name : 'action' , orderable: false, searchable: false}


        ]

    });


});
$('#btnamor').on('click', function(){

    $('.modal-title-user').text('ENREGISTREMENT');
    $('#idamor').val(null);
    $('#libelle').val(null);
    $('#btnadd').text('Valider');
    $('#btnadd').removeClass('btn-warning');
    $('#btnadd').addClass('btn-primary');
    $('#taux').val(null);
    $('#vie').val(null);;
    $('#ajout_amor').modal('show');
});

//post des données
$('#ajout_amor  form').on('submit', function (e) {

    let url,message;
    if (!$('#idamor').val()){
        url = '/ajoutamor'
        message = 'Amortissement enregistré'


    }
    else{
        url = '/updateamor'
        message = 'Amortissement modifié'

    }
    e.preventDefault();
    if (e.isDefaultPrevented()){
        $.ajax({
            url : url ,
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#ajout_amor form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {

                $('#ajout_amor').modal('hide');
                sweetToast('success',message);

               amorTable.ajax.reload();
            },
            error : function(data){
              alert('erreur')
            }
        });
    }
});



function editamor(id){
    $.ajax({
        url : '/showamor-'+id,
        type : "get",
        success : function(data) {

            $('#idamor').val(data.id);
            $('#libelle').val(data.libelle);
            $('#btnadd').text('Modifier');
            $('#btnadd').removeClass('btn-primary');
            $('#btnadd').addClass('btn-warning');
            $('.modal-title-user').text('Modifier les informations ');
            $('#taux').val(data.taux);
            $('#vie').val(data.duree_vie);
            $('#ajout_amor').modal('show');

        },
        error : function(data){
alert('erreur')
        }
    });
}

function deleteamor(id){
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
                url : '/deleteamor-'+id,
                type : "get",

                contentType: false,
                processData: false,
                success : function(data) {

                    amorTable.ajax.reload();

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

