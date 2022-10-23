


function showUser(id) {

    $.ajax({
        url: '/showUser-'+id,
        type: "get",
        success : function(data) {
            $('#modal-user-title').text('Utilisateur : '+data.user.nom+' '+data.user.prenom);
            $('#sProfil').text(data.profil.name);
             $('#sNom_Prenom').text(data.user.nom+' '+data.user.prenom);
             if(data.user.sexe ===  'M'){
                 $('#sSexe').text('Masculin');
             }else if(data.user.sexe === 'F'){
                 $('#sSexe').text('Féminin');
             }
            $('#sEmail').text(data.user.email);
            $('#sContact').text(data.user.contact);

            $('#detailUser').modal('show');



        },
        error : function(data){
        }
    })

}
$('#change').on('click', function() {
    $('#ancien').val(null);
    $('#nouveau').val(null);
    $('#modal-form-user').modal('show');
});
    $('#modal-form-user form').on('submit', function (e) {
        let url,message;

            url = '/changement'
            message = 'Mot de passe changé'
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
                    $('#modal-form-user').modal('hide');
                    sweetToast('success',message);

                },
                error : function(data){
                }
            });
        }



    });

