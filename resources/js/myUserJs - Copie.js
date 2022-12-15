

let userTable;

function sweetToast(type,text){
    return  Swal.fire({
        position: 'top-end',

        icon: type,
        title: text,
        showConfirmButton: false,
        toast : true,
        timer: 3000,
        animation : true
    });
}

$(function () {
    $('[data-mask]').inputmask();
    userTable =   $('#userTable').DataTable({
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
        ajax: '/admin/allUsers',
        "columns": [
            {data: "#", name : "#", orderable: false, searchable: false},
            {data: 'id',name : 'id'},
            {data: "nom",name : 'nom'},
            {data: "prenom",name: 'prenom'},
            {data :  "sexe",name : 'sexe'},
            {data: "username", name : 'username'},
            {data: "action", name : 'action' , orderable: false, searchable: false}
        ]

    });




});



$('#addUser').on('click', function(){

        $('.modal-title-user').text('Enregistrer un nouvel utilisateur');
        $('#store-user').text('Enregistrer');
        $('#modal-form-user').modal('show');
});
//post des données
$('#modal-form-user form').on('submit', function (e) {
    let url,message;
    if (!$('#id').val()){
        url = '/admin/PostUsers'
        message = 'Utilisateur enregistrer'
    }
    else{
        url = '/admin/editUser'
        message = 'Utilisateur modifier'
    }
    e.preventDefault();
    if (e.isDefaultPrevented()){
        $.ajax({
            url : url ,
            type : "post",
           // data : $('#modal-form-user').serialize(),
            data: new FormData($("#modal-form-user form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {

                sweetToast('success',message);


                $('#modal-form-user').modal('hide');



                userTable.ajax.reload();
            },
            error : function(data){
                sweetToast('error','Une erreur c\'est produite');
            }
        });
    }



});

function showUser(id) {

    $.ajax({
        url: '/admin/showUser-'+id,
        type: "get",
        success : function(data) {
            $('#modal-user-title').text('Utilisateur : '+data.user.nom+' '+data.user.prenom);
            $('#sId').text(data.user.id);
             $('#sNom_Prenom').text(data.user.nom+' '+data.user.prenom);
            let source = 'assets/template_admin/dist/img/user/'+data.user.avatar;
            $('#sTof').attr( 'src', source);
             if(data.user.sexe ===  'M'){
                 $('#sSexe').text('Masculin');
             }else if(data.user.sexe === 'F'){
                 $('#sSexe').text('Féminin');
             }
            $('#sUsername').text(data.user.username);
            $('#sEmail').text(data.user.email);
            $('#sContact').text(data.user.contact);
            $('#sCreate').text(data.user.created_at);
            $('#sUpdate').text(data.user.updated_at);
            $('#single-data-user').modal('show');



        },
        error : function(data){
            sweetToast('Une erreur c\'est produite. Veuillez recommancer')
        }
    })

}
function editUser(id) {


    $.ajax({
        url : '/admin/showUser-'+id,
        type : "get",
        success : function(data) {
            $('#id').val(data.user.id);
            $('#nom').val(data.user.nom);
            $('#store-user').text('Modifier');
            $('#store-user').removeClass('btn-primary');
            $('#store-user').addClass('btn-warning');
            $('.modal-title-user').text('Modifier les informations de : '+data.user.nom+' '+data.user.prenom);
            $('#prenom').val(data.user.prenom);
            $('#username').val(data.user.username);
            $('#email').val(data.user.email);
            $('#contact').val(data.user.contact);
            $('#profil').val(data.profil.role_id);
            $('#sexe').val(data.user.sexe);
            $('#modal-form-user').modal('show');

        },
        error : function(data){
            sweetToast('Une erreur c\'est produite. Veuillez recommancer')
        }
    });
}

function changeState(id){
    $.ajax({
        url : '/admin/changeUserState-'+id,
        type : "get",
        success : function(data) {

               sweetToast('success','Utilisateur bloqué');

            userTable.ajax.reload();

        },
        error : function(data){
            sweetToast('error','Une erreur c\'est produite');
        }
    });
}
