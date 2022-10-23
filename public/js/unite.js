

var uniteTable;
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

    uniteTable =   $('#uniteTable').DataTable({
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
        ajax: '/allunite',
        "columns": [

            {data: "libelle",name : 'libelle'},
            {data: "action", name : 'action' , orderable: false, searchable: false}


        ]

    });


});
$('#btnunite').on('click', function(){

    $('.modal-title-user').text('ENREGISTREMENT ');
    $('#idunite').val(null);
    $('#libelle').val(null);
    $('#btnadd').text('Valider');
    $('#btnadd').removeClass('btn-warning');
    $('#btnadd').addClass('btn-primary');
    $('#ajout_unite').modal('show');
});

//post des données
$('#ajout_unite  form').on('submit', function (e) {

    let url,message;
    if (!$('#idunite').val()){
        url = '/ajoutunite'
        message = 'unité enregistrée'

    }
    else{
        url = '/updateunite'
        message = 'unité modifiée'

    }
    e.preventDefault();
    if (e.isDefaultPrevented()){
        $.ajax({
            url : url ,
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#ajout_unite form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {
                sweetToast('success',message);

                $('#ajout_unite').modal('hide');

                uniteTable.ajax.reload();
            },
            error : function(data){
              alert('erreur')
            }
        });
    }



});


function show(id){

    $.ajax({
        url: '/showunite-'+id,
        type: "get",
        success : function(data) {
            $('#modal-user-title').text('UNITE : '+data.libelle);
            $('#sLibelle').text(data.libelle);
            $('#Create').text(data.created_at);
            $('#Update').text(data.updated_at);
            $('#detailunite').modal('show');



        },
        error : function(data){
            sweetToast('Une erreur c\'est produite. Veuillez recommancer')
        }
    })
}
function edit(id){
    $.ajax({
        url : '/showunite-'+id,
        type : "get",
        success : function(data) {

            $('#idunite').val(data.id);
            $('#libelle').val(data.libelle);
            $('#btnadd').text('Modifier');
            $('#btnadd').removeClass('btn-primary');
            $('#btnadd').addClass('btn-warning');
            $('.modal-title-user').text('Modifier les informations de : '+data.libelle);
            $('#ajout_unite').modal('show');

        },
        error : function(data){
alert('erreur')
        }
    });
}

function deleteunite(id){
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
                url : '/deleteunite-'+id,
                type : "get",
                contentType: false,
                processData: false,
                success : function(data) {
                    console.log(data)
                    uniteTable.ajax.reload();
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

