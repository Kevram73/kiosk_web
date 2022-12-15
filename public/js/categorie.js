

var categorieTable;
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

    categorieTable =   $('#categorieTable').DataTable({
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
        ajax: '/allcategorie',
        "columns": [

            {data: "nom",name : 'nom'},
            {data: "description",name : 'description'},
            {data: "action", name : 'action' , orderable: false, searchable: false}


        ]

    });


});
$('#btncategorie').on('click', function(){

    $('.modal-title-user').text('ENREGISTREMENT DE LA CATEGORIE');
    $('#idcategorie').val(null);
    $('#nom').val(null);
    $('#description').val(null);
    $('#btnadd').text('Valider');
    $('#btnadd').removeClass('btn-warning');
    $('#btnadd').addClass('btn-primary');
    $('#ajout_categorie').modal('show');
});

//post des données
$('#ajout_categorie  form').on('submit', function (e) {

    let url,message;
    if (!$('#idcategorie').val()){
        url = '/ajoutcategorie'
        message = 'categorie enregistrée'


    }
    else{
        url = '/updatecategorie'
        message = 'categorie modifiée'


    }
    e.preventDefault();
    if (e.isDefaultPrevented()){
        $.ajax({
            url : url ,
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#ajout_categorie form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {

                sweetToast('success',message);


                $('#ajout_categorie').modal('hide');

                categorieTable.ajax.reload();
            },
            error : function(data){
                message = 'Erreur dans la sauvegarde de la categorie '
                sweetToast('warning',message);
            }
        });
    }



});


function showcategorie(id){

    $.ajax({
        url: '/showcategorie-'+id,
        type: "get",
        success : function(data) {
            $('#modal-user-title').text('CATEGORIE : '+data.nom);
            $('#sNom').text(data.nom);
            $('#sDescription').text(data.description);
            $('#sCreate').text(data.created_at);
            $('#sUpdate').text(data.updated_at);
            $('#detailcategorie').modal('show');



        },
        error : function(data){
            sweetToast('Une erreur c\'est produite. Veuillez recommancer')
        }
    })
}
function editcategorie(id){
    $.ajax({
        url : '/showcategorie-'+id,
        type : "get",
        success : function(data) {

            $('#idcategorie').val(data.id);
            $('#nom').val(data.nom);
            $('#description').val(data.description);
            $('#btnadd').text('Modifier');
            $('#btnadd').removeClass('btn-primary');
            $('#btnadd').addClass('btn-warning');
            $('.modal-title-user').text('Modifier les informations de : '+data.nom);
            $('#ajout_categorie').modal('show');

        },
        error : function(data){
alert('erreur')
        }
    });
}
function deletecategorie(id){
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
                Swal.fire('Effacé',
                    'Fichier bien effacé',
                    'success')
            },
            error : function(data){
            }
        });

    }
});
}



