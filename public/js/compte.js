



//post des données
$('#modal-form-user form').on('submit', function (e) {
    e.preventDefault();
    if (e.isDefaultPrevented()){
        $.ajax({
            url : '/updateUser2',
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#modal-form-user form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {
                $('#modal-form-user').modal('hide');
                window.location='/compte'                },
            error : function(data){
            }
        });
    }



});


function editUser() {
    $('.modal-title-user').text('Modification du mot de passe');
    $('#modal-form-user').modal('show');
}

